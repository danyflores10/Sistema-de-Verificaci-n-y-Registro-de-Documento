<?php

namespace App\Imports;

use App\Models\Box;
use App\Models\InternalNote;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * Importador principal que delega a cada hoja del Excel.
 * Lee TODAS las hojas (CAJA 12, CAJA 18, etc.) automáticamente.
 */
class InternalNotesImport implements WithMultipleSheets
{
    use Importable;

    protected int $userId;
    protected string $filePath;
    protected array $sheetImporters = [];

    public function __construct(int $userId, string $filePath = '')
    {
        $this->userId = $userId;
        $this->filePath = $filePath;
    }

    /**
     * Importar TODAS las hojas del archivo Excel dinámicamente.
     * Lee los nombres reales de las hojas del archivo y asigna un importador a cada una.
     */
    public function sheets(): array
    {
        $sheets = [];

        if ($this->filePath && file_exists($this->filePath)) {
            $spreadsheet = IOFactory::load($this->filePath);
            $sheetNames = $spreadsheet->getSheetNames();
            $spreadsheet->disconnectWorksheets();
            unset($spreadsheet);

            foreach ($sheetNames as $name) {
                $importer = new InternalNotesSheetImport($this->userId);
                $this->sheetImporters[] = $importer;
                $sheets[$name] = $importer;
            }
        }

        // Fallback: si no se pudieron leer los nombres, usar hoja 0
        if (empty($sheets)) {
            $importer = new InternalNotesSheetImport($this->userId);
            $this->sheetImporters[] = $importer;
            $sheets[0] = $importer;
        }

        return $sheets;
    }

    public function getImportedCount(): int
    {
        $total = 0;
        foreach ($this->sheetImporters as $imp) {
            $total += $imp->getImportedCount();
        }
        return $total;
    }

    public function getSkippedCount(): int
    {
        $total = 0;
        foreach ($this->sheetImporters as $imp) {
            $total += $imp->getSkippedCount();
        }
        return $total;
    }

    public function getSheetsProcessed(): int
    {
        return count($this->sheetImporters);
    }
}

/**
 * Importador por hoja individual.
 * Mapea las columnas del Excel exactamente:
 *   A: N° DE CAJA
 *   B: N° DE CARPETA
 *   C: N° DE DOCUMENTO  (no hay C en el screenshot original, es C en la columna)
 *   D: (vacío o N° DE DOCUMENTO)
 *   E: FECHA de recepción
 *   F: REFERENCIA
 *   G: DOC. ORIGINAL Y/O FOT.
 *   H: FOJAS
 *   I: OBSERVACIONES
 *   J: TIPO DOCUMENTACIÓN
 */
class InternalNotesSheetImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    use Importable;

    protected int $userId;
    protected static array $boxCache = [];
    protected int $imported = 0;
    protected int $skipped = 0;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * Busca un valor en la fila probando múltiples claves posibles.
     * maatwebsite convierte encabezados a slug, pero los caracteres
     * especiales (°, /, ó, etc.) producen resultados impredecibles.
     */
    private function findValue(array $row, array $keywords, string $default = ''): string
    {
        // Primero intentar claves exactas
        foreach ($keywords as $key) {
            if (isset($row[$key]) && $row[$key] !== null && $row[$key] !== '') {
                return (string) $row[$key];
            }
        }

        // Buscar por coincidencia parcial en las claves de la fila
        foreach ($row as $key => $value) {
            if ($value === null || $value === '') continue;
            $keyLower = strtolower((string) $key);
            foreach ($keywords as $kw) {
                if (str_contains($keyLower, $kw)) {
                    return (string) $value;
                }
            }
        }

        return $default;
    }

    public function model(array $row)
    {
        // ── N° DE CAJA ──
        $boxNumber = trim($this->findValue($row, [
            'n_de_caja', 'no_de_caja', 'n__de_caja', 'ndeg_de_caja',
            'no_caja', 'n_caja', 'numero_de_caja', 'caja',
        ]));

        if (empty($boxNumber)) {
            $this->skipped++;
            return null;
        }

        // Normalizar: mayúsculas + trim + eliminar espacios internos dobles
        $boxNumber = strtoupper(preg_replace('/\s+/', ' ', $boxNumber));

        // Buscar o crear la caja (case-insensitive usando UPPER para evitar duplicados)
        if (!isset(self::$boxCache[$boxNumber])) {
            // Buscar primero con LOWER para evitar duplicados por case
            $box = Box::whereRaw('UPPER(box_number) = ?', [$boxNumber])->first();
            if (!$box) {
                $box = Box::create([
                    'box_number'  => $boxNumber,
                    'description' => 'Importado desde Excel',
                    'created_by'  => $this->userId,
                ]);
            }
            self::$boxCache[$boxNumber] = $box->id;
        }

        // ── N° DE CARPETA ──
        $folderNumber = trim($this->findValue($row, [
            'n_de_carpeta', 'no_de_carpeta', 'n__de_carpeta', 'ndeg_de_carpeta',
            'no_carpeta', 'n_carpeta', 'numero_de_carpeta', 'carpeta',
        ]));

        // ── N° DE DOCUMENTO ──
        $internalNumber = trim($this->findValue($row, [
            'n_de_documento', 'no_de_documento', 'n__de_documento', 'ndeg_de_documento',
            'no_documento', 'n_documento', 'numero_de_documento', 'documento',
        ]));

        // ── FECHA de recepción ──
        $rawDate = $this->findValue($row, [
            'fecha_de_recepcion', 'fecha_de', 'fecha_recepcion', 'fecha', 'recepcion',
        ]);
        $noteDate = $this->parseDate($rawDate);

        // ── REFERENCIA ──
        $reference = trim($this->findValue($row, ['referencia', 'ref']));

        // ── DOC. ORIGINAL Y/O FOT. ──
        $rawDocType = strtoupper(trim($this->findValue($row, [
            'doc_original', 'doc_original_yo_fot', 'doc_original_y_o_fot',
            'original_yo_fot', 'original', 'fot', 'estado_doc',
        ])));
        $docType = match (true) {
            str_contains($rawDocType, 'AMBOS') => 'AMBOS',
            str_contains($rawDocType, 'FOTOCOPIA') => 'FOTOCOPIA',
            str_contains($rawDocType, 'FOTOGRAF') => 'FOTOGRAFÍA',
            str_contains($rawDocType, 'ORIGINAL') => 'ORIGINAL',
            default => 'ORIGINAL',
        };

        // ── FOJAS ──
        $pages = max(1, (int) ($this->findValue($row, ['fojas', 'foja', 'hojas', 'paginas'], '1')));

        // ── OBSERVACIONES ──
        $observations = trim($this->findValue($row, ['observaciones', 'observacion', 'obs']));

        // ── TIPO DOCUMENTACIÓN ──
        $rawNoteType = strtoupper(trim($this->findValue($row, [
            'tipo_documentacion', 'tipo_doc', 'tipo', 'documentacion',
        ])));
        $noteType = match (true) {
            str_contains($rawNoteType, 'INTERNA') => 'NOTA INTERNA',
            str_contains($rawNoteType, 'EXTERNA') && str_contains($rawNoteType, 'CONTRALOR') => 'EVALUACIONES Y/O NOTAS DE LA CONTRALORIA GENERAL DEL ESTADO',
            str_contains($rawNoteType, 'EXTERNA') => 'NOTA EXTERNA',
            str_contains($rawNoteType, 'INFORME') => 'INFORME',
            str_contains($rawNoteType, 'EVALUACION') || str_contains($rawNoteType, 'CONTRALOR') => 'EVALUACIONES Y/O NOTAS DE LA CONTRALORIA GENERAL DEL ESTADO',
            default => 'NOTA INTERNA',
        };

        // ── REMITENTE / DESTINATARIO / VIA (opcionales en el Excel) ──
        $remitente = trim($this->findValue($row, ['remitente', 'de', 'from']));
        $destinatario = trim($this->findValue($row, ['destinatario', 'para', 'to']));
        $via = trim($this->findValue($row, ['via', 'conducto']));

        $this->imported++;

        return new InternalNote([
            'box_id'          => self::$boxCache[$boxNumber],
            'folder_number'   => $folderNumber ?: null,
            'internal_number' => $internalNumber ?: ('IMP-' . $this->imported),
            'note_date'       => $noteDate,
            'reference'       => $reference ?: 'Sin referencia',
            'doc_type'        => $docType,
            'note_type'       => $noteType,
            'pages'           => $pages,
            'observations'    => $observations ?: null,
            'remitente'       => $remitente ?: 'Importado',
            'destinatario'    => $destinatario ?: 'Importado',
            'via'             => $via ?: null,
            'status'          => 'BORRADOR',
            'created_by'      => $this->userId,
        ]);
    }

    private function parseDate(string $rawDate): string
    {
        if (empty($rawDate)) {
            return now()->format('Y-m-d');
        }

        if (is_numeric($rawDate)) {
            try {
                return Date::excelToDateTimeObject((int) $rawDate)->format('Y-m-d');
            } catch (\Exception $e) {
                return now()->format('Y-m-d');
            }
        }

        // Intentar formato dd/mm/yyyy
        if (preg_match('#^(\d{1,2})/(\d{1,2})/(\d{4})$#', $rawDate, $m)) {
            return sprintf('%04d-%02d-%02d', $m[3], $m[2], $m[1]);
        }

        // Intentar formato dd-mm-yyyy
        if (preg_match('#^(\d{1,2})-(\d{1,2})-(\d{4})$#', $rawDate, $m)) {
            return sprintf('%04d-%02d-%02d', $m[3], $m[2], $m[1]);
        }

        try {
            return \Carbon\Carbon::parse($rawDate)->format('Y-m-d');
        } catch (\Exception $e) {
            return now()->format('Y-m-d');
        }
    }

    public function getImportedCount(): int
    {
        return $this->imported;
    }

    public function getSkippedCount(): int
    {
        return $this->skipped;
    }
}

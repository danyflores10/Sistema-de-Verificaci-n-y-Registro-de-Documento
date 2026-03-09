<?php

namespace App\Imports;

use App\Models\Box;
use App\Models\InternalNote;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class InternalNotesImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    use Importable;

    protected int $userId;
    protected array $boxCache = [];
    protected int $imported = 0;

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
        $boxNumber = trim($this->findValue($row, ['n_de_caja', 'no_de_caja', 'n__de_caja', 'caja']));

        if (empty($boxNumber)) {
            return null;
        }

        // Buscar o crear la caja
        if (!isset($this->boxCache[$boxNumber])) {
            $box = Box::firstOrCreate(
                ['box_number' => $boxNumber],
                ['description' => 'Importado desde Excel', 'created_by' => $this->userId]
            );
            $this->boxCache[$boxNumber] = $box->id;
        }

        // Parsear fecha
        $rawDate = $this->findValue($row, ['fecha_de_recepcion', 'fecha', 'recepcion']);
        $noteDate = $this->parseDate($rawDate);

        // Mapear doc_type
        $rawDocType = strtoupper(trim($this->findValue($row, ['doc_original', 'original', 'fot'])));
        $docType = match (true) {
            str_contains($rawDocType, 'AMBOS') => 'AMBOS',
            str_contains($rawDocType, 'FOTOCOPIA') => 'FOTOCOPIA',
            str_contains($rawDocType, 'FOTOGRAF') => 'FOTOGRAFÍA',
            str_contains($rawDocType, 'ORIGINAL') => 'ORIGINAL',
            default => 'ORIGINAL',
        };

        // Mapear note_type
        $rawNoteType = strtoupper(trim($this->findValue($row, ['tipo_documentacion', 'tipo'])));
        $noteType = match (true) {
            str_contains($rawNoteType, 'INTERNA') => 'NOTA INTERNA',
            str_contains($rawNoteType, 'EXTERNA') && str_contains($rawNoteType, 'CONTRALOR') => 'EVALUACIONES Y/O NOTAS DE LA CONTRALORIA GENERAL DEL ESTADO',
            str_contains($rawNoteType, 'EXTERNA') => 'NOTA EXTERNA',
            str_contains($rawNoteType, 'INFORME') => 'INFORME',
            str_contains($rawNoteType, 'EVALUACION') || str_contains($rawNoteType, 'CONTRALOR') => 'EVALUACIONES Y/O NOTAS DE LA CONTRALORIA GENERAL DEL ESTADO',
            default => 'NOTA INTERNA',
        };

        $this->imported++;

        return new InternalNote([
            'box_id'          => $this->boxCache[$boxNumber],
            'internal_number' => trim($this->findValue($row, ['n_de_documento', 'no_de_documento', 'n__de_documento', 'documento'])),
            'note_date'       => $noteDate,
            'reference'       => trim($this->findValue($row, ['referencia'])),
            'doc_type'        => $docType,
            'note_type'       => $noteType,
            'pages'           => max(1, (int) ($this->findValue($row, ['fojas'], '1'))),
            'observations'    => trim($this->findValue($row, ['observaciones'])),
            'remitente'       => trim($this->findValue($row, ['remitente'])),
            'destinatario'    => trim($this->findValue($row, ['destinatario'])),
            'via'             => trim($this->findValue($row, ['via'])),
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
            return Date::excelToDateTimeObject((int) $rawDate)->format('Y-m-d');
        }

        // Intentar formato dd/mm/yyyy
        if (preg_match('#^(\d{1,2})/(\d{1,2})/(\d{4})$#', $rawDate, $m)) {
            return "{$m[3]}-{$m[2]}-{$m[1]}";
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
}

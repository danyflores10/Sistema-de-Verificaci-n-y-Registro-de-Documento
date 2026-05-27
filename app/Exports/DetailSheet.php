<?php

namespace App\Exports;

use App\Http\Controllers\ReportController;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class DetailSheet implements FromCollection, WithTitle, WithEvents, WithColumnWidths
{
    protected int $totalDocs = 0;
    protected int $totalFojas = 0;

    public function __construct(
        protected array $filters,
        protected Collection $notes,
    ) {}

    public function title(): string
    {
        return 'Detalle de Documentos';
    }

    public function collection()
    {
        $rows = collect();
        foreach ($this->notes as $index => $note) {
            $foja = ReportController::parsePagesValue($note->pages);
            $this->totalFojas += $foja;
            $this->totalDocs++;

            $rows->push([
                $index + 1,
                $note->box->box_number ?? '—',
                $note->internal_number,
                optional($note->note_date)->format('d/m/Y') ?? '—',
                $note->reference ?? '',
                $note->doc_type ?? '—',
                $note->note_type ?? '—',
                (string) ($note->pages ?? ''),
                $note->observations ?? '',
                $note->status,
                $note->rejection_reason ?? '',
                $note->creator->name ?? '—',
                $note->verifier->name ?? '—',
                $note->verified_at ? $note->verified_at->format('d/m/Y H:i') : '—',
                $note->created_at->format('d/m/Y H:i'),
            ]);
        }
        return $rows;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5, 'B' => 12, 'C' => 16, 'D' => 12, 'E' => 45,
            'F' => 14, 'G' => 18, 'H' => 10, 'I' => 35, 'J' => 14,
            'K' => 30, 'L' => 22, 'M' => 22, 'N' => 18, 'O' => 18,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastCol = 'O';

                // Insertar 4 filas arriba para el encabezado institucional
                $sheet->insertNewRowBefore(1, 4);

                // === Fila 1: Brand bar ===
                $sheet->mergeCells("A1:{$lastCol}1");
                $sheet->setCellValue('A1', 'AGENCIA BOLIVIANA DE CORREOS');
                $sheet->getRowDimension(1)->setRowHeight(32);
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 15, 'color' => ['argb' => 'FFFFFFFF']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF0C2340']],
                ]);

                // === Fila 2: Subtítulo ===
                $sheet->mergeCells("A2:{$lastCol}2");
                $sheet->setCellValue('A2', 'Detalle de Documentos · Sistema de Verificación');
                $sheet->getRowDimension(2)->setRowHeight(20);
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => ['italic' => true, 'size' => 10, 'color' => ['argb' => 'FFC8102E']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFFFFBEB']],
                    'borders' => ['bottom' => ['borderStyle' => Border::BORDER_MEDIUM, 'color' => ['argb' => 'FFF4B223']]],
                ]);

                // === Fila 3: Meta ===
                $sheet->mergeCells("A3:{$lastCol}3");
                $sheet->setCellValue('A3', sprintf(
                    'Generado: %s   ·   Filtros: %s   ·   Total docs: %d   ·   Total fojas: %d',
                    now()->format('d/m/Y H:i:s'),
                    $this->buildFiltersText(),
                    $this->totalDocs,
                    $this->totalFojas
                ));
                $sheet->getRowDimension(3)->setRowHeight(18);
                $sheet->getStyle('A3')->applyFromArray([
                    'font' => ['size' => 9, 'color' => ['argb' => 'FF475569']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFF1F5F9']],
                ]);

                // === Fila 4: vacía (separador) ===
                $sheet->getRowDimension(4)->setRowHeight(8);

                // === Fila 5: Encabezados ===
                $headings = [
                    'N°', 'N° CAJA', 'N° CITE', 'FECHA', 'REFERENCIA',
                    'ESTADO DOC.', 'NOTA INTERNO', 'FOJAS', 'OBSERVACIONES',
                    'ESTADO', 'MOTIVO RECHAZO', 'CREADO POR', 'VERIFICADO POR',
                    'FECHA VERIFICACIÓN', 'CREADO EN',
                ];
                foreach ($headings as $i => $h) {
                    $col = chr(65 + $i);
                    $sheet->setCellValue("{$col}5", $h);
                }
                $sheet->getStyle("A5:{$lastCol}5")->applyFromArray([
                    'font' => ['bold' => true, 'size' => 9, 'color' => ['argb' => 'FFFFFFFF']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF1E3A5F']],
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => 'FF334155']]],
                ]);
                $sheet->getRowDimension(5)->setRowHeight(30);

                // === Data styling (filas 6+) ===
                if ($this->totalDocs > 0) {
                    $dataStart = 6;
                    $dataEnd = $dataStart + $this->totalDocs - 1;

                    $sheet->getStyle("A{$dataStart}:{$lastCol}{$dataEnd}")->applyFromArray([
                        'font' => ['size' => 9, 'color' => ['argb' => 'FF1F2937']],
                        'alignment' => ['vertical' => Alignment::VERTICAL_TOP, 'wrapText' => true, 'indent' => 1],
                        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => 'FFE2E8F0']]],
                    ]);

                    // Centrar columnas chicas
                    foreach (['A', 'B', 'D', 'H'] as $col) {
                        $sheet->getStyle("{$col}{$dataStart}:{$col}{$dataEnd}")
                              ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    }

                    // N° (A) en navy con fondo claro
                    $sheet->getStyle("A{$dataStart}:A{$dataEnd}")->applyFromArray([
                        'font' => ['bold' => true, 'size' => 9, 'color' => ['argb' => 'FF0C2340']],
                        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFF8FAFC']],
                    ]);
                    // N° CAJA (B) con badge naranja
                    $sheet->getStyle("B{$dataStart}:B{$dataEnd}")->applyFromArray([
                        'font' => ['bold' => true, 'size' => 9, 'color' => ['argb' => 'FF92400E']],
                        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFFEF3C7']],
                    ]);
                    // N° CITE (C) en bold
                    $sheet->getStyle("C{$dataStart}:C{$dataEnd}")->applyFromArray([
                        'font' => ['bold' => true, 'size' => 9, 'color' => ['argb' => 'FF0F172A']],
                    ]);
                    // FOJAS (H) en bold center
                    $sheet->getStyle("H{$dataStart}:H{$dataEnd}")->applyFromArray([
                        'font' => ['bold' => true, 'size' => 10, 'color' => ['argb' => 'FF4338CA']],
                    ]);

                    // Filas alternadas + ESTADO con color
                    for ($r = $dataStart; $r <= $dataEnd; $r++) {
                        // Estado (J)
                        $status = $sheet->getCell("J{$r}")->getValue();
                        $palette = match (strtoupper((string) $status)) {
                            'BORRADOR'   => ['fg' => 'FF92400E', 'bg' => 'FFFEF3C7'],
                            'ENVIADO'    => ['fg' => 'FF075985', 'bg' => 'FFE0F2FE'],
                            'VERIFICADO' => ['fg' => 'FF065F46', 'bg' => 'FFD1FAE5'],
                            'RECHAZADO'  => ['fg' => 'FF991B1B', 'bg' => 'FFFEE2E2'],
                            default      => null,
                        };
                        if ($palette) {
                            $sheet->getStyle("J{$r}")->applyFromArray([
                                'font' => ['bold' => true, 'size' => 9, 'color' => ['argb' => $palette['fg']]],
                                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => $palette['bg']]],
                                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                            ]);
                        }

                        // Filas pares con fondo gris muy claro (excepto cols con color propio)
                        if ($r % 2 === 0) {
                            foreach (['D', 'E', 'F', 'G', 'I', 'K', 'L', 'M', 'N', 'O'] as $col) {
                                $sheet->getStyle("{$col}{$r}")
                                      ->getFill()->setFillType(Fill::FILL_SOLID)
                                      ->getStartColor()->setARGB('FFF8FAFC');
                            }
                        }

                        $sheet->getRowDimension($r)->setRowHeight(20);
                    }

                    // === Fila TOTAL al final ===
                    $totalRow = $dataEnd + 1;
                    $sheet->mergeCells("A{$totalRow}:G{$totalRow}");
                    $sheet->setCellValue("A{$totalRow}", '▸ TOTALES');
                    $sheet->setCellValue("H{$totalRow}", $this->totalFojas);
                    $sheet->mergeCells("I{$totalRow}:{$lastCol}{$totalRow}");
                    $sheet->setCellValue("I{$totalRow}", $this->totalDocs . ' documento(s) procesado(s)');
                    $sheet->getStyle("A{$totalRow}:{$lastCol}{$totalRow}")->applyFromArray([
                        'font' => ['bold' => true, 'size' => 11, 'color' => ['argb' => 'FFFFFFFF']],
                        'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
                        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF0C2340']],
                        'borders' => ['top' => ['borderStyle' => Border::BORDER_THICK, 'color' => ['argb' => 'FFF4B223']]],
                    ]);
                    $sheet->getStyle("A{$totalRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT)->setIndent(2);
                    $sheet->getStyle("H{$totalRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle("I{$totalRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setIndent(2);
                    $sheet->getRowDimension($totalRow)->setRowHeight(28);
                }

                // Congelar header
                $sheet->freezePane('A6');
                $sheet->getSheetView()->setZoomScale(95);
                $sheet->setShowGridlines(false);

                // AutoFilter sobre el header
                if ($this->totalDocs > 0) {
                    $sheet->setAutoFilter("A5:{$lastCol}" . (5 + $this->totalDocs));
                }
            },
        ];
    }

    protected function buildFiltersText(): string
    {
        $parts = [];
        if (!empty($this->filters['box_id']))    $parts[] = 'Caja #' . $this->filters['box_id'];
        if (!empty($this->filters['status']))    $parts[] = 'Estado=' . $this->filters['status'];
        if (!empty($this->filters['date_from'])) $parts[] = 'Desde ' . $this->filters['date_from'];
        if (!empty($this->filters['date_to']))   $parts[] = 'Hasta ' . $this->filters['date_to'];
        if (!empty($this->filters['created_by']))$parts[] = 'Creado por #' . $this->filters['created_by'];
        return empty($parts) ? 'ninguno' : implode(' · ', $parts);
    }
}

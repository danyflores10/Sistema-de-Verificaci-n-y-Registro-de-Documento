<?php

namespace App\Exports;

use App\Http\Controllers\ReportController;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class SummarySheet implements WithTitle, WithEvents, WithColumnWidths
{
    public function __construct(
        protected array $filters,
        protected Collection $notes,
    ) {}

    public function title(): string
    {
        return 'Resumen Ejecutivo';
    }

    public function columnWidths(): array
    {
        return [
            'A' => 4, 'B' => 28, 'C' => 18, 'D' => 18, 'E' => 18, 'F' => 4,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $total       = $this->notes->count();
                $borradores  = $this->notes->where('status', 'BORRADOR')->count();
                $enviados    = $this->notes->where('status', 'ENVIADO')->count();
                $verificados = $this->notes->where('status', 'VERIFICADO')->count();
                $rechazados  = $this->notes->where('status', 'RECHAZADO')->count();
                $totalFojas  = $this->notes->sum(fn ($n) => ReportController::parsePagesValue($n->pages));

                // ════════ Fila 1: Logo/Brand ════════
                $sheet->mergeCells('B2:E2');
                $sheet->setCellValue('B2', 'CORREOS DE BOLIVIA');
                $sheet->getRowDimension(2)->setRowHeight(36);
                $sheet->getStyle('B2')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 18, 'color' => ['argb' => 'FFFFFFFF']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF0C2340']],
                ]);

                // ════════ Fila 3: Subtítulo ════════
                $sheet->mergeCells('B3:E3');
                $sheet->setCellValue('B3', 'Reporte Ejecutivo · Sistema de Verificación de Documentos');
                $sheet->getRowDimension(3)->setRowHeight(22);
                $sheet->getStyle('B3')->applyFromArray([
                    'font' => ['italic' => true, 'size' => 11, 'color' => ['argb' => 'FFC8102E']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFFFFBEB']],
                    'borders' => ['bottom' => ['borderStyle' => Border::BORDER_MEDIUM, 'color' => ['argb' => 'FFF4B223']]],
                ]);

                // ════════ Fila 5: Meta info ════════
                $sheet->mergeCells('B5:E5');
                $sheet->setCellValue('B5', sprintf(
                    'Generado el %s · Filtros: %s',
                    now()->format('d/m/Y H:i:s'),
                    $this->buildFiltersText()
                ));
                $sheet->getStyle('B5')->applyFromArray([
                    'font' => ['size' => 9, 'color' => ['argb' => 'FF475569']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                // ════════ Sección: INDICADORES CLAVE ════════
                $sheet->mergeCells('B7:E7');
                $sheet->setCellValue('B7', '▸ INDICADORES CLAVE');
                $sheet->getRowDimension(7)->setRowHeight(22);
                $sheet->getStyle('B7')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 10, 'color' => ['argb' => 'FF0C2340']],
                    'alignment' => ['vertical' => Alignment::VERTICAL_CENTER, 'indent' => 1],
                    'borders' => ['left' => ['borderStyle' => Border::BORDER_THICK, 'color' => ['argb' => 'FFF4B223']]],
                ]);

                // KPI Cards row (B8:E8 título, B9:E9 valor)
                $kpis = [
                    ['B', 'TOTAL DOCS',  $total,       'FF0C2340', 'FFFFFFFF'],
                    ['C', 'TOTAL FOJAS', $totalFojas,  'FF6366F1', 'FFFFFFFF'],
                    ['D', 'VERIFICADOS', $verificados, 'FF10B981', 'FFFFFFFF'],
                    ['E', 'PENDIENTES',  $enviados,    'FF0EA5E9', 'FFFFFFFF'],
                ];
                foreach ($kpis as [$col, $label, $value, $bg, $fg]) {
                    $sheet->setCellValue("{$col}8", $label);
                    $sheet->setCellValue("{$col}9", $value);
                    $sheet->getStyle("{$col}8")->applyFromArray([
                        'font' => ['bold' => true, 'size' => 8, 'color' => ['argb' => $fg]],
                        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => $bg]],
                    ]);
                    $sheet->getStyle("{$col}9")->applyFromArray([
                        'font' => ['bold' => true, 'size' => 22, 'color' => ['argb' => $bg]],
                        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFF8FAFC']],
                        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => 'FFE2E8F0']]],
                    ]);
                }
                $sheet->getRowDimension(8)->setRowHeight(18);
                $sheet->getRowDimension(9)->setRowHeight(40);

                // ════════ Sección: DISTRIBUCIÓN POR ESTADO ════════
                $sheet->mergeCells('B11:E11');
                $sheet->setCellValue('B11', '▸ DISTRIBUCIÓN POR ESTADO');
                $sheet->getRowDimension(11)->setRowHeight(22);
                $sheet->getStyle('B11')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 10, 'color' => ['argb' => 'FF0C2340']],
                    'alignment' => ['vertical' => Alignment::VERTICAL_CENTER, 'indent' => 1],
                    'borders' => ['left' => ['borderStyle' => Border::BORDER_THICK, 'color' => ['argb' => 'FFF4B223']]],
                ]);

                // Header tabla distribución
                $headers = ['B' => 'ESTADO', 'C' => 'CANTIDAD', 'D' => '%', 'E' => 'BARRA'];
                foreach ($headers as $col => $h) {
                    $sheet->setCellValue("{$col}12", $h);
                }
                $sheet->getStyle('B12:E12')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 9, 'color' => ['argb' => 'FFFFFFFF']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF1E3A5F']],
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => 'FF334155']]],
                ]);
                $sheet->getRowDimension(12)->setRowHeight(20);

                $distribution = [
                    ['BORRADORES',   $borradores,  'FFF59E0B', 'FFFEF3C7'],
                    ['ENVIADOS',     $enviados,    'FF0EA5E9', 'FFE0F2FE'],
                    ['VERIFICADOS',  $verificados, 'FF10B981', 'FFD1FAE5'],
                    ['RECHAZADOS',   $rechazados,  'FFEF4444', 'FFFEE2E2'],
                ];
                $row = 13;
                foreach ($distribution as [$label, $value, $colorBg, $colorLight]) {
                    $pct = $total > 0 ? round($value / $total * 100, 1) : 0;
                    $bar = str_repeat('█', (int) round($pct / 5)); // bloque visual

                    $sheet->setCellValue("B{$row}", $label);
                    $sheet->setCellValue("C{$row}", $value);
                    $sheet->setCellValue("D{$row}", $pct . '%');
                    $sheet->setCellValue("E{$row}", $bar);

                    $sheet->getStyle("B{$row}")->applyFromArray([
                        'font' => ['bold' => true, 'size' => 10, 'color' => ['argb' => $colorBg]],
                        'alignment' => ['vertical' => Alignment::VERTICAL_CENTER, 'indent' => 1],
                        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => $colorLight]],
                        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => 'FFE2E8F0']]],
                    ]);
                    $sheet->getStyle("C{$row}")->applyFromArray([
                        'font' => ['bold' => true, 'size' => 11],
                        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => 'FFE2E8F0']]],
                    ]);
                    $sheet->getStyle("D{$row}")->applyFromArray([
                        'font' => ['bold' => true, 'size' => 10, 'color' => ['argb' => 'FF64748B']],
                        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => 'FFE2E8F0']]],
                    ]);
                    $sheet->getStyle("E{$row}")->applyFromArray([
                        'font' => ['size' => 9, 'color' => ['argb' => $colorBg]],
                        'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER, 'indent' => 1],
                        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => 'FFE2E8F0']]],
                    ]);
                    $sheet->getRowDimension($row)->setRowHeight(20);
                    $row++;
                }

                // Fila TOTAL
                $sheet->setCellValue("B{$row}", 'TOTAL');
                $sheet->setCellValue("C{$row}", $total);
                $sheet->setCellValue("D{$row}", '100%');
                $sheet->setCellValue("E{$row}", '');
                $sheet->getStyle("B{$row}:E{$row}")->applyFromArray([
                    'font' => ['bold' => true, 'size' => 11, 'color' => ['argb' => 'FFFFFFFF']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF0C2340']],
                ]);
                $sheet->getRowDimension($row)->setRowHeight(24);
                $row += 2;

                // ════════ Sección: TASAS Y MÉTRICAS ════════
                $sheet->mergeCells("B{$row}:E{$row}");
                $sheet->setCellValue("B{$row}", '▸ TASAS Y MÉTRICAS');
                $sheet->getRowDimension($row)->setRowHeight(22);
                $sheet->getStyle("B{$row}")->applyFromArray([
                    'font' => ['bold' => true, 'size' => 10, 'color' => ['argb' => 'FF0C2340']],
                    'alignment' => ['vertical' => Alignment::VERTICAL_CENTER, 'indent' => 1],
                    'borders' => ['left' => ['borderStyle' => Border::BORDER_THICK, 'color' => ['argb' => 'FFF4B223']]],
                ]);
                $row++;

                $tasaVerif = $total > 0 ? round($verificados / $total * 100, 1) : 0;
                $tasaRech  = $total > 0 ? round($rechazados / $total * 100, 1) : 0;
                $promFoj   = $total > 0 ? round($totalFojas / $total, 1) : 0;

                $metrics = [
                    ['Tasa de Verificación',  $tasaVerif . ' %', 'FF10B981'],
                    ['Tasa de Rechazo',       $tasaRech . ' %',  'FFEF4444'],
                    ['Promedio Fojas/Doc',    $promFoj,          'FF6366F1'],
                ];
                foreach ($metrics as [$label, $value, $color]) {
                    $sheet->setCellValue("B{$row}", $label);
                    $sheet->mergeCells("C{$row}:E{$row}");
                    $sheet->setCellValue("C{$row}", $value);
                    $sheet->getStyle("B{$row}")->applyFromArray([
                        'font' => ['size' => 10, 'color' => ['argb' => 'FF334155']],
                        'alignment' => ['vertical' => Alignment::VERTICAL_CENTER, 'indent' => 1],
                        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => 'FFE2E8F0']]],
                        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFF8FAFC']],
                    ]);
                    $sheet->getStyle("C{$row}")->applyFromArray([
                        'font' => ['bold' => true, 'size' => 13, 'color' => ['argb' => $color]],
                        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => 'FFE2E8F0']]],
                    ]);
                    $sheet->getRowDimension($row)->setRowHeight(26);
                    $row++;
                }

                // Footer
                $row += 2;
                $sheet->mergeCells("B{$row}:E{$row}");
                $sheet->setCellValue("B{$row}", '© ' . date('Y') . ' · AGBC — Documento confidencial · Generado automáticamente');
                $sheet->getStyle("B{$row}")->applyFromArray([
                    'font' => ['italic' => true, 'size' => 8, 'color' => ['argb' => 'FF94A3B8']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                ]);

                // Ocultar líneas de cuadrícula
                $sheet->setShowGridlines(false);
            },
        ];
    }

    protected function buildFiltersText(): string
    {
        $parts = [];
        if (!empty($this->filters['box_id']))    $parts[] = 'Caja #' . $this->filters['box_id'];
        if (!empty($this->filters['status']))    $parts[] = 'Estado=' . $this->filters['status'];
        if (!empty($this->filters['date_from']))  $parts[] = 'Desde ' . $this->filters['date_from'];
        if (!empty($this->filters['date_to']))    $parts[] = 'Hasta ' . $this->filters['date_to'];
        if (!empty($this->filters['created_by'])) $parts[] = 'Creado por #' . $this->filters['created_by'];
        return empty($parts) ? 'ninguno' : implode(' · ', $parts);
    }
}

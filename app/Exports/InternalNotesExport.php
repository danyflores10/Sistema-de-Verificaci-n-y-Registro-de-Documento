<?php

namespace App\Exports;

use App\Models\InternalNote;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InternalNotesExport implements FromQuery, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    use Exportable;

    protected array $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = InternalNote::query()->with(['box', 'creator', 'verifier']);

        if (!empty($this->filters['box_id'])) {
            $query->where('box_id', $this->filters['box_id']);
        }
        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }
        if (!empty($this->filters['date_from'])) {
            $query->where('note_date', '>=', $this->filters['date_from']);
        }
        if (!empty($this->filters['date_to'])) {
            $query->where('note_date', '<=', $this->filters['date_to']);
        }
        if (!empty($this->filters['created_by'])) {
            $query->where('created_by', $this->filters['created_by']);
        }

        return $query->orderBy('note_date', 'desc');
    }

    public function headings(): array
    {
        return [
            'N°',
            'N° CAJA',
            'N. DE CITE',
            'FECHA',
            'REFERENCIA',
            'ESTADO DOC.',
            'NOTA INTERNO',
            'FOJAS',
            'OBSERVACIONES',
            'ESTADO',
            'MOTIVO RECHAZO',
            'CREADO POR',
            'VERIFICADO POR',
            'FECHA VERIFICACIÓN',
            'CREADO EN',
        ];
    }

    public function map($note): array
    {
        return [
            $note->id,
            $note->box->box_number ?? '-',
            $note->internal_number,
            $note->note_date->format('d/m/Y'),
            $note->reference,
            $note->doc_type,
            $note->note_type ?? '-',
            $note->pages,
            $note->observations ?? '-',
            $note->status,
            $note->rejection_reason ?? '-',
            $note->creator->name ?? '-',
            $note->verifier->name ?? '-',
            $note->verified_at ? $note->verified_at->format('d/m/Y H:i') : '-',
            $note->created_at->format('d/m/Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF1E3A5F'],
                ],
            ],
        ];
    }
}

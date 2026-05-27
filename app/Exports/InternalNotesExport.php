<?php

namespace App\Exports;

use App\Http\Controllers\ReportController;
use App\Models\InternalNote;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class InternalNotesExport implements WithMultipleSheets
{
    use Exportable;

    protected array $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function sheets(): array
    {
        // Cargar la data una sola vez y compartir entre hojas
        $notes = $this->loadNotes();

        return [
            new SummarySheet($this->filters, $notes),
            new DetailSheet($this->filters, $notes),
        ];
    }

    protected function loadNotes()
    {
        $query = InternalNote::query()->with(['box', 'creator', 'verifier']);

        if (!empty($this->filters['box_id']))    $query->where('box_id', $this->filters['box_id']);
        if (!empty($this->filters['status']))    $query->where('status', $this->filters['status']);
        if (!empty($this->filters['date_from'])) $query->where('note_date', '>=', $this->filters['date_from']);
        if (!empty($this->filters['date_to']))   $query->where('note_date', '<=', $this->filters['date_to']);
        if (!empty($this->filters['created_by']))$query->where('created_by', $this->filters['created_by']);

        return $query->orderBy('note_date', 'desc')->get();
    }
}

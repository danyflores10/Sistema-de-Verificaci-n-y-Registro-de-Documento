<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Box;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    public function index(Request $request)
    {
        $query = Box::with('creator')->withCount('internalNotes');

        if ($search = $request->get('search')) {
            $query->where('box_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $boxes = $query->orderBy('box_number')->paginate(15)->withQueryString();

        return view('boxes.index', compact('boxes'));
    }

    public function create()
    {
        $this->authorize('create', Box::class);
        return view('boxes.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Box::class);

        $validated = $request->validate([
            'box_number'  => 'required|string|max:50|unique:boxes,box_number',
            'description' => 'nullable|string|max:500',
        ], [
            'box_number.required' => 'El número de caja es obligatorio.',
            'box_number.unique'   => 'Este número de caja ya existe.',
        ]);

        $box = Box::create([
            ...$validated,
            'created_by' => $request->user()->id,
        ]);

        AuditLog::record('CREAR', 'boxes', $box->id, null, $box->toArray());

        return redirect()->route('boxes.index')
                         ->with('success', 'Caja creada exitosamente.');
    }

    public function edit(Box $box)
    {
        $this->authorize('update', $box);
        return view('boxes.edit', compact('box'));
    }

    public function update(Request $request, Box $box)
    {
        $this->authorize('update', $box);

        $validated = $request->validate([
            'box_number'  => 'required|string|max:50|unique:boxes,box_number,' . $box->id,
            'description' => 'nullable|string|max:500',
        ]);

        $old = $box->toArray();
        $box->update($validated);

        AuditLog::record('EDITAR', 'boxes', $box->id, $old, $box->fresh()->toArray());

        return redirect()->route('boxes.index')
                         ->with('success', 'Caja actualizada exitosamente.');
    }

    public function destroy(Box $box)
    {
        $this->authorize('delete', $box);

        $old = $box->toArray();
        $box->delete();

        AuditLog::record('ELIMINAR', 'boxes', $box->id, $old, null);

        return redirect()->route('boxes.index')
                         ->with('success', 'Caja eliminada exitosamente.');
    }
}

<x-app-layout>
    <div class="abc-page-header">
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold tracking-tight">Documentos</h2>
                <p class="text-sm text-white/70 mt-1">Gestión de documentos internos &mdash; Agencia Boliviana de Correos</p>
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                <a href="{{ route('reports.export.excel', request()->query()) }}" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-xs font-semibold bg-emerald-500 hover:bg-emerald-600 text-white transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                    Excel
                </a>
                <a href="{{ route('reports.export.pdf', request()->query()) }}" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-xs font-semibold bg-red-500 hover:bg-red-600 text-white transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                    PDF
                </a>
                <a href="{{ route('notes.create') }}" class="abc-btn abc-btn-warning">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Nueva Nota
                </a>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Filtros --}}
            <div class="abc-filter-bar">
                <form method="GET" action="{{ route('notes.index') }}" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-7 gap-4 items-end">
                    <div>
                        <label class="abc-label">N° Caja</label>
                        <select name="box_id" class="abc-input">
                            <option value="">-- Todas --</option>
                            @foreach($boxes as $box)
                                <option value="{{ $box->id }}" @selected(request('box_id') == $box->id)>{{ $box->box_number }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="abc-label">N. de CITE</label>
                        <input type="text" name="internal_number" value="{{ request('internal_number') }}"
                               class="abc-input" placeholder="Buscar...">
                    </div>
                    <div>
                        <label class="abc-label">N° Carpeta</label>
                        <input type="text" name="folder_number" value="{{ request('folder_number') }}"
                               class="abc-input" placeholder="Buscar...">
                    </div>
                    <div>
                        <label class="abc-label">Estado</label>
                        <select name="status" class="abc-input">
                            <option value="">-- Todos --</option>
                            <option value="BORRADOR" @selected(request('status') === 'BORRADOR')>BORRADOR</option>
                            <option value="ENVIADO" @selected(request('status') === 'ENVIADO')>ENVIADO</option>
                            <option value="VERIFICADO" @selected(request('status') === 'VERIFICADO')>VERIFICADO</option>
                            <option value="RECHAZADO" @selected(request('status') === 'RECHAZADO')>RECHAZADO</option>
                        </select>
                    </div>
                    <div>
                        <label class="abc-label">Fecha desde</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="abc-input">
                    </div>
                    <div>
                        <label class="abc-label">Fecha hasta</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="abc-input">
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="abc-btn abc-btn-primary">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                            Filtrar
                        </button>
                        <a href="{{ route('notes.index') }}" class="abc-btn abc-btn-ghost text-xs">Limpiar</a>
                    </div>
                </form>
            </div>

            {{-- Contador de resultados --}}
            <div class="flex items-center justify-between mb-3 px-1">
                <p class="text-sm" style="color: var(--text-muted);">
                    Mostrando <span class="font-semibold" style="color: var(--text-primary);">{{ $notes->count() }}</span> de <span class="font-semibold" style="color: var(--text-primary);">{{ $notes->total() }}</span> registros
                </p>
            </div>

            {{-- Tabla profesional (Desktop) --}}
            <div class="abc-card mobile-hide-table" style="border-radius: 0.75rem;">
                <div class="overflow-x-auto">
                    <table class="w-full" style="min-width: 900px;">
                        <thead>
                            <tr style="background: linear-gradient(135deg, var(--abc-navy) 0%, var(--abc-navy-light) 100%);">
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 40px;">N°</th>
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 80px;">N° Caja</th>
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 80px;">N° Carpeta</th>
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 90px;">N. de CITE</th>
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 85px;">Fecha</th>
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider">Referencia</th>
                                <th class="px-3 py-3 text-center text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 80px;">Estado Doc.</th>
                                <th class="px-3 py-3 text-center text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 120px;">Nota Interno</th>
                                <th class="px-3 py-3 text-center text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 50px;">Fojas</th>
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 160px;">Observaciones</th>
                                <th class="px-3 py-3 text-center text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 100px;">Estado</th>
                                <th class="px-3 py-3 text-center text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 90px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y" style="border-color: var(--surface-border-light);">
                            @forelse($notes as $index => $note)
                                <tr class="transition-colors duration-150 hover:bg-blue-50/40 dark:hover:bg-blue-900/10">
                                    <td class="px-3 py-2.5 text-xs font-medium" style="color: var(--text-muted);">{{ $notes->firstItem() + $index }}</td>
                                    <td class="px-3 py-2.5 text-xs font-bold" style="color: var(--text-primary);">{{ $note->box->box_number ?? '-' }}</td>
                                    <td class="px-3 py-2.5 text-xs" style="color: var(--text-secondary);">{{ $note->folder_number ?? '-' }}</td>
                                    <td class="px-3 py-2.5">
                                        <a href="{{ route('notes.show', $note) }}" class="text-xs font-bold hover:underline" style="color: var(--abc-navy);">
                                            {{ $note->internal_number }}
                                        </a>
                                    </td>
                                    <td class="px-3 py-2.5 text-xs" style="color: var(--text-secondary);">{{ $note->note_date->format('d/m/Y') }}</td>
                                    <td class="px-3 py-2.5 text-xs" style="color: var(--text-secondary); max-width: 200px;">
                                        <span class="block truncate" title="{{ $note->reference }}">{{ $note->reference }}</span>
                                    </td>
                                    <td class="px-3 py-2.5 text-center">
                                        <span class="inline-flex px-2 py-0.5 text-[10px] font-semibold rounded-md" style="background-color: var(--surface-border-light); color: var(--text-secondary);">{{ $note->doc_type }}</span>
                                    </td>
                                    <td class="px-3 py-2.5 text-center">
                                        <span class="inline-flex px-2 py-0.5 text-[10px] font-semibold rounded-md" style="background-color: var(--surface-border-light); color: var(--text-secondary);">{{ $note->note_type ?? '-' }}</span>
                                    </td>
                                    <td class="px-3 py-2.5 text-xs text-center font-semibold" style="color: var(--text-primary);">{{ $note->pages }}</td>
                                    <td class="px-3 py-2.5 text-xs" style="color: var(--text-muted); max-width: 160px;">
                                        <span class="block truncate" title="{{ $note->observations }}">{{ $note->observations ?? '-' }}</span>
                                    </td>
                                    <td class="px-3 py-2.5 text-center">
                                        @include('partials.status-badge', ['status' => $note->status])
                                    </td>
                                    <td class="px-3 py-2.5 text-center">
                                        <div class="inline-flex items-center gap-0.5">
                                            <a href="{{ route('notes.show', $note) }}" class="p-1.5 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900/20 transition" style="color: var(--text-muted);" title="Ver">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                                            </a>
                                            @can('update', $note)
                                                <a href="{{ route('notes.edit', $note) }}" class="p-1.5 rounded-md hover:bg-amber-50 dark:hover:bg-amber-900/20 transition" style="color: var(--text-muted);" title="Editar">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"/></svg>
                                                </a>
                                            @endcan
                                            @can('delete', $note)
                                                <form method="POST" action="{{ route('notes.destroy', $note) }}" class="inline" id="delete-form-{{ $note->id }}" onsubmit="event.preventDefault(); confirmarEliminar('{{ $note->internal_number }}', 'delete-form-{{ $note->id }}')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="p-1.5 rounded-md hover:bg-red-50 dark:hover:bg-red-900/20 transition" style="color: var(--text-muted);" title="Eliminar">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center py-16" style="border: none;">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="w-16 h-16 rounded-full flex items-center justify-center" style="background-color: var(--surface-border-light);">
                                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" style="color: var(--text-muted);"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9.75m3 0H9.75m0 0V18m-6-13.5V18a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25V6.108c0-.591-.239-1.16-.659-1.575l-2.847-2.784A2.25 2.25 0 0 0 12.172 1.5H8.25A2.25 2.25 0 0 0 6 3.75Z"/></svg>
                                            </div>
                                            <p class="font-semibold text-sm" style="color: var(--text-muted);">No hay documentos registrados</p>
                                            <a href="{{ route('notes.create') }}" class="abc-btn abc-btn-primary text-xs mt-1">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                                Crear primera nota
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Paginación --}}
                @if($notes->hasPages())
                    <div class="px-5 py-3" style="border-top: 1px solid var(--surface-border);">
                        {{ $notes->links() }}
                    </div>
                @endif
            </div>

            {{-- ═══ MOBILE CARDS VIEW ═══ --}}
            <div class="mobile-show-cards">
                @forelse($notes as $index => $note)
                    <div class="mobile-card-item">
                        {{-- Header del card --}}
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold px-2 py-0.5 rounded-md" style="background: linear-gradient(135deg, var(--abc-navy), var(--abc-navy-light)); color: white;">
                                    {{ $note->box->box_number ?? '-' }}
                                </span>
                                <a href="{{ route('notes.show', $note) }}" class="text-sm font-bold hover:underline" style="color: var(--accent-primary);">
                                    {{ $note->internal_number }}
                                </a>
                            </div>
                            @include('partials.status-badge', ['status' => $note->status])
                        </div>

                        {{-- Referencia (destacada) --}}
                        <p class="text-xs mb-2 line-clamp-2" style="color: var(--text-secondary);" title="{{ $note->reference }}">
                            {{ $note->reference }}
                        </p>

                        {{-- Info grid --}}
                        <div class="grid grid-cols-2 gap-x-4 gap-y-1">
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Fecha</span>
                                <span class="mobile-card-value text-xs">{{ $note->note_date->format('d/m/Y') }}</span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Fojas</span>
                                <span class="mobile-card-value text-xs font-semibold">{{ $note->pages }}</span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Estado Doc.</span>
                                <span class="mobile-card-value text-xs">{{ $note->doc_type }}</span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Tipo</span>
                                <span class="mobile-card-value text-xs truncate">{{ $note->note_type ?? '-' }}</span>
                            </div>
                            @if($note->folder_number)
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Carpeta</span>
                                <span class="mobile-card-value text-xs">{{ $note->folder_number }}</span>
                            </div>
                            @endif
                        </div>

                        @if($note->observations)
                            <p class="text-[11px] mt-1.5 truncate" style="color: var(--text-muted);" title="{{ $note->observations }}">
                                <span class="font-semibold">Obs:</span> {{ $note->observations }}
                            </p>
                        @endif

                        {{-- Acciones --}}
                        <div class="mobile-card-actions">
                            <a href="{{ route('notes.show', $note) }}" class="text-blue-600 bg-blue-50 dark:bg-blue-900/20 dark:text-blue-400 hover:bg-blue-100">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                                Ver
                            </a>
                            @can('update', $note)
                                <a href="{{ route('notes.edit', $note) }}" class="text-amber-600 bg-amber-50 dark:bg-amber-900/20 dark:text-amber-400 hover:bg-amber-100">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"/></svg>
                                    Editar
                                </a>
                            @endcan
                            @can('delete', $note)
                                <form method="POST" action="{{ route('notes.destroy', $note) }}" class="flex-1" id="mobile-delete-{{ $note->id }}" onsubmit="event.preventDefault(); confirmarEliminar('{{ $note->internal_number }}', 'mobile-delete-{{ $note->id }}')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full text-red-600 bg-red-50 dark:bg-red-900/20 dark:text-red-400 hover:bg-red-100 inline-flex items-center justify-center gap-1.5 py-2 rounded-lg text-[11px] font-semibold transition">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                                        Eliminar
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center gap-3 py-12">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center" style="background-color: var(--surface-border-light);">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" style="color: var(--text-muted);"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9.75m3 0H9.75m0 0V18m-6-13.5V18a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25V6.108c0-.591-.239-1.16-.659-1.575l-2.847-2.784A2.25 2.25 0 0 0 12.172 1.5H8.25A2.25 2.25 0 0 0 6 3.75Z"/></svg>
                        </div>
                        <p class="font-semibold text-sm" style="color: var(--text-muted);">No hay documentos registrados</p>
                        <a href="{{ route('notes.create') }}" class="abc-btn abc-btn-primary text-xs mt-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            Crear primera nota
                        </a>
                    </div>
                @endforelse

                {{-- Paginación mobile --}}
                @if($notes->hasPages())
                    <div class="mt-4">
                        {{ $notes->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function confirmarEliminar(cite, formId) {
            Swal.fire({
                title: '¿Eliminar esta nota?',
                html: 'Se eliminará permanentemente el CITE <strong style="color:#ef4444">' + cite + '</strong>.<br>Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
</x-app-layout>

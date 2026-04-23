<x-app-layout>
    <div class="abc-page-header">
            <div class="flex justify-between items-center relative z-10">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight">Gestion de Cajas</h2>
                    <p class="text-white/70 text-sm mt-1">Administracion y control de cajas del sistema</p>
                </div>
                @can('create', App\Models\Box::class)
                    <a href="{{ route('boxes.create') }}" class="abc-btn abc-btn-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                        Nueva Caja
                    </a>
                @endcan
            </div>
        </div>

    <div class="py-6">
        <div class="max-w-[96rem] mx-auto px-3 sm:px-4 lg:px-6 xl:px-8 space-y-6">

            {{-- Filtro de busqueda --}}
            <div class="abc-filter-bar">
                <form method="GET" action="{{ route('boxes.index') }}" class="flex flex-col sm:flex-row gap-4 items-end">
                    <div class="flex-1">
                        <label class="abc-label">Buscar</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="N de caja o descripcion..."
                                   class="abc-input pl-10">
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="abc-btn abc-btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                            </svg>
                            Buscar
                        </button>
                        <a href="{{ route('boxes.index') }}" class="abc-btn abc-btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                            Limpiar
                        </a>
                    </div>
                </form>
            </div>

            {{-- Tabla (Desktop) --}}
            <div class="abc-card mobile-hide-table">
                <div class="overflow-x-auto">
                    <table class="abc-table boxes-table min-w-[1120px] w-full">
                        <thead>
                            <tr>
                                <th class="text-center whitespace-nowrap w-16">ID</th>
                                <th class="whitespace-nowrap w-36">N Caja</th>
                                <th class="whitespace-nowrap w-[420px]">Descripción</th>
                                <th class="text-center whitespace-nowrap w-32">Registros</th>
                                <th class="whitespace-nowrap w-56">Creado por</th>
                                <th class="whitespace-nowrap w-36">Fecha</th>
                                @can('create', App\Models\Box::class)
                                    <th class="text-center whitespace-nowrap w-56">Acciones</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($boxes as $box)
                                <tr>
                                    <td class="font-mono text-sm text-center" style="color: var(--text-muted)">{{ $box->id }}</td>
                                    <td class="font-semibold" style="color: var(--text-primary)">{{ $box->box_number }}</td>
                                    <td class="max-w-[420px]">
                                        <span class="line-clamp-2" style="color: var(--text-secondary)" title="{{ $box->description ?? '-' }}">{{ $box->description ?? '-' }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="abc-badge bg-indigo-50 text-indigo-700 border border-indigo-200">
                                            {{ $box->internal_notes_count }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap font-medium" style="color: var(--text-secondary)">{{ $box->creator->name ?? '-' }}</td>
                                    <td class="whitespace-nowrap" style="color: var(--text-muted)">{{ $box->created_at->format('d/m/Y') }}</td>
                                    @can('create', App\Models\Box::class)
                                        <td>
                                            <div class="flex justify-center gap-2 flex-nowrap">
                                                <a href="{{ route('boxes.edit', $box) }}" class="abc-btn abc-btn-ghost !px-3 !py-1.5 text-xs" title="Editar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                                    </svg>
                                                    Editar
                                                </a>
                                                <form method="POST" action="{{ route('boxes.destroy', $box) }}" class="inline" id="delete-box-{{ $box->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                            onclick="confirmarEliminarCaja('{{ addslashes($box->box_number) }}', {{ $box->internal_notes_count }}, 'delete-box-{{ $box->id }}')"
                                                            class="abc-btn abc-btn-danger !px-3 !py-1.5 text-xs">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                        </svg>
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-12">
                                        <div class="flex flex-col items-center gap-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                            <p class="font-medium" style="color: var(--text-muted)">No hay cajas registradas.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-5 py-4" style="border-top: 1px solid var(--border-primary)">
                    {{ $boxes->links() }}
                </div>
            </div>

            {{-- ═══ MOBILE CARDS VIEW ═══ --}}
            <div class="mobile-show-cards">
                @forelse($boxes as $box)
                    <div class="mobile-card-item">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-bold" style="color: var(--text-primary);">{{ $box->box_number }}</span>
                            <span class="abc-badge bg-indigo-50 text-indigo-700 border border-indigo-200">
                                {{ $box->internal_notes_count }} docs
                            </span>
                        </div>
                        <p class="text-xs truncate mb-1" style="color: var(--text-secondary);">{{ $box->description ?? 'Sin descripción' }}</p>
                        <div class="grid grid-cols-2 gap-x-4 gap-y-1">
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Creado por</span>
                                <span class="mobile-card-value text-xs">{{ $box->creator->name ?? '-' }}</span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Fecha</span>
                                <span class="mobile-card-value text-xs">{{ $box->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        @can('create', App\Models\Box::class)
                            <div class="mobile-card-actions">
                                <a href="{{ route('boxes.edit', $box) }}" class="text-amber-600 bg-amber-50 dark:bg-amber-900/20 dark:text-amber-400 hover:bg-amber-100 rounded-lg">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/></svg>
                                    Editar
                                </a>
                                <form method="POST" action="{{ route('boxes.destroy', $box) }}" class="flex-1" id="mobile-del-box-{{ $box->id }}">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmarEliminarCaja('{{ addslashes($box->box_number) }}', {{ $box->internal_notes_count }}, 'mobile-del-box-{{ $box->id }}')"
                                            class="w-full text-red-600 bg-red-50 dark:bg-red-900/20 dark:text-red-400 hover:bg-red-100 inline-flex items-center justify-center gap-1.5 py-2 rounded-lg text-[11px] font-semibold transition">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        @endcan
                    </div>
                @empty
                    <div class="flex flex-col items-center gap-3 py-12">
                        <svg class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        <p class="font-medium" style="color: var(--text-muted)">No hay cajas registradas.</p>
                    </div>
                @endforelse
                <div class="mt-4">{{ $boxes->links() }}</div>
            </div>
        </div>
    </div>

<style>
    .boxes-table thead th {
        letter-spacing: .04em;
    }

    .boxes-table tbody td {
        vertical-align: middle;
    }
</style>

@push('scripts')
<script>
    function confirmarEliminarCaja(boxNumber, notesCount, formId) {
        let mensaje = `Se eliminará la caja <strong>${boxNumber}</strong> de forma permanente.`;
        if (notesCount > 0) {
            mensaje += `<br><br><span style="color:#dc2626;font-weight:600;">⚠ Esta caja contiene ${notesCount} documento(s) que también serán eliminados.</span>`;
        }

        Swal.fire({
            title: '¿Eliminar caja?',
            html: mensaje,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>
@endpush
</x-app-layout>

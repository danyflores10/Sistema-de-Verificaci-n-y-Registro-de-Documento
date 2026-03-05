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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

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

            {{-- Tabla --}}
            <div class="abc-card">
                <div class="overflow-x-auto">
                    <table class="abc-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>N Caja</th>
                                <th>Descripcion</th>
                                <th class="text-center">Registros</th>
                                <th>Creado por</th>
                                <th>Fecha</th>
                                @can('create', App\Models\Box::class)
                                    <th class="text-center">Acciones</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($boxes as $box)
                                <tr>
                                    <td class="font-mono text-xs" style="color: var(--text-muted)">{{ $box->id }}</td>
                                    <td class="font-semibold" style="color: var(--text-primary)">{{ $box->box_number }}</td>
                                    <td class="max-w-xs truncate" style="color: var(--text-secondary)">{{ $box->description ?? '-' }}</td>
                                    <td class="text-center">
                                        <span class="abc-badge bg-indigo-50 text-indigo-700 border border-indigo-200">
                                            {{ $box->internal_notes_count }}
                                        </span>
                                    </td>
                                    <td style="color: var(--text-secondary)">{{ $box->creator->name ?? '-' }}</td>
                                    <td style="color: var(--text-muted)">{{ $box->created_at->format('d/m/Y') }}</td>
                                    @can('create', App\Models\Box::class)
                                        <td>
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('boxes.edit', $box) }}" class="abc-btn abc-btn-ghost !px-3 !py-1.5 text-xs" title="Editar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                                    </svg>
                                                    Editar
                                                </a>
                                                <form method="POST" action="{{ route('boxes.destroy', $box) }}" class="inline"
                                                      onsubmit="return confirm('Esta seguro de eliminar esta caja?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="abc-btn abc-btn-danger !px-3 !py-1.5 text-xs">
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
        </div>
    </div>
</x-app-layout>

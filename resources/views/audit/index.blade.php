<x-app-layout>
    {{-- Page Header --}}
    <div class="abc-page-header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-white flex items-center gap-3">
                    <svg class="w-7 h-7 text-[var(--abc-yellow)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                    Registro de Auditoría
                </h1>
                <p class="text-blue-200 text-sm mt-1">Seguimiento de todas las acciones del sistema</p>
            </div>
            <div class="text-sm text-blue-200">
                <span class="bg-white/10 backdrop-blur px-3 py-1.5 rounded-lg">{{ $logs->total() }} registros encontrados</span>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-[96rem] mx-auto px-3 sm:px-4 lg:px-6 xl:px-8">

            {{-- Filtros --}}
            <div class="abc-filter-bar">
                <form method="GET" action="{{ route('audit.index') }}" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 items-end">
                    <div>
                        <label class="abc-label">Acción</label>
                        <select name="action" class="abc-input">
                            <option value="">-- Todas --</option>
                            @foreach($actions as $action)
                                <option value="{{ $action }}" @selected(request('action') === $action)>{{ $action }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="abc-label">Entidad</label>
                        <select name="entity" class="abc-input">
                            <option value="">-- Todas --</option>
                            @foreach($entities as $entity)
                                <option value="{{ $entity }}" @selected(request('entity') === $entity)>{{ $entity }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="abc-label">Usuario</label>
                        <select name="user_id" class="abc-input">
                            <option value="">-- Todos --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @selected(request('user_id') == $user->id)>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="abc-label">Desde</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="abc-input">
                    </div>
                    <div>
                        <label class="abc-label">Hasta</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="abc-input">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="abc-btn-primary w-full">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                            Filtrar
                        </button>
                        <a href="{{ route('audit.index') }}" class="abc-btn-outline whitespace-nowrap">Limpiar</a>
                    </div>
                </form>
            </div>

            {{-- Tabla de auditoría --}}
            <div class="abc-card overflow-hidden mobile-hide-table">
                <div class="overflow-x-auto">
                    <table class="abc-table audit-table min-w-[1360px] w-full">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap w-44">Fecha / Hora</th>
                                <th class="whitespace-nowrap w-64">Usuario</th>
                                <th class="whitespace-nowrap w-48">Acción</th>
                                <th class="whitespace-nowrap w-52">Entidad</th>
                                <th class="text-center whitespace-nowrap w-20">ID</th>
                                <th class="whitespace-nowrap w-32">IP</th>
                                <th class="whitespace-nowrap w-[360px]">Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td class="whitespace-nowrap">
                                        <div class="text-xs font-medium text-gray-700">{{ $log->created_at->format('d/m/Y') }}</div>
                                        <div class="text-xs text-gray-400">{{ $log->created_at->format('H:i:s') }}</div>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-gradient-to-br from-[var(--abc-navy)] to-[var(--abc-sky)] text-white flex items-center justify-center text-xs font-bold flex-shrink-0">
                                                {{ $log->user ? strtoupper(substr($log->user->name, 0, 1)) : 'S' }}
                                            </div>
                                            <span class="text-sm text-gray-700">{{ $log->user->name ?? 'Sistema' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $actionColors = [
                                                'CREAR' => 'bg-emerald-100 text-emerald-700 ring-emerald-600/20',
                                                'EDITAR' => 'bg-amber-100 text-amber-700 ring-amber-600/20',
                                                'ELIMINAR' => 'bg-red-100 text-red-700 ring-red-600/20',
                                                'VERIFICAR' => 'bg-emerald-100 text-emerald-700 ring-emerald-600/20',
                                                'RECHAZAR' => 'bg-red-100 text-red-700 ring-red-600/20',
                                                'ENVIAR' => 'bg-sky-100 text-sky-700 ring-sky-600/20',
                                                'LOGIN' => 'bg-indigo-100 text-indigo-700 ring-indigo-600/20',
                                            ];
                                            $color = 'bg-gray-100 text-gray-700 ring-gray-600/20';
                                            foreach ($actionColors as $key => $val) {
                                                if (str_contains($log->action, $key)) { $color = $val; break; }
                                            }
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold ring-1 ring-inset {{ $color }}">
                                            {{ $log->action }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm text-gray-600 bg-gray-100 px-2 py-0.5 rounded">{{ $log->entity }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-sm font-mono text-gray-500">{{ $log->entity_id }}</span>
                                    </td>
                                    <td>
                                        <span class="text-xs font-mono text-gray-400">{{ $log->ip_address ?? '-' }}</span>
                                    </td>
                                    <td>
                                        @if($log->new_values)
                                            <details class="group cursor-pointer" x-data="{ open: false }">
                                                <summary @click="open = !open" class="inline-flex items-center gap-1 text-[var(--abc-sky)] hover:text-[var(--abc-navy)] text-xs font-medium transition-colors">
                                                    <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
                                                    Ver cambios
                                                </summary>
                                                <div class="mt-2 text-xs bg-slate-50 border border-slate-200 p-3 rounded-lg max-w-sm overflow-auto shadow-sm">
                                                    @if($log->old_values)
                                                        <p class="font-semibold text-red-500 mb-1 flex items-center gap-1">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                                            Antes:
                                                        </p>
                                                        <pre class="text-gray-600 bg-white p-2 rounded border text-[10px] leading-relaxed mb-2">{{ json_encode($log->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                    @endif
                                                    <p class="font-semibold text-emerald-600 mb-1 flex items-center gap-1">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                                        Después:
                                                    </p>
                                                    <pre class="text-gray-600 bg-white p-2 rounded border text-[10px] leading-relaxed">{{ json_encode($log->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                </div>
                                            </details>
                                        @else
                                            <span class="text-xs text-gray-300">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-12">
                                        <div class="flex flex-col items-center gap-3">
                                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                            <p class="text-gray-400 text-sm">No hay registros de auditoría</p>
                                            <p class="text-gray-300 text-xs">Los registros aparecerán cuando se realicen acciones en el sistema</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($logs->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                        {{ $logs->links() }}
                    </div>
                @endif
            </div>

            {{-- ═══ MOBILE CARDS VIEW ═══ --}}
            <div class="mobile-show-cards">
                @forelse($logs as $log)
                    <div class="mobile-card-item">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-[var(--abc-navy)] to-[var(--abc-sky)] text-white flex items-center justify-center text-xs font-bold flex-shrink-0">
                                    {{ $log->user ? strtoupper(substr($log->user->name, 0, 1)) : 'S' }}
                                </div>
                                <span class="text-sm font-semibold" style="color: var(--text-primary)">{{ $log->user->name ?? 'Sistema' }}</span>
                            </div>
                            @php
                                $actionColors = [
                                    'CREAR' => 'bg-emerald-100 text-emerald-700',
                                    'EDITAR' => 'bg-amber-100 text-amber-700',
                                    'ELIMINAR' => 'bg-red-100 text-red-700',
                                    'VERIFICAR' => 'bg-emerald-100 text-emerald-700',
                                    'RECHAZAR' => 'bg-red-100 text-red-700',
                                    'ENVIAR' => 'bg-sky-100 text-sky-700',
                                    'LOGIN' => 'bg-indigo-100 text-indigo-700',
                                ];
                                $color = 'bg-gray-100 text-gray-700';
                                foreach ($actionColors as $key => $val) {
                                    if (str_contains($log->action, $key)) { $color = $val; break; }
                                }
                            @endphp
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold {{ $color }}">{{ $log->action }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-x-4 gap-y-1">
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Fecha</span>
                                <span class="mobile-card-value text-xs">{{ $log->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Entidad</span>
                                <span class="mobile-card-value text-xs">{{ $log->entity }}</span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">ID Entidad</span>
                                <span class="mobile-card-value text-xs font-mono">{{ $log->entity_id }}</span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">IP</span>
                                <span class="mobile-card-value text-xs font-mono">{{ $log->ip_address ?? '-' }}</span>
                            </div>
                        </div>
                        @if($log->new_values)
                            <details class="mt-2" x-data="{ open: false }">
                                <summary @click="open = !open" class="inline-flex items-center gap-1 text-[var(--abc-sky)] text-xs font-medium cursor-pointer">
                                    <svg class="w-3.5 h-3.5 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
                                    Ver cambios
                                </summary>
                                <div class="mt-2 text-xs bg-slate-50 dark:bg-slate-800 border p-2 rounded-lg overflow-auto max-h-40">
                                    @if($log->old_values)
                                        <p class="font-semibold text-red-500 mb-1 text-[10px]">Antes:</p>
                                        <pre class="text-[10px] leading-relaxed mb-2 whitespace-pre-wrap">{{ json_encode($log->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                    @endif
                                    <p class="font-semibold text-emerald-600 mb-1 text-[10px]">Después:</p>
                                    <pre class="text-[10px] leading-relaxed whitespace-pre-wrap">{{ json_encode($log->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                </div>
                            </details>
                        @endif
                    </div>
                @empty
                    <div class="flex flex-col items-center gap-3 py-12">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                        <p class="text-sm" style="color: var(--text-muted)">No hay registros de auditoría</p>
                    </div>
                @endforelse
                @if($logs->hasPages())
                    <div class="mt-4">{{ $logs->links() }}</div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .audit-table thead th {
            letter-spacing: .04em;
        }

        .audit-table tbody td {
            vertical-align: middle;
        }
    </style>
</x-app-layout>


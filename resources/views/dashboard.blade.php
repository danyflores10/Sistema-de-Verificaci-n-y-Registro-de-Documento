<x-app-layout>
    {{-- ═══ Hero Header ═══ --}}
    <div class="relative overflow-hidden rounded-none" style="background: linear-gradient(135deg, #0c2340 0%, #1a3c68 40%, #0ea5e9 80%, #0d9488 100%);">
        {{-- Decorative circles --}}
        <div class="absolute -top-12 -right-12 w-64 h-64 rounded-full opacity-10" style="background: radial-gradient(circle, white 0%, transparent 70%);"></div>
        <div class="absolute -bottom-8 -left-8 w-48 h-48 rounded-full opacity-[0.07]" style="background: radial-gradient(circle, white 0%, transparent 70%);"></div>
        <div class="absolute top-1/2 left-1/3 w-32 h-32 rounded-full opacity-[0.05]" style="background: radial-gradient(circle, white 0%, transparent 70%);"></div>

        <div class="relative z-10 px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 rounded-2xl bg-white/15 backdrop-blur-sm flex items-center justify-center border border-white/10 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" /></svg>
                        </div>
                        <div>
                            <p class="text-blue-200/80 text-xs font-medium uppercase tracking-widest">Bienvenido</p>
                            <h1 class="text-2xl lg:text-3xl font-extrabold text-white tracking-tight">Panel de Control</h1>
                        </div>
                    </div>
                    <p class="text-blue-200/70 text-sm ml-0.5">Agencia Boliviana de Correos — Sistema de Verificación de Documentos</p>
                </div>
                <div class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-white/10 backdrop-blur-sm border border-white/10">
                    <svg class="w-4 h-4 text-blue-200/80" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                    <span class="text-white/90 text-sm font-medium">{{ now()->translatedFormat('l, d \\d\\e F \\d\\e Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="px-2 lg:px-0 -mt-6 relative z-10">
        {{-- ═══ Stat Cards ═══ --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            {{-- Total Cajas --}}
            <div class="group relative overflow-hidden rounded-2xl p-5 text-white shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl animate-fade-in-up"
                 style="background: linear-gradient(135deg, #0c2340 0%, #1a3c68 100%);">
                <div class="absolute -top-4 -right-4 w-20 h-20 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-500"></div>
                <div class="absolute -bottom-2 -right-2 w-12 h-12 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-700"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-blue-200/80 text-[11px] font-bold uppercase tracking-wider">Total Cajas</p>
                        <p class="text-4xl font-black mt-1 tracking-tight">{{ $totalBoxes }}</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-sm group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white/80" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" /></svg>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1.5">
                    <div class="h-1 flex-1 rounded-full bg-white/10 overflow-hidden">
                        <div class="h-full rounded-full bg-blue-400/60" style="width: 100%"></div>
                    </div>
                </div>
            </div>

            {{-- Total Notas --}}
            <div class="group relative overflow-hidden rounded-2xl p-5 text-white shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl animate-fade-in-up animate-fade-in-up-delay-1"
                 style="background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%);">
                <div class="absolute -top-4 -right-4 w-20 h-20 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-500"></div>
                <div class="absolute -bottom-2 -right-2 w-12 h-12 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-700"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-sky-100/80 text-[11px] font-bold uppercase tracking-wider">Total Documentos</p>
                        <p class="text-4xl font-black mt-1 tracking-tight">{{ $totalNotes }}</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-sm group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white/80" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1.5">
                    <div class="h-1 flex-1 rounded-full bg-white/10 overflow-hidden">
                        <div class="h-full rounded-full bg-sky-300/60" style="width: 100%"></div>
                    </div>
                </div>
            </div>

            {{-- Verificados --}}
            <div class="group relative overflow-hidden rounded-2xl p-5 text-white shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl animate-fade-in-up animate-fade-in-up-delay-2"
                 style="background: linear-gradient(135deg, #059669 0%, #34d399 100%);">
                <div class="absolute -top-4 -right-4 w-20 h-20 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-500"></div>
                <div class="absolute -bottom-2 -right-2 w-12 h-12 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-700"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100/80 text-[11px] font-bold uppercase tracking-wider">Verificados</p>
                        <p class="text-4xl font-black mt-1 tracking-tight">{{ $verificados }}</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-sm group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white/80" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1.5">
                    <div class="h-1 flex-1 rounded-full bg-white/10 overflow-hidden">
                        <div class="h-full rounded-full bg-emerald-300/60" style="width: {{ $totalNotes > 0 ? round($verificados / $totalNotes * 100) : 0 }}%"></div>
                    </div>
                    <span class="text-[10px] font-bold text-white/60">{{ $totalNotes > 0 ? round($verificados / $totalNotes * 100) : 0 }}%</span>
                </div>
            </div>

            @if(auth()->user()->isAdmin())
            {{-- Pendientes --}}
            <div class="group relative overflow-hidden rounded-2xl p-5 text-white shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl animate-fade-in-up animate-fade-in-up-delay-3"
                 style="background: linear-gradient(135deg, #dc2626 0%, #f87171 100%);">
                <div class="absolute -top-4 -right-4 w-20 h-20 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-500"></div>
                <div class="absolute -bottom-2 -right-2 w-12 h-12 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-700"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-red-100/80 text-[11px] font-bold uppercase tracking-wider">Pendientes</p>
                        <p class="text-4xl font-black mt-1 tracking-tight">{{ $pendientesRevision }}</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-sm group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white/80" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1.5">
                    <div class="h-1 flex-1 rounded-full bg-white/10 overflow-hidden">
                        <div class="h-full rounded-full bg-red-300/60 animate-pulse" style="width: {{ $totalNotes > 0 ? round($pendientesRevision / $totalNotes * 100) : 0 }}%"></div>
                    </div>
                    <span class="text-[10px] font-bold text-white/60">{{ $pendientesRevision }}</span>
                </div>
            </div>
            @endif
        </div>

        {{-- ═══ Status Summary ═══ --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-6">
            <div class="abc-card group hover:shadow-lg transition-all duration-300 p-4 flex items-center gap-3.5 border-l-4 border-l-gray-400">
                <div class="w-11 h-11 rounded-xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <div class="w-3 h-3 rounded-full bg-gray-400"></div>
                </div>
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-wider" style="color: var(--text-muted)">Borradores</p>
                    <p class="text-2xl font-black" style="color: var(--text-primary)">{{ $borradores }}</p>
                </div>
            </div>
            <div class="abc-card group hover:shadow-lg transition-all duration-300 p-4 flex items-center gap-3.5 border-l-4 border-l-sky-500">
                <div class="w-11 h-11 rounded-xl bg-sky-50 dark:bg-sky-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <div class="w-3 h-3 rounded-full bg-sky-500"></div>
                </div>
                <div>
                    <p class="text-[11px] text-sky-600 dark:text-sky-400 font-bold uppercase tracking-wider">Enviados</p>
                    <p class="text-2xl font-black" style="color: var(--text-primary)">{{ $enviados }}</p>
                </div>
            </div>
            <div class="abc-card group hover:shadow-lg transition-all duration-300 p-4 flex items-center gap-3.5 border-l-4 border-l-emerald-500">
                <div class="w-11 h-11 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                </div>
                <div>
                    <p class="text-[11px] text-emerald-600 dark:text-emerald-400 font-bold uppercase tracking-wider">Verificados</p>
                    <p class="text-2xl font-black" style="color: var(--text-primary)">{{ $verificados }}</p>
                </div>
            </div>
            <div class="abc-card group hover:shadow-lg transition-all duration-300 p-4 flex items-center gap-3.5 border-l-4 border-l-red-500">
                <div class="w-11 h-11 rounded-xl bg-red-50 dark:bg-red-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                </div>
                <div>
                    <p class="text-[11px] text-red-600 dark:text-red-400 font-bold uppercase tracking-wider">Rechazados</p>
                    <p class="text-2xl font-black" style="color: var(--text-primary)">{{ $rechazados }}</p>
                </div>
            </div>
        </div>

        {{-- ═══ Recent Records ═══ --}}
        <div class="abc-card overflow-hidden shadow-lg">
            <div class="px-6 py-5 flex items-center justify-between" style="border-bottom: 1px solid var(--surface-border);">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, var(--accent-primary), var(--accent-light));">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold" style="color: var(--text-primary)">Últimos Registros</h3>
                        <p class="text-xs" style="color: var(--text-muted)">Documentos más recientes del sistema</p>
                    </div>
                </div>
                <a href="{{ route('notes.index') }}"
                   class="hidden sm:inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 hover:-translate-x-0.5"
                   style="color: var(--accent-primary); background: var(--accent-primary)10;">
                    Ver todos
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="abc-table">
                    <thead>
                        <tr>
                            <th>N° Caja</th>
                            <th>N° Carpeta</th>
                            <th>N. de CITE</th>
                            <th>Fecha</th>
                            <th>Referencia</th>
                            <th>Estado</th>
                            <th>Creado por</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentNotes as $note)
                            <tr class="group hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors">
                                <td>
                                    <span class="inline-flex items-center gap-1.5 font-bold text-sm" style="color: var(--text-primary)">
                                        <svg class="w-3.5 h-3.5 opacity-40" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" /></svg>
                                        {{ $note->box->box_number ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-sm tabular-nums" style="color: var(--text-secondary)">{{ $note->folder_number ?? '-' }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('notes.show', $note) }}" class="font-bold text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 hover:underline transition-colors">
                                        {{ $note->internal_number }}
                                    </a>
                                </td>
                                <td>
                                    <span class="text-sm tabular-nums" style="color: var(--text-secondary)">{{ $note->note_date->format('d/m/Y') }}</span>
                                </td>
                                <td>
                                    <span class="max-w-xs block truncate text-sm" style="color: var(--text-secondary)">{{ $note->reference }}</span>
                                </td>
                                <td>@include('partials.status-badge', ['status' => $note->status])</td>
                                <td>
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-lg flex items-center justify-center text-white text-[10px] font-bold shadow-sm" style="background: linear-gradient(135deg, var(--accent-primary), var(--accent-light));">
                                            {{ strtoupper(substr($note->creator->name ?? '-', 0, 1)) }}
                                        </div>
                                        <span class="text-sm font-medium" style="color: var(--text-secondary)">{{ $note->creator->name ?? '-' }}</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-12">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-300 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                                        </div>
                                        <p class="font-semibold text-sm" style="color: var(--text-muted)">No hay registros aún</p>
                                        <a href="{{ route('notes.create') }}" class="text-xs font-semibold px-3 py-1.5 rounded-lg transition" style="color: var(--accent-primary); background: var(--accent-primary)10;">
                                            + Crear primer documento
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Mobile: Ver todos link --}}
            <div class="sm:hidden px-6 py-3 text-center" style="border-top: 1px solid var(--surface-border);">
                <a href="{{ route('notes.index') }}" class="text-sm font-semibold" style="color: var(--accent-primary)">Ver todos los documentos →</a>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    {{-- Page Header --}}
    <div class="abc-page-header animate-fade-in-up">
        <div class="relative z-10 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Panel de Control</h1>
                <p class="text-blue-200 text-sm mt-1">Agencia Boliviana de Correos — Sistema de Verificación de Documentos</p>
            </div>
            <div class="hidden md:flex items-center gap-2 text-sm text-blue-200">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                {{ now()->translatedFormat('l, d \\d\\e F \\d\\e Y') }}
            </div>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        {{-- Total Cajas --}}
        <div class="abc-stat-card animate-fade-in-up animate-fade-in-up-delay-1" style="background: linear-gradient(135deg, #0c2340 0%, #1a3c68 100%);">
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <p class="text-blue-200 text-xs font-semibold uppercase tracking-wider">Total Cajas</p>
                    <p class="text-3xl font-extrabold mt-1">{{ $totalBoxes }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" /></svg>
                </div>
            </div>
        </div>

        {{-- Total Notas --}}
        <div class="abc-stat-card animate-fade-in-up animate-fade-in-up-delay-2" style="background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);">
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <p class="text-sky-100 text-xs font-semibold uppercase tracking-wider">Total Notas</p>
                    <p class="text-3xl font-extrabold mt-1">{{ $totalNotes }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                </div>
            </div>
        </div>

        {{-- Verificados --}}
        <div class="abc-stat-card animate-fade-in-up animate-fade-in-up-delay-3" style="background: linear-gradient(135deg, #059669 0%, #34d399 100%);">
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-xs font-semibold uppercase tracking-wider">Verificados</p>
                    <p class="text-3xl font-extrabold mt-1">{{ $verificados }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                </div>
            </div>
        </div>

        @if(auth()->user()->isAdmin())
        {{-- Pendientes --}}
        <div class="abc-stat-card animate-fade-in-up animate-fade-in-up-delay-4" style="background: linear-gradient(135deg, #c8102e 0%, #e63946 100%);">
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-xs font-semibold uppercase tracking-wider">Pendientes Revisión</p>
                    <p class="text-3xl font-extrabold mt-1">{{ $pendientesRevision }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- Status Summary --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="abc-card p-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase" style="color: var(--text-secondary)">Borradores</p>
                <p class="text-xl font-extrabold" style="color: var(--text-primary)">{{ $borradores }}</p>
            </div>
        </div>
        <div class="abc-card p-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-sky-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-sky-500" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>
            </div>
            <div>
                <p class="text-xs text-sky-600 font-semibold uppercase">Enviados</p>
                <p class="text-xl font-extrabold" style="color: var(--text-primary)">{{ $enviados }}</p>
            </div>
        </div>
        <div class="abc-card p-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
            </div>
            <div>
                <p class="text-xs text-emerald-600 font-semibold uppercase">Verificados</p>
                <p class="text-xl font-extrabold" style="color: var(--text-primary)">{{ $verificados }}</p>
            </div>
        </div>
        <div class="abc-card p-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
            </div>
            <div>
                <p class="text-xs text-red-600 font-semibold uppercase">Rechazados</p>
                <p class="text-xl font-extrabold" style="color: var(--text-primary)">{{ $rechazados }}</p>
            </div>
        </div>
    </div>

    {{-- Recent Records --}}
    <div class="abc-card">
        <div class="p-6 flex items-center justify-between" style="border-bottom: 1px solid var(--border-primary)">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg gradient-navy flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                </div>
                <h3 class="text-lg font-bold" style="color: var(--text-primary)">Últimos Registros</h3>
            </div>
            <a href="{{ route('notes.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                Ver todos
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="abc-table">
                <thead>
                    <tr>
                        <th>N° Caja</th>
                        <th>N. de CITE</th>
                        <th>Fecha</th>
                        <th>Referencia</th>
                        <th>Estado</th>
                        <th>Creado por</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentNotes as $note)
                        <tr>
                            <td class="font-semibold" style="color: var(--text-primary)">{{ $note->box->box_number ?? '-' }}</td>
                            <td>
                                <a href="{{ route('notes.show', $note) }}" class="text-blue-600 hover:text-blue-800 font-semibold hover:underline">
                                    {{ $note->internal_number }}
                                </a>
                            </td>
                            <td>{{ $note->note_date->format('d/m/Y') }}</td>
                            <td class="max-w-xs truncate">{{ $note->reference }}</td>
                            <td>@include('partials.status-badge', ['status' => $note->status])</td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full gradient-navy flex items-center justify-center text-white text-[10px] font-bold">
                                        {{ strtoupper(substr($note->creator->name ?? '-', 0, 1)) }}
                                    </div>
                                    {{ $note->creator->name ?? '-' }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                                    <p class="font-medium" style="color: var(--text-muted)">No hay registros aún</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

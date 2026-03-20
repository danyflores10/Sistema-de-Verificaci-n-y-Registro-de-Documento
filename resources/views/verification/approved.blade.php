<x-app-layout>
    <div class="abc-page-header">
        <div class="flex justify-between items-center relative z-10">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center border border-white/20">
                    <svg class="w-6 h-6 text-[var(--abc-gold)]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold tracking-tight">Documentos Aprobados</h2>
                    <p class="text-white/70 text-sm mt-0.5">Historial de documentos verificados y aprobados</p>
                </div>
            </div>
            <span class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 text-sm font-bold">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                {{ $total }} aprobado(s) en total
            </span>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-5">

            {{-- Filtros --}}
            <div class="abc-card p-5 animate-fade-in-up">
                <form method="GET" action="{{ route('verification.approved') }}" class="flex flex-wrap gap-3 items-end">
                    <div class="flex-1 min-w-[160px]">
                        <label class="abc-label text-xs">Desde</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="abc-input !py-2">
                    </div>
                    <div class="flex-1 min-w-[160px]">
                        <label class="abc-label text-xs">Hasta</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="abc-input !py-2">
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label class="abc-label text-xs">Buscar</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="CITE, referencia, remitente..."
                               class="abc-input !py-2">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="abc-btn abc-btn-primary !py-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                            Filtrar
                        </button>
                        @if(request('date_from') || request('date_to') || request('search'))
                            <a href="{{ route('verification.approved') }}" class="abc-btn abc-btn-ghost !py-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                                Limpiar
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Tabla (Desktop) --}}
            <div class="abc-card animate-fade-in-up mobile-hide-table">
                <div class="overflow-x-auto">
                    <table class="abc-table">
                        <thead style="background: linear-gradient(135deg, #059669, #34d399);">
                            <tr>
                                <th class="!text-white">#</th>
                                <th class="!text-white">N. Caja</th>
                                <th class="!text-white">N. de CITE</th>
                                <th class="!text-white">Fecha Doc.</th>
                                <th class="!text-white">Remitente</th>
                                <th class="!text-white">Destinatario</th>
                                <th class="!text-white">Referencia</th>
                                <th class="!text-white text-center">Fojas</th>
                                <th class="!text-white">Aprobado por</th>
                                <th class="!text-white">Fecha Aprobación</th>
                                <th class="!text-white text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notes as $note)
                                <tr>
                                    <td class="font-mono text-xs" style="color: var(--text-muted)">{{ $note->id }}</td>
                                    <td class="font-semibold" style="color: var(--text-primary)">{{ $note->box->box_number ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('notes.show', $note) }}" class="text-emerald-600 hover:text-emerald-800 hover:underline font-medium">
                                            {{ $note->internal_number }}
                                        </a>
                                    </td>
                                    <td style="color: var(--text-secondary)">{{ $note->note_date->format('d/m/Y') }}</td>
                                    <td style="color: var(--text-secondary)">{{ $note->remitente ?? '-' }}</td>
                                    <td style="color: var(--text-secondary)">{{ $note->destinatario ?? '-' }}</td>
                                    <td class="max-w-xs truncate" style="color: var(--text-secondary)">{{ $note->reference }}</td>
                                    <td class="text-center">
                                        <span class="abc-badge bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            {{ $note->pages }}
                                        </span>
                                    </td>
                                    <td style="color: var(--text-secondary)">{{ $note->verifier->name ?? '-' }}</td>
                                    <td style="color: var(--text-secondary)">
                                        {{ $note->verified_at ? $note->verified_at->format('d/m/Y H:i') : '-' }}
                                    </td>
                                    <td>
                                        <div class="flex justify-center">
                                            <a href="{{ route('notes.show', $note) }}" class="abc-btn abc-btn-ghost !px-3 !py-1.5 text-xs">
                                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                                Ver
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center py-12">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="w-14 h-14 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20 flex items-center justify-center">
                                                <svg class="w-7 h-7 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                                                </svg>
                                            </div>
                                            <p class="font-semibold" style="color: var(--text-secondary)">
                                                @if(request('date_from') || request('date_to') || request('search'))
                                                    No se encontraron documentos con esos filtros
                                                @else
                                                    No hay documentos aprobados aún
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($notes->hasPages())
                    <div class="px-5 py-4 border-t" style="border-color: var(--surface-border);">
                        {{ $notes->links() }}
                    </div>
                @endif
            </div>

            {{-- ═══ MOBILE CARDS VIEW ═══ --}}
            <div class="mobile-show-cards">
                @forelse($notes as $note)
                    <div class="mobile-card-item">
                        {{-- Header --}}
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="text-xs font-bold px-2 py-0.5 rounded-md" style="background: linear-gradient(135deg, #059669, #34d399); color: white;">
                                    {{ $note->box->box_number ?? '-' }}
                                </span>
                                <a href="{{ route('notes.show', $note) }}" class="text-sm font-bold hover:underline text-emerald-600">
                                    {{ $note->internal_number }}
                                </a>
                            </div>
                            <span class="text-xs font-medium text-emerald-700 bg-emerald-50 border border-emerald-200 px-2 py-0.5 rounded-md">
                                ✓ Aprobado
                            </span>
                        </div>

                        {{-- Referencia --}}
                        <p class="text-xs mb-2 line-clamp-2" style="color: var(--text-secondary);" title="{{ $note->reference }}">
                            {{ $note->reference }}
                        </p>

                        {{-- Info grid --}}
                        <div class="grid grid-cols-2 gap-x-4 gap-y-1">
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Fecha Doc.</span>
                                <span class="mobile-card-value text-xs">{{ $note->note_date->format('d/m/Y') }}</span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Fojas</span>
                                <span class="mobile-card-value text-xs font-semibold">{{ $note->pages }}</span>
                            </div>
                            @if($note->remitente)
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Remitente</span>
                                <span class="mobile-card-value text-xs truncate">{{ $note->remitente }}</span>
                            </div>
                            @endif
                            @if($note->destinatario)
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Destinatario</span>
                                <span class="mobile-card-value text-xs truncate">{{ $note->destinatario }}</span>
                            </div>
                            @endif
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Aprobado por</span>
                                <span class="mobile-card-value text-xs">{{ $note->verifier->name ?? '-' }}</span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Fecha Aprob.</span>
                                <span class="mobile-card-value text-xs">{{ $note->verified_at ? $note->verified_at->format('d/m/Y') : '-' }}</span>
                            </div>
                        </div>

                        {{-- Acciones --}}
                        <div class="mobile-card-actions">
                            <a href="{{ route('notes.show', $note) }}" class="text-emerald-600 bg-emerald-50 hover:bg-emerald-100">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>
                                Ver Documento
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center gap-3 py-12">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center">
                            <svg class="w-7 h-7 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                        <p class="font-semibold text-sm" style="color: var(--text-muted);">
                            @if(request('date_from') || request('date_to') || request('search'))
                                No se encontraron documentos con esos filtros
                            @else
                                No hay documentos aprobados aún
                            @endif
                        </p>
                    </div>
                @endforelse

                @if($notes->hasPages())
                    <div class="mt-4">
                        {{ $notes->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

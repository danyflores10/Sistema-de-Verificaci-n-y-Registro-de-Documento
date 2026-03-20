<x-app-layout>
    <div class="abc-page-header">
        <div class="flex justify-between items-center relative z-10">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center border border-white/20">
                    <svg class="w-6 h-6 text-[var(--abc-gold)]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold tracking-tight">Bandeja de Verificación</h2>
                    <p class="text-white/70 text-sm mt-0.5">Notas internas con estado ENVIADO pendientes de revisión</p>
                </div>
            </div>
            @if($notes->total() > 0)
                <span class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 text-sm font-bold">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    {{ $notes->total() }} pendiente(s)
                </span>
            @endif
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Tabla --}}
            <div class="abc-card animate-fade-in-up mobile-hide-table">
                <div class="overflow-x-auto">
                    <table class="abc-table">
                        <thead style="background: linear-gradient(135deg, #f4b223, #ffd166);">
                            <tr>
                                <th class="!text-gray-900">#</th>
                                <th class="!text-gray-900">N. Caja</th>
                                <th class="!text-gray-900">N. de CITE</th>
                                <th class="!text-gray-900">Fecha</th>
                                <th class="!text-gray-900">Referencia</th>
                                <th class="!text-gray-900 text-center">Fojas</th>
                                <th class="!text-gray-900">Creado por</th>
                                <th class="!text-gray-900 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notes as $note)
                                <tr x-data="{ showReject: false }">
                                    <td class="font-mono text-xs" style="color: var(--text-muted)">{{ $note->id }}</td>
                                    <td class="font-semibold" style="color: var(--text-primary)">{{ $note->box->box_number ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('notes.show', $note) }}" class="text-blue-600 hover:text-blue-800 hover:underline font-medium">
                                            {{ $note->internal_number }}
                                        </a>
                                    </td>
                                    <td style="color: var(--text-secondary)">{{ $note->note_date->format('d/m/Y') }}</td>
                                    <td class="max-w-xs truncate" style="color: var(--text-secondary)">{{ $note->reference }}</td>
                                    <td class="text-center">
                                        <span class="abc-badge bg-indigo-50 text-indigo-700 border border-indigo-200">
                                            {{ $note->pages }}
                                        </span>
                                    </td>
                                    <td style="color: var(--text-secondary)">{{ $note->creator->name ?? '-' }}</td>
                                    <td>
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('notes.show', $note) }}" class="abc-btn abc-btn-ghost !px-3 !py-1.5 text-xs">
                                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                                                Ver Detalle
                                            </a>
                                            <form method="POST" action="{{ route('verification.verify', $note) }}" id="approve-form-{{ $note->id }}">
                                                @csrf
                                                <button type="button"
                                                        onclick="confirmarAprobacion('{{ $note->internal_number }}', 'approve-form-{{ $note->id }}')"
                                                        class="abc-btn abc-btn-success !px-3 !py-1.5 text-xs">
                                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                                    Aprobar
                                                </button>
                                            </form>
                                            <button @click="showReject = !showReject" type="button"
                                                    class="abc-btn abc-btn-danger !px-3 !py-1.5 text-xs">
                                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                                                Rechazar
                                            </button>
                                        </div>

                                        {{-- Formulario de rechazo inline --}}
                                        <div x-show="showReject"
                                             x-transition:enter="transition ease-out duration-200"
                                             x-transition:enter-start="opacity-0 -translate-y-2"
                                             x-transition:enter-end="opacity-100 translate-y-0"
                                             x-transition:leave="transition ease-in duration-150"
                                             x-transition:leave-start="opacity-100 translate-y-0"
                                             x-transition:leave-end="opacity-0 -translate-y-2"
                                             x-cloak
                                             class="mt-3 p-4 rounded-xl border border-red-200 dark:border-red-800/50 text-left"
                                             style="background: var(--surface-card);">
                                            <div class="flex items-center gap-2 mb-3">
                                                <div class="w-6 h-6 rounded-lg bg-red-100 dark:bg-red-900/40 flex items-center justify-center">
                                                    <svg class="w-3.5 h-3.5 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>
                                                </div>
                                                <p class="text-xs font-bold text-red-600 dark:text-red-400">Motivo de Rechazo</p>
                                            </div>
                                            <form method="POST" action="{{ route('verification.reject', $note) }}">
                                                @csrf
                                                <textarea name="rejection_reason" rows="2" required
                                                          class="abc-input text-xs mb-3"
                                                          placeholder="Describa el motivo de rechazo..."></textarea>
                                                <div class="flex justify-end gap-2">
                                                    <button @click="showReject = false" type="button" class="abc-btn abc-btn-ghost !px-3 !py-1.5 text-xs">
                                                        Cancelar
                                                    </button>
                                                    <button type="submit" class="abc-btn abc-btn-danger !px-3 !py-1.5 text-xs">
                                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                                                        Confirmar Rechazo
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-12">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="w-16 h-16 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20 flex items-center justify-center">
                                                <svg class="h-8 w-8 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                                </svg>
                                            </div>
                                            <p class="font-semibold" style="color: var(--text-primary)">¡Todo al día!</p>
                                            <p class="text-sm" style="color: var(--text-muted)">No hay notas pendientes de verificación</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($notes->hasPages())
                    <div class="px-5 py-4" style="border-top: 1px solid var(--surface-border)">
                        {{ $notes->links() }}
                    </div>
                @endif
            </div>

            {{-- ═══ MOBILE CARDS VIEW ═══ --}}
            <div class="mobile-show-cards">
                @forelse($notes as $note)
                    <div class="mobile-card-item" x-data="{ showReject: false }">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold px-2 py-0.5 rounded-md" style="background: linear-gradient(135deg, var(--abc-navy), var(--abc-navy-light)); color: white;">
                                    {{ $note->box->box_number ?? '-' }}
                                </span>
                                <a href="{{ route('notes.show', $note) }}" class="text-sm font-bold hover:underline" style="color: var(--accent-primary);">
                                    {{ $note->internal_number }}
                                </a>
                            </div>
                            <span class="abc-badge abc-badge-enviado text-[10px]">ENVIADO</span>
                        </div>
                        <p class="text-xs mb-2 line-clamp-2" style="color: var(--text-secondary);">{{ $note->reference }}</p>
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
                                <span class="mobile-card-label">Creado por</span>
                                <span class="mobile-card-value text-xs truncate">{{ $note->creator->name ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="mobile-card-actions">
                            <a href="{{ route('notes.show', $note) }}" class="text-blue-600 bg-blue-50 dark:bg-blue-900/20 dark:text-blue-400 hover:bg-blue-100 rounded-lg">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                                Ver
                            </a>
                            <form method="POST" action="{{ route('verification.verify', $note) }}" class="flex-1" id="mobile-approve-{{ $note->id }}">
                                @csrf
                                <button type="button" onclick="confirmarAprobacion('{{ $note->internal_number }}', 'mobile-approve-{{ $note->id }}')"
                                        class="w-full text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20 dark:text-emerald-400 hover:bg-emerald-100 inline-flex items-center justify-center gap-1.5 py-2 rounded-lg text-[11px] font-semibold transition">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                    Aprobar
                                </button>
                            </form>
                            <button @click="showReject = !showReject" type="button"
                                    class="text-red-600 bg-red-50 dark:bg-red-900/20 dark:text-red-400 hover:bg-red-100 rounded-lg inline-flex items-center justify-center gap-1.5 py-2 text-[11px] font-semibold transition">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                                Rechazar
                            </button>
                        </div>
                        {{-- Rechazo inline móvil --}}
                        <div x-show="showReject" x-transition x-cloak class="mt-3 p-3 rounded-xl border border-red-200 dark:border-red-800/50" style="background: var(--surface-card);">
                            <p class="text-xs font-bold text-red-600 dark:text-red-400 mb-2">Motivo de Rechazo</p>
                            <form method="POST" action="{{ route('verification.reject', $note) }}">
                                @csrf
                                <textarea name="rejection_reason" rows="2" required class="abc-input text-xs mb-2" placeholder="Describa el motivo..."></textarea>
                                <div class="flex gap-2">
                                    <button @click="showReject = false" type="button" class="abc-btn abc-btn-ghost !px-3 !py-1.5 text-xs flex-1">Cancelar</button>
                                    <button type="submit" class="abc-btn abc-btn-danger !px-3 !py-1.5 text-xs flex-1">Confirmar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center gap-3 py-12">
                        <div class="w-16 h-16 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20 flex items-center justify-center">
                            <svg class="h-8 w-8 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" /></svg>
                        </div>
                        <p class="font-semibold" style="color: var(--text-primary)">¡Todo al día!</p>
                        <p class="text-sm" style="color: var(--text-muted)">No hay notas pendientes de verificación</p>
                    </div>
                @endforelse
                @if($notes->hasPages())
                    <div class="mt-4">{{ $notes->links() }}</div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function confirmarAprobacion(cite, formId) {
            Swal.fire({
                title: '¿Aprobar esta nota?',
                html: 'Estás a punto de verificar y aprobar el CITE <strong style="color:#10b981">' + cite + '</strong>.<br>Esta acción cambiará su estado a <strong>VERIFICADO</strong>.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
                customClass: {
                    popup: 'swal2-border-radius',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
</x-app-layout>

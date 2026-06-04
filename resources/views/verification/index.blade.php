<x-app-layout>
<div x-data="verificationPage()" @keydown.escape.window="closeRejectModal()">
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
        <div class="w-full space-y-6">

            {{-- Barra de acciones masivas (visible al seleccionar) --}}
            <div class="flex items-center justify-end gap-3 flex-wrap" x-show="selectedIds.length > 0" x-cloak>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-amber-100 text-amber-800"
                      x-text="`${selectedIds.length} de ${selectableIds.length} seleccionado(s)`"></span>
                <button type="button" @click="clearSelection()"
                        class="text-xs font-medium text-gray-500 hover:text-red-600 transition">
                    Limpiar
                </button>
                <button type="button" class="abc-bulk-btn abc-bulk-btn--green" @click="confirmBulkVerify()" :disabled="processing" title="Aprobar seleccionados">
                    <div class="svg-wrapper-1">
                        <div class="svg-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path fill="currentColor" d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"></path>
                            </svg>
                        </div>
                    </div>
                    <span>Aprobar</span>
                </button>
                <button type="button" class="abc-bulk-btn abc-bulk-btn--red" @click="openRejectModal()" :disabled="processing" title="Rechazar seleccionados">
                    <div class="svg-wrapper-1">
                        <div class="svg-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path fill="currentColor" d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"></path>
                            </svg>
                        </div>
                    </div>
                    <span>Rechazar</span>
                </button>
            </div>

            {{-- Tabla --}}
            <div class="abc-card animate-fade-in-up mobile-hide-table">
                <div class="overflow-x-auto">
                    <table class="abc-table verification-table min-w-[1260px] w-full">
                        <thead style="background: linear-gradient(135deg, #f4b223, #ffd166);">
                            <tr>
                                <th class="text-center" style="width: 44px;">
                                    <input type="checkbox" class="abc-checkbox" :checked="allSelected()" @change="toggleAll()" :disabled="selectableIds.length === 0" title="Seleccionar todos">
                                </th>
                                <th class="!text-gray-900 whitespace-nowrap text-center w-14">#</th>
                                <th class="!text-gray-900 whitespace-nowrap w-28">N° Caja</th>
                                <th class="!text-gray-900 whitespace-nowrap w-[290px]">N° de Documento</th>
                                <th class="!text-gray-900 whitespace-nowrap w-28">Fecha</th>
                                <th class="!text-gray-900 whitespace-nowrap w-[320px]">Referencia</th>
                                <th class="!text-gray-900 text-center whitespace-nowrap w-24">Fojas</th>
                                <th class="!text-gray-900 whitespace-nowrap w-44">Creado por</th>
                                <th class="!text-gray-900 text-center whitespace-nowrap w-[260px]">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notes as $note)
                                <tr x-data="{ showReject: false }" :class="isSelected({{ $note->id }}) ? 'bg-amber-50/60 dark:bg-amber-900/10' : ''">
                                    <td class="text-center">
                                        <input type="checkbox" class="abc-checkbox"
                                               :checked="isSelected({{ $note->id }})"
                                               @change="toggleOne({{ $note->id }})">
                                    </td>
                                    <td class="font-mono text-sm text-center" style="color: var(--text-muted)">{{ $note->id }}</td>
                                    <td class="font-semibold" style="color: var(--text-primary)">{{ $note->box->box_number ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('notes.show', $note) }}" class="line-clamp-2 text-blue-600 hover:text-blue-800 hover:underline font-semibold" title="{{ $note->internal_number }}">
                                            {{ $note->internal_number }}
                                        </a>
                                    </td>
                                    <td class="whitespace-nowrap font-medium" style="color: var(--text-secondary)">{{ $note->note_date->format('d/m/Y') }}</td>
                                    <td class="max-w-[320px]">
                                        <span class="line-clamp-2" style="color: var(--text-secondary)" title="{{ $note->reference }}">{{ $note->reference }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="abc-badge bg-indigo-50 text-indigo-700 border border-indigo-200">
                                            {{ $note->pages }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap font-medium" style="color: var(--text-secondary)">{{ $note->creator->name ?? '-' }}</td>
                                    <td>
                                        <div class="flex justify-center gap-2 flex-nowrap">
                                            <a href="{{ route('notes.show', $note) }}" class="abc-btn abc-btn-ghost !px-3 !py-1.5 text-xs">
                                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                                                Ver Detalle
                                            </a>
                                            <form method="POST" action="{{ route('verification.verify', $note) }}" id="approve-form-{{ $note->id }}">
                                                @csrf
                                                <button type="button"
                                                        onclick="confirmarAprobacion('{{ $note->internal_number }}', 'approve-form-{{ $note->id }}')"
                                                        class="abc-bulk-btn abc-bulk-btn--green abc-bulk-btn--sm">
                                                    <div class="svg-wrapper-1">
                                                        <div class="svg-wrapper">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18">
                                                                <path fill="none" d="M0 0h24v24H0z"></path>
                                                                <path fill="currentColor" d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"></path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <span>Aprobar</span>
                                                </button>
                                            </form>
                                            <button @click="showReject = !showReject" type="button"
                                                    class="abc-bulk-btn abc-bulk-btn--red abc-bulk-btn--sm">
                                                <div class="svg-wrapper-1">
                                                    <div class="svg-wrapper">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18">
                                                            <path fill="none" d="M0 0h24v24H0z"></path>
                                                            <path fill="currentColor" d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <span>Rechazar</span>
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
                                    <td colspan="9" class="text-center py-12">
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
                                <input type="checkbox" class="abc-checkbox"
                                       :checked="isSelected({{ $note->id }})"
                                       @change="toggleOne({{ $note->id }})">
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

    {{-- Formulario oculto: aprobación masiva --}}
    <form method="POST" action="{{ route('verification.bulk-verify') }}" x-ref="bulkVerifyForm" class="hidden">
        @csrf
        <template x-for="id in selectedIds" :key="`v-${id}`">
            <input type="hidden" name="note_ids[]" :value="id">
        </template>
    </form>

    {{-- ═══ MODAL: RECHAZO MASIVO ═══ --}}
    <div x-show="rejectModalOpen" x-cloak
         class="fixed inset-0 z-[60] flex items-center justify-center p-4"
         style="background: rgba(15, 23, 42, 0.55);"
         @click.self="closeRejectModal()">
        <div x-show="rejectModalOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-3 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             class="w-full max-w-md rounded-2xl overflow-hidden shadow-2xl"
             style="background-color: var(--surface-card);">

            <div class="px-5 py-4 flex items-center gap-2.5" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                <h3 class="text-white font-bold text-base">Rechazar documentos</h3>
            </div>

            <form method="POST" action="{{ route('verification.bulk-reject') }}" x-ref="bulkRejectForm" @submit.prevent="submitReject()">
                @csrf
                <template x-for="id in selectedIds" :key="`r-${id}`">
                    <input type="hidden" name="note_ids[]" :value="id">
                </template>

                <div class="p-5 space-y-4">
                    <p class="text-sm" style="color: var(--text-secondary);">
                        Se rechazarán <strong x-text="selectedIds.length" style="color: var(--text-primary);"></strong>
                        documento(s) seleccionado(s). Indique el motivo de rechazo (se aplicará a todos):
                    </p>
                    <div>
                        <label class="abc-label">Motivo de rechazo *</label>
                        <textarea x-model="rejectReason" name="rejection_reason" rows="3" required
                                  class="abc-input text-sm" placeholder="Describa el motivo de rechazo..."></textarea>
                    </div>
                </div>

                <div class="px-5 py-4 flex items-center justify-end gap-3 border-t" style="background-color: var(--surface-card-hover); border-color: var(--surface-border);">
                    <button type="button" @click="closeRejectModal()"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-semibold transition-colors duration-200"
                            style="color: var(--text-secondary); background-color: var(--surface-input);">
                        Cancelar
                    </button>
                    <button type="submit" class="abc-bulk-btn abc-bulk-btn--red" :disabled="!rejectReason.trim() || processing">
                        <div class="svg-wrapper-1">
                            <div class="svg-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path fill="currentColor" d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"></path>
                                </svg>
                            </div>
                        </div>
                        <span x-text="processing ? 'Rechazando...' : 'Rechazar'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>{{-- fin x-data="verificationPage()" --}}

    <script id="verification-selectable-ids" type="application/json">
        @json($verifiableIds)
    </script>

    <script>
        function verificationPage() {
            const node = document.getElementById('verification-selectable-ids');
            let ids = [];
            if (node) {
                try { ids = JSON.parse(node.textContent || '[]'); } catch (e) { ids = []; }
            }

            return {
                selectableIds: Array.isArray(ids) ? ids.map(Number) : [],
                selectedIds: [],
                rejectModalOpen: false,
                rejectReason: '',
                processing: false,

                toggleOne(id) {
                    id = Number(id);
                    const i = this.selectedIds.indexOf(id);
                    if (i === -1) { this.selectedIds.push(id); }
                    else { this.selectedIds.splice(i, 1); }
                },
                isSelected(id) {
                    return this.selectedIds.includes(Number(id));
                },
                allSelected() {
                    return this.selectableIds.length > 0
                        && this.selectedIds.length === this.selectableIds.length;
                },
                toggleAll() {
                    this.selectedIds = this.allSelected() ? [] : [...this.selectableIds];
                },
                clearSelection() {
                    this.selectedIds = [];
                },
                confirmBulkVerify() {
                    if (this.selectedIds.length === 0) {
                        if (Alpine.store('toasts')) Alpine.store('toasts').error('Seleccione al menos un documento.');
                        return;
                    }
                    Swal.fire({
                        title: '¿Aprobar documentos seleccionados?',
                        html: `Se verificarán <strong style="color:#10b981">${this.selectedIds.length}</strong> documento(s).<br>Pasarán a estado <strong>VERIFICADO</strong>.`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#10b981',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Sí, aprobar',
                        cancelButtonText: 'Cancelar',
                        reverseButtons: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.processing = true;
                            this.$refs.bulkVerifyForm.submit();
                        }
                    });
                },
                openRejectModal() {
                    if (this.selectedIds.length === 0) {
                        if (Alpine.store('toasts')) Alpine.store('toasts').error('Seleccione al menos un documento.');
                        return;
                    }
                    this.rejectReason = '';
                    this.processing = false;
                    this.rejectModalOpen = true;
                    document.body.style.overflow = 'hidden';
                },
                closeRejectModal() {
                    this.rejectModalOpen = false;
                    this.processing = false;
                    document.body.style.overflow = '';
                },
                submitReject() {
                    if (!this.rejectReason.trim()) {
                        if (Alpine.store('toasts')) Alpine.store('toasts').error('Indique el motivo de rechazo.');
                        return;
                    }
                    this.processing = true;
                    this.$refs.bulkRejectForm.submit();
                },
            };
        }

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

    <style>
        [x-cloak] { display: none !important; }

        .verification-table thead th {
            letter-spacing: .04em;
        }

        .verification-table tbody td {
            vertical-align: middle;
        }

        /* Checkbox de selección */
        .abc-checkbox {
            width: 1.05rem;
            height: 1.05rem;
            border-radius: 0.3rem;
            border: 1.5px solid var(--surface-border, #cbd5e1);
            accent-color: royalblue;
            cursor: pointer;
            vertical-align: middle;
        }
        .abc-checkbox:disabled { opacity: 0.4; cursor: not-allowed; }

        /* Botones masivos animados (Uiverse by adamgiebl) — verde/rojo */
        .abc-bulk-btn {
            font-family: inherit;
            font-size: 15px;
            color: white;
            padding: 0.55em 1em;
            padding-left: 0.85em;
            display: flex;
            align-items: center;
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.2s;
            cursor: pointer;
        }
        .abc-bulk-btn span {
            display: block;
            margin-left: 0.3em;
            transition: all 0.3s ease-in-out;
        }
        .abc-bulk-btn svg {
            display: block;
            transform-origin: center center;
            transition: transform 0.3s ease-in-out;
        }
        .abc-bulk-btn:hover:not(:disabled) .svg-wrapper {
            animation: abc-fly-1 0.6s ease-in-out infinite alternate;
        }
        .abc-bulk-btn:hover:not(:disabled) svg {
            transform: translateX(1.2em) rotate(45deg) scale(1.1);
        }
        .abc-bulk-btn:hover:not(:disabled) span {
            transform: translateX(5em);
        }
        .abc-bulk-btn:active:not(:disabled) { transform: scale(0.95); }
        .abc-bulk-btn:disabled { opacity: 0.55; cursor: not-allowed; box-shadow: none; }

        .abc-bulk-btn--green { background: #10b981; box-shadow: 0 4px 12px -2px rgba(16, 185, 129, 0.5); }
        .abc-bulk-btn--red   { background: #ef4444; box-shadow: 0 4px 12px -2px rgba(239, 68, 68, 0.5); }

        /* Variante compacta para botones dentro de la fila */
        .abc-bulk-btn--sm { font-size: 13px; padding: 0.4em 0.75em; padding-left: 0.65em; border-radius: 10px; }
        .abc-bulk-btn--sm:hover:not(:disabled) span { transform: translateX(3.5em); }

        @keyframes abc-fly-1 {
            from { transform: translateY(0.1em); }
            to   { transform: translateY(-0.1em); }
        }
    </style>
</x-app-layout>

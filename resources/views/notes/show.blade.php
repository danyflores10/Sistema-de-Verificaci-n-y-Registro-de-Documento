<x-app-layout>
    <div class="abc-page-header">
            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-bold tracking-tight">Documento: {{ $note->internal_number }}</h2>
                        <p class="text-sm text-white/70 mt-1">Detalle completo del documento</p>
                    </div>
                    <div class="ml-2">
                        @include('partials.status-badge', ['status' => $note->status])
                    </div>
                </div>
                <div class="flex gap-2">
                    @can('update', $note)
                        <a href="{{ route('notes.edit', $note) }}" class="abc-btn abc-btn-warning">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"/></svg>
                            Editar
                        </a>
                    @endcan
                    <a href="{{ route('notes.index') }}" class="abc-btn abc-btn-ghost !bg-white/10 !text-white hover:!bg-white/20">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                        Volver
                    </a>
                </div>
            </div>
        </div>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            {{-- Motivo de rechazo --}}
            @if($note->isRechazado() && $note->rejection_reason)
                <div class="mb-6 abc-card border-l-4 !border-l-red-500 !rounded-l-none">
                    <div class="p-5 flex items-start gap-3">
                        <div class="w-9 h-9 rounded-lg gradient-red flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-red-700 uppercase tracking-wide">Motivo de rechazo</p>
                            <p class="text-sm text-red-600 mt-1">{{ $note->rejection_reason }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Detalle de la nota --}}
            <div class="abc-card mb-6">
                <div class="gradient-navy px-6 py-4 flex items-center gap-3">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                    <h3 class="text-white font-semibold">Detalle del Registro</h3>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        <div>
                            <span class="text-[11px] uppercase font-bold tracking-wider" style="color: var(--text-muted)">N. Caja</span>
                            <p class="font-semibold mt-0.5" style="color: var(--text-primary)">{{ $note->box->box_number ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-[11px] uppercase font-bold tracking-wider" style="color: var(--text-muted)">N. de CITE</span>
                            <p class="font-semibold mt-0.5" style="color: var(--text-primary)">{{ $note->internal_number }}</p>
                        </div>
                        <div>
                            <span class="text-[11px] uppercase font-bold tracking-wider" style="color: var(--text-muted)">Fecha</span>
                            <p class="font-semibold mt-0.5" style="color: var(--text-primary)">{{ $note->note_date->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <span class="text-[11px] uppercase font-bold tracking-wider" style="color: var(--text-muted)">Estado del Documento</span>
                            <p class="font-semibold mt-0.5" style="color: var(--text-primary)">{{ $note->doc_type }}</p>
                        </div>
                        <div>
                            <span class="text-[11px] uppercase font-bold tracking-wider" style="color: var(--text-muted)">Nota Interno</span>
                            <p class="font-semibold mt-0.5" style="color: var(--text-primary)">{{ $note->note_type ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-[11px] uppercase font-bold tracking-wider" style="color: var(--text-muted)">Fojas</span>
                            <p class="font-semibold mt-0.5" style="color: var(--text-primary)">{{ $note->pages }}</p>
                        </div>
                        <div>
                            <span class="text-[11px] uppercase font-bold tracking-wider" style="color: var(--text-muted)">Creado por</span>
                            <p class="font-semibold mt-0.5" style="color: var(--text-primary)">{{ $note->creator->name ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="mt-5 pt-5" style="border-top: 1px solid var(--border-primary)">
                        <span class="text-[11px] uppercase font-bold tracking-wider" style="color: var(--text-muted)">Referencia</span>
                        <p class="mt-1" style="color: var(--text-secondary)">{{ $note->reference }}</p>
                    </div>

                    @if($note->observations)
                        <div class="mt-5 pt-5" style="border-top: 1px solid var(--border-primary)">
                            <span class="text-[11px] uppercase font-bold tracking-wider" style="color: var(--text-muted)">Observaciones</span>
                            <p class="mt-1" style="color: var(--text-secondary)">{{ $note->observations }}</p>
                        </div>
                    @endif

                    @if($note->verifier)
                        <div class="mt-5 pt-5" style="border-top: 1px solid var(--border-primary)">
                            <span class="text-[11px] uppercase font-bold tracking-wider" style="color: var(--text-muted)">Verificado por</span>
                            <p class="font-semibold mt-0.5" style="color: var(--text-primary)">{{ $note->verifier->name }} &mdash; {{ $note->verified_at?->format('d/m/Y H:i') }}</p>
                        </div>
                    @endif

                    {{-- Botones de accion de estado --}}
                    <div class="mt-6 pt-5 flex flex-wrap gap-3" style="border-top: 1px solid var(--border-primary)">
                        @can('send', $note)
                            <form method="POST" action="{{ route('notes.send', $note) }}" id="send-form-{{ $note->id }}">
                                @csrf
                                <button type="button" onclick="confirmarEnvio('{{ $note->internal_number }}', 'send-form-{{ $note->id }}')" class="abc-btn abc-btn-primary">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/></svg>
                                    Enviar para Revisión
                                </button>
                            </form>
                        @endcan

                        @can('verify', $note)
                            <form method="POST" action="{{ route('verification.verify', $note) }}" id="verify-form-{{ $note->id }}">
                                @csrf
                                <button type="button" onclick="confirmarAprobacion('{{ $note->internal_number }}', 'verify-form-{{ $note->id }}')" class="abc-btn abc-btn-success">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                    Verificar / Aprobar
                                </button>
                            </form>

                            <div x-data="{ showReject: false }">
                                <button @click="showReject = !showReject" type="button" class="abc-btn abc-btn-danger">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                    Rechazar
                                </button>

                                {{-- Formulario de rechazo --}}
                                <div x-show="showReject" x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
                                     class="mt-4 abc-card border-l-4 !border-l-red-500 !rounded-l-none" x-cloak>
                                    <div class="p-5">
                                        <form method="POST" action="{{ route('verification.reject', $note) }}">
                                            @csrf
                                            <label class="abc-label text-red-700">Motivo de rechazo *</label>
                                            <textarea name="rejection_reason" rows="3" required
                                                      class="abc-input !border-red-200 !focus:border-red-400 !focus:ring-red-100"
                                                      placeholder="Indique el motivo de rechazo..."></textarea>
                                            @error('rejection_reason')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                            <div class="mt-3 flex justify-end">
                                                <button type="submit" class="abc-btn abc-btn-danger">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                                    Confirmar Rechazo
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>

            {{-- Adjuntos --}}
            <div class="abc-card mb-6">
                <div class="gradient-navy px-6 py-4 flex items-center gap-3">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13"/></svg>
                    <h3 class="text-white font-semibold">Adjuntos ({{ $note->attachments->count() }})</h3>
                </div>

                <div class="p-6">
                    @if($note->attachments->count())
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach($note->attachments as $attachment)
                                <div class="flex items-center justify-between p-4 rounded-xl" style="background-color: var(--surface-card-hover); border: 1px solid var(--border-primary)">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg gradient-navy flex items-center justify-center flex-shrink-0">
                                            @if(str_contains($attachment->mime_type, 'pdf'))
                                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                                            @else
                                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5a2.25 2.25 0 0 0 2.25-2.25V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/></svg>
                                            @endif
                                        </div>
                                        <div>
                                            <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank"
                                               class="text-sm font-semibold text-abc-navy hover:underline">
                                                {{ $attachment->original_name }}
                                            </a>
                                            <p class="text-xs mt-0.5" style="color: var(--text-muted)">
                                                {{ $attachment->mime_type }} -- {{ number_format($attachment->file_size / 1024, 1) }} KB
                                                -- Subido por {{ $attachment->uploader->name ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                    <a href="{{ asset('storage/' . $attachment->file_path) }}" download
                                       class="inline-flex items-center justify-center w-9 h-9 rounded-lg hover:text-blue-600 hover:bg-blue-50 transition" style="color: var(--text-muted)" title="Descargar">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13"/></svg>
                            <p class="text-sm font-medium" style="color: var(--text-muted)">No hay archivos adjuntos</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Historial de auditoria --}}
            <div class="abc-card">
                <div class="gradient-navy px-6 py-4 flex items-center gap-3">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                    <h3 class="text-white font-semibold">Historial de Cambios</h3>
                </div>

                <div class="p-6">
                    @if($auditLogs->count())
                        <div class="relative">
                            {{-- Linea conectora vertical --}}
                            <div class="absolute left-[7px] top-3 bottom-3 w-0.5 bg-gray-200"></div>

                            <div class="space-y-5">
                                @foreach($auditLogs as $log)
                                    <div class="relative flex items-start gap-4 pl-6">
                                        {{-- Punto de color --}}
                                        <div class="absolute left-0 top-1 w-[15px] h-[15px] rounded-full border-2 border-white shadow-sm flex-shrink-0
                                            @if(str_contains($log->action, 'CREAR')) bg-emerald-500
                                            @elseif(str_contains($log->action, 'EDITAR')) bg-amber-500
                                            @elseif(str_contains($log->action, 'ENVIAR')) bg-blue-500
                                            @elseif(str_contains($log->action, 'VERIFICAR')) bg-emerald-500
                                            @elseif(str_contains($log->action, 'RECHAZAR')) bg-red-500
                                            @elseif(str_contains($log->action, 'ELIMINAR')) bg-gray-500
                                            @else bg-gray-400
                                            @endif
                                        "></div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm" style="color: var(--text-secondary)">
                                                <span class="font-bold" style="color: var(--text-primary)">{{ $log->user->name ?? 'Sistema' }}</span>
                                                realizo
                                                <span class="font-semibold text-abc-navy">{{ $log->action }}</span>
                                            </p>
                                            <p class="text-xs mt-0.5" style="color: var(--text-muted)">
                                                {{ $log->created_at->format('d/m/Y H:i:s') }}
                                                @if($log->ip_address) -- IP: {{ $log->ip_address }} @endif
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                            <p class="text-sm font-medium" style="color: var(--text-muted)">Sin historial de cambios</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmarEnvio(cite, formId) {
            Swal.fire({
                title: '¿Enviar para revisión?',
                html: 'Se enviará el CITE <strong style="color:#0ea5e9">' + cite + '</strong> para su verificación.<br>Una vez enviado, no podrás editarlo.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0c2340',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
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
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
</x-app-layout>

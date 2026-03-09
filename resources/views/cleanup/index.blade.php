<x-app-layout>
    <div class="abc-page-header">
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-3">
                <svg class="w-7 h-7 text-red-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
                <div>
                    <h2 class="text-2xl font-bold tracking-tight">Limpieza de Documentos</h2>
                    <p class="text-sm text-white/70 mt-1">Eliminación masiva de documentos del sistema</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Alerta de peligro --}}
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-start gap-3">
                <svg class="w-6 h-6 text-red-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
                <div>
                    <p class="text-sm font-bold text-red-700">Zona de peligro</p>
                    <p class="text-xs text-red-600 mt-0.5">Las eliminaciones son permanentes y no se pueden deshacer. Se eliminarán los documentos y todos sus archivos adjuntos.</p>
                </div>
            </div>

            {{-- Filtros --}}
            <div class="abc-filter-bar">
                <form method="GET" action="{{ route('cleanup.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                    <div>
                        <label class="abc-label">Caja</label>
                        <select name="box_id" class="abc-input">
                            <option value="">-- Todas --</option>
                            @foreach($boxes as $box)
                                <option value="{{ $box->id }}" @selected(request('box_id') == $box->id)>{{ $box->box_number }}</option>
                            @endforeach
                        </select>
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
                        <label class="abc-label">Desde</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="abc-input">
                    </div>
                    <div>
                        <label class="abc-label">Hasta</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="abc-input">
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="abc-btn abc-btn-primary">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                            Filtrar
                        </button>
                        <a href="{{ route('cleanup.index') }}" class="abc-btn abc-btn-ghost text-xs">Limpiar</a>
                    </div>
                </form>
            </div>

            {{-- Tabla con selección --}}
            <form method="POST" action="{{ route('cleanup.destroy-selected') }}" id="bulk-delete-form"
                  x-data="{
                      selectedIds: [],
                      allSelected: false,
                      toggleAll(checked) {
                          this.allSelected = checked;
                          if (checked) {
                              this.selectedIds = Array.from(document.querySelectorAll('.note-checkbox')).map(cb => cb.value);
                          } else {
                              this.selectedIds = [];
                          }
                      },
                      toggle(id) {
                          let idx = this.selectedIds.indexOf(id);
                          if (idx > -1) {
                              this.selectedIds.splice(idx, 1);
                          } else {
                              this.selectedIds.push(id);
                          }
                          this.allSelected = this.selectedIds.length === document.querySelectorAll('.note-checkbox').length;
                      }
                  }">
                @csrf

                {{-- Barra de acciones --}}
                <div class="flex items-center justify-between mb-3 px-1">
                    <p class="text-sm" style="color: var(--text-muted);">
                        Mostrando <span class="font-semibold" style="color: var(--text-primary);">{{ $notes->count() }}</span> de <span class="font-semibold" style="color: var(--text-primary);">{{ $notes->total() }}</span> registros
                        <span x-show="selectedIds.length > 0" x-cloak class="ml-2 text-red-600 font-semibold">
                            — <span x-text="selectedIds.length"></span> seleccionado(s)
                        </span>
                    </p>
                    <div class="flex gap-2">
                        <button type="button" x-show="selectedIds.length > 0" x-cloak
                                onclick="confirmarEliminarSeleccionados()"
                                class="abc-btn abc-btn-danger text-xs">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                            Eliminar Seleccionados
                        </button>
                        <button type="button" onclick="confirmarEliminarTodo()"
                                class="abc-btn text-xs bg-red-800 hover:bg-red-900 text-white">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                            Eliminar TODO
                        </button>
                    </div>
                </div>

                <div class="abc-card" style="border-radius: 0.75rem;">
                    <div class="overflow-x-auto">
                        <table class="w-full" style="min-width: 800px;">
                            <thead>
                                <tr style="background: linear-gradient(135deg, #991b1b 0%, #dc2626 100%);">
                                    <th class="px-3 py-3 text-center" style="width: 40px;">
                                        <input type="checkbox" class="rounded border-white/50"
                                               @change="toggleAll($event.target.checked)"
                                               :checked="allSelected">
                                    </th>
                                    <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 40px;">N°</th>
                                    <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider">N° Caja</th>
                                    <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider">N. de CITE</th>
                                    <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider">Fecha</th>
                                    <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider">Referencia</th>
                                    <th class="px-3 py-3 text-center text-[10px] font-bold text-white/90 uppercase tracking-wider">Estado</th>
                                    <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider">Creado por</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y" style="border-color: var(--surface-border-light);">
                                @forelse($notes as $index => $note)
                                    <tr class="transition-colors duration-150 hover:bg-red-50/40"
                                        :class="selectedIds.includes('{{ $note->id }}') ? 'bg-red-50' : ''">
                                        <td class="px-3 py-2.5 text-center">
                                            <input type="checkbox" name="note_ids[]" value="{{ $note->id }}"
                                                   class="note-checkbox rounded border-gray-300"
                                                   @change="toggle('{{ $note->id }}')"
                                                   :checked="selectedIds.includes('{{ $note->id }}')">
                                        </td>
                                        <td class="px-3 py-2.5 text-xs font-medium" style="color: var(--text-muted);">{{ $notes->firstItem() + $index }}</td>
                                        <td class="px-3 py-2.5 text-xs font-bold" style="color: var(--text-primary);">{{ $note->box->box_number ?? '-' }}</td>
                                        <td class="px-3 py-2.5 text-xs font-bold" style="color: var(--abc-navy);">{{ $note->internal_number }}</td>
                                        <td class="px-3 py-2.5 text-xs" style="color: var(--text-secondary);">{{ $note->note_date->format('d/m/Y') }}</td>
                                        <td class="px-3 py-2.5 text-xs" style="color: var(--text-secondary); max-width: 200px;">
                                            <span class="block truncate" title="{{ $note->reference }}">{{ $note->reference }}</span>
                                        </td>
                                        <td class="px-3 py-2.5 text-center">
                                            @include('partials.status-badge', ['status' => $note->status])
                                        </td>
                                        <td class="px-3 py-2.5 text-xs" style="color: var(--text-secondary);">{{ $note->creator->name ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-16" style="border: none;">
                                            <div class="flex flex-col items-center gap-3">
                                                <div class="w-16 h-16 rounded-full flex items-center justify-center bg-green-50">
                                                    <svg class="w-8 h-8 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                                </div>
                                                <p class="font-semibold text-sm" style="color: var(--text-muted);">No hay documentos que eliminar</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($notes->hasPages())
                        <div class="px-5 py-3" style="border-top: 1px solid var(--surface-border);">
                            {{ $notes->links() }}
                        </div>
                    @endif
                </div>
            </form>

            {{-- Formulario oculto para eliminar todo --}}
            <form method="POST" action="{{ route('cleanup.destroy-all') }}" id="delete-all-form" class="hidden">
                @csrf
                <input type="hidden" name="confirm_text" id="confirm_text_input">
            </form>

            {{-- Formulario oculto para limpiar sistema --}}
            <form method="POST" action="{{ route('cleanup.destroy-system') }}" id="delete-system-form" class="hidden">
                @csrf
                <input type="hidden" name="confirm_text" id="confirm_system_input">
            </form>

            {{-- Secci\u00f3n: Limpiar Sistema Completo --}}
            <div class="abc-card" style="border: 2px solid #dc2626; border-radius: 0.75rem;">
                <div class="p-5">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #dc2626, #991b1b);">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-red-700">Limpiar Sistema Completo</h3>
                            <p class="text-sm mt-1" style="color: var(--text-secondary);">
                                Elimina <strong>todos los datos</strong> del sistema excepto los usuarios: documentos, cajas, adjuntos y registros de auditor\u00eda.
                                Ideal para preparar el sistema antes de subir a producci\u00f3n.
                            </p>
                            <div class="mt-3">
                                <button type="button" onclick="confirmarLimpiarSistema()"
                                        class="abc-btn text-xs text-white font-bold"
                                        style="background: linear-gradient(135deg, #dc2626, #7f1d1d);">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                                    </svg>
                                    Limpiar Todo el Sistema
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmarEliminarSeleccionados() {
            const form = document.getElementById('bulk-delete-form');
            const count = form.querySelectorAll('.note-checkbox:checked').length;

            Swal.fire({
                title: '¿Eliminar documentos seleccionados?',
                html: 'Se eliminarán <strong style="color:#ef4444">' + count + ' documento(s)</strong> permanentemente junto con sus archivos adjuntos.<br><br>Esta acción <strong>NO se puede deshacer</strong>.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#b91c1c',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        function confirmarEliminarTodo() {
            Swal.fire({
                title: '¡ELIMINAR TODOS LOS DOCUMENTOS!',
                html: 'Esta acción eliminará <strong style="color:#ef4444">TODOS</strong> los documentos del sistema permanentemente.<br><br>Escriba <strong>ELIMINAR TODO</strong> para confirmar:',
                icon: 'error',
                input: 'text',
                inputPlaceholder: 'ELIMINAR TODO',
                showCancelButton: true,
                confirmButtonColor: '#7f1d1d',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Eliminar todo permanentemente',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
                inputValidator: (value) => {
                    if (value !== 'ELIMINAR TODO') {
                        return 'Debe escribir "ELIMINAR TODO" exactamente';
                    }
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('confirm_text_input').value = result.value;
                    document.getElementById('delete-all-form').submit();
                }
            });
        }

        function confirmarLimpiarSistema() {
            Swal.fire({
                title: '¡LIMPIAR SISTEMA COMPLETO!',
                html: 'Esta acción eliminará <strong style="color:#ef4444">TODOS</strong> los datos del sistema:<br><br>' +
                      '<ul style="text-align:left;margin:0 auto;max-width:280px;line-height:1.8;">' +
                      '<li>✗ Todos los documentos</li>' +
                      '<li>✗ Todas las cajas</li>' +
                      '<li>✗ Todos los adjuntos</li>' +
                      '<li>✗ Registros de auditoría</li>' +
                      '<li>✓ <strong>Usuarios se mantienen</strong></li>' +
                      '</ul><br>Escriba <strong>LIMPIAR SISTEMA</strong> para confirmar:',
                icon: 'error',
                input: 'text',
                inputPlaceholder: 'LIMPIAR SISTEMA',
                showCancelButton: true,
                confirmButtonColor: '#7f1d1d',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Limpiar todo el sistema',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
                inputValidator: (value) => {
                    if (value !== 'LIMPIAR SISTEMA') {
                        return 'Debe escribir "LIMPIAR SISTEMA" exactamente';
                    }
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('confirm_system_input').value = result.value;
                    document.getElementById('delete-system-form').submit();
                }
            });
        }
    </script>
</x-app-layout>

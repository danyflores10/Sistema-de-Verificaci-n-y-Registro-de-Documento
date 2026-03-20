<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

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

            
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-start gap-3">
                <svg class="w-6 h-6 text-red-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
                <div>
                    <p class="text-sm font-bold text-red-700">Zona de peligro</p>
                    <p class="text-xs text-red-600 mt-0.5">Las eliminaciones son permanentes y no se pueden deshacer. Se eliminarán los documentos y todos sus archivos adjuntos.</p>
                </div>
            </div>

            
            <div class="abc-filter-bar">
                <form method="GET" action="<?php echo e(route('cleanup.index')); ?>" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                    <div>
                        <label class="abc-label">Caja</label>
                        <select name="box_id" class="abc-input">
                            <option value="">-- Todas --</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $boxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $box): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <option value="<?php echo e($box->id); ?>" <?php if(request('box_id') == $box->id): echo 'selected'; endif; ?>><?php echo e($box->box_number); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                    <div>
                        <label class="abc-label">Estado</label>
                        <select name="status" class="abc-input">
                            <option value="">-- Todos --</option>
                            <option value="BORRADOR" <?php if(request('status') === 'BORRADOR'): echo 'selected'; endif; ?>>BORRADOR</option>
                            <option value="ENVIADO" <?php if(request('status') === 'ENVIADO'): echo 'selected'; endif; ?>>ENVIADO</option>
                            <option value="VERIFICADO" <?php if(request('status') === 'VERIFICADO'): echo 'selected'; endif; ?>>VERIFICADO</option>
                            <option value="RECHAZADO" <?php if(request('status') === 'RECHAZADO'): echo 'selected'; endif; ?>>RECHAZADO</option>
                        </select>
                    </div>
                    <div>
                        <label class="abc-label">Desde</label>
                        <input type="date" name="date_from" value="<?php echo e(request('date_from')); ?>" class="abc-input">
                    </div>
                    <div>
                        <label class="abc-label">Hasta</label>
                        <input type="date" name="date_to" value="<?php echo e(request('date_to')); ?>" class="abc-input">
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="abc-btn abc-btn-primary">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                            Filtrar
                        </button>
                        <a href="<?php echo e(route('cleanup.index')); ?>" class="abc-btn abc-btn-ghost text-xs">Limpiar</a>
                    </div>
                </form>
            </div>

            
            <form method="POST" action="<?php echo e(route('cleanup.destroy-selected')); ?>" id="bulk-delete-form"
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
                <?php echo csrf_field(); ?>

                
                <div class="flex items-center justify-between mb-3 px-1">
                    <p class="text-sm" style="color: var(--text-muted);">
                        Mostrando <span class="font-semibold" style="color: var(--text-primary);"><?php echo e($notes->count()); ?></span> de <span class="font-semibold" style="color: var(--text-primary);"><?php echo e($notes->total()); ?></span> registros
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
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <tr class="transition-colors duration-150 hover:bg-red-50/40"
                                        :class="selectedIds.includes('<?php echo e($note->id); ?>') ? 'bg-red-50' : ''">
                                        <td class="px-3 py-2.5 text-center">
                                            <input type="checkbox" name="note_ids[]" value="<?php echo e($note->id); ?>"
                                                   class="note-checkbox rounded border-gray-300"
                                                   @change="toggle('<?php echo e($note->id); ?>')"
                                                   :checked="selectedIds.includes('<?php echo e($note->id); ?>')">
                                        </td>
                                        <td class="px-3 py-2.5 text-xs font-medium" style="color: var(--text-muted);"><?php echo e($notes->firstItem() + $index); ?></td>
                                        <td class="px-3 py-2.5 text-xs font-bold" style="color: var(--text-primary);"><?php echo e($note->box->box_number ?? '-'); ?></td>
                                        <td class="px-3 py-2.5 text-xs font-bold" style="color: var(--abc-navy);"><?php echo e($note->internal_number); ?></td>
                                        <td class="px-3 py-2.5 text-xs" style="color: var(--text-secondary);"><?php echo e($note->note_date->format('d/m/Y')); ?></td>
                                        <td class="px-3 py-2.5 text-xs" style="color: var(--text-secondary); max-width: 200px;">
                                            <span class="block truncate" title="<?php echo e($note->reference); ?>"><?php echo e($note->reference); ?></span>
                                        </td>
                                        <td class="px-3 py-2.5 text-center">
                                            <?php echo $__env->make('partials.status-badge', ['status' => $note->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                        </td>
                                        <td class="px-3 py-2.5 text-xs" style="color: var(--text-secondary);"><?php echo e($note->creator->name ?? '-'); ?></td>
                                    </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
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
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($notes->hasPages()): ?>
                        <div class="px-5 py-3" style="border-top: 1px solid var(--surface-border);">
                            <?php echo e($notes->links()); ?>

                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </form>

            
            <form method="POST" action="<?php echo e(route('cleanup.destroy-all')); ?>" id="delete-all-form" class="hidden">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="confirm_text" id="confirm_text_input">
            </form>


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


    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\hp pavilion\OneDrive\Escritorio\System Correos\system-correos\resources\views/cleanup/index.blade.php ENDPATH**/ ?>
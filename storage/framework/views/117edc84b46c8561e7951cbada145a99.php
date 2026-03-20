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
            <div>
                <h2 class="text-2xl font-bold tracking-tight">Documentos</h2>
                <p class="text-sm text-white/70 mt-1">Gestión de documentos internos &mdash; Agencia Boliviana de Correos</p>
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                <a href="<?php echo e(route('reports.export.excel', request()->query())); ?>" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-xs font-semibold bg-emerald-500 hover:bg-emerald-600 text-white transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                    Excel
                </a>
                <a href="<?php echo e(route('reports.export.pdf', request()->query())); ?>" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-xs font-semibold bg-red-500 hover:bg-red-600 text-white transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                    PDF
                </a>
                <a href="<?php echo e(route('notes.create')); ?>" class="abc-btn abc-btn-warning">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Nueva Nota
                </a>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            
            <div class="abc-filter-bar">
                <form method="GET" action="<?php echo e(route('notes.index')); ?>" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-7 gap-4 items-end">
                    <div>
                        <label class="abc-label">N° Caja</label>
                        <select name="box_id" class="abc-input">
                            <option value="">-- Todas --</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $boxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $box): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <option value="<?php echo e($box->id); ?>" <?php if(request('box_id') == $box->id): echo 'selected'; endif; ?>><?php echo e($box->box_number); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                    <div>
                        <label class="abc-label">N. de CITE</label>
                        <input type="text" name="internal_number" value="<?php echo e(request('internal_number')); ?>"
                               class="abc-input" placeholder="Buscar...">
                    </div>
                    <div>
                        <label class="abc-label">N° Carpeta</label>
                        <input type="text" name="folder_number" value="<?php echo e(request('folder_number')); ?>"
                               class="abc-input" placeholder="Buscar...">
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
                        <label class="abc-label">Fecha desde</label>
                        <input type="date" name="date_from" value="<?php echo e(request('date_from')); ?>" class="abc-input">
                    </div>
                    <div>
                        <label class="abc-label">Fecha hasta</label>
                        <input type="date" name="date_to" value="<?php echo e(request('date_to')); ?>" class="abc-input">
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="abc-btn abc-btn-primary">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                            Filtrar
                        </button>
                        <a href="<?php echo e(route('notes.index')); ?>" class="abc-btn abc-btn-ghost text-xs">Limpiar</a>
                    </div>
                </form>
            </div>

            
            <div class="flex items-center justify-between mb-3 px-1">
                <p class="text-sm" style="color: var(--text-muted);">
                    Mostrando <span class="font-semibold" style="color: var(--text-primary);"><?php echo e($notes->count()); ?></span> de <span class="font-semibold" style="color: var(--text-primary);"><?php echo e($notes->total()); ?></span> registros
                </p>
            </div>

            
            <div class="abc-card mobile-hide-table" style="border-radius: 0.75rem;">
                <div class="overflow-x-auto">
                    <table class="w-full" style="min-width: 900px;">
                        <thead>
                            <tr style="background: linear-gradient(135deg, var(--abc-navy) 0%, var(--abc-navy-light) 100%);">
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 40px;">N°</th>
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 80px;">N° Caja</th>
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 80px;">N° Carpeta</th>
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 90px;">N. de CITE</th>
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 85px;">Fecha</th>
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider">Referencia</th>
                                <th class="px-3 py-3 text-center text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 80px;">Estado Doc.</th>
                                <th class="px-3 py-3 text-center text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 120px;">Nota Interno</th>
                                <th class="px-3 py-3 text-center text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 50px;">Fojas</th>
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 160px;">Observaciones</th>
                                <th class="px-3 py-3 text-center text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 100px;">Estado</th>
                                <th class="px-3 py-3 text-center text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 90px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y" style="border-color: var(--surface-border-light);">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr class="transition-colors duration-150 hover:bg-blue-50/40 dark:hover:bg-blue-900/10">
                                    <td class="px-3 py-2.5 text-xs font-medium" style="color: var(--text-muted);"><?php echo e($notes->firstItem() + $index); ?></td>
                                    <td class="px-3 py-2.5 text-xs font-bold" style="color: var(--text-primary);"><?php echo e($note->box->box_number ?? '-'); ?></td>
                                    <td class="px-3 py-2.5 text-xs" style="color: var(--text-secondary);"><?php echo e($note->folder_number ?? '-'); ?></td>
                                    <td class="px-3 py-2.5">
                                        <a href="<?php echo e(route('notes.show', $note)); ?>" class="text-xs font-bold hover:underline" style="color: var(--abc-navy);">
                                            <?php echo e($note->internal_number); ?>

                                        </a>
                                    </td>
                                    <td class="px-3 py-2.5 text-xs" style="color: var(--text-secondary);"><?php echo e($note->note_date->format('d/m/Y')); ?></td>
                                    <td class="px-3 py-2.5 text-xs" style="color: var(--text-secondary); max-width: 200px;">
                                        <span class="block truncate" title="<?php echo e($note->reference); ?>"><?php echo e($note->reference); ?></span>
                                    </td>
                                    <td class="px-3 py-2.5 text-center">
                                        <span class="inline-flex px-2 py-0.5 text-[10px] font-semibold rounded-md" style="background-color: var(--surface-border-light); color: var(--text-secondary);"><?php echo e($note->doc_type); ?></span>
                                    </td>
                                    <td class="px-3 py-2.5 text-center">
                                        <span class="inline-flex px-2 py-0.5 text-[10px] font-semibold rounded-md" style="background-color: var(--surface-border-light); color: var(--text-secondary);"><?php echo e($note->note_type ?? '-'); ?></span>
                                    </td>
                                    <td class="px-3 py-2.5 text-xs text-center font-semibold" style="color: var(--text-primary);"><?php echo e($note->pages); ?></td>
                                    <td class="px-3 py-2.5 text-xs" style="color: var(--text-muted); max-width: 160px;">
                                        <span class="block truncate" title="<?php echo e($note->observations); ?>"><?php echo e($note->observations ?? '-'); ?></span>
                                    </td>
                                    <td class="px-3 py-2.5 text-center">
                                        <?php echo $__env->make('partials.status-badge', ['status' => $note->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                    </td>
                                    <td class="px-3 py-2.5 text-center">
                                        <div class="inline-flex items-center gap-0.5">
                                            <a href="<?php echo e(route('notes.show', $note)); ?>" class="p-1.5 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900/20 transition" style="color: var(--text-muted);" title="Ver">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                                            </a>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $note)): ?>
                                                <a href="<?php echo e(route('notes.edit', $note)); ?>" class="p-1.5 rounded-md hover:bg-amber-50 dark:hover:bg-amber-900/20 transition" style="color: var(--text-muted);" title="Editar">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"/></svg>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $note)): ?>
                                                <form method="POST" action="<?php echo e(route('notes.destroy', $note)); ?>" class="inline" id="delete-form-<?php echo e($note->id); ?>" onsubmit="event.preventDefault(); confirmarEliminar('<?php echo e($note->internal_number); ?>', 'delete-form-<?php echo e($note->id); ?>')">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="p-1.5 rounded-md hover:bg-red-50 dark:hover:bg-red-900/20 transition" style="color: var(--text-muted);" title="Eliminar">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <tr>
                                    <td colspan="12" class="text-center py-16" style="border: none;">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="w-16 h-16 rounded-full flex items-center justify-center" style="background-color: var(--surface-border-light);">
                                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" style="color: var(--text-muted);"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9.75m3 0H9.75m0 0V18m-6-13.5V18a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25V6.108c0-.591-.239-1.16-.659-1.575l-2.847-2.784A2.25 2.25 0 0 0 12.172 1.5H8.25A2.25 2.25 0 0 0 6 3.75Z"/></svg>
                                            </div>
                                            <p class="font-semibold text-sm" style="color: var(--text-muted);">No hay documentos registrados</p>
                                            <a href="<?php echo e(route('notes.create')); ?>" class="abc-btn abc-btn-primary text-xs mt-1">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                                Crear primera nota
                                            </a>
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

            
            <div class="mobile-show-cards">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <div class="mobile-card-item">
                        
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold px-2 py-0.5 rounded-md" style="background: linear-gradient(135deg, var(--abc-navy), var(--abc-navy-light)); color: white;">
                                    <?php echo e($note->box->box_number ?? '-'); ?>

                                </span>
                                <a href="<?php echo e(route('notes.show', $note)); ?>" class="text-sm font-bold hover:underline" style="color: var(--accent-primary);">
                                    <?php echo e($note->internal_number); ?>

                                </a>
                            </div>
                            <?php echo $__env->make('partials.status-badge', ['status' => $note->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>

                        
                        <p class="text-xs mb-2 line-clamp-2" style="color: var(--text-secondary);" title="<?php echo e($note->reference); ?>">
                            <?php echo e($note->reference); ?>

                        </p>

                        
                        <div class="grid grid-cols-2 gap-x-4 gap-y-1">
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Fecha</span>
                                <span class="mobile-card-value text-xs"><?php echo e($note->note_date->format('d/m/Y')); ?></span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Fojas</span>
                                <span class="mobile-card-value text-xs font-semibold"><?php echo e($note->pages); ?></span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Estado Doc.</span>
                                <span class="mobile-card-value text-xs"><?php echo e($note->doc_type); ?></span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Tipo</span>
                                <span class="mobile-card-value text-xs truncate"><?php echo e($note->note_type ?? '-'); ?></span>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($note->folder_number): ?>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Carpeta</span>
                                <span class="mobile-card-value text-xs"><?php echo e($note->folder_number); ?></span>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($note->observations): ?>
                            <p class="text-[11px] mt-1.5 truncate" style="color: var(--text-muted);" title="<?php echo e($note->observations); ?>">
                                <span class="font-semibold">Obs:</span> <?php echo e($note->observations); ?>

                            </p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        
                        <div class="mobile-card-actions">
                            <a href="<?php echo e(route('notes.show', $note)); ?>" class="text-blue-600 bg-blue-50 dark:bg-blue-900/20 dark:text-blue-400 hover:bg-blue-100">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                                Ver
                            </a>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $note)): ?>
                                <a href="<?php echo e(route('notes.edit', $note)); ?>" class="text-amber-600 bg-amber-50 dark:bg-amber-900/20 dark:text-amber-400 hover:bg-amber-100">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"/></svg>
                                    Editar
                                </a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $note)): ?>
                                <form method="POST" action="<?php echo e(route('notes.destroy', $note)); ?>" class="flex-1" id="mobile-delete-<?php echo e($note->id); ?>" onsubmit="event.preventDefault(); confirmarEliminar('<?php echo e($note->internal_number); ?>', 'mobile-delete-<?php echo e($note->id); ?>')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="w-full text-red-600 bg-red-50 dark:bg-red-900/20 dark:text-red-400 hover:bg-red-100 inline-flex items-center justify-center gap-1.5 py-2 rounded-lg text-[11px] font-semibold transition">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                                        Eliminar
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="flex flex-col items-center gap-3 py-12">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center" style="background-color: var(--surface-border-light);">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" style="color: var(--text-muted);"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9.75m3 0H9.75m0 0V18m-6-13.5V18a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25V6.108c0-.591-.239-1.16-.659-1.575l-2.847-2.784A2.25 2.25 0 0 0 12.172 1.5H8.25A2.25 2.25 0 0 0 6 3.75Z"/></svg>
                        </div>
                        <p class="font-semibold text-sm" style="color: var(--text-muted);">No hay documentos registrados</p>
                        <a href="<?php echo e(route('notes.create')); ?>" class="abc-btn abc-btn-primary text-xs mt-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            Crear primera nota
                        </a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($notes->hasPages()): ?>
                    <div class="mt-4">
                        <?php echo e($notes->links()); ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        function confirmarEliminar(cite, formId) {
            Swal.fire({
                title: '¿Eliminar esta nota?',
                html: 'Se eliminará permanentemente el CITE <strong style="color:#ef4444">' + cite + '</strong>.<br>Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
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
<?php /**PATH C:\Users\hp pavilion\OneDrive\Escritorio\System Correos\system-correos\resources\views/notes/index.blade.php ENDPATH**/ ?>
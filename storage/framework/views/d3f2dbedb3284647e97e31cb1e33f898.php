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
                <?php echo e($total); ?> aprobado(s) en total
            </span>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-[96rem] mx-auto px-3 sm:px-4 lg:px-6 xl:px-8 space-y-5">

            
            <div class="abc-card p-5 animate-fade-in-up">
                <form method="GET" action="<?php echo e(route('verification.approved')); ?>" class="flex flex-wrap gap-3 items-end">
                    <div class="flex-1 min-w-[160px]">
                        <label class="abc-label text-xs">Desde</label>
                        <input type="date" name="date_from" value="<?php echo e(request('date_from')); ?>" class="abc-input !py-2">
                    </div>
                    <div class="flex-1 min-w-[160px]">
                        <label class="abc-label text-xs">Hasta</label>
                        <input type="date" name="date_to" value="<?php echo e(request('date_to')); ?>" class="abc-input !py-2">
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label class="abc-label text-xs">Buscar</label>
                        <input type="text" name="search" value="<?php echo e(request('search')); ?>"
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
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('date_from') || request('date_to') || request('search')): ?>
                            <a href="<?php echo e(route('verification.approved')); ?>" class="abc-btn abc-btn-ghost !py-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                                Limpiar
                            </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </form>
            </div>

            
            <div class="abc-card animate-fade-in-up mobile-hide-table">
                <div class="overflow-x-auto">
                    <table class="abc-table approved-table min-w-[1500px] w-full">
                        <thead style="background: linear-gradient(135deg, #059669, #34d399);">
                            <tr>
                                <th class="!text-white whitespace-nowrap text-center w-14">#</th>
                                <th class="!text-white whitespace-nowrap w-28">N° Caja</th>
                                <th class="!text-white whitespace-nowrap w-[260px]">N° de Documento</th>
                                <th class="!text-white whitespace-nowrap w-28">Fecha Doc.</th>
                                <th class="!text-white whitespace-nowrap w-44">Remitente</th>
                                <th class="!text-white whitespace-nowrap w-44">Destinatario</th>
                                <th class="!text-white whitespace-nowrap w-[320px]">Referencia</th>
                                <th class="!text-white text-center whitespace-nowrap w-24">Fojas</th>
                                <th class="!text-white whitespace-nowrap w-44">Aprobado por</th>
                                <th class="!text-white whitespace-nowrap w-40">Fecha Aprobación</th>
                                <th class="!text-white text-center whitespace-nowrap w-28">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr>
                                    <td class="font-mono text-sm text-center" style="color: var(--text-muted)"><?php echo e($note->id); ?></td>
                                    <td class="font-semibold" style="color: var(--text-primary)"><?php echo e($note->box->box_number ?? '-'); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('notes.show', $note)); ?>" class="line-clamp-2 text-emerald-600 hover:text-emerald-800 hover:underline font-semibold" title="<?php echo e($note->internal_number); ?>">
                                            <?php echo e($note->internal_number); ?>

                                        </a>
                                    </td>
                                    <td class="whitespace-nowrap font-medium" style="color: var(--text-secondary)"><?php echo e($note->note_date->format('d/m/Y')); ?></td>
                                    <td class="max-w-[176px] truncate" style="color: var(--text-secondary)" title="<?php echo e($note->remitente ?? '-'); ?>"><?php echo e($note->remitente ?? '-'); ?></td>
                                    <td class="max-w-[176px] truncate" style="color: var(--text-secondary)" title="<?php echo e($note->destinatario ?? '-'); ?>"><?php echo e($note->destinatario ?? '-'); ?></td>
                                    <td class="max-w-[320px]">
                                        <span class="line-clamp-2" style="color: var(--text-secondary)" title="<?php echo e($note->reference); ?>"><?php echo e($note->reference); ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="abc-badge bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <?php echo e($note->pages); ?>

                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap font-medium" style="color: var(--text-secondary)"><?php echo e($note->verifier->name ?? '-'); ?></td>
                                    <td class="whitespace-nowrap" style="color: var(--text-secondary)">
                                        <?php echo e($note->verified_at ? $note->verified_at->format('d/m/Y H:i') : '-'); ?>

                                    </td>
                                    <td>
                                        <div class="flex justify-center flex-nowrap">
                                            <a href="<?php echo e(route('notes.show', $note)); ?>" class="abc-btn abc-btn-ghost !px-3 !py-1.5 text-xs">
                                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                                Ver
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <tr>
                                    <td colspan="11" class="text-center py-12">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="w-14 h-14 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20 flex items-center justify-center">
                                                <svg class="w-7 h-7 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                                                </svg>
                                            </div>
                                            <p class="font-semibold" style="color: var(--text-secondary)">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('date_from') || request('date_to') || request('search')): ?>
                                                    No se encontraron documentos con esos filtros
                                                <?php else: ?>
                                                    No hay documentos aprobados aún
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($notes->hasPages()): ?>
                    <div class="px-5 py-4 border-t" style="border-color: var(--surface-border);">
                        <?php echo e($notes->links()); ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="mobile-show-cards">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <div class="mobile-card-item">
                        
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="text-xs font-bold px-2 py-0.5 rounded-md" style="background: linear-gradient(135deg, #059669, #34d399); color: white;">
                                    <?php echo e($note->box->box_number ?? '-'); ?>

                                </span>
                                <a href="<?php echo e(route('notes.show', $note)); ?>" class="text-sm font-bold hover:underline text-emerald-600">
                                    <?php echo e($note->internal_number); ?>

                                </a>
                            </div>
                            <span class="text-xs font-medium text-emerald-700 bg-emerald-50 border border-emerald-200 px-2 py-0.5 rounded-md">
                                ✓ Aprobado
                            </span>
                        </div>

                        
                        <p class="text-xs mb-2 line-clamp-2" style="color: var(--text-secondary);" title="<?php echo e($note->reference); ?>">
                            <?php echo e($note->reference); ?>

                        </p>

                        
                        <div class="grid grid-cols-2 gap-x-4 gap-y-1">
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Fecha Doc.</span>
                                <span class="mobile-card-value text-xs"><?php echo e($note->note_date->format('d/m/Y')); ?></span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Fojas</span>
                                <span class="mobile-card-value text-xs font-semibold"><?php echo e($note->pages); ?></span>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($note->remitente): ?>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Remitente</span>
                                <span class="mobile-card-value text-xs truncate"><?php echo e($note->remitente); ?></span>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($note->destinatario): ?>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Destinatario</span>
                                <span class="mobile-card-value text-xs truncate"><?php echo e($note->destinatario); ?></span>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Aprobado por</span>
                                <span class="mobile-card-value text-xs"><?php echo e($note->verifier->name ?? '-'); ?></span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Fecha Aprob.</span>
                                <span class="mobile-card-value text-xs"><?php echo e($note->verified_at ? $note->verified_at->format('d/m/Y') : '-'); ?></span>
                            </div>
                        </div>

                        
                        <div class="mobile-card-actions">
                            <a href="<?php echo e(route('notes.show', $note)); ?>" class="text-emerald-600 bg-emerald-50 hover:bg-emerald-100">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>
                                Ver Documento
                            </a>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="flex flex-col items-center gap-3 py-12">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center">
                            <svg class="w-7 h-7 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                        <p class="font-semibold text-sm" style="color: var(--text-muted);">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('date_from') || request('date_to') || request('search')): ?>
                                No se encontraron documentos con esos filtros
                            <?php else: ?>
                                No hay documentos aprobados aún
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </p>
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

    <style>
        .approved-table thead th {
            letter-spacing: .04em;
        }

        .approved-table tbody td {
            vertical-align: middle;
        }
    </style>
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
<?php /**PATH C:\Users\hp pavilion\OneDrive\Escritorio\System Correos\system-correos\resources\views/verification/approved.blade.php ENDPATH**/ ?>
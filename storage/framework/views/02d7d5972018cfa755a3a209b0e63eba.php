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
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-white flex items-center gap-3">
                    <svg class="w-7 h-7 text-[var(--abc-yellow)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                    Registro de Auditoría
                </h1>
                <p class="text-blue-200 text-sm mt-1">Seguimiento de todas las acciones del sistema</p>
            </div>
            <div class="text-sm text-blue-200">
                <span class="bg-white/10 backdrop-blur px-3 py-1.5 rounded-lg"><?php echo e($logs->total()); ?> registros encontrados</span>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            
            <div class="abc-filter-bar">
                <form method="GET" action="<?php echo e(route('audit.index')); ?>" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 items-end">
                    <div>
                        <label class="abc-label">Acción</label>
                        <select name="action" class="abc-input">
                            <option value="">-- Todas --</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <option value="<?php echo e($action); ?>" <?php if(request('action') === $action): echo 'selected'; endif; ?>><?php echo e($action); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                    <div>
                        <label class="abc-label">Entidad</label>
                        <select name="entity" class="abc-input">
                            <option value="">-- Todas --</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $entities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <option value="<?php echo e($entity); ?>" <?php if(request('entity') === $entity): echo 'selected'; endif; ?>><?php echo e($entity); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                    <div>
                        <label class="abc-label">Usuario</label>
                        <select name="user_id" class="abc-input">
                            <option value="">-- Todos --</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <option value="<?php echo e($user->id); ?>" <?php if(request('user_id') == $user->id): echo 'selected'; endif; ?>><?php echo e($user->name); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
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
                    <div class="flex gap-2">
                        <button type="submit" class="abc-btn-primary w-full">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                            Filtrar
                        </button>
                        <a href="<?php echo e(route('audit.index')); ?>" class="abc-btn-outline whitespace-nowrap">Limpiar</a>
                    </div>
                </form>
            </div>

            
            <div class="abc-card overflow-hidden mobile-hide-table">
                <div class="overflow-x-auto">
                    <table class="abc-table">
                        <thead>
                            <tr>
                                <th>Fecha / Hora</th>
                                <th>Usuario</th>
                                <th>Acción</th>
                                <th>Entidad</th>
                                <th class="text-center">ID</th>
                                <th>IP</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr>
                                    <td class="whitespace-nowrap">
                                        <div class="text-xs font-medium text-gray-700"><?php echo e($log->created_at->format('d/m/Y')); ?></div>
                                        <div class="text-xs text-gray-400"><?php echo e($log->created_at->format('H:i:s')); ?></div>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-gradient-to-br from-[var(--abc-navy)] to-[var(--abc-sky)] text-white flex items-center justify-center text-xs font-bold flex-shrink-0">
                                                <?php echo e($log->user ? strtoupper(substr($log->user->name, 0, 1)) : 'S'); ?>

                                            </div>
                                            <span class="text-sm text-gray-700"><?php echo e($log->user->name ?? 'Sistema'); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                            $actionColors = [
                                                'CREAR' => 'bg-emerald-100 text-emerald-700 ring-emerald-600/20',
                                                'EDITAR' => 'bg-amber-100 text-amber-700 ring-amber-600/20',
                                                'ELIMINAR' => 'bg-red-100 text-red-700 ring-red-600/20',
                                                'VERIFICAR' => 'bg-emerald-100 text-emerald-700 ring-emerald-600/20',
                                                'RECHAZAR' => 'bg-red-100 text-red-700 ring-red-600/20',
                                                'ENVIAR' => 'bg-sky-100 text-sky-700 ring-sky-600/20',
                                                'LOGIN' => 'bg-indigo-100 text-indigo-700 ring-indigo-600/20',
                                            ];
                                            $color = 'bg-gray-100 text-gray-700 ring-gray-600/20';
                                            foreach ($actionColors as $key => $val) {
                                                if (str_contains($log->action, $key)) { $color = $val; break; }
                                            }
                                        ?>
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold ring-1 ring-inset <?php echo e($color); ?>">
                                            <?php echo e($log->action); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm text-gray-600 bg-gray-100 px-2 py-0.5 rounded"><?php echo e($log->entity); ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-sm font-mono text-gray-500"><?php echo e($log->entity_id); ?></span>
                                    </td>
                                    <td>
                                        <span class="text-xs font-mono text-gray-400"><?php echo e($log->ip_address ?? '-'); ?></span>
                                    </td>
                                    <td>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($log->new_values): ?>
                                            <details class="group cursor-pointer" x-data="{ open: false }">
                                                <summary @click="open = !open" class="inline-flex items-center gap-1 text-[var(--abc-sky)] hover:text-[var(--abc-navy)] text-xs font-medium transition-colors">
                                                    <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
                                                    Ver cambios
                                                </summary>
                                                <div class="mt-2 text-xs bg-slate-50 border border-slate-200 p-3 rounded-lg max-w-sm overflow-auto shadow-sm">
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($log->old_values): ?>
                                                        <p class="font-semibold text-red-500 mb-1 flex items-center gap-1">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                                            Antes:
                                                        </p>
                                                        <pre class="text-gray-600 bg-white p-2 rounded border text-[10px] leading-relaxed mb-2"><?php echo e(json_encode($log->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); ?></pre>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    <p class="font-semibold text-emerald-600 mb-1 flex items-center gap-1">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                                        Después:
                                                    </p>
                                                    <pre class="text-gray-600 bg-white p-2 rounded border text-[10px] leading-relaxed"><?php echo e(json_encode($log->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); ?></pre>
                                                </div>
                                            </details>
                                        <?php else: ?>
                                            <span class="text-xs text-gray-300">—</span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <tr>
                                    <td colspan="7" class="text-center py-12">
                                        <div class="flex flex-col items-center gap-3">
                                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                            <p class="text-gray-400 text-sm">No hay registros de auditoría</p>
                                            <p class="text-gray-300 text-xs">Los registros aparecerán cuando se realicen acciones en el sistema</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($logs->hasPages()): ?>
                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                        <?php echo e($logs->links()); ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="mobile-show-cards">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <div class="mobile-card-item">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-[var(--abc-navy)] to-[var(--abc-sky)] text-white flex items-center justify-center text-xs font-bold flex-shrink-0">
                                    <?php echo e($log->user ? strtoupper(substr($log->user->name, 0, 1)) : 'S'); ?>

                                </div>
                                <span class="text-sm font-semibold" style="color: var(--text-primary)"><?php echo e($log->user->name ?? 'Sistema'); ?></span>
                            </div>
                            <?php
                                $actionColors = [
                                    'CREAR' => 'bg-emerald-100 text-emerald-700',
                                    'EDITAR' => 'bg-amber-100 text-amber-700',
                                    'ELIMINAR' => 'bg-red-100 text-red-700',
                                    'VERIFICAR' => 'bg-emerald-100 text-emerald-700',
                                    'RECHAZAR' => 'bg-red-100 text-red-700',
                                    'ENVIAR' => 'bg-sky-100 text-sky-700',
                                    'LOGIN' => 'bg-indigo-100 text-indigo-700',
                                ];
                                $color = 'bg-gray-100 text-gray-700';
                                foreach ($actionColors as $key => $val) {
                                    if (str_contains($log->action, $key)) { $color = $val; break; }
                                }
                            ?>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold <?php echo e($color); ?>"><?php echo e($log->action); ?></span>
                        </div>
                        <div class="grid grid-cols-2 gap-x-4 gap-y-1">
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Fecha</span>
                                <span class="mobile-card-value text-xs"><?php echo e($log->created_at->format('d/m/Y H:i')); ?></span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Entidad</span>
                                <span class="mobile-card-value text-xs"><?php echo e($log->entity); ?></span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">ID Entidad</span>
                                <span class="mobile-card-value text-xs font-mono"><?php echo e($log->entity_id); ?></span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">IP</span>
                                <span class="mobile-card-value text-xs font-mono"><?php echo e($log->ip_address ?? '-'); ?></span>
                            </div>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($log->new_values): ?>
                            <details class="mt-2" x-data="{ open: false }">
                                <summary @click="open = !open" class="inline-flex items-center gap-1 text-[var(--abc-sky)] text-xs font-medium cursor-pointer">
                                    <svg class="w-3.5 h-3.5 transition-transform" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
                                    Ver cambios
                                </summary>
                                <div class="mt-2 text-xs bg-slate-50 dark:bg-slate-800 border p-2 rounded-lg overflow-auto max-h-40">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($log->old_values): ?>
                                        <p class="font-semibold text-red-500 mb-1 text-[10px]">Antes:</p>
                                        <pre class="text-[10px] leading-relaxed mb-2 whitespace-pre-wrap"><?php echo e(json_encode($log->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); ?></pre>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <p class="font-semibold text-emerald-600 mb-1 text-[10px]">Después:</p>
                                    <pre class="text-[10px] leading-relaxed whitespace-pre-wrap"><?php echo e(json_encode($log->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); ?></pre>
                                </div>
                            </details>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="flex flex-col items-center gap-3 py-12">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                        <p class="text-sm" style="color: var(--text-muted)">No hay registros de auditoría</p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($logs->hasPages()): ?>
                    <div class="mt-4"><?php echo e($logs->links()); ?></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
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

<?php /**PATH C:\Users\hp pavilion\OneDrive\Escritorio\System Correos\system-correos\resources\views/audit/index.blade.php ENDPATH**/ ?>
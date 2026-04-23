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
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-amber-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                </svg>
                <div>
                    <h2 class="text-2xl font-bold tracking-tight">Permisos de Acceso</h2>
                    <p class="text-white/70 text-sm mt-1">Gestionar los módulos visibles del menú para cada usuario</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-[96rem] mx-auto px-3 sm:px-4 lg:px-6 xl:px-8 space-y-6">

            
            <div class="abc-filter-bar">
                <form method="GET" action="<?php echo e(route('permissions.index')); ?>" class="flex flex-col sm:flex-row gap-4 items-end">
                    <div class="flex-1">
                        <label class="abc-label">Buscar</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                            <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                                   placeholder="Nombre o correo..."
                                   class="abc-input pl-10">
                        </div>
                    </div>
                    <div>
                        <label class="abc-label">Rol</label>
                        <select name="role" class="abc-input">
                            <option value="">-- Todos --</option>
                            <option value="ADMIN" <?php if(request('role') === 'ADMIN'): echo 'selected'; endif; ?>>ADMIN</option>
                            <option value="USUARIO" <?php if(request('role') === 'USUARIO'): echo 'selected'; endif; ?>>USUARIO</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="abc-btn abc-btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"/>
                            </svg>
                            Filtrar
                        </button>
                        <a href="<?php echo e(route('permissions.index')); ?>" class="abc-btn abc-btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                            Limpiar
                        </a>
                    </div>
                </form>
            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="abc-card" x-data="{ expanded: false }">
                    <div class="px-5 py-4">
                        
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0 <?php echo e($user->is_active ? 'gradient-navy' : 'bg-gray-400'); ?>">
                                    <?php echo e(strtoupper(substr($user->name, 0, 2))); ?>

                                </div>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="font-semibold text-sm sm:text-base truncate" style="color: var(--text-primary)"><?php echo e($user->name); ?></span>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->role === 'ADMIN'): ?>
                                            <span class="abc-badge bg-red-50 text-red-700 border border-red-200 text-[10px] flex-shrink-0">ADMIN</span>
                                        <?php else: ?>
                                            <span class="abc-badge bg-blue-50 text-blue-700 border border-blue-200 text-[10px] flex-shrink-0">USUARIO</span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$user->is_active): ?>
                                            <span class="abc-badge bg-red-100 text-red-700 border border-red-200 text-[10px] flex-shrink-0">BLOQUEADO</span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <p class="text-xs mt-0.5 truncate" style="color: var(--text-muted)"><?php echo e($user->email); ?></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                
                                <?php
                                    $userModules = $user->getAllowedModules();
                                    $totalModules = count(\App\Models\User::ALL_MODULES);
                                    $activeModules = count($userModules);
                                ?>
                                <span class="hidden sm:inline text-xs font-medium px-2.5 py-1 rounded-lg whitespace-nowrap" style="background-color: var(--surface-border-light); color: var(--text-secondary)">
                                    <?php echo e($activeModules); ?>/<?php echo e($totalModules); ?> módulos
                                </span>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->id !== auth()->id()): ?>
                                    <button @click="expanded = !expanded" type="button"
                                            class="abc-btn abc-btn-primary !px-3 !py-2 text-xs whitespace-nowrap">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200"
                                             :class="expanded ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                        <span x-text="expanded ? 'Cerrar' : 'Configurar'"></span>
                                    </button>
                                <?php elseif($user->id === auth()->id()): ?>
                                    <span class="text-xs italic px-2 py-1.5" style="color: var(--text-muted)">Tu cuenta</span>
                                <?php else: ?>
                                    <span class="text-xs italic px-2 py-1.5" style="color: var(--text-muted)">Sin permisos</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>

                        
                        <div class="sm:hidden mt-2">
                            <span class="text-xs font-medium px-2 py-0.5 rounded-md" style="background-color: var(--surface-border-light); color: var(--text-secondary)">
                                <?php echo e($activeModules); ?>/<?php echo e($totalModules); ?> módulos activos
                            </span>
                        </div>

                        
                        <div class="flex flex-wrap gap-1.5 mt-3" x-show="!expanded">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = \App\Models\User::ALL_MODULES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($key, $userModules)): ?>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <svg class="w-2.5 h-2.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        <?php echo e($label); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-medium bg-red-50 text-red-400 border border-red-100 line-through">
                                        <svg class="w-2.5 h-2.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                        <?php echo e($label); ?>

                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>

                    
                    <div x-show="expanded"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-2"
                         x-cloak
                         class="border-t px-4 sm:px-5 py-4 sm:py-5" style="border-color: var(--border-primary); background-color: var(--surface-secondary)">

                        <form method="POST" action="<?php echo e(route('permissions.update-modules', $user)); ?>" id="form-modules-<?php echo e($user->id); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="mb-4">
                                <p class="text-sm font-semibold mb-1" style="color: var(--text-primary)">Módulos del menú</p>
                                <p class="text-xs" style="color: var(--text-muted)">Desmarca los módulos que quieras quitar del menú de este usuario. El Dashboard siempre es visible.</p>
                            </div>

                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-3">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = \App\Models\User::ALL_MODULES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <?php
                                        $isChecked = in_array($key, $userModules);
                                        $isDashboard = $key === 'dashboard';
                                    ?>
                                    <label class="relative flex items-center gap-2.5 p-3 rounded-lg border cursor-pointer transition-all duration-150 hover:shadow-sm
                                                  <?php echo e($isDashboard ? 'opacity-50 cursor-not-allowed' : ''); ?>"
                                           style="border-color: var(--border-primary); background-color: var(--surface-card)">
                                        <input type="checkbox"
                                               name="modules[]"
                                               value="<?php echo e($key); ?>"
                                               <?php echo e($isChecked ? 'checked' : ''); ?>

                                               <?php echo e($isDashboard ? 'checked disabled' : ''); ?>

                                               class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 transition">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isDashboard): ?>
                                            <input type="hidden" name="modules[]" value="dashboard">
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <div>
                                            <span class="text-xs font-semibold block" style="color: var(--text-primary)"><?php echo e($label); ?></span>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isDashboard): ?>
                                                <span class="text-[9px]" style="color: var(--text-muted)">Siempre visible</span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    </label>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>

                            <div class="flex justify-end gap-3 mt-5">
                                <button @click="expanded = false" type="button" class="abc-btn abc-btn-ghost">
                                    Cancelar
                                </button>
                                <button type="button" onclick="confirmarGuardarModulos(<?php echo e($user->id); ?>, '<?php echo e(addslashes($user->name)); ?>')"
                                        class="abc-btn abc-btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Guardar Permisos
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="abc-card">
                    <div class="text-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                        <p class="font-medium mt-3" style="color: var(--text-muted)">No se encontraron usuarios.</p>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div class="px-2">
                <?php echo e($users->links()); ?>

            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        function confirmarGuardarModulos(userId, userName) {
            const form = document.getElementById(`form-modules-${userId}`);
            const checked = form.querySelectorAll('input[name="modules[]"]:checked');
            const count = checked.length;

            Swal.fire({
                title: '¿Guardar permisos?',
                html: `Se asignarán <strong class="text-blue-600">${count} módulos</strong> al usuario <strong>${userName}</strong>.<br><small class="text-gray-500">Los módulos no seleccionados desaparecerán de su menú.</small>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1d4ed8',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
    <?php $__env->stopPush(); ?>
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
<?php /**PATH C:\Users\hp pavilion\OneDrive\Escritorio\System Correos\system-correos\resources\views\permissions\index.blade.php ENDPATH**/ ?>
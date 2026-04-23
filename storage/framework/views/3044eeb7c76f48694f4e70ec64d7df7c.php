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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-amber-300" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z"/>
                    </svg>
                    <div>
                        <h2 class="text-2xl font-bold tracking-tight">Gestion de Usuarios</h2>
                        <p class="text-white/70 text-sm mt-1">Administracion de cuentas y permisos del sistema</p>
                    </div>
                </div>
                <a href="<?php echo e(route('users.create')); ?>" class="abc-btn abc-btn-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Nuevo Usuario
                </a>
            </div>
        </div>

    <div class="py-6">
        <div class="max-w-[96rem] mx-auto px-3 sm:px-4 lg:px-6 xl:px-8 space-y-6">

            
            <div class="abc-filter-bar">
                <form method="GET" action="<?php echo e(route('users.index')); ?>" class="flex flex-col sm:flex-row gap-4 items-end">
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
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                            </svg>
                            Buscar
                        </button>
                        <a href="<?php echo e(route('users.index')); ?>" class="abc-btn abc-btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                            Limpiar
                        </a>
                    </div>
                </form>
            </div>

            
            <div class="abc-card mobile-hide-table">
                <div class="overflow-x-auto">
                    <table class="abc-table users-table min-w-[1180px] w-full">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap text-center w-16">ID</th>
                                <th class="whitespace-nowrap w-64">Usuario</th>
                                <th class="whitespace-nowrap w-[340px]">Email</th>
                                <th class="text-center whitespace-nowrap w-32">Rol</th>
                                <th class="text-center whitespace-nowrap w-32">Estado</th>
                                <th class="text-center whitespace-nowrap w-[360px]">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr x-data="{ showReset: false }">
                                    <td class="font-mono text-sm text-center" style="color: var(--text-muted)"><?php echo e($user->id); ?></td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full gradient-navy flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                                <?php echo e(strtoupper(substr($user->name, 0, 2))); ?>

                                            </div>
                                            <span class="font-semibold" style="color: var(--text-primary)"><?php echo e($user->name); ?></span>
                                        </div>
                                    </td>
                                    <td class="max-w-[340px] truncate" style="color: var(--text-secondary)" title="<?php echo e($user->email); ?>"><?php echo e($user->email); ?></td>
                                    <td class="text-center">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->role === 'ADMIN'): ?>
                                            <span class="abc-badge bg-red-50 text-red-700 border border-red-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                ADMIN
                                            </span>
                                        <?php else: ?>
                                            <span class="abc-badge bg-blue-50 text-blue-700 border border-blue-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                                </svg>
                                                USUARIO
                                            </span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->is_active): ?>
                                            <span class="abc-badge bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                Activo
                                            </span>
                                        <?php else: ?>
                                            <span class="abc-badge bg-red-50 text-red-700 border border-red-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                </svg>
                                                Inactivo
                                            </span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="flex justify-center items-center gap-1.5 flex-nowrap">
                                            <a href="<?php echo e(route('users.edit', $user)); ?>" class="abc-btn abc-btn-ghost !px-3 !py-1.5 text-xs">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                                </svg>
                                                Editar
                                            </a>
                                            <form method="POST" action="<?php echo e(route('users.toggle-active', $user)); ?>" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->is_active): ?>
                                                    <button type="submit" class="abc-btn abc-btn-danger !px-3 !py-1.5 text-xs">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"/>
                                                        </svg>
                                                        Desactivar
                                                    </button>
                                                <?php else: ?>
                                                    <button type="submit" class="abc-btn abc-btn-success !px-3 !py-1.5 text-xs">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                        </svg>
                                                        Activar
                                                    </button>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </form>
                                            <button @click="showReset = !showReset" type="button"
                                                    class="abc-btn abc-btn-warning !px-3 !py-1.5 text-xs">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                                </svg>
                                                Reset Pass
                                            </button>
                                            
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->isAdmin() && $user->id !== auth()->id()): ?>
                                                <form method="POST" action="<?php echo e(route('users.destroy', $user)); ?>" class="inline" id="delete-user-<?php echo e($user->id); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="button"
                                                            onclick="confirmarEliminarUsuario('<?php echo e(addslashes($user->name)); ?>', 'delete-user-<?php echo e($user->id); ?>')"
                                                            class="abc-btn !px-3 !py-1.5 text-xs font-bold text-white"
                                                            style="background: linear-gradient(135deg, #dc2626, #991b1b);">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                        </svg>
                                                        Eliminar
                                                    </button>
                                                </form>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>

                                        
                                        <div x-show="showReset"
                                             x-transition:enter="transition ease-out duration-200"
                                             x-transition:enter-start="opacity-0 -translate-y-2"
                                             x-transition:enter-end="opacity-100 translate-y-0"
                                             x-transition:leave="transition ease-in duration-150"
                                             x-transition:leave-start="opacity-100 translate-y-0"
                                             x-transition:leave-end="opacity-0 -translate-y-2"
                                             x-cloak
                                             class="mt-3 p-3 bg-amber-50 rounded-lg border border-amber-200 text-left">
                                            <form method="POST" action="<?php echo e(route('users.reset-password', $user)); ?>">
                                                <?php echo csrf_field(); ?>
                                                <label class="abc-label text-xs !text-amber-700">Nueva contrasena</label>
                                                <input type="password" name="password" placeholder="Nueva contrasena"
                                                       class="abc-input !border-amber-300 !bg-white text-xs mb-2" required>
                                                <input type="password" name="password_confirmation" placeholder="Confirmar contrasena"
                                                       class="abc-input !border-amber-300 !bg-white text-xs mb-2" required>
                                                <div class="flex justify-end gap-2">
                                                    <button @click="showReset = false" type="button" class="abc-btn abc-btn-ghost !px-3 !py-1.5 text-xs">
                                                        Cancelar
                                                    </button>
                                                    <button type="submit" class="abc-btn abc-btn-warning !px-3 !py-1.5 text-xs">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                        </svg>
                                                        Cambiar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <tr>
                                    <td colspan="6" class="text-center py-12">
                                        <div class="flex flex-col items-center gap-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                                            </svg>
                                            <p class="font-medium" style="color: var(--text-muted)">No hay usuarios registrados.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="px-5 py-4" style="border-top: 1px solid var(--border-primary)">
                    <?php echo e($users->links()); ?>

                </div>
            </div>

            
            <div class="mobile-show-cards">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <div class="mobile-card-item" x-data="{ showReset: false }">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-full gradient-navy flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                                <?php echo e(strtoupper(substr($user->name, 0, 2))); ?>

                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-sm truncate" style="color: var(--text-primary)"><?php echo e($user->name); ?></p>
                                <p class="text-xs truncate" style="color: var(--text-muted)"><?php echo e($user->email); ?></p>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->is_active): ?>
                                <span class="abc-badge bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px]">Activo</span>
                            <?php else: ?>
                                <span class="abc-badge bg-red-50 text-red-700 border border-red-200 text-[10px]">Inactivo</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="grid grid-cols-2 gap-x-4 gap-y-1 mb-3">
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Rol</span>
                                <span class="mobile-card-value">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->role === 'ADMIN'): ?>
                                        <span class="text-red-600 font-bold text-xs">ADMIN</span>
                                    <?php else: ?>
                                        <span class="text-blue-600 font-bold text-xs">USUARIO</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">ID</span>
                                <span class="mobile-card-value text-xs font-mono"><?php echo e($user->id); ?></span>
                            </div>
                        </div>
                        <div class="mobile-card-actions">
                            <a href="<?php echo e(route('users.edit', $user)); ?>" class="text-amber-600 bg-amber-50 dark:bg-amber-900/20 dark:text-amber-400 hover:bg-amber-100 rounded-lg">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/></svg>
                                Editar
                            </a>
                            <form method="POST" action="<?php echo e(route('users.toggle-active', $user)); ?>" class="flex-1">
                                <?php echo csrf_field(); ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->is_active): ?>
                                    <button type="submit" class="w-full text-red-600 bg-red-50 dark:bg-red-900/20 dark:text-red-400 hover:bg-red-100 inline-flex items-center justify-center gap-1.5 py-2 rounded-lg text-[11px] font-semibold transition">
                                        Desactivar
                                    </button>
                                <?php else: ?>
                                    <button type="submit" class="w-full text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20 dark:text-emerald-400 hover:bg-emerald-100 inline-flex items-center justify-center gap-1.5 py-2 rounded-lg text-[11px] font-semibold transition">
                                        Activar
                                    </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </form>
                            <button @click="showReset = !showReset" type="button"
                                    class="text-amber-600 bg-amber-50 dark:bg-amber-900/20 dark:text-amber-400 hover:bg-amber-100 rounded-lg inline-flex items-center justify-center gap-1.5 py-2 text-[11px] font-semibold transition">
                                Reset
                            </button>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->isAdmin() && $user->id !== auth()->id()): ?>
                                <form method="POST" action="<?php echo e(route('users.destroy', $user)); ?>" class="inline" id="mobile-delete-user-<?php echo e($user->id); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="button"
                                            onclick="confirmarEliminarUsuario('<?php echo e(addslashes($user->name)); ?>', 'mobile-delete-user-<?php echo e($user->id); ?>')"
                                            class="text-white bg-red-600 hover:bg-red-700 rounded-lg inline-flex items-center justify-center gap-1.5 py-2 px-3 text-[11px] font-semibold transition">
                                        Eliminar
                                    </button>
                                </form>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        
                        <div x-show="showReset" x-transition x-cloak class="mt-3 p-3 rounded-xl border border-amber-200 dark:border-amber-800/50" style="background: var(--surface-card);">
                            <p class="text-xs font-bold text-amber-600 dark:text-amber-400 mb-2">Resetear Contraseña</p>
                            <form method="POST" action="<?php echo e(route('users.reset-password', $user)); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="password" name="password" placeholder="Nueva contraseña" class="abc-input text-xs mb-2" required>
                                <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" class="abc-input text-xs mb-2" required>
                                <div class="flex gap-2">
                                    <button @click="showReset = false" type="button" class="abc-btn abc-btn-ghost !px-3 !py-1.5 text-xs flex-1">Cancelar</button>
                                    <button type="submit" class="abc-btn abc-btn-warning !px-3 !py-1.5 text-xs flex-1">Cambiar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="flex flex-col items-center gap-3 py-12">
                        <svg class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                        <p class="font-medium" style="color: var(--text-muted)">No hay usuarios registrados.</p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($users->hasPages()): ?>
                    <div class="mt-4"><?php echo e($users->links()); ?></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        function confirmarEliminarUsuario(nombre, formId) {
            Swal.fire({
                title: '¿Eliminar este usuario?',
                html: 'Se eliminará <strong style="color:#ef4444">permanentemente</strong> al usuario <strong>' + nombre + '</strong> y todos sus documentos asociados.<br><br>Esta acción <strong>NO se puede deshacer</strong>.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#b91c1c',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, eliminar permanentemente',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>

    <style>
        .users-table thead th {
            letter-spacing: .04em;
        }

        .users-table tbody td {
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
<?php /**PATH C:\Users\hp pavilion\OneDrive\Escritorio\System Correos\system-correos\resources\views\users\index.blade.php ENDPATH**/ ?>
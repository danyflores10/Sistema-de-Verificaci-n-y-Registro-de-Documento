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
        <div class="relative z-10 flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center border border-white/20">
                <svg class="w-6 h-6 text-[var(--abc-gold)]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold tracking-tight">Mi Perfil</h2>
                <p class="text-sm text-white/70 mt-0.5">Gestiona tu información personal, contraseña y seguridad</p>
            </div>
        </div>
    </div>

    
    <div class="max-w-4xl mx-auto mb-6">
        <div class="abc-card animate-fade-in-up">
            <div class="p-6 flex flex-col sm:flex-row items-center gap-5">
                
                <div class="relative">
                    <div class="w-20 h-20 rounded-2xl gradient-navy flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                        <?php echo e(strtoupper(substr(Auth::user()->name, 0, 2))); ?>

                    </div>
                    <div class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full bg-emerald-500 border-2 border-white flex items-center justify-center">
                        <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    </div>
                </div>
                
                <div class="text-center sm:text-left flex-1">
                    <h3 class="text-lg font-bold" style="color: var(--text-primary);"><?php echo e(Auth::user()->name); ?></h3>
                    <p class="text-sm" style="color: var(--text-muted);"><?php echo e(Auth::user()->email); ?></p>
                    <div class="flex items-center justify-center sm:justify-start gap-2 mt-2">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold
                            <?php if(Auth::user()->role === 'ADMIN'): ?> bg-red-50 text-red-700 border border-red-200
                            <?php else: ?> bg-blue-50 text-blue-700 border border-blue-200 <?php endif; ?>">
                            <span class="w-1.5 h-1.5 rounded-full
                                <?php if(Auth::user()->role === 'ADMIN'): ?> bg-red-500
                                <?php else: ?> bg-blue-500 <?php endif; ?>"></span>
                            <?php echo e(Auth::user()->role); ?>

                        </span>
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                            Cuenta Activa
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    
    <div class="max-w-4xl mx-auto space-y-6 pb-8">
        
        <div class="abc-card animate-fade-in-up animate-fade-in-up-delay-1">
            <div class="px-6 py-4 border-b flex items-center gap-3" style="border-color: var(--surface-border);">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: rgba(14,165,233,0.1);">
                    <svg class="w-4 h-4" style="color: var(--abc-sky);" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold" style="color: var(--text-primary);">Información del Perfil</h3>
                    <p class="text-xs" style="color: var(--text-muted);">Actualiza tu nombre y correo electrónico</p>
                </div>
            </div>
            <div class="p-6">
                <?php echo $__env->make('profile.partials.update-profile-information-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>

        
        <div class="abc-card animate-fade-in-up animate-fade-in-up-delay-2">
            <div class="px-6 py-4 border-b flex items-center gap-3" style="border-color: var(--surface-border);">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: rgba(244,178,35,0.1);">
                    <svg class="w-4 h-4" style="color: var(--abc-gold);" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold" style="color: var(--text-primary);">Actualizar Contraseña</h3>
                    <p class="text-xs" style="color: var(--text-muted);">Usa una contraseña segura y única para proteger tu cuenta</p>
                </div>
            </div>
            <div class="p-6">
                <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
<?php /**PATH C:\Users\hp pavilion\OneDrive\Escritorio\System Correos\system-correos\resources\views/profile/edit.blade.php ENDPATH**/ ?>
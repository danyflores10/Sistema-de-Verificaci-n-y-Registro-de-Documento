<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <link rel="icon" type="image/png" href="<?php echo e(asset('images/logoCorreos.png')); ?>">
        <title><?php echo e(config('app.name', 'AGBC Documentos')); ?></title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
        
        <script>
            (function(){
                const t = localStorage.getItem('abc-theme');
                if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                }
                // Apply accent color before paint
                const presets = {
                    navy:   { p: '#0c2340', l: '#1a3c68', d: '#081a2f' },
                    blue:   { p: '#1d4ed8', l: '#3b82f6', d: '#1e3a8a' },
                    purple: { p: '#7c3aed', l: '#8b5cf6', d: '#5b21b6' },
                    teal:   { p: '#0d9488', l: '#14b8a6', d: '#0f766e' },
                    rose:   { p: '#e11d48', l: '#f43f5e', d: '#9f1239' },
                    amber:  { p: '#d97706', l: '#f59e0b', d: '#b45309' },
                };
                const a = localStorage.getItem('abc-accent') || 'navy';
                const c = presets[a] || presets.navy;
                document.documentElement.style.setProperty('--accent-primary', c.p);
                document.documentElement.style.setProperty('--accent-light', c.l);
                document.documentElement.style.setProperty('--accent-dark', c.d);
            })();
        </script>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="font-sans antialiased">

        
        <div id="page-loader" aria-hidden="true">
            <div class="loader-wrapper">
                <div class="loader-ball blue"></div>
                <div class="loader-ball red"></div>
                <div class="loader-ball yellow"></div>
                <div class="loader-ball green"></div>
            </div>
            <p class="loader-text">Cargando...</p>
        </div>

        <script>
            // Ocultar loader cuando la página termina de cargar
            (function () {
                function hideLoader() {
                    var el = document.getElementById('page-loader');
                    if (el) { el.classList.add('loader-hidden'); }
                }
                if (document.readyState === 'complete') {
                    hideLoader();
                } else {
                    window.addEventListener('load', hideLoader);
                    // Fallback: máximo 8 segundos para conexiones lentas
                    setTimeout(hideLoader, 8000);
                }
                // Mostrar loader en navegación (links internos)
                document.addEventListener('click', function (e) {
                    var a = e.target.closest('a');
                    if (a && a.href && !a.href.startsWith('#') && !a.href.startsWith('javascript') &&
                        a.target !== '_blank' && a.origin === window.location.origin &&
                        !a.hasAttribute('data-no-loader')) {
                        var el2 = document.getElementById('page-loader');
                        if (el2) { el2.classList.remove('loader-hidden'); }
                    }
                });
                // Mostrar loader en submit de formularios
                document.addEventListener('submit', function (e) {
                    if (!e.target.hasAttribute('data-no-loader')) {
                        var el3 = document.getElementById('page-loader');
                        if (el3) { el3.classList.remove('loader-hidden'); }
                    }
                });
            })();
        </script>

        <div class="min-h-screen flex" x-data="{ sidebarOpen: window.innerWidth >= 1024, mobileSidebar: false }">

            
            <div x-show="mobileSidebar"
                 x-transition:enter="transition-opacity ease-out duration-300"
                 x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-in duration-200"
                 x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 @click="mobileSidebar = false"
                 class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 lg:hidden"
                 x-cloak></div>

            
            <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            
            <div class="flex-1 flex flex-col min-h-screen transition-all duration-300"
                 :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'">

                
                <header class="abc-topbar sticky top-0 z-30">
                    <div class="flex items-center justify-between px-4 lg:px-6 h-16">
                        
                        <div class="flex items-center gap-3">
                            <button @click="sidebarOpen = !sidebarOpen"
                                    class="hidden lg:flex items-center justify-center w-9 h-9 rounded-lg transition-colors"
                                    style="color: var(--text-muted);"
                                    onmouseover="this.style.backgroundColor='var(--surface-border)'"
                                    onmouseout="this.style.backgroundColor='transparent'">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </button>
                            <button @click="mobileSidebar = true"
                                    class="lg:hidden flex items-center justify-center w-9 h-9 rounded-lg transition-colors"
                                    style="color: var(--text-muted);">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </button>

                            
                            <div class="hidden sm:flex items-center gap-2 text-sm" style="color: var(--text-muted);">
                                <svg class="w-4 h-4 text-[var(--abc-gold)]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                <span class="font-medium" style="color: var(--text-secondary);">Agencia Boliviana de Correos</span>
                            </div>
                        </div>

                        
                        <div class="flex items-center gap-2 sm:gap-3">

                            
                            <div class="relative" x-data="{ colorOpen: false }">
                                <button @click="colorOpen = !colorOpen"
                                        class="relative flex items-center justify-center w-9 h-9 rounded-lg transition-all duration-300"
                                        style="color: var(--text-muted);"
                                        onmouseover="this.style.backgroundColor='var(--surface-border)'"
                                        onmouseout="this.style.backgroundColor='transparent'"
                                        title="Personalizar color">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42" />
                                    </svg>
                                </button>
                                
                                <div x-show="colorOpen" @click.away="colorOpen = false"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute right-0 top-full mt-2 w-56 rounded-xl shadow-2xl border p-4 z-50"
                                     style="background: var(--surface-card); border-color: var(--surface-border);"
                                     x-cloak>
                                    <p class="text-xs font-bold uppercase tracking-wider mb-3" style="color: var(--text-muted);">
                                        <svg class="w-3.5 h-3.5 inline -mt-0.5 mr-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42" /></svg>
                                        Color del sistema
                                    </p>
                                    <div class="grid grid-cols-3 gap-2.5">
                                        <template x-for="(preset, key) in $store.accent.presets" :key="key">
                                            <button @click="$store.accent.apply(key); colorOpen = false"
                                                    class="group relative flex flex-col items-center gap-1.5 p-2 rounded-lg transition-all duration-200 hover:scale-105"
                                                    :class="$store.accent.current === key ? 'ring-2 ring-offset-2 dark:ring-offset-gray-800' : 'hover:bg-gray-100 dark:hover:bg-gray-700/50'"
                                                    :style="$store.accent.current === key ? 'ring-color: ' + preset.primary : ''">
                                                <div class="w-8 h-8 rounded-full shadow-md transition-transform duration-200 group-hover:shadow-lg relative"
                                                     :style="'background: linear-gradient(135deg, ' + preset.primary + ', ' + preset.light + ')'">
                                                    <div x-show="$store.accent.current === key"
                                                         class="absolute inset-0 flex items-center justify-center">
                                                        <svg class="w-4 h-4 text-white drop-shadow" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                                    </div>
                                                </div>
                                                <span class="text-[10px] font-semibold capitalize" style="color: var(--text-secondary);" x-text="key"></span>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            
                            <button @click="$store.theme.toggle()"
                                    class="relative flex items-center justify-center w-9 h-9 rounded-lg transition-all duration-300"
                                    style="color: var(--text-muted);"
                                    onmouseover="this.style.backgroundColor='var(--surface-border)'"
                                    onmouseout="this.style.backgroundColor='transparent'"
                                    :title="$store.theme.dark ? 'Cambiar a modo claro' : 'Cambiar a modo oscuro'">
                                
                                <svg x-show="$store.theme.dark" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 rotate-[-90deg] scale-0" x-transition:enter-end="opacity-100 rotate-0 scale-100"
                                     class="w-5 h-5 text-[var(--abc-gold)]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                                </svg>
                                
                                <svg x-show="!$store.theme.dark" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 rotate-90 scale-0" x-transition:enter-end="opacity-100 rotate-0 scale-100"
                                     class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                                </svg>
                            </button>

                            
                            <button x-data="{ isFs: false }"
                                    x-init="
                                        /* Al cargar la página, si el usuario tenía FS activo, reactivarlo */
                                        if (localStorage.getItem('abc-fullscreen') === '1') {
                                            document.documentElement.requestFullscreen().then(() => { isFs = true }).catch(() => {});
                                        }
                                        /* Sincronizar ícono y guardar preferencia al cambiar estado */
                                        document.addEventListener('fullscreenchange', () => {
                                            isFs = !!document.fullscreenElement;
                                            localStorage.setItem('abc-fullscreen', isFs ? '1' : '0');
                                        });
                                        /* Si el usuario presiona ESC, limpiar preferencia */
                                        document.addEventListener('keydown', (e) => {
                                            if (e.key === 'Escape' && isFs) {
                                                localStorage.setItem('abc-fullscreen', '0');
                                            }
                                        });
                                    "
                                    @click="isFs ? (localStorage.setItem('abc-fullscreen','0'), document.exitFullscreen()) : document.documentElement.requestFullscreen()"
                                    class="relative flex items-center justify-center w-9 h-9 rounded-lg transition-all duration-300"
                                    style="color: var(--text-muted);"
                                    onmouseover="this.style.backgroundColor='var(--surface-border)'"
                                    onmouseout="this.style.backgroundColor='transparent'"
                                    :title="isFs ? 'Salir de pantalla completa (ESC)' : 'Pantalla completa'">
                                <svg x-show="!isFs" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                                </svg>
                                <svg x-show="isFs" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 9V4.5M9 9H4.5M9 9 3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5 5.25 5.25" />
                                </svg>
                            </button>

                            
                            <div class="hidden sm:block w-px h-8" style="background-color: var(--surface-border);"></div>

                            
                            <?php if (isset($component)) { $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown','data' => ['align' => 'right','width' => '48']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'right','width' => '48']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                                 <?php $__env->slot('trigger', null, []); ?> 
                                    <button class="flex items-center gap-2.5 px-2 py-1.5 rounded-xl transition-colors"
                                            style="color: var(--text-primary);"
                                            onmouseover="this.style.backgroundColor='var(--surface-border)'"
                                            onmouseout="this.style.backgroundColor='transparent'">
                                        <div class="w-9 h-9 rounded-lg gradient-navy flex items-center justify-center text-white text-xs font-bold shadow-sm">
                                            <?php echo e(strtoupper(substr(Auth::user()->name, 0, 2))); ?>

                                        </div>
                                        <div class="hidden md:block text-left">
                                            <p class="text-sm font-semibold leading-tight" style="color: var(--text-primary);"><?php echo e(Auth::user()->name); ?></p>
                                            <p class="text-xs" style="color: var(--text-muted);"><?php echo e(Auth::user()->email); ?></p>
                                        </div>
                                        <svg class="w-4 h-4 hidden md:block" style="color: var(--text-muted);" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                 <?php $__env->endSlot(); ?>
                                 <?php $__env->slot('content', null, []); ?> 
                                    <div class="px-4 py-3 border-b" style="border-color: var(--surface-border);">
                                        <p class="text-sm font-semibold" style="color: var(--text-primary);"><?php echo e(Auth::user()->name); ?></p>
                                        <p class="text-xs" style="color: var(--text-muted);"><?php echo e(Auth::user()->email); ?></p>
                                    </div>
                                    <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('profile.edit'),'class' => 'flex items-center gap-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('profile.edit')),'class' => 'flex items-center gap-2']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0" /></svg>
                                        Mi Perfil
                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                                    
                                    <button @click="$store.theme.toggle()" class="block w-full px-4 py-2 text-start text-sm leading-5 transition duration-150 ease-in-out hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none flex items-center gap-2" style="color: var(--text-secondary);">
                                        <template x-if="$store.theme.dark">
                                            <svg class="w-4 h-4 text-[var(--abc-gold)]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" /></svg>
                                        </template>
                                        <template x-if="!$store.theme.dark">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" /></svg>
                                        </template>
                                        <span x-text="$store.theme.dark ? 'Modo Claro' : 'Modo Oscuro'"></span>
                                    </button>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('logout'),'onclick' => 'event.preventDefault(); this.closest(\'form\').submit();','class' => 'flex items-center gap-2 text-red-600 hover:text-red-700']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('logout')),'onclick' => 'event.preventDefault(); this.closest(\'form\').submit();','class' => 'flex items-center gap-2 text-red-600 hover:text-red-700']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" /></svg>
                                            Cerrar Sesión
                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                                    </form>
                                 <?php $__env->endSlot(); ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $attributes = $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $component = $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
                        </div>
                    </div>
                </header>

                
                <main class="flex-1 p-4 lg:p-8">
                    <?php echo e($slot); ?>

                </main>

                
                <footer class="abc-footer px-8 py-3">
                    <p class="text-xs text-center" style="color: var(--text-muted);">&copy; <?php echo e(date('Y')); ?> Agencia Boliviana de Correos — Sistema de Verificación de Documentos</p>
                </footer>
            </div>

        </div>

        
        <div class="abc-toast-container" x-data>
            <template x-for="toast in $store.toasts.items" :key="toast.id">
                <div :class="[
                    'abc-toast',
                    'abc-toast-' + toast.type,
                    toast.removing ? 'abc-toast-exit' : ''
                ]">
                    
                    <div class="flex-shrink-0 mt-0.5">
                        <template x-if="toast.type === 'success'">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                        </template>
                        <template x-if="toast.type === 'error'">
                            <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
                        </template>
                        <template x-if="toast.type === 'warning'">
                            <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>
                        </template>
                        <template x-if="toast.type === 'info'">
                            <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>
                        </template>
                    </div>
                    
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold leading-tight" x-text="toast.title"></p>
                        <p class="text-xs mt-0.5 opacity-75 leading-snug" x-text="toast.message"></p>
                    </div>
                    
                    <button @click="$store.toasts.remove(toast.id)" class="flex-shrink-0 p-1 rounded opacity-40 hover:opacity-100 transition-opacity">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </template>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <script>
                document.addEventListener('alpine:initialized', () => {
                    Alpine.store('toasts').success(<?php echo json_encode(session('success'), 15, 512) ?>);
                });
            </script>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
            <script>
                document.addEventListener('alpine:initialized', () => {
                    Alpine.store('toasts').error(<?php echo json_encode(session('error'), 15, 512) ?>);
                });
            </script>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('warning')): ?>
            <script>
                document.addEventListener('alpine:initialized', () => {
                    Alpine.store('toasts').warning(<?php echo json_encode(session('warning'), 15, 512) ?>);
                });
            </script>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php echo $__env->yieldPushContent('scripts'); ?>
    </body>
</html>
<?php /**PATH C:\Users\hp pavilion\OneDrive\Escritorio\System Correos\system-correos\resources\views\layouts\app.blade.php ENDPATH**/ ?>
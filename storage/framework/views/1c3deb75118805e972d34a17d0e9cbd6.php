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

    
    <div class="relative overflow-hidden rounded-none" style="background: linear-gradient(135deg, #0c2340 0%, #1a3c68 40%, #0ea5e9 80%, #0d9488 100%);">
        
        <div class="absolute -top-12 -right-12 w-64 h-64 rounded-full opacity-10" style="background: radial-gradient(circle, white 0%, transparent 70%);"></div>
        <div class="absolute -bottom-8 -left-8 w-48 h-48 rounded-full opacity-[0.07]" style="background: radial-gradient(circle, white 0%, transparent 70%);"></div>
        <div class="absolute top-1/2 left-1/3 w-32 h-32 rounded-full opacity-[0.05]" style="background: radial-gradient(circle, white 0%, transparent 70%);"></div>

        <div class="relative z-10 px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 rounded-2xl bg-white/15 backdrop-blur-sm flex items-center justify-center border border-white/10 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" /></svg>
                        </div>
                        <div>
                            <p class="text-blue-200/80 text-xs font-medium uppercase tracking-widest">Bienvenido</p>
                            <h1 class="text-2xl lg:text-3xl font-extrabold text-white tracking-tight">Panel de Control</h1>
                        </div>
                    </div>
                    <p class="text-blue-200/70 text-sm ml-0.5">Agencia Boliviana de Correos — Sistema de Verificación de Documentos</p>
                </div>
                <div class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-white/10 backdrop-blur-sm border border-white/10">
                    <svg class="w-4 h-4 text-blue-200/80" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                    <span class="text-white/90 text-sm font-medium"><?php echo e(now()->translatedFormat('l, d \\d\\e F \\d\\e Y')); ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="px-2 lg:px-0 -mt-6 relative z-10">
        <?php
            $statusChart = [
                ['label' => 'Borradores', 'value' => $borradores, 'color' => '#64748b'],
                ['label' => 'Enviados', 'value' => $enviados, 'color' => '#0ea5e9'],
                ['label' => 'Verificados', 'value' => $verificados, 'color' => '#10b981'],
                ['label' => 'Rechazados', 'value' => $rechazados, 'color' => '#ef4444'],
            ];

            $buildDonutGradient = function (array $segments): string {
                $total = collect($segments)->sum('value');
                if ($total <= 0) {
                    return '#e2e8f0 0deg 360deg';
                }

                $angle = 0;
                $parts = [];
                foreach ($segments as $segment) {
                    $value = (int) ($segment['value'] ?? 0);
                    if ($value <= 0) {
                        continue;
                    }

                    $start = $angle;
                    $angle += ($value / $total) * 360;
                    $parts[] = "{$segment['color']} {$start}deg {$angle}deg";
                }

                return empty($parts) ? '#e2e8f0 0deg 360deg' : implode(', ', $parts);
            };

            $tipologyPalette = ['#2563eb', '#14b8a6', '#8b5cf6', '#f59e0b', '#ef4444', '#0ea5e9'];
            $tipologiaChart = collect($tipologiaStats)->values()->map(function ($item, $index) use ($tipologyPalette) {
                return [
                    'label' => $item->label,
                    'value' => (int) $item->total,
                    'color' => $tipologyPalette[$index % count($tipologyPalette)],
                ];
            })->all();

            $statusGradient = $buildDonutGradient($statusChart);
            $tipologiaGradient = $buildDonutGradient($tipologiaChart);
            $monthlyMax = max(1, (int) collect($monthlyStats)->max('total'));
            $topBoxesMax = max(1, (int) collect($topBoxes)->max('total_documentos'));
        ?>

        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            
            <div class="group relative overflow-hidden rounded-2xl p-5 text-white shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl animate-fade-in-up"
                 style="background: linear-gradient(135deg, #0c2340 0%, #1a3c68 100%);">
                <div class="absolute -top-4 -right-4 w-20 h-20 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-500"></div>
                <div class="absolute -bottom-2 -right-2 w-12 h-12 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-700"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-blue-200/80 text-[11px] font-bold uppercase tracking-wider">Total Cajas</p>
                        <p class="text-4xl font-black mt-1 tracking-tight">
                            <span class="dashboard-count" data-count-to="<?php echo e($totalBoxes); ?>"><?php echo e(number_format($totalBoxes)); ?></span>
                        </p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-sm group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white/80" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" /></svg>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1.5">
                    <div class="h-1 flex-1 rounded-full bg-white/10 overflow-hidden">
                        <div class="h-full rounded-full bg-blue-400/60" style="width: 100%"></div>
                    </div>
                </div>
            </div>

            
            <div class="group relative overflow-hidden rounded-2xl p-5 text-white shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl animate-fade-in-up animate-fade-in-up-delay-1"
                 style="background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%);">
                <div class="absolute -top-4 -right-4 w-20 h-20 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-500"></div>
                <div class="absolute -bottom-2 -right-2 w-12 h-12 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-700"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-sky-100/80 text-[11px] font-bold uppercase tracking-wider">Total Documentos</p>
                        <p class="text-4xl font-black mt-1 tracking-tight">
                            <span class="dashboard-count" data-count-to="<?php echo e($totalNotes); ?>"><?php echo e(number_format($totalNotes)); ?></span>
                        </p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-sm group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white/80" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1.5">
                    <div class="h-1 flex-1 rounded-full bg-white/10 overflow-hidden">
                        <div class="h-full rounded-full bg-sky-300/60" style="width: 100%"></div>
                    </div>
                </div>
            </div>

            
            <div class="group relative overflow-hidden rounded-2xl p-5 text-white shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl animate-fade-in-up animate-fade-in-up-delay-2"
                 style="background: linear-gradient(135deg, #059669 0%, #34d399 100%);">
                <div class="absolute -top-4 -right-4 w-20 h-20 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-500"></div>
                <div class="absolute -bottom-2 -right-2 w-12 h-12 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-700"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100/80 text-[11px] font-bold uppercase tracking-wider">Verificados</p>
                        <p class="text-4xl font-black mt-1 tracking-tight">
                            <span class="dashboard-count" data-count-to="<?php echo e($verificados); ?>"><?php echo e(number_format($verificados)); ?></span>
                        </p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-sm group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white/80" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1.5">
                    <div class="h-1 flex-1 rounded-full bg-white/10 overflow-hidden">
                        <div class="h-full rounded-full bg-emerald-300/60" style="width: <?php echo e($totalNotes > 0 ? round($verificados / $totalNotes * 100) : 0); ?>%"></div>
                    </div>
                    <span class="text-[10px] font-bold text-white/60">
                        <span class="dashboard-count"
                              data-count-to="<?php echo e($totalNotes > 0 ? round($verificados / $totalNotes * 100) : 0); ?>"
                              data-suffix="%"><?php echo e($totalNotes > 0 ? round($verificados / $totalNotes * 100) : 0); ?>%</span>
                    </span>
                </div>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->isAdmin()): ?>
            
            <div class="group relative overflow-hidden rounded-2xl p-5 text-white shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl animate-fade-in-up animate-fade-in-up-delay-3"
                 style="background: linear-gradient(135deg, #dc2626 0%, #f87171 100%);">
                <div class="absolute -top-4 -right-4 w-20 h-20 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-500"></div>
                <div class="absolute -bottom-2 -right-2 w-12 h-12 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-700"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-red-100/80 text-[11px] font-bold uppercase tracking-wider">Pendientes</p>
                        <p class="text-4xl font-black mt-1 tracking-tight">
                            <span class="dashboard-count" data-count-to="<?php echo e($pendientesRevision); ?>"><?php echo e(number_format($pendientesRevision)); ?></span>
                        </p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-sm group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white/80" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1.5">
                    <div class="h-1 flex-1 rounded-full bg-white/10 overflow-hidden">
                        <div class="h-full rounded-full bg-red-300/60 animate-pulse" style="width: <?php echo e($totalNotes > 0 ? round($pendientesRevision / $totalNotes * 100) : 0); ?>%"></div>
                    </div>
                    <span class="text-[10px] font-bold text-white/60">
                        <span class="dashboard-count" data-count-to="<?php echo e($pendientesRevision); ?>"><?php echo e(number_format($pendientesRevision)); ?></span>
                    </span>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-6">
            <div class="abc-card group hover:shadow-lg transition-all duration-300 p-4 flex items-center gap-3.5 border-l-4 border-l-gray-400">
                <div class="w-11 h-11 rounded-xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <div class="w-3 h-3 rounded-full bg-gray-400"></div>
                </div>
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-wider" style="color: var(--text-muted)">Borradores</p>
                    <p class="text-2xl font-black" style="color: var(--text-primary)">
                        <span class="dashboard-count" data-count-to="<?php echo e($borradores); ?>"><?php echo e(number_format($borradores)); ?></span>
                    </p>
                </div>
            </div>
            <div class="abc-card group hover:shadow-lg transition-all duration-300 p-4 flex items-center gap-3.5 border-l-4 border-l-sky-500">
                <div class="w-11 h-11 rounded-xl bg-sky-50 dark:bg-sky-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <div class="w-3 h-3 rounded-full bg-sky-500"></div>
                </div>
                <div>
                    <p class="text-[11px] text-sky-600 dark:text-sky-400 font-bold uppercase tracking-wider">Enviados</p>
                    <p class="text-2xl font-black" style="color: var(--text-primary)">
                        <span class="dashboard-count" data-count-to="<?php echo e($enviados); ?>"><?php echo e(number_format($enviados)); ?></span>
                    </p>
                </div>
            </div>
            <div class="abc-card group hover:shadow-lg transition-all duration-300 p-4 flex items-center gap-3.5 border-l-4 border-l-emerald-500">
                <div class="w-11 h-11 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                </div>
                <div>
                    <p class="text-[11px] text-emerald-600 dark:text-emerald-400 font-bold uppercase tracking-wider">Verificados</p>
                    <p class="text-2xl font-black" style="color: var(--text-primary)">
                        <span class="dashboard-count" data-count-to="<?php echo e($verificados); ?>"><?php echo e(number_format($verificados)); ?></span>
                    </p>
                </div>
            </div>
            <div class="abc-card group hover:shadow-lg transition-all duration-300 p-4 flex items-center gap-3.5 border-l-4 border-l-red-500">
                <div class="w-11 h-11 rounded-xl bg-red-50 dark:bg-red-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                </div>
                <div>
                    <p class="text-[11px] text-red-600 dark:text-red-400 font-bold uppercase tracking-wider">Rechazados</p>
                    <p class="text-2xl font-black" style="color: var(--text-primary)">
                        <span class="dashboard-count" data-count-to="<?php echo e($rechazados); ?>"><?php echo e(number_format($rechazados)); ?></span>
                    </p>
                </div>
            </div>
        </div>

        
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
            <div class="abc-card p-5 border border-slate-200/70 dark:border-slate-700/60">
                <p class="text-[11px] font-bold uppercase tracking-widest" style="color: var(--text-muted)">Fojas Totales</p>
                <p class="text-3xl font-black mt-1.5" style="color: var(--text-primary)">
                    <span class="dashboard-count" data-count-to="<?php echo e($totalPages); ?>"><?php echo e(number_format($totalPages)); ?></span>
                </p>
                <p class="text-xs mt-2" style="color: var(--text-muted)">Capacidad documental procesada</p>
            </div>
            <div class="abc-card p-5 border border-slate-200/70 dark:border-slate-700/60">
                <p class="text-[11px] font-bold uppercase tracking-widest" style="color: var(--text-muted)">Promedio Fojas/Doc</p>
                <p class="text-3xl font-black mt-1.5" style="color: var(--text-primary)">
                    <span class="dashboard-count" data-count-to="<?php echo e($averagePages); ?>" data-decimals="1"><?php echo e(number_format($averagePages, 1)); ?></span>
                </p>
                <p class="text-xs mt-2" style="color: var(--text-muted)">Promedio por documento registrado</p>
            </div>
            <div class="abc-card p-5 border border-slate-200/70 dark:border-slate-700/60">
                <p class="text-[11px] font-bold uppercase tracking-widest" style="color: var(--text-muted)">Tasa de Verificación</p>
                <p class="text-3xl font-black mt-1.5 text-emerald-600">
                    <span class="dashboard-count" data-count-to="<?php echo e($verificationRate); ?>" data-decimals="1" data-suffix="%"><?php echo e(number_format($verificationRate, 1)); ?>%</span>
                </p>
                <p class="text-xs mt-2" style="color: var(--text-muted)">Documentos verificados sobre el total</p>
            </div>
            <div class="abc-card p-5 border border-slate-200/70 dark:border-slate-700/60">
                <p class="text-[11px] font-bold uppercase tracking-widest" style="color: var(--text-muted)">Tasa de Rechazo</p>
                <p class="text-3xl font-black mt-1.5 text-rose-600">
                    <span class="dashboard-count" data-count-to="<?php echo e($rejectionRate); ?>" data-decimals="1" data-suffix="%"><?php echo e(number_format($rejectionRate, 1)); ?>%</span>
                </p>
                <p class="text-xs mt-2" style="color: var(--text-muted)">Documentos rechazados sobre el total</p>
            </div>
        </div>

        
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">
            <div class="abc-card p-6 border border-slate-200/70 dark:border-slate-700/60">
                <div class="flex items-center justify-between gap-2 mb-4">
                    <h3 class="text-base font-extrabold" style="color: var(--text-primary)">Distribución por Estado</h3>
                    <span class="text-xs px-2.5 py-1 rounded-full bg-slate-100 dark:bg-slate-800 font-semibold" style="color: var(--text-muted)">
                        <span class="dashboard-count" data-count-to="<?php echo e($totalNotes); ?>"><?php echo e(number_format($totalNotes)); ?></span> docs
                    </span>
                </div>

                <div class="dashboard-donut" style="background: conic-gradient(<?php echo e($statusGradient); ?>);">
                    <div class="dashboard-donut-center">
                        <span class="text-xs font-semibold uppercase tracking-wider" style="color: var(--text-muted)">Total</span>
                        <span class="text-2xl font-black" style="color: var(--text-primary)">
                            <span class="dashboard-count" data-count-to="<?php echo e($totalNotes); ?>"><?php echo e(number_format($totalNotes)); ?></span>
                        </span>
                    </div>
                </div>

                <div class="mt-5 grid grid-cols-1 gap-2.5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $statusChart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-2.5">
                                <span class="dashboard-legend-dot" style="background: <?php echo e($item['color']); ?>"></span>
                                <span style="color: var(--text-secondary)"><?php echo e($item['label']); ?></span>
                            </div>
                            <span class="font-bold" style="color: var(--text-primary)">
                                <span class="dashboard-count" data-count-to="<?php echo e($item['value']); ?>"><?php echo e(number_format($item['value'])); ?></span>
                            </span>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>

            <div class="abc-card p-6 border border-slate-200/70 dark:border-slate-700/60">
                <div class="flex items-center justify-between gap-2 mb-4">
                    <h3 class="text-base font-extrabold" style="color: var(--text-primary)">Distribución por Tipología</h3>
                    <span class="text-xs px-2.5 py-1 rounded-full bg-indigo-50 dark:bg-indigo-900/30 font-semibold text-indigo-600 dark:text-indigo-300">
                        Top 6
                    </span>
                </div>

                <div class="dashboard-donut" style="background: conic-gradient(<?php echo e($tipologiaGradient); ?>);">
                    <div class="dashboard-donut-center">
                        <span class="text-xs font-semibold uppercase tracking-wider" style="color: var(--text-muted)">Tipologías</span>
                        <span class="text-2xl font-black" style="color: var(--text-primary)">
                            <span class="dashboard-count" data-count-to="<?php echo e(count($tipologiaChart)); ?>"><?php echo e(number_format(count($tipologiaChart))); ?></span>
                        </span>
                    </div>
                </div>

                <div class="mt-5 grid grid-cols-1 gap-2.5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tipologiaChart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <span class="dashboard-legend-dot" style="background: <?php echo e($item['color']); ?>"></span>
                                <span class="truncate" style="color: var(--text-secondary)"><?php echo e($item['label']); ?></span>
                            </div>
                            <span class="font-bold ml-2" style="color: var(--text-primary)">
                                <span class="dashboard-count" data-count-to="<?php echo e($item['value']); ?>"><?php echo e(number_format($item['value'])); ?></span>
                            </span>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <p class="text-sm text-center py-6" style="color: var(--text-muted)">Sin datos de tipología aún.</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            <div class="abc-card p-6 border border-slate-200/70 dark:border-slate-700/60">
                <div class="flex items-center justify-between gap-2 mb-4">
                    <h3 class="text-base font-extrabold" style="color: var(--text-primary)">Ranking de Cajas</h3>
                    <span class="text-xs px-2.5 py-1 rounded-full bg-emerald-50 dark:bg-emerald-900/30 font-semibold text-emerald-600 dark:text-emerald-300">
                        Más activas
                    </span>
                </div>

                <div class="space-y-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $topBoxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $box): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <?php
                            $boxWidth = $topBoxesMax > 0 ? round(($box->total_documentos / $topBoxesMax) * 100, 2) : 0;
                        ?>
                        <div>
                            <div class="flex items-center justify-between text-sm mb-1.5">
                                <span class="font-bold" style="color: var(--text-primary)"><?php echo e($box->box_number); ?></span>
                                <span class="font-semibold" style="color: var(--text-secondary)">
                                    <span class="dashboard-count" data-count-to="<?php echo e($box->total_documentos); ?>"><?php echo e(number_format($box->total_documentos)); ?></span> docs
                                </span>
                            </div>
                            <div class="h-2 rounded-full bg-slate-200 dark:bg-slate-700 overflow-hidden">
                                <div class="h-full rounded-full" style="width: <?php echo e($boxWidth); ?>%; background: linear-gradient(90deg, #0ea5e9 0%, #22c55e 100%);"></div>
                            </div>
                            <p class="text-[11px] mt-1.5" style="color: var(--text-muted)">
                                <span class="dashboard-count" data-count-to="<?php echo e($box->total_fojas); ?>"><?php echo e(number_format($box->total_fojas)); ?></span> fojas acumuladas
                            </p>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <p class="text-sm text-center py-6" style="color: var(--text-muted)">No hay cajas con actividad registrada.</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="abc-card p-6 mb-6 border border-slate-200/70 dark:border-slate-700/60">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
                <div>
                    <h3 class="text-base font-extrabold" style="color: var(--text-primary)">Evolución de Documentos (Últimos 6 meses)</h3>
                    <p class="text-xs mt-1" style="color: var(--text-muted)">Comparativa mensual de documentos registrados, verificados y rechazados.</p>
                </div>
                <div class="flex items-center gap-3 text-xs font-semibold">
                    <span class="inline-flex items-center gap-1.5"><span class="dashboard-legend-dot" style="background:#0ea5e9"></span>Total</span>
                    <span class="inline-flex items-center gap-1.5"><span class="dashboard-legend-dot" style="background:#10b981"></span>Verificados</span>
                    <span class="inline-flex items-center gap-1.5"><span class="dashboard-legend-dot" style="background:#ef4444"></span>Rechazados</span>
                </div>
            </div>

            <div class="dashboard-month-grid">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $monthlyStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <?php
                        $totalHeight = $monthlyMax > 0 ? round(($month['total'] / $monthlyMax) * 100, 2) : 0;
                        $verifiedHeight = $monthlyMax > 0 ? round(($month['verificados'] / $monthlyMax) * 100, 2) : 0;
                        $rejectedHeight = $monthlyMax > 0 ? round(($month['rechazados'] / $monthlyMax) * 100, 2) : 0;
                    ?>
                    <div class="rounded-xl p-3 border border-slate-200/70 dark:border-slate-700/60 bg-white/60 dark:bg-slate-900/20">
                        <div class="dashboard-month-bars">
                            <div class="dashboard-month-bar" style="height: <?php echo e($totalHeight); ?>%; background: #0ea5e9;"></div>
                            <div class="dashboard-month-bar" style="height: <?php echo e($verifiedHeight); ?>%; background: #10b981;"></div>
                            <div class="dashboard-month-bar" style="height: <?php echo e($rejectedHeight); ?>%; background: #ef4444;"></div>
                        </div>
                        <p class="text-xs font-bold text-center mt-2" style="color: var(--text-primary)"><?php echo e($month['label']); ?></p>
                        <p class="text-[11px] text-center mt-0.5" style="color: var(--text-muted)"><?php echo e(number_format($month['total'])); ?> docs</p>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>

        
        <?php
            $currentPage = $recentNotes->currentPage();
            $lastPage = $recentNotes->lastPage();
            $startPage = max(1, $currentPage - 2);
            $endPage = min($lastPage, $currentPage + 2);

            if (($endPage - $startPage) < 4) {
                $startPage = max(1, $endPage - 4);
                $endPage = min($lastPage, $startPage + 4);
            }
        ?>
        <div class="abc-card overflow-hidden shadow-lg">
            <div class="px-6 py-5 flex items-center justify-between" style="border-bottom: 1px solid var(--surface-border);">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, var(--accent-primary), var(--accent-light));">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold" style="color: var(--text-primary)">Últimos Registros</h3>
                        <p class="text-xs" style="color: var(--text-muted)">
                            Mostrando <?php echo e($recentNotes->firstItem() ?? 0); ?> a <?php echo e($recentNotes->lastItem() ?? 0); ?> de <?php echo e($recentNotes->total()); ?> registros
                        </p>
                    </div>
                </div>
                <a href="<?php echo e(route('notes.index')); ?>"
                   class="hidden sm:inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 hover:-translate-x-0.5"
                   style="color: var(--accent-primary); background: var(--accent-primary)10;">
                    Ver todos
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="abc-table">
                    <thead>
                        <tr>
                            <th>N° Caja</th>
                            <th>N° Carpeta</th>
                            <th>N° de Documento</th>
                            <th>Fecha</th>
                            <th>Referencia</th>
                            <th>Estado</th>
                            <th>Creado por</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $recentNotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <tr class="group hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors">
                                <td>
                                    <span class="inline-flex items-center gap-1.5 font-bold text-sm" style="color: var(--text-primary)">
                                        <svg class="w-3.5 h-3.5 opacity-40" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" /></svg>
                                        <?php echo e($note->box->box_number ?? '-'); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="text-sm tabular-nums" style="color: var(--text-secondary)"><?php echo e($note->folder_number ?? '-'); ?></span>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('notes.show', $note)); ?>" class="font-bold text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 hover:underline transition-colors">
                                        <?php echo e($note->internal_number); ?>

                                    </a>
                                </td>
                                <td>
                                    <span class="text-sm tabular-nums" style="color: var(--text-secondary)"><?php echo e($note->note_date->format('d/m/Y')); ?></span>
                                </td>
                                <td>
                                    <span class="max-w-xs block truncate text-sm" style="color: var(--text-secondary)"><?php echo e($note->reference); ?></span>
                                </td>
                                <td><?php echo $__env->make('partials.status-badge', ['status' => $note->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
                                <td>
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-lg flex items-center justify-center text-white text-[10px] font-bold shadow-sm" style="background: linear-gradient(135deg, var(--accent-primary), var(--accent-light));">
                                            <?php echo e(strtoupper(substr($note->creator->name ?? '-', 0, 1))); ?>

                                        </div>
                                        <span class="text-sm font-medium" style="color: var(--text-secondary)"><?php echo e($note->creator->name ?? '-'); ?></span>
                                    </div>
                                </td>
                            </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <tr>
                                <td colspan="7" class="text-center py-12">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-300 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                                        </div>
                                        <p class="font-semibold text-sm" style="color: var(--text-muted)">No hay registros aún</p>
                                        <a href="<?php echo e(route('notes.create')); ?>" class="text-xs font-semibold px-3 py-1.5 rounded-lg transition" style="color: var(--accent-primary); background: var(--accent-primary)10;">
                                            + Crear primer documento
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($recentNotes->hasPages()): ?>
                <div class="px-6 py-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between" style="border-top: 1px solid var(--surface-border);">
                    <p class="text-xs sm:text-sm font-semibold" style="color: var(--text-muted)">
                        Página <?php echo e($recentNotes->currentPage()); ?> de <?php echo e($recentNotes->lastPage()); ?>

                    </p>
                    <div class="dashboard-pagination-wrap">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($recentNotes->onFirstPage()): ?>
                            <span class="dashboard-pagination-link is-disabled">Anterior</span>
                        <?php else: ?>
                            <a href="<?php echo e($recentNotes->previousPageUrl()); ?>" class="dashboard-pagination-link">Anterior</a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($startPage > 1): ?>
                            <a href="<?php echo e($recentNotes->url(1)); ?>" class="dashboard-pagination-link <?php echo e($currentPage === 1 ? 'is-active' : ''); ?>">1</a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($startPage > 2): ?>
                                <span class="dashboard-pagination-dots">...</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($page = $startPage; $page <= $endPage; $page++): ?>
                            <a href="<?php echo e($recentNotes->url($page)); ?>" class="dashboard-pagination-link <?php echo e($currentPage === $page ? 'is-active' : ''); ?>">
                                <?php echo e($page); ?>

                            </a>
                        <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($endPage < $lastPage): ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($endPage < ($lastPage - 1)): ?>
                                <span class="dashboard-pagination-dots">...</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <a href="<?php echo e($recentNotes->url($lastPage)); ?>" class="dashboard-pagination-link <?php echo e($currentPage === $lastPage ? 'is-active' : ''); ?>">
                                <?php echo e($lastPage); ?>

                            </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($recentNotes->hasMorePages()): ?>
                            <a href="<?php echo e($recentNotes->nextPageUrl()); ?>" class="dashboard-pagination-link">Siguiente</a>
                        <?php else: ?>
                            <span class="dashboard-pagination-link is-disabled">Siguiente</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div class="sm:hidden px-6 py-3 text-center" style="border-top: 1px solid var(--surface-border);">
                <a href="<?php echo e(route('notes.index')); ?>" class="text-sm font-semibold" style="color: var(--accent-primary)">Ver todos los documentos →</a>
            </div>
        </div>
    </div>

    <style>
        .dashboard-count {
            font-variant-numeric: tabular-nums;
        }

        .dashboard-donut {
            width: 210px;
            height: 210px;
            border-radius: 9999px;
            position: relative;
            margin: 0 auto;
            box-shadow: inset 0 0 0 1px rgba(148, 163, 184, 0.25);
        }

        .dashboard-donut::after {
            content: "";
            position: absolute;
            inset: 22%;
            border-radius: 9999px;
            background: var(--surface-card, #ffffff);
            box-shadow: 0 0 0 1px rgba(148, 163, 184, 0.2);
        }

        .dashboard-donut-center {
            position: absolute;
            inset: 0;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            line-height: 1.2;
        }

        .dashboard-legend-dot {
            display: inline-block;
            width: 0.7rem;
            height: 0.7rem;
            border-radius: 9999px;
        }

        .dashboard-month-grid {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 1rem;
            align-items: stretch;
        }

        .dashboard-month-bars {
            min-height: 180px;
            height: 180px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            gap: 0.4rem;
        }

        .dashboard-month-bar {
            width: 12px;
            min-height: 0;
            border-radius: 9999px 9999px 5px 5px;
            transition: all 0.25s ease;
        }

        .dashboard-pagination-wrap {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-end;
            gap: 0.45rem;
        }

        .dashboard-pagination-link {
            min-width: 2.2rem;
            height: 2.2rem;
            padding: 0 0.75rem;
            border-radius: 0.65rem;
            border: 1px solid rgba(148, 163, 184, 0.45);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--text-secondary);
            background: #ffffff;
            transition: all 0.2s ease;
        }

        .dashboard-pagination-link:hover {
            border-color: rgba(59, 130, 246, 0.55);
            color: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.15);
        }

        .dashboard-pagination-link.is-active {
            border-color: transparent;
            color: #ffffff;
            background: linear-gradient(135deg, #1d4ed8 0%, #0ea5e9 100%);
            box-shadow: 0 8px 18px rgba(30, 64, 175, 0.28);
            pointer-events: none;
        }

        .dashboard-pagination-link.is-disabled {
            opacity: 0.5;
            pointer-events: none;
            background: #f1f5f9;
        }

        .dashboard-pagination-dots {
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 700;
            padding: 0 0.1rem;
        }

        @media (max-width: 1200px) {
            .dashboard-month-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {
            .dashboard-donut {
                width: 180px;
                height: 180px;
            }

            .dashboard-month-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .dashboard-pagination-wrap {
                justify-content: flex-start;
            }
        }
    </style>

    <script>
        (function () {
            function animateDashboardCounters() {
                const counters = document.querySelectorAll('.dashboard-count[data-count-to]');
                if (!counters.length) return;

                counters.forEach((counter, index) => {
                    const target = Number(counter.dataset.countTo ?? 0);
                    if (!Number.isFinite(target)) return;

                    const decimals = Number(counter.dataset.decimals ?? 0);
                    const suffix = counter.dataset.suffix ?? '';
                    const prefix = counter.dataset.prefix ?? '';
                    const duration = Number(counter.dataset.duration ?? 1100) + Math.min(index * 25, 250);

                    const formatter = new Intl.NumberFormat('es-BO', {
                        minimumFractionDigits: decimals,
                        maximumFractionDigits: decimals,
                    });

                    const renderValue = (value) => {
                        counter.textContent = `${prefix}${formatter.format(value)}${suffix}`;
                    };

                    renderValue(0);

                    const start = performance.now();
                    const frame = (now) => {
                        const progress = Math.min((now - start) / duration, 1);
                        const eased = 1 - Math.pow(1 - progress, 4);
                        const current = target * eased;

                        renderValue(progress >= 1 ? target : current);

                        if (progress < 1) {
                            requestAnimationFrame(frame);
                        }
                    };

                    requestAnimationFrame(frame);
                });
            }

            document.addEventListener('DOMContentLoaded', animateDashboardCounters);
            window.addEventListener('pageshow', function (event) {
                if (event.persisted) {
                    animateDashboardCounters();
                }
            });
        })();
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
<?php /**PATH C:\Users\hp pavilion\OneDrive\Escritorio\System Correos\system-correos\resources\views/dashboard.blade.php ENDPATH**/ ?>
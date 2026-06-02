<x-app-layout>
    {{-- ═══ Hero Header ═══ --}}
    <div class="relative overflow-hidden rounded-none" style="background: linear-gradient(135deg, #0c2340 0%, #1a3c68 40%, #0ea5e9 80%, #0d9488 100%);">
        {{-- Decorative circles --}}
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
                    <span class="text-white/90 text-sm font-medium">{{ now()->translatedFormat('l, d \\d\\e F \\d\\e Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-[96rem] mx-auto px-3 sm:px-4 lg:px-6 xl:px-8 -mt-6 relative z-10">
        @php
            $statusChart = [
                ['label' => 'Borradores', 'value' => $borradores, 'color' => '#f59e0b'],
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
        @endphp

      <div class="space-y-6 pt-2">

        {{-- ═══ Sección: Resumen General ═══ --}}
        <section>
            <div class="flex items-center gap-2 mb-3">
                <span class="inline-block w-1 h-5 rounded-full" style="background: linear-gradient(180deg, var(--accent-primary), var(--accent-light));"></span>
                <h2 class="text-sm font-bold uppercase tracking-widest" style="color: var(--text-secondary)">Resumen General</h2>
            </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- Total Cajas --}}
            <div class="group relative overflow-hidden rounded-2xl p-5 text-white shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl animate-fade-in-up"
                 style="background: linear-gradient(135deg, #0c2340 0%, #1a3c68 100%);">
                <div class="absolute -top-4 -right-4 w-20 h-20 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-500"></div>
                <div class="absolute -bottom-2 -right-2 w-12 h-12 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-700"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-blue-200/80 text-[11px] font-bold uppercase tracking-wider">Total Cajas</p>
                        <p class="text-4xl font-black mt-1 tracking-tight">
                            <span class="dashboard-count" data-count-to="{{ $totalBoxes }}">{{ number_format($totalBoxes) }}</span>
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

            {{-- Total Notas --}}
            <div class="group relative overflow-hidden rounded-2xl p-5 text-white shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl animate-fade-in-up animate-fade-in-up-delay-1"
                 style="background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%);">
                <div class="absolute -top-4 -right-4 w-20 h-20 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-500"></div>
                <div class="absolute -bottom-2 -right-2 w-12 h-12 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-700"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-sky-100/80 text-[11px] font-bold uppercase tracking-wider">Total Documentos</p>
                        <p class="text-4xl font-black mt-1 tracking-tight">
                            <span class="dashboard-count" data-count-to="{{ $totalNotes }}">{{ number_format($totalNotes) }}</span>
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

            {{-- Verificados --}}
            <div class="group relative overflow-hidden rounded-2xl p-5 text-white shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl animate-fade-in-up animate-fade-in-up-delay-2"
                 style="background: linear-gradient(135deg, #059669 0%, #34d399 100%);">
                <div class="absolute -top-4 -right-4 w-20 h-20 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-500"></div>
                <div class="absolute -bottom-2 -right-2 w-12 h-12 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-700"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100/80 text-[11px] font-bold uppercase tracking-wider">Verificados</p>
                        <p class="text-4xl font-black mt-1 tracking-tight">
                            <span class="dashboard-count" data-count-to="{{ $verificados }}">{{ number_format($verificados) }}</span>
                        </p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-sm group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white/80" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1.5">
                    <div class="h-1 flex-1 rounded-full bg-white/10 overflow-hidden">
                        <div class="h-full rounded-full bg-emerald-300/60" data-width="{{ $totalNotes > 0 ? round($verificados / $totalNotes * 100) : 0 }}%"></div>
                    </div>
                    <span class="text-[10px] font-bold text-white/60">
                        <span class="dashboard-count"
                              data-count-to="{{ $totalNotes > 0 ? round($verificados / $totalNotes * 100) : 0 }}"
                              data-suffix="%">{{ $totalNotes > 0 ? round($verificados / $totalNotes * 100) : 0 }}%</span>
                    </span>
                </div>
            </div>

            @if(auth()->user()->hasModule('verification'))
            {{-- Pendientes --}}
            <div class="group relative overflow-hidden rounded-2xl p-5 text-white shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl animate-fade-in-up animate-fade-in-up-delay-3"
                 style="background: linear-gradient(135deg, #dc2626 0%, #f87171 100%);">
                <div class="absolute -top-4 -right-4 w-20 h-20 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-500"></div>
                <div class="absolute -bottom-2 -right-2 w-12 h-12 rounded-full bg-white/5 group-hover:bg-white/10 transition-all duration-700"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-red-100/80 text-[11px] font-bold uppercase tracking-wider">Pendientes</p>
                        <p class="text-4xl font-black mt-1 tracking-tight">
                            <span class="dashboard-count" data-count-to="{{ $pendientesRevision }}">{{ number_format($pendientesRevision) }}</span>
                        </p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-sm group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white/80" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1.5">
                    <div class="h-1 flex-1 rounded-full bg-white/10 overflow-hidden">
                        <div class="h-full rounded-full bg-red-300/60 animate-pulse" data-width="{{ $totalNotes > 0 ? round($pendientesRevision / $totalNotes * 100) : 0 }}%"></div>
                    </div>
                    <span class="text-[10px] font-bold text-white/60">
                        <span class="dashboard-count" data-count-to="{{ $pendientesRevision }}">{{ number_format($pendientesRevision) }}</span>
                    </span>
                </div>
            </div>
            @endif
        </div>
        </section>

        {{-- ═══ Sección: Estados Documentales ═══ --}}
        <section>
            <div class="flex items-center gap-2 mb-3">
                <span class="inline-block w-1 h-5 rounded-full" style="background: linear-gradient(180deg, var(--accent-primary), var(--accent-light));"></span>
                <h2 class="text-sm font-bold uppercase tracking-widest" style="color: var(--text-secondary)">Estados Documentales</h2>
            </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
            <div class="abc-card group hover:shadow-lg transition-all duration-300 p-4 flex items-center gap-3.5 border-l-4 border-l-gray-400">
                <div class="w-11 h-11 rounded-xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <div class="w-3 h-3 rounded-full bg-gray-400"></div>
                </div>
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-wider" style="color: var(--text-muted)">Borradores</p>
                    <p class="text-2xl font-black" style="color: var(--text-primary)">
                        <span class="dashboard-count" data-count-to="{{ $borradores }}">{{ number_format($borradores) }}</span>
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
                        <span class="dashboard-count" data-count-to="{{ $enviados }}">{{ number_format($enviados) }}</span>
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
                        <span class="dashboard-count" data-count-to="{{ $verificados }}">{{ number_format($verificados) }}</span>
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
                        <span class="dashboard-count" data-count-to="{{ $rechazados }}">{{ number_format($rechazados) }}</span>
                    </p>
                </div>
            </div>
        </div>
        </section>

        {{-- ═══ Sección: Indicadores Clave ═══ --}}
        <section>
            <div class="flex items-center gap-2 mb-3">
                <span class="inline-block w-1 h-5 rounded-full" style="background: linear-gradient(180deg, var(--accent-primary), var(--accent-light));"></span>
                <h2 class="text-sm font-bold uppercase tracking-widest" style="color: var(--text-secondary)">Indicadores Clave</h2>
            </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
            <div class="abc-card p-5 border border-slate-200/70 dark:border-slate-700/60">
                <p class="text-[11px] font-bold uppercase tracking-widest" style="color: var(--text-muted)">Fojas Totales</p>
                <p class="text-3xl font-black mt-1.5" style="color: var(--text-primary)">
                    <span class="dashboard-count" data-count-to="{{ $totalPages }}">{{ number_format($totalPages) }}</span>
                </p>
                <p class="text-xs mt-2" style="color: var(--text-muted)">Capacidad documental procesada</p>
            </div>
            <div class="abc-card p-5 border border-slate-200/70 dark:border-slate-700/60">
                <p class="text-[11px] font-bold uppercase tracking-widest" style="color: var(--text-muted)">Promedio Fojas/Doc</p>
                <p class="text-3xl font-black mt-1.5" style="color: var(--text-primary)">
                    <span class="dashboard-count" data-count-to="{{ $averagePages }}" data-decimals="1">{{ number_format($averagePages, 1) }}</span>
                </p>
                <p class="text-xs mt-2" style="color: var(--text-muted)">Promedio por documento registrado</p>
            </div>
            <div class="abc-card p-5 border border-slate-200/70 dark:border-slate-700/60">
                <p class="text-[11px] font-bold uppercase tracking-widest" style="color: var(--text-muted)">Tasa de Verificación</p>
                <p class="text-3xl font-black mt-1.5 text-emerald-600">
                    <span class="dashboard-count" data-count-to="{{ $verificationRate }}" data-decimals="1" data-suffix="%">{{ number_format($verificationRate, 1) }}%</span>
                </p>
                <p class="text-xs mt-2" style="color: var(--text-muted)">Documentos verificados sobre el total</p>
            </div>
            <div class="abc-card p-5 border border-slate-200/70 dark:border-slate-700/60">
                <p class="text-[11px] font-bold uppercase tracking-widest" style="color: var(--text-muted)">Tasa de Rechazo</p>
                <p class="text-3xl font-black mt-1.5 text-rose-600">
                    <span class="dashboard-count" data-count-to="{{ $rejectionRate }}" data-decimals="1" data-suffix="%">{{ number_format($rejectionRate, 1) }}%</span>
                </p>
                <p class="text-xs mt-2" style="color: var(--text-muted)">Documentos rechazados sobre el total</p>
            </div>
        </div>
        </section>

        {{-- ═══ Sección: Análisis Documental ═══ --}}
        <section>
            <div class="flex items-center gap-2 mb-3">
                <span class="inline-block w-1 h-5 rounded-full" style="background: linear-gradient(180deg, var(--accent-primary), var(--accent-light));"></span>
                <h2 class="text-sm font-bold uppercase tracking-widest" style="color: var(--text-secondary)">Análisis Documental</h2>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                {{-- Donut Estado --}}
                <article class="dashboard-chart-card">
                    <header class="dashboard-chart-card__head">
                        <div>
                            <h3 class="dashboard-chart-card__title">Distribución por Estado</h3>
                            <p class="dashboard-chart-card__subtitle">Composición actual del total registrado.</p>
                        </div>
                        <span class="dashboard-chart-card__pill" data-bg="rgba(245, 158, 11, 0.12)" style="color: #b45309;">
                            <span class="dashboard-count" data-count-to="{{ $totalNotes }}">{{ number_format($totalNotes) }}</span> docs
                        </span>
                    </header>

                    <div class="dashboard-chart-card__body">
                        <div id="chart-estado" class="dashboard-chart-canvas"></div>
                    </div>

                    <footer class="dashboard-chart-card__legend">
                        @foreach($statusChart as $item)
                            <div class="dashboard-legend-row">
                                <span class="dashboard-legend-dot" data-bg="{{ $item['color'] }}"></span>
                                <span class="dashboard-legend-row__label">{{ $item['label'] }}</span>
                                <span class="dashboard-legend-row__value">
                                    <span class="dashboard-count" data-count-to="{{ $item['value'] }}">{{ number_format($item['value']) }}</span>
                                </span>
                            </div>
                        @endforeach
                    </footer>
                </article>

                {{-- Donut Tipología --}}
                <article class="dashboard-chart-card">
                    <header class="dashboard-chart-card__head">
                        <div>
                            <h3 class="dashboard-chart-card__title">Distribución por Tipología</h3>
                            <p class="dashboard-chart-card__subtitle">Tipos documentales más frecuentes.</p>
                        </div>
                        <span class="dashboard-chart-card__pill" data-bg="rgba(99, 102, 241, 0.12)" style="color: #4338ca;">
                            Top 6
                        </span>
                    </header>

                    <div class="dashboard-chart-card__body">
                        <div id="chart-tipologia" class="dashboard-chart-canvas"></div>
                    </div>

                    <footer class="dashboard-chart-card__legend">
                        @forelse($tipologiaChart as $item)
                            <div class="dashboard-legend-row">
                                <span class="dashboard-legend-dot" data-bg="{{ $item['color'] }}"></span>
                                <span class="dashboard-legend-row__label">{{ $item['label'] }}</span>
                                <span class="dashboard-legend-row__value">
                                    <span class="dashboard-count" data-count-to="{{ $item['value'] }}">{{ number_format($item['value']) }}</span>
                                </span>
                            </div>
                        @empty
                            <p class="text-sm text-center py-3 col-span-full" style="color: var(--text-muted)">Sin datos de tipología aún.</p>
                        @endforelse
                    </footer>
                </article>
            </div>
        </section>

        {{-- ═══ Sección: Tendencias y Ranking ═══ --}}
        <section>
            <div class="flex items-center gap-2 mb-3">
                <span class="inline-block w-1 h-5 rounded-full" style="background: linear-gradient(180deg, var(--accent-primary), var(--accent-light));"></span>
                <h2 class="text-sm font-bold uppercase tracking-widest" style="color: var(--text-secondary)">Tendencias y Ranking</h2>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                {{-- Ranking Cajas --}}
                <article class="dashboard-chart-card">
                    <header class="dashboard-chart-card__head">
                        <div>
                            <h3 class="dashboard-chart-card__title">Ranking de Cajas</h3>
                            <p class="dashboard-chart-card__subtitle">Documentos por caja, ordenados de mayor a menor.</p>
                        </div>
                        <span class="dashboard-chart-card__pill" data-bg="rgba(16, 185, 129, 0.12)" style="color: #047857;">
                            Más activas
                        </span>
                    </header>

                    <div class="dashboard-chart-card__body">
                        @if(count($topBoxes) > 0)
                            <div id="chart-cajas" class="dashboard-chart-canvas"></div>
                        @else
                            <p class="text-sm text-center" style="color: var(--text-muted)">No hay cajas con actividad registrada.</p>
                        @endif
                    </div>
                </article>

                {{-- Evolución Mensual --}}
                <article class="dashboard-chart-card">
                    <header class="dashboard-chart-card__head">
                        <div>
                            <h3 class="dashboard-chart-card__title">Evolución (Últimos 6 meses)</h3>
                            <p class="dashboard-chart-card__subtitle">Documentos registrados, verificados y rechazados.</p>
                        </div>
                        <span class="dashboard-chart-card__pill" data-bg="rgba(14, 165, 233, 0.12)" style="color: #0369a1;">
                            6 meses
                        </span>
                    </header>

                    <div class="dashboard-chart-card__body">
                        <div id="chart-mensual" class="dashboard-chart-canvas"></div>
                    </div>
                </article>
            </div>
        </section>

      </div>
    </div>

    <style>
        .dashboard-count {
            font-variant-numeric: tabular-nums;
        }

        /* === Cards de gráficos estilo shadcn === */
        .dashboard-chart-card {
            display: flex;
            flex-direction: column;
            background: var(--surface-card, #ffffff);
            border: 1px solid var(--surface-border, rgba(148, 163, 184, 0.25));
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04), 0 1px 2px rgba(15, 23, 42, 0.06);
            padding: 1.5rem;
            transition: box-shadow .25s ease, transform .25s ease, border-color .25s ease;
        }

        .dashboard-chart-card:hover {
            box-shadow: 0 10px 25px -8px rgba(15, 23, 42, 0.12), 0 4px 10px -4px rgba(15, 23, 42, 0.08);
            border-color: rgba(99, 102, 241, 0.25);
        }

        html.dark .dashboard-chart-card {
            background: var(--surface-card, #0f172a);
            border-color: rgba(71, 85, 105, 0.45);
        }

        .dashboard-chart-card__head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .dashboard-chart-card__title {
            font-size: 1rem;
            font-weight: 800;
            line-height: 1.3;
            color: var(--text-primary);
        }

        .dashboard-chart-card__subtitle {
            font-size: 0.75rem;
            line-height: 1.4;
            margin-top: 0.25rem;
            color: var(--text-muted);
        }

        .dashboard-chart-card__pill {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.6rem;
            border-radius: 9999px;
            font-size: 0.7rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .dashboard-chart-card__body {
            position: relative;
            height: 320px;
            width: 100%;
            max-width: 100%;
            overflow: hidden;
        }

        .dashboard-chart-canvas {
            width: 100% !important;
            max-width: 100% !important;
            height: 100%;
        }

        /* Forzar que el SVG interno de ApexCharts no se desborde */
        .dashboard-chart-canvas .apexcharts-canvas,
        .dashboard-chart-canvas .apexcharts-svg {
            max-width: 100% !important;
        }

        .dashboard-chart-card__legend {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.5rem 1.25rem;
            padding-top: 1rem;
            margin-top: 1rem;
            border-top: 1px solid var(--surface-border, rgba(148, 163, 184, 0.18));
        }

        .dashboard-legend-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.825rem;
            min-width: 0;
        }

        .dashboard-legend-row__label {
            color: var(--text-secondary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            flex: 1;
            min-width: 0;
        }

        .dashboard-legend-row__value {
            font-weight: 700;
            color: var(--text-primary);
            font-variant-numeric: tabular-nums;
            flex-shrink: 0;
        }

        @media (max-width: 640px) {
            .dashboard-chart-card { padding: 1.1rem; }
            .dashboard-chart-card__body { height: 280px; }
            .dashboard-chart-card__legend { grid-template-columns: 1fr; }
        }

        /* Estilo shadcn-blocks para los tooltips de ApexCharts */
        .apexcharts-tooltip.apexcharts-theme-light {
            border: 1px solid rgba(148, 163, 184, 0.35) !important;
            box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.25) !important;
            border-radius: 12px !important;
            overflow: hidden;
        }

        .apexcharts-tooltip.apexcharts-theme-light .apexcharts-tooltip-title {
            background: rgba(248, 250, 252, 0.95) !important;
            border-bottom: 1px solid rgba(148, 163, 184, 0.25) !important;
            font-weight: 700 !important;
        }

        html.dark .apexcharts-tooltip.apexcharts-theme-light {
            background: #0f172a !important;
            border-color: rgba(71, 85, 105, 0.55) !important;
            color: #e2e8f0 !important;
        }

        html.dark .apexcharts-tooltip.apexcharts-theme-light .apexcharts-tooltip-title {
            background: #1e293b !important;
            border-bottom-color: rgba(71, 85, 105, 0.55) !important;
            color: #e2e8f0 !important;
        }

        html.dark .apexcharts-text tspan,
        html.dark .apexcharts-legend-text,
        html.dark .apexcharts-datalabel-label,
        html.dark .apexcharts-datalabel-value {
            fill: #cbd5e1 !important;
            color: #cbd5e1 !important;
        }

        .dashboard-legend-dot {
            display: inline-block;
            width: 0.7rem;
            height: 0.7rem;
            border-radius: 9999px;
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

        @media (max-width: 768px) {
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

    @php
        $dashboardChartPayload = [
            'estado'    => collect($statusChart)->values()->all(),
            'tipologia' => collect($tipologiaChart)->values()->all(),
            'cajas'     => collect($topBoxes)->map(function ($b) {
                return [
                    'box_number'       => $b->box_number,
                    'total_documentos' => (int) $b->total_documentos,
                    'total_fojas'      => (int) $b->total_fojas,
                ];
            })->values()->all(),
            'mensual'   => collect($monthlyStats)->values()->all(),
        ];
    @endphp

    @push('scripts')
        <meta id="dashboard-chart-data" name="dashboard-chart-data" content="{{ json_encode($dashboardChartPayload, JSON_UNESCAPED_UNICODE) }}">
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.49.1/dist/apexcharts.min.js"></script>
        <script>
            (function () {
                document.querySelectorAll('[data-bg]').forEach(function (el) {
                    el.style.background = el.getAttribute('data-bg');
                });
                document.querySelectorAll('[data-width]').forEach(function (el) {
                    el.style.width = el.getAttribute('data-width');
                });

                const dataEl = document.getElementById('dashboard-chart-data');
                const payload = dataEl ? JSON.parse(dataEl.getAttribute('content')) : {};
                const estadoData    = payload.estado    || [];
                const tipologiaData = payload.tipologia || [];
                const cajasData     = payload.cajas     || [];
                const mensualData   = payload.mensual   || [];

                const isDark = () => document.documentElement.classList.contains('dark');
                const textColor = () => isDark() ? '#cbd5e1' : '#475569';
                const gridColor = () => isDark() ? 'rgba(148,163,184,0.18)' : 'rgba(148,163,184,0.25)';

                const baseFont = "'Inter', system-ui, -apple-system, sans-serif";

                const charts = {};

                const numberFmt = new Intl.NumberFormat('es-BO');

                const donutBaseOptions = (data, centerLabel) => ({
                    chart: {
                        type: 'donut',
                        height: 320,
                        width: '100%',
                        fontFamily: baseFont,
                        animations: { speed: 700, animateGradually: { enabled: true, delay: 80 } },
                        redrawOnParentResize: true,
                        redrawOnWindowResize: true,
                    },
                    series: data.map(d => d.value),
                    labels: data.map(d => d.label),
                    colors: data.map(d => d.color),
                    stroke: { width: 3, colors: ['var(--surface-card, #ffffff)'] },
                    dataLabels: { enabled: false },
                    legend: { show: false },
                    plotOptions: {
                        pie: {
                            expandOnClick: true,
                            donut: {
                                size: '72%',
                                background: 'transparent',
                                labels: {
                                    show: true,
                                    name: {
                                        show: true,
                                        fontSize: '11px',
                                        fontWeight: 700,
                                        letterSpacing: '0.08em',
                                        color: isDark() ? '#94a3b8' : '#64748b',
                                        offsetY: 22,
                                        formatter: () => centerLabel.toUpperCase(),
                                    },
                                    value: {
                                        show: true,
                                        fontSize: '34px',
                                        fontWeight: 800,
                                        color: textColor(),
                                        offsetY: -10,
                                        formatter: (v) => numberFmt.format(v),
                                    },
                                    total: {
                                        show: true,
                                        showAlways: true,
                                        label: centerLabel.toUpperCase(),
                                        color: isDark() ? '#94a3b8' : '#64748b',
                                        fontSize: '11px',
                                        fontWeight: 700,
                                        formatter: (w) => numberFmt.format(
                                            w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                        ),
                                    },
                                },
                            },
                        },
                    },
                    states: {
                        hover:  { filter: { type: 'lighten', value: 0.08 } },
                        active: { filter: { type: 'darken',  value: 0.10 } },
                    },
                    tooltip: {
                        fillSeriesColor: false,
                        y: { formatter: (v) => `${numberFmt.format(v)} docs` },
                    },
                });

                /* === 1. Donut ESTADO === */
                if (estadoData.some(d => d.value > 0)) {
                    charts.estado = new ApexCharts(
                        document.querySelector('#chart-estado'),
                        donutBaseOptions(estadoData, 'Total')
                    );
                    charts.estado.render();
                } else {
                    document.querySelector('#chart-estado').innerHTML =
                        '<p class="text-sm text-center py-12" style="color: var(--text-muted)">Sin datos registrados.</p>';
                }

                /* === 2. Donut TIPOLOGIA === */
                if (tipologiaData.length > 0 && tipologiaData.some(d => d.value > 0)) {
                    charts.tipologia = new ApexCharts(
                        document.querySelector('#chart-tipologia'),
                        donutBaseOptions(tipologiaData, 'Tipologías')
                    );
                    charts.tipologia.render();
                } else {
                    document.querySelector('#chart-tipologia').innerHTML =
                        '<p class="text-sm text-center py-12" style="color: var(--text-muted)">Sin datos de tipología aún.</p>';
                }

                /* === 3. Bar HORIZONTAL Ranking Cajas === */
                if (cajasData.length > 0) {
                    const opts = {
                        chart: { type: 'bar', height: 320, width: '100%', fontFamily: baseFont, toolbar: { show: false }, animations: { speed: 700 }, redrawOnParentResize: true, redrawOnWindowResize: true },
                        series: [{ name: 'Documentos', data: cajasData.map(c => c.total_documentos) }],
                        colors: ['#ea580c'],
                        plotOptions: {
                            bar: {
                                horizontal: true,
                                borderRadius: 6,
                                borderRadiusApplication: 'end',
                                barHeight: cajasData.length === 1 ? '32%' : (cajasData.length <= 3 ? '50%' : '70%'),
                                dataLabels: { position: 'top' },
                            },
                        },
                        dataLabels: {
                            enabled: true,
                            offsetX: 28,
                            style: { fontSize: '12px', fontWeight: 700, colors: [textColor()] },
                            formatter: (v) => new Intl.NumberFormat('es-BO').format(v),
                        },
                        xaxis: {
                            categories: cajasData.map(c => c.box_number),
                            labels: { style: { colors: textColor(), fontSize: '11px', fontWeight: 600 } },
                            axisBorder: { show: false },
                            axisTicks: { show: false },
                        },
                        yaxis: { labels: { style: { colors: textColor(), fontSize: '12px', fontWeight: 700 } } },
                        grid: {
                            borderColor: gridColor(),
                            strokeDashArray: 4,
                            padding: cajasData.length === 1
                                ? { right: 40, top: 80, bottom: 60 }
                                : (cajasData.length <= 3 ? { right: 40, top: 30, bottom: 20 } : { right: 40 }),
                        },
                        tooltip: {
                            y: {
                                formatter: (v, opts) => {
                                    const fojas = cajasData[opts.dataPointIndex]?.total_fojas ?? 0;
                                    return `${new Intl.NumberFormat('es-BO').format(v)} docs · ${new Intl.NumberFormat('es-BO').format(fojas)} fojas`;
                                },
                            },
                        },
                    };
                    charts.cajas = new ApexCharts(document.querySelector('#chart-cajas'), opts);
                    charts.cajas.render();
                }

                /* === 4. Bar AGRUPADO Mensual con labels === */
                {
                    const opts = {
                        chart: { type: 'bar', height: 320, width: '100%', fontFamily: baseFont, toolbar: { show: false }, animations: { speed: 700 }, redrawOnParentResize: true, redrawOnWindowResize: true },
                        series: [
                            { name: 'Total',       data: mensualData.map(m => m.total) },
                            { name: 'Verificados', data: mensualData.map(m => m.verificados) },
                            { name: 'Rechazados',  data: mensualData.map(m => m.rechazados) },
                        ],
                        colors: ['#0ea5e9', '#10b981', '#ef4444'],
                        plotOptions: {
                            bar: {
                                borderRadius: 6,
                                borderRadiusApplication: 'end',
                                columnWidth: '60%',
                                dataLabels: { position: 'top' },
                            },
                        },
                        dataLabels: {
                            enabled: true,
                            offsetY: -22,
                            style: { fontSize: '11px', fontWeight: 700, colors: [textColor()] },
                            formatter: (v) => v > 0 ? new Intl.NumberFormat('es-BO').format(v) : '',
                            background: { enabled: false },
                        },
                        xaxis: {
                            categories: mensualData.map(m => m.label),
                            labels: { style: { colors: textColor(), fontSize: '12px', fontWeight: 600 } },
                            axisBorder: { show: false },
                            axisTicks: { show: false },
                        },
                        yaxis: { labels: { style: { colors: textColor(), fontSize: '11px' } } },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'right',
                            fontSize: '12px',
                            fontWeight: 600,
                            labels: { colors: textColor() },
                            markers: { width: 12, height: 12, radius: 6 },
                        },
                        grid: { borderColor: gridColor(), strokeDashArray: 4, padding: { top: 30 } },
                        tooltip: { y: { formatter: (v) => `${new Intl.NumberFormat('es-BO').format(v)} docs` } },
                    };
                    charts.mensual = new ApexCharts(document.querySelector('#chart-mensual'), opts);
                    charts.mensual.render();
                }

                /* Forzar resize después del primer render para evitar desbordes */
                requestAnimationFrame(function () {
                    Object.values(charts).forEach(function (c) {
                        try {
                            const el = c.el;
                            if (el && el.offsetWidth > 0) {
                                c.updateOptions({ chart: { width: '100%' } }, false, false);
                            }
                        } catch (_) { /* noop */ }
                    });
                    window.dispatchEvent(new Event('resize'));
                });

                /* Re-render al cambiar dark/light para refrescar colores */
                const observer = new MutationObserver(() => {
                    const color = textColor();
                    const grid  = gridColor();
                    Object.values(charts).forEach(c => {
                        c.updateOptions({
                            xaxis: { labels: { style: { colors: color } } },
                            yaxis: { labels: { style: { colors: color } } },
                            dataLabels: { style: { colors: [color] } },
                            grid: { borderColor: grid },
                            legend: { labels: { colors: color } },
                        }, false, true);
                    });
                });
                observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
            })();
        </script>
    @endpush
</x-app-layout>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{ asset('images/logoCorreos.png') }}">
        <title>{{ config('app.name', 'AGBC Documentos') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
        {{-- Prevent dark mode & accent color flash --}}
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
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex" x-data="{ sidebarOpen: true, mobileSidebar: false }">

            {{-- Sidebar --}}
            @include('layouts.navigation')

            {{-- Main Content --}}
            <div class="flex-1 flex flex-col min-h-screen transition-all duration-300"
                 :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'">

                {{-- ═══════ Top Bar ═══════ --}}
                <header class="abc-topbar sticky top-0 z-30">
                    <div class="flex items-center justify-between px-4 lg:px-6 h-16">
                        {{-- Left: Menu toggles --}}
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

                            {{-- Breadcrumb area --}}
                            <div class="hidden sm:flex items-center gap-2 text-sm" style="color: var(--text-muted);">
                                <svg class="w-4 h-4 text-[var(--abc-gold)]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                <span class="font-medium" style="color: var(--text-secondary);">Agencia Boliviana de Correos</span>
                            </div>
                        </div>

                        {{-- Right: Actions --}}
                        <div class="flex items-center gap-2 sm:gap-3">

                            {{-- ══ Color Accent Picker ══ --}}
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
                                {{-- Color picker dropdown --}}
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

                            {{-- ══ Dark Mode Toggle ══ --}}
                            <button @click="$store.theme.toggle()"
                                    class="relative flex items-center justify-center w-9 h-9 rounded-lg transition-all duration-300"
                                    style="color: var(--text-muted);"
                                    onmouseover="this.style.backgroundColor='var(--surface-border)'"
                                    onmouseout="this.style.backgroundColor='transparent'"
                                    :title="$store.theme.dark ? 'Cambiar a modo claro' : 'Cambiar a modo oscuro'">
                                {{-- Sun icon (shown in dark mode) --}}
                                <svg x-show="$store.theme.dark" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 rotate-[-90deg] scale-0" x-transition:enter-end="opacity-100 rotate-0 scale-100"
                                     class="w-5 h-5 text-[var(--abc-gold)]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                                </svg>
                                {{-- Moon icon (shown in light mode) --}}
                                <svg x-show="!$store.theme.dark" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 rotate-90 scale-0" x-transition:enter-end="opacity-100 rotate-0 scale-100"
                                     class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                                </svg>
                            </button>

                            {{-- Divider --}}
                            <div class="hidden sm:block w-px h-8" style="background-color: var(--surface-border);"></div>

                            {{-- User dropdown --}}
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center gap-2.5 px-2 py-1.5 rounded-xl transition-colors"
                                            style="color: var(--text-primary);"
                                            onmouseover="this.style.backgroundColor='var(--surface-border)'"
                                            onmouseout="this.style.backgroundColor='transparent'">
                                        <div class="w-9 h-9 rounded-lg gradient-navy flex items-center justify-center text-white text-xs font-bold shadow-sm">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                        </div>
                                        <div class="hidden md:block text-left">
                                            <p class="text-sm font-semibold leading-tight" style="color: var(--text-primary);">{{ Auth::user()->name }}</p>
                                            <p class="text-xs" style="color: var(--text-muted);">{{ Auth::user()->email }}</p>
                                        </div>
                                        <svg class="w-4 h-4 hidden md:block" style="color: var(--text-muted);" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <div class="px-4 py-3 border-b" style="border-color: var(--surface-border);">
                                        <p class="text-sm font-semibold" style="color: var(--text-primary);">{{ Auth::user()->name }}</p>
                                        <p class="text-xs" style="color: var(--text-muted);">{{ Auth::user()->email }}</p>
                                    </div>
                                    <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0" /></svg>
                                        Mi Perfil
                                    </x-dropdown-link>
                                    {{-- Theme toggle in dropdown --}}
                                    <button @click="$store.theme.toggle()" class="block w-full px-4 py-2 text-start text-sm leading-5 transition duration-150 ease-in-out hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none flex items-center gap-2" style="color: var(--text-secondary);">
                                        <template x-if="$store.theme.dark">
                                            <svg class="w-4 h-4 text-[var(--abc-gold)]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" /></svg>
                                        </template>
                                        <template x-if="!$store.theme.dark">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" /></svg>
                                        </template>
                                        <span x-text="$store.theme.dark ? 'Modo Claro' : 'Modo Oscuro'"></span>
                                    </button>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-2 text-red-600 hover:text-red-700">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" /></svg>
                                            Cerrar Sesión
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </header>

                {{-- Page Content --}}
                <main class="flex-1 p-4 lg:p-8">
                    {{ $slot }}
                </main>

                {{-- Footer --}}
                <footer class="abc-footer px-8 py-3">
                    <p class="text-xs text-center" style="color: var(--text-muted);">&copy; {{ date('Y') }} Agencia Boliviana de Correos — Sistema de Verificación de Documentos</p>
                </footer>
            </div>

            {{-- Mobile sidebar overlay --}}
            <div x-show="mobileSidebar" x-transition:enter="transition-opacity ease-out duration-300"
                 x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-in duration-200"
                 x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 @click="mobileSidebar = false"
                 class="fixed inset-0 bg-black/50 z-40 lg:hidden" style="display:none"></div>
        </div>

        {{-- Toast Notification Container --}}
        <div class="abc-toast-container" x-data>
            <template x-for="toast in $store.toasts.items" :key="toast.id">
                <div :class="[
                    'abc-toast',
                    'abc-toast-' + toast.type,
                    toast.removing ? 'abc-toast-exit' : ''
                ]">
                    {{-- Icon with colored background --}}
                    <div class="flex-shrink-0">
                        <template x-if="toast.type === 'success'">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                            </div>
                        </template>
                        <template x-if="toast.type === 'error'">
                            <div class="w-10 h-10 rounded-xl bg-red-100 dark:bg-red-900/40 flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
                            </div>
                        </template>
                        <template x-if="toast.type === 'warning'">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-900/40 flex items-center justify-center">
                                <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>
                            </div>
                        </template>
                        <template x-if="toast.type === 'info'">
                            <div class="w-10 h-10 rounded-xl bg-sky-100 dark:bg-sky-900/40 flex items-center justify-center">
                                <svg class="w-5 h-5 text-sky-600 dark:text-sky-400" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>
                            </div>
                        </template>
                    </div>
                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold leading-tight" x-text="toast.title"></p>
                        <p class="text-xs mt-0.5 opacity-80 leading-snug" x-text="toast.message"></p>
                    </div>
                    {{-- Close button --}}
                    <button @click="$store.toasts.remove(toast.id)" class="flex-shrink-0 p-1 rounded-lg opacity-40 hover:opacity-100 transition-all hover:bg-black/5 dark:hover:bg-white/10">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                    {{-- Progress bar --}}
                    <div class="absolute bottom-0 left-0 right-0 h-1 rounded-b-xl overflow-hidden" style="background: rgba(0,0,0,0.06);">
                        <div class="h-full rounded-b-xl transition-all duration-100 ease-linear"
                             :class="{
                                 'bg-emerald-500': toast.type === 'success',
                                 'bg-red-500': toast.type === 'error',
                                 'bg-amber-500': toast.type === 'warning',
                                 'bg-sky-500': toast.type === 'info'
                             }"
                             :style="'width: ' + toast.progress + '%'"></div>
                    </div>
                </div>
            </template>
        </div>

        {{-- Flash messages → Toast --}}
        @if(session('success'))
            <script>
                document.addEventListener('alpine:initialized', () => {
                    Alpine.store('toasts').success(@json(session('success')));
                });
            </script>
        @endif
        @if(session('error'))
            <script>
                document.addEventListener('alpine:initialized', () => {
                    Alpine.store('toasts').error(@json(session('error')));
                });
            </script>
        @endif
        @if(session('warning'))
            <script>
                document.addEventListener('alpine:initialized', () => {
                    Alpine.store('toasts').warning(@json(session('warning')));
                });
            </script>
        @endif
        @stack('scripts')
    </body>
</html>

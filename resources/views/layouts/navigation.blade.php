{{-- Sidebar Navigation --}}
<aside class="abc-sidebar fixed inset-y-0 left-0 z-40 flex flex-col transition-all duration-300 border-r border-white/5"
       :class="[
           sidebarOpen ? 'w-64' : 'w-20',
           mobileSidebar ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'
       ]">

    {{-- Logo Header --}}
    <div class="flex items-center h-16 px-4 border-b border-white/10 flex-shrink-0">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 overflow-hidden">
            <div class="flex-shrink-0 w-10 h-10 rounded-xl overflow-hidden flex items-center justify-center">
                <img src="{{ asset('images/logoCorreos.png') }}" alt="ABC" class="w-10 h-10 object-contain drop-shadow-lg">
            </div>
            <div x-show="sidebarOpen" x-transition:enter="transition-opacity duration-200" x-transition:enter-start="opacity-0" class="overflow-hidden">
                <p class="text-sm font-bold text-white leading-tight tracking-tight">Agencia Boliviana</p>
                <p class="text-[10px] text-yellow-400/80 font-medium tracking-widest">DE CORREOS</p>
            </div>
        </a>
        {{-- Close mobile --}}
        <button @click="mobileSidebar = false" class="lg:hidden ml-auto text-gray-400 hover:text-white">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
        </button>
    </div>

    {{-- Navigation Links --}}
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1 relative">
        {{-- Watermark logo de fondo --}}
        <div class="pointer-events-none absolute inset-0 flex items-center justify-center overflow-hidden" aria-hidden="true">
            <img src="{{ asset('images/logoCorreos.png') }}" alt="" class="w-44 h-44 object-contain opacity-[0.04] select-none" draggable="false">
        </div>
        {{-- Section: Principal --}}
        <div x-show="sidebarOpen" class="px-3 mb-2">
            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Principal</p>
        </div>

        <a href="{{ route('dashboard') }}"
           class="abc-sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span x-show="sidebarOpen" class="truncate">Dashboard</span>
        </a>

        {{-- Section: Gestión --}}
        @if(auth()->user()->hasModule('boxes') || auth()->user()->hasModule('notes'))
            <div x-show="sidebarOpen" class="px-3 mt-5 mb-2">
                <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Gestión Documental</p>
            </div>
        @endif

        @if(auth()->user()->hasModule('boxes'))
        <a href="{{ route('boxes.index') }}"
           class="abc-sidebar-link {{ request()->routeIs('boxes.*') ? 'active' : '' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
            </svg>
            <span x-show="sidebarOpen" class="truncate">Cajas</span>
        </a>
        @endif

        @if(auth()->user()->hasModule('notes'))
        <a href="{{ route('notes.index') }}"
           class="abc-sidebar-link {{ request()->routeIs('notes.*') ? 'active' : '' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
            <span x-show="sidebarOpen" class="truncate">Documentos</span>
        </a>
        @endif

        @if(auth()->user()->isAdmin())
            {{-- Section: Administracion --}}
            @if(auth()->user()->hasModule('verification') || auth()->user()->hasModule('users') || auth()->user()->hasModule('audit') || auth()->user()->hasModule('permissions'))
                <div x-show="sidebarOpen" class="px-3 mt-5 mb-2">
                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Administración</p>
                </div>
            @endif

            @if(auth()->user()->hasModule('verification'))
            <a href="{{ route('verification.index') }}"
               class="abc-sidebar-link {{ request()->routeIs('verification.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                </svg>
                <span x-show="sidebarOpen" class="truncate">Verificación</span>
                @if(isset($pendingCount) && $pendingCount > 0)
                    <span class="ml-auto bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">{{ $pendingCount }}</span>
                @endif
            </a>
            @endif

            @if(auth()->user()->hasModule('users'))
            <a href="{{ route('users.index') }}"
               class="abc-sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <span x-show="sidebarOpen" class="truncate">Usuarios</span>
            </a>
            @endif

            @if(auth()->user()->hasModule('audit'))
            <a href="{{ route('audit.index') }}"
               class="abc-sidebar-link {{ request()->routeIs('audit.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span x-show="sidebarOpen" class="truncate">Auditoría</span>
            </a>
            @endif

            @if(auth()->user()->hasModule('permissions'))
            <a href="{{ route('permissions.index') }}"
               class="abc-sidebar-link {{ request()->routeIs('permissions.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                </svg>
                <span x-show="sidebarOpen" class="truncate">Permisos</span>
            </a>
            @endif

            {{-- Section: Sistema --}}
            @if(auth()->user()->hasModule('pulse') || auth()->user()->hasModule('log-viewer'))
                <div x-show="sidebarOpen" class="px-3 mt-5 mb-2">
                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Sistema</p>
                </div>
            @endif

            @if(auth()->user()->hasModule('pulse'))
            <a href="{{ route('admin.pulse') }}"
               class="abc-sidebar-link {{ request()->routeIs('admin.pulse') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                </svg>
                <span x-show="sidebarOpen" class="truncate">Pulse Monitor</span>
            </a>
            @endif

            @if(auth()->user()->hasModule('log-viewer'))
            <a href="{{ route('admin.log-viewer') }}"
               class="abc-sidebar-link {{ request()->routeIs('admin.log-viewer') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 7.5l3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0021 18V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v12a2.25 2.25 0 002.25 2.25z" />
                </svg>
                <span x-show="sidebarOpen" class="truncate">Log Viewer</span>
            </a>
            @endif
        @endif

        {{-- Section: Reportes --}}
        @if(auth()->user()->hasModule('reports'))
        <div x-show="sidebarOpen" class="px-3 mt-5 mb-2">
            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Reportes</p>
        </div>

        <a href="{{ route('reports.index') }}"
           class="abc-sidebar-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
            </svg>
            <span x-show="sidebarOpen" class="truncate">Reportes</span>
        </a>
        @endif
    </nav>

    {{-- Sidebar Footer --}}
    <div class="border-t border-white/10 p-3 flex-shrink-0">
        <div x-show="sidebarOpen" class="px-2">
            <p class="text-[9px] text-gray-500 leading-relaxed text-center">Agencia Boliviana de Correos<br>v1.0 &mdash; 2026</p>
        </div>
    </div>
</aside>

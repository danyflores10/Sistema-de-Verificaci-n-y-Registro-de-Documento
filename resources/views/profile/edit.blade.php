<x-app-layout>
    {{-- Page Header --}}
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

    {{-- Profile Overview Card --}}
    <div class="max-w-4xl mx-auto mb-6">
        <div class="abc-card animate-fade-in-up">
            <div class="p-6 flex flex-col sm:flex-row items-center gap-5">
                {{-- Avatar --}}
                <div class="relative">
                    <div class="w-20 h-20 rounded-2xl gradient-navy flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full bg-emerald-500 border-2 border-white flex items-center justify-center">
                        <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                    </div>
                </div>
                {{-- Info --}}
                <div class="text-center sm:text-left flex-1">
                    <h3 class="text-lg font-bold" style="color: var(--text-primary);">{{ Auth::user()->name }}</h3>
                    <p class="text-sm" style="color: var(--text-muted);">{{ Auth::user()->email }}</p>
                    <div class="flex items-center justify-center sm:justify-start gap-2 mt-2">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold
                            @if(Auth::user()->role === 'ADMIN') bg-red-50 text-red-700 border border-red-200
                            @else bg-blue-50 text-blue-700 border border-blue-200 @endif">
                            <span class="w-1.5 h-1.5 rounded-full
                                @if(Auth::user()->role === 'ADMIN') bg-red-500
                                @else bg-blue-500 @endif"></span>
                            {{ Auth::user()->role }}
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

    {{-- Profile Sections --}}
    <div class="max-w-4xl mx-auto space-y-6 pb-8">
        {{-- Section: Profile Info --}}
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
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        {{-- Section: Password --}}
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
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- Section: Delete Account --}}
        <div class="abc-card animate-fade-in-up animate-fade-in-up-delay-3 border-red-200 dark:border-red-900/50">
            <div class="px-6 py-4 border-b flex items-center gap-3" style="border-color: var(--surface-border);">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-red-50 dark:bg-red-900/30">
                    <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-red-600 dark:text-red-400">Zona de Peligro</h3>
                    <p class="text-xs" style="color: var(--text-muted);">Acciones irreversibles sobre tu cuenta</p>
                </div>
            </div>
            <div class="p-6">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>

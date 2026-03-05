<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" x-data="{ showPassword: false }">
        @csrf

        <div class="text-center mb-6">
            <h3 class="text-xl font-bold text-gray-800">Iniciar Sesión</h3>
            <p class="text-sm text-gray-500 mt-1">Ingrese sus credenciales para acceder</p>
        </div>

        <div class="space-y-4">
            <div>
                <label for="email" class="abc-label">Correo Electrónico</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                    </div>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                           class="abc-input pl-10" placeholder="correo@correos.bo">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <label for="password" class="abc-label">Contraseña</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </div>
                    <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password"
                           class="abc-input pl-10 pr-11" placeholder="••••••••">
                    {{-- Eye toggle button --}}
                    <button type="button" @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center transition-colors duration-200 text-gray-400 hover:text-gray-600 focus:outline-none"
                            :title="showPassword ? 'Ocultar contraseña' : 'Mostrar contraseña'">
                        {{-- Eye open (show when password is hidden) --}}
                        <svg x-show="!showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        {{-- Eye closed (show when password is visible) --}}
                        <svg x-show="showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-900 shadow-sm focus:ring-blue-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">Recordarme</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-600 hover:text-blue-800 font-medium" href="{{ route('password.request') }}">
                        ¿Olvidó su contraseña?
                    </a>
                @endif
            </div>

            {{-- Botón dinámico de ingreso --}}
            <button type="submit"
                    class="login-btn-dynamic group relative w-full flex items-center justify-center gap-3 py-3.5 px-6 rounded-xl text-base font-bold text-white overflow-hidden transition-all duration-300 transform hover:scale-[1.02] hover:shadow-[0_8px_30px_rgba(59,130,246,0.4)] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-blue-400/50 focus:ring-offset-2 focus:ring-offset-transparent">
                {{-- Animated gradient background --}}
                <span class="absolute inset-0 bg-gradient-to-r from-blue-600 via-blue-500 to-cyan-500 transition-opacity duration-300"></span>
                <span class="absolute inset-0 bg-gradient-to-r from-cyan-500 via-blue-500 to-blue-700 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>

                {{-- Shine effect --}}
                <span class="absolute inset-0 -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-in-out bg-gradient-to-r from-transparent via-white/20 to-transparent"></span>

                {{-- Border glow --}}
                <span class="absolute inset-0 rounded-xl border border-white/20 group-hover:border-white/40 transition-colors duration-300"></span>

                {{-- Content --}}
                <span class="relative flex items-center gap-2.5">
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                    <span class="tracking-wide">Ingresar al Sistema</span>
                    <svg class="w-4 h-4 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </span>
            </button>
        </div>
    </form>
</x-guest-layout>

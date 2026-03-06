<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{ asset('images/logoCorreos.png') }}">
        <title>{{ config('app.name', 'AGBC Documentos') }} — Iniciar Sesión</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="login-bg min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

            {{-- ── Aceternity Animated Gradient Background ── --}}
            <div class="gradient-blobs-container">
                {{-- Blob 1: Azul brillante — moveVertical 30s --}}
                <div class="gradient-blob gradient-blob-1 animate-first"></div>
                {{-- Blob 2: Magenta/morado — moveInCircle 20s reverse --}}
                <div class="gradient-blob gradient-blob-2 animate-second"></div>
                {{-- Blob 3: Cian claro — moveInCircle 40s --}}
                <div class="gradient-blob gradient-blob-3 animate-third"></div>
                {{-- Blob 4: Rojo ABC — moveHorizontal 40s --}}
                <div class="gradient-blob gradient-blob-4 animate-fourth"></div>
                {{-- Blob 5: Índigo/violeta — moveInCircle 20s --}}
                <div class="gradient-blob gradient-blob-5 animate-fifth"></div>
            </div>

            <div class="relative z-10 w-full max-w-md">
                {{-- Logo y branding --}}
                <div class="text-center mb-8 animate-fade-in-up">
                    <div class="inline-flex items-center justify-center mb-4">
                        <img src="{{ asset('images/logoCorreos.png') }}" alt="Agencia Boliviana de Correos" class="w-36 h-36 object-contain drop-shadow-[0_0_30px_rgba(255,255,255,0.25)] hover:scale-105 transition-transform duration-500">
                    </div>
                    <h1 class="text-2xl font-bold text-white tracking-tight drop-shadow-lg">AGENCIA BOLIVIANA</h1>
                    <h2 class="text-lg font-medium text-yellow-400 tracking-widest drop-shadow-md">DE CORREOS</h2>
                    <p class="text-sm text-white/60 mt-2">Sistema de Verificación y Registro de Documentos</p>
                </div>

                {{-- Card de Login con Glassmorphism --}}
                <div class="glass-card rounded-2xl shadow-2xl p-8 animate-fade-in-up" style="animation-delay: 0.15s;">
                    {{ $slot }}
                </div>

                {{-- Footer --}}
                <p class="text-center text-xs text-white/40 mt-6 animate-fade-in-up" style="animation-delay: 0.3s;">
                    &copy; {{ date('Y') }} Agencia Boliviana de Correos — Todos los derechos reservados
                </p>
            </div>
        </div>
    </body>
</html>

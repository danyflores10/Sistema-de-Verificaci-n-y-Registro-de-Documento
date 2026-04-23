<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <link rel="icon" type="image/png" href="<?php echo e(asset('images/logoCorreos.png')); ?>">
        <title><?php echo e(config('app.name', 'AGBC Documentos')); ?> — Iniciar Sesión</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
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
            (function () {
                function hideLoader() {
                    var el = document.getElementById('page-loader');
                    if (el) { el.classList.add('loader-hidden'); }
                }
                if (document.readyState === 'complete') {
                    hideLoader();
                } else {
                    window.addEventListener('load', hideLoader);
                    setTimeout(hideLoader, 8000);
                }
                document.addEventListener('click', function (e) {
                    var a = e.target.closest('a');
                    if (a && a.href && !a.href.startsWith('#') && !a.href.startsWith('javascript') &&
                        a.target !== '_blank' && a.origin === window.location.origin) {
                        var el2 = document.getElementById('page-loader');
                        if (el2) { el2.classList.remove('loader-hidden'); }
                    }
                });
                document.addEventListener('submit', function () {
                    var el3 = document.getElementById('page-loader');
                    if (el3) { el3.classList.remove('loader-hidden'); }
                });
            })();
        </script>
        <div class="login-bg min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

            
            <div class="gradient-blobs-container">
                
                <div class="gradient-blob gradient-blob-1 animate-first"></div>
                
                <div class="gradient-blob gradient-blob-2 animate-second"></div>
                
                <div class="gradient-blob gradient-blob-3 animate-third"></div>
                
                <div class="gradient-blob gradient-blob-4 animate-fourth"></div>
                
                <div class="gradient-blob gradient-blob-5 animate-fifth"></div>
            </div>

            <div class="relative z-10 w-full max-w-md">
                
                <div class="text-center mb-8 animate-fade-in-up">
                    <div class="inline-flex items-center justify-center mb-4">
                        <img src="<?php echo e(asset('images/logoCorreos.png')); ?>" alt="Agencia Boliviana de Correos" class="w-36 h-36 object-contain drop-shadow-[0_0_30px_rgba(255,255,255,0.25)] hover:scale-105 transition-transform duration-500">
                    </div>
                    <h1 class="text-2xl font-bold text-white tracking-tight drop-shadow-lg">AGENCIA BOLIVIANA</h1>
                    <h2 class="text-lg font-medium text-yellow-400 tracking-widest drop-shadow-md">DE CORREOS</h2>
                    <p class="text-sm text-white/60 mt-2">Sistema de Verificación y Registro de Documentos</p>
                </div>

                
                <div class="glass-card rounded-2xl shadow-2xl p-8 animate-fade-in-up" style="animation-delay: 0.15s;">
                    <?php echo e($slot); ?>

                </div>

                
                <p class="text-center text-xs text-white/40 mt-6 animate-fade-in-up" style="animation-delay: 0.3s;">
                    &copy; <?php echo e(date('Y')); ?> Agencia Boliviana de Correos — Todos los derechos reservados
                </p>
            </div>
        </div>
    </body>
</html>
<?php /**PATH C:\Users\hp pavilion\OneDrive\Escritorio\System Correos\system-correos\resources\views\layouts\guest.blade.php ENDPATH**/ ?>
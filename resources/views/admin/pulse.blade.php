<x-app-layout>
    <div class="abc-page-header">
        <div>
            <h1 class="text-2xl font-bold" style="color: var(--text-primary);">
                <svg class="w-7 h-7 inline -mt-1 text-purple-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                </svg>
                Monitoreo del Sistema
            </h1>
            <p class="text-sm mt-1" style="color: var(--text-muted);">Actividad de usuarios, rendimiento del servidor, consultas y errores en tiempo real</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                En Vivo
            </span>
        </div>
    </div>

    <div class="abc-card" style="padding: 0; overflow: hidden; height: calc(100vh - 220px); min-height: 600px; border-radius: 0.75rem;">
        <iframe src="{{ url('/pulse') }}" 
                class="w-full h-full border-0" 
                style="min-height: 600px;"
                title="Laravel Pulse Dashboard"
                loading="lazy">
        </iframe>
    </div>
</x-app-layout>

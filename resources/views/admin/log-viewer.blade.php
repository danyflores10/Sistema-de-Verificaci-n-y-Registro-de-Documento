<x-app-layout>
    <div class="abc-page-header">
        <div>
            <h1 class="text-2xl font-bold" style="color: var(--text-primary);">
                <svg class="w-7 h-7 inline -mt-1 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 7.5l3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0021 18V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v12a2.25 2.25 0 002.25 2.25z" />
                </svg>
                Log Viewer
            </h1>
            <p class="text-sm mt-1" style="color: var(--text-muted);">Registro de errores y eventos del sistema</p>
        </div>
    </div>

    <div class="abc-card" style="padding: 0; overflow: hidden; height: calc(100vh - 220px); min-height: 600px;">
        <iframe src="{{ url('/log-viewer') }}" 
                class="w-full h-full border-0" 
                style="min-height: 600px;"
                title="Log Viewer"
                loading="lazy">
        </iframe>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="abc-page-header">
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold tracking-tight">Importar desde Excel</h2>
                <p class="text-sm text-white/70 mt-1">Carga masiva de documentos desde archivos Excel &mdash; Agencia Boliviana de Correos</p>
            </div>
            <a href="{{ route('notes.index') }}" class="abc-btn abc-btn-warning">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"/></svg>
                Volver a Documentos
            </a>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Mensaje de éxito --}}
            @if(session('success'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 flex items-start gap-3">
                    <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-emerald-800">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- Mensaje de error --}}
            @if(session('error'))
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 flex items-start gap-3">
                    <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-red-500 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-red-800">{{ session('error') }}</p>
                        @if(session('import_errors'))
                            <ul class="mt-2 text-xs text-red-600 list-disc list-inside space-y-1">
                                @foreach(session('import_errors') as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Card principal --}}
            <div class="abc-card">
                <div class="p-6">
                    {{-- Instrucciones --}}
                    <div class="mb-6 rounded-xl border border-blue-200 bg-blue-50 p-5">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-blue-900 text-sm mb-2">Formato requerido del Excel</h4>
                                <p class="text-xs text-blue-700 mb-3">El archivo Excel debe tener las siguientes columnas en la <strong>primera fila</strong> (encabezados):</p>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Columna</p>
                                        <p class="text-xs font-semibold text-blue-900">N° DE CAJA</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Columna</p>
                                        <p class="text-xs font-semibold text-blue-900">N° DE DOCUMENTO</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Columna</p>
                                        <p class="text-xs font-semibold text-blue-900">FECHA de recepción</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Columna</p>
                                        <p class="text-xs font-semibold text-blue-900">REFERENCIA</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Columna</p>
                                        <p class="text-xs font-semibold text-blue-900">DOC. ORIGINAL Y/O FOT.</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Columna</p>
                                        <p class="text-xs font-semibold text-blue-900">FOJAS</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Columna</p>
                                        <p class="text-xs font-semibold text-blue-900">OBSERVACIONES</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Columna</p>
                                        <p class="text-xs font-semibold text-blue-900">TIPO DOCUMENTACIÓN</p>
                                    </div>
                                </div>
                                <p class="text-xs text-blue-600 mt-3">
                                    <strong>Nota:</strong> Si la caja no existe en el sistema, se creará automáticamente. Los documentos se importarán con estado <strong>BORRADOR</strong>.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Formulario de carga --}}
                    <form action="{{ route('import.store') }}" method="POST" enctype="multipart/form-data"
                          x-data="{ fileName: '', uploading: false, dragOver: false }"
                          @submit="uploading = true">
                        @csrf

                        <div class="mb-6">
                            <label class="abc-label text-base font-semibold mb-3 block">Seleccionar archivo Excel</label>

                            <div class="relative border-2 border-dashed rounded-xl p-8 text-center transition-all duration-300 cursor-pointer"
                                 :class="dragOver ? 'border-emerald-400 bg-emerald-50' : 'border-gray-300 bg-gray-50 hover:border-emerald-400 hover:bg-emerald-50'"
                                 @dragover.prevent="dragOver = true"
                                 @dragleave.prevent="dragOver = false"
                                 @drop.prevent="dragOver = false; const f = $event.dataTransfer.files[0]; if(f) { $refs.fileInput.files = $event.dataTransfer.files; fileName = f.name; }">

                                <input type="file" name="file" accept=".xlsx,.xls,.csv" x-ref="fileInput"
                                       @change="fileName = $refs.fileInput.files[0]?.name || ''"
                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

                                <div x-show="!fileName" class="space-y-3">
                                    <div class="mx-auto w-16 h-16 rounded-2xl bg-emerald-100 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-700">Arrastre y suelte el archivo aquí</p>
                                        <p class="text-xs text-gray-400 mt-1">o haga clic para seleccionar &mdash; Formatos: .xlsx, .xls, .csv (máx. 200MB)</p>
                                    </div>
                                </div>

                                <div x-show="fileName" x-cloak class="space-y-3">
                                    <div class="mx-auto w-16 h-16 rounded-2xl bg-emerald-500 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-emerald-700">Archivo seleccionado:</p>
                                        <p class="text-xs text-emerald-600 font-mono mt-1" x-text="fileName"></p>
                                    </div>
                                </div>
                            </div>

                            @error('file')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4 border-t" style="border-color: var(--surface-border);">
                            <a href="{{ route('notes.index') }}" class="abc-btn" style="background-color: var(--surface-hover);">
                                Cancelar
                            </a>
                            <button type="submit"
                                    :disabled="!fileName || uploading"
                                    class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold text-white transition-all duration-300 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                                    style="background: linear-gradient(135deg, #059669, #047857);">
                                <template x-if="!uploading">
                                    <span class="inline-flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/></svg>
                                        Importar Documentos
                                    </span>
                                </template>
                                <template x-if="uploading">
                                    <span class="inline-flex items-center gap-2">
                                        <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                                        Importando...
                                    </span>
                                </template>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tabla de referencia --}}
            <div class="abc-card mt-6">
                <div class="p-5">
                    <h3 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12"/></svg>
                        Mapeo de columnas Excel → Sistema
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b-2" style="border-color: var(--surface-border);">
                                    <th class="text-left py-2 px-3 text-xs font-bold text-gray-500 uppercase">Columna Excel</th>
                                    <th class="text-left py-2 px-3 text-xs font-bold text-gray-500 uppercase">Campo en el sistema</th>
                                    <th class="text-left py-2 px-3 text-xs font-bold text-gray-500 uppercase">Requerido</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y" style="border-color: var(--surface-border);">
                                <tr><td class="py-2 px-3 font-mono text-xs">N° DE CAJA</td><td class="py-2 px-3">Caja</td><td class="py-2 px-3"><span class="text-emerald-600 font-bold text-xs">SÍ</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">N° DE DOCUMENTO</td><td class="py-2 px-3">N. de CITE</td><td class="py-2 px-3"><span class="text-emerald-600 font-bold text-xs">SÍ</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">FECHA de recepción</td><td class="py-2 px-3">Fecha</td><td class="py-2 px-3"><span class="text-emerald-600 font-bold text-xs">SÍ</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">REFERENCIA</td><td class="py-2 px-3">Referencia</td><td class="py-2 px-3"><span class="text-emerald-600 font-bold text-xs">SÍ</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">DOC. ORIGINAL Y/O FOT.</td><td class="py-2 px-3">Estado del documento</td><td class="py-2 px-3"><span class="text-gray-400 font-bold text-xs">NO</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">FOJAS</td><td class="py-2 px-3">Fojas</td><td class="py-2 px-3"><span class="text-gray-400 font-bold text-xs">NO</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">OBSERVACIONES</td><td class="py-2 px-3">Observaciones</td><td class="py-2 px-3"><span class="text-gray-400 font-bold text-xs">NO</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">TIPO DOCUMENTACIÓN</td><td class="py-2 px-3">Tipo de nota</td><td class="py-2 px-3"><span class="text-gray-400 font-bold text-xs">NO</span></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

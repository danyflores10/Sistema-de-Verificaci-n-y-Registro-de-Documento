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
        <div class="w-full">

            {{-- Mensaje de éxito --}}
            @if(session('success'))
                <div class="w-full mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 flex items-start gap-3">
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
                <div class="w-full mb-6 rounded-xl border border-red-200 bg-red-50 p-4 flex items-start gap-3">
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
            <div class="abc-card w-full">
                <div class="p-6">
                    {{-- Instrucciones --}}
                    <div class="mb-6 rounded-xl border border-blue-200 bg-blue-50 p-5">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-blue-900 text-sm mb-2">Formato requerido del Excel</h4>
                                <p class="text-xs text-blue-700 mb-3">El archivo Excel puede tener <strong>múltiples hojas</strong> (CAJA 12, CAJA 18, etc.) y debe tener estas columnas en la <strong>primera fila</strong> (encabezados):</p>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2">
                                    <div class="bg-gray-50 rounded-lg px-3 py-2 border border-blue-100 opacity-60">
                                        <p class="text-[10px] font-bold text-blue-400 uppercase">Col. A</p>
                                        <p class="text-xs font-semibold text-blue-700">N° (fila)</p>
                                        <p class="text-[9px] text-blue-400 mt-0.5">se ignora</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-emerald-300 ring-1 ring-emerald-200">
                                        <p class="text-[10px] font-bold text-emerald-600 uppercase">Col. B ✱</p>
                                        <p class="text-xs font-semibold text-blue-900">N° CAJA</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Col. C</p>
                                        <p class="text-xs font-semibold text-blue-900">N° DE CARPETA</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Col. D</p>
                                        <p class="text-xs font-semibold text-blue-900">N° DE DOCUMENTO</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Col. E</p>
                                        <p class="text-xs font-semibold text-blue-900">FECHA recepción</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Col. F</p>
                                        <p class="text-xs font-semibold text-blue-900">REFERENCIA</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Col. G</p>
                                        <p class="text-xs font-semibold text-blue-900">DOC. ORIGINAL Y/O FOT.</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Col. H</p>
                                        <p class="text-xs font-semibold text-blue-900">FOJAS</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Col. I</p>
                                        <p class="text-xs font-semibold text-blue-900">OBSERVACIONES</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Col. J</p>
                                        <p class="text-xs font-semibold text-blue-900">TIPO DOCUMENTACIÓN</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Col. K</p>
                                        <p class="text-xs font-semibold text-blue-900">TIPOLOGIA</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Col. L</p>
                                        <p class="text-xs font-semibold text-blue-900">ESTADO DE CONSERVACIÓN</p>
                                    </div>
                                </div>
                                <p class="text-xs text-blue-600 mt-3">
                                    <strong>Nota:</strong> Se leen <strong>todas las hojas</strong> del archivo automáticamente. Si la caja no existe, se creará. Los documentos se importan con estado <strong>BORRADOR</strong>.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Formulario de carga --}}
                    <form action="{{ route('import.store') }}" method="POST" enctype="multipart/form-data"
                          x-data="excelImport()"
                          @submit="onSubmit($event)">
                        @csrf

                        <div class="mb-6">
                            <label class="abc-label text-base font-semibold mb-3 block">Seleccionar archivo Excel</label>

                            <div class="import-upload-wrap rounded-xl border border-emerald-100 bg-gradient-to-b from-emerald-50/80 to-white p-6 transition-all"
                                 :class="dragging ? 'is-dragging' : ''"
                                 @dragover.prevent="dragging = true"
                                 @dragenter.prevent="dragging = true"
                                 @dragleave.prevent="dragging = false"
                                 @drop.prevent="handleDrop($event)">

                                <div class="flex justify-center">
                                    <label class="container-btn-file">
                                        <svg fill="#fff" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                            <path d="M14 2H7a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8zm0 1.5L18.5 8H14zM8.75 13.5h6.5v1.5h-6.5zm0 3h6.5V18h-6.5zm0-6h3.5V12h-3.5z"/>
                                        </svg>
                                        <span x-text="fileName ? 'Cambiar archivo' : 'Subir archivo Excel'"></span>
                                        <input class="file"
                                               type="file"
                                               name="file"
                                               accept=".xlsx,.xls,.csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,text/csv"
                                               x-ref="fileInput"
                                               @change="handlePick($event)" />
                                    </label>
                                </div>

                                <p class="mt-3 text-center text-xs text-gray-500">
                                    Arrastra el archivo aquí o haz clic en el botón. Formatos: <strong>.xlsx</strong>, <strong>.xls</strong>, <strong>.csv</strong> (máx. 500MB)
                                </p>

                                <div x-show="fileName" x-cloak class="mt-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-semibold text-emerald-700">Archivo seleccionado:</p>
                                        <p class="text-xs text-emerald-600 font-mono mt-1 break-all" x-text="fileName"></p>
                                        <p class="text-[10px] text-emerald-500 mt-0.5" x-text="fileSizeLabel"></p>
                                    </div>
                                    <button type="button" @click="clearFile()" class="p-1.5 rounded-lg text-emerald-500 hover:text-red-600 hover:bg-red-50 transition flex-shrink-0" title="Quitar">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                                    </button>
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
            <div class="abc-card mt-6 w-full">
                <div class="p-5">
                    <h3 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12"/></svg>
                        Mapeo de columnas Excel → Sistema
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm import-map-table min-w-[980px]">
                            <thead>
                                <tr class="border-b-2" style="border-color: var(--surface-border);">
                                    <th class="text-left py-2 px-3 text-xs font-bold text-gray-500 uppercase">Columna Excel</th>
                                    <th class="text-left py-2 px-3 text-xs font-bold text-gray-500 uppercase">Campo en el sistema</th>
                                    <th class="text-left py-2 px-3 text-xs font-bold text-gray-500 uppercase">Requerido</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y" style="border-color: var(--surface-border);">
                                <tr class="opacity-50"><td class="py-2 px-3 font-mono text-xs">A — N°</td><td class="py-2 px-3 italic text-gray-400">Número de fila (se ignora)</td><td class="py-2 px-3"><span class="text-gray-300 font-bold text-xs">—</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">B — N° caja</td><td class="py-2 px-3">Caja</td><td class="py-2 px-3"><span class="text-emerald-600 font-bold text-xs">SÍ</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">C — N° DE Carpeta</td><td class="py-2 px-3">N° de Carpeta</td><td class="py-2 px-3"><span class="text-gray-400 font-bold text-xs">NO</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">D — N° DE DOCUMENTO</td><td class="py-2 px-3">N° de Documento</td><td class="py-2 px-3"><span class="text-gray-400 font-bold text-xs">NO</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">E — FECHA de recepción</td><td class="py-2 px-3">Fecha</td><td class="py-2 px-3"><span class="text-gray-400 font-bold text-xs">NO</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">F — REFERENCIA</td><td class="py-2 px-3">Referencia</td><td class="py-2 px-3"><span class="text-gray-400 font-bold text-xs">NO</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">G — DOC. ORIGINAL Y/O FOT.</td><td class="py-2 px-3">Estado del documento</td><td class="py-2 px-3"><span class="text-gray-400 font-bold text-xs">NO</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">H — FOJAS</td><td class="py-2 px-3">Fojas</td><td class="py-2 px-3"><span class="text-gray-400 font-bold text-xs">NO</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">I — OBSERVACIONES</td><td class="py-2 px-3">Observaciones</td><td class="py-2 px-3"><span class="text-gray-400 font-bold text-xs">NO</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">J — TIPO DOCUMENTACIÓN</td><td class="py-2 px-3">Tipo de nota</td><td class="py-2 px-3"><span class="text-gray-400 font-bold text-xs">NO</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">K — TIPOLOGIA</td><td class="py-2 px-3">Tipología</td><td class="py-2 px-3"><span class="text-gray-400 font-bold text-xs">NO</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">L — ESTADO DE CONSERVACIÓN</td><td class="py-2 px-3">Estado de conservación</td><td class="py-2 px-3"><span class="text-gray-400 font-bold text-xs">NO</span></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .import-map-table th {
            letter-spacing: .04em;
        }

        .import-map-table td {
            vertical-align: middle;
        }

        .container-btn-file {
            display: inline-flex;
            position: relative;
            justify-content: center;
            align-items: center;
            gap: 0.7rem;
            background-color: #307750;
            color: #fff;
            border-style: none;
            padding: 0.9em 1.8em;
            border-radius: 0.6em;
            overflow: hidden;
            z-index: 1;
            box-shadow: 4px 8px 10px -3px rgba(0, 0, 0, 0.25);
            transition: all 250ms;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
        }

        .container-btn-file input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            inset: 0;
        }

        .container-btn-file::before {
            content: "";
            position: absolute;
            height: 100%;
            width: 0;
            border-radius: 0.6em;
            background-color: #469b61;
            z-index: -1;
            transition: all 350ms;
        }

        .container-btn-file:hover::before {
            width: 100%;
        }

        .import-upload-wrap.is-dragging {
            border-color: #10b981 !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
            transform: translateY(-1px);
            background: linear-gradient(180deg, rgba(209, 250, 229, 0.9), rgba(236, 253, 245, 0.95));
        }
    </style>

    <script>
        function excelImport() {
            const allowedExt = ['xlsx', 'xls', 'csv'];
            const maxBytes = 500 * 1024 * 1024;

            const notify = (type, message) => {
                if (window.Alpine && Alpine.store('toasts')) {
                    Alpine.store('toasts')[type](message);
                } else {
                    alert(message);
                }
            };

            const formatBytes = (bytes) => {
                if (!bytes && bytes !== 0) return '';
                const units = ['B', 'KB', 'MB', 'GB'];
                let i = 0;
                let value = bytes;
                while (value >= 1024 && i < units.length - 1) {
                    value /= 1024;
                    i++;
                }
                return `${value.toFixed(value >= 10 || i === 0 ? 0 : 1)} ${units[i]}`;
            };

            return {
                fileName: '',
                fileSizeLabel: '',
                dragging: false,
                uploading: false,

                assignFile(file) {
                    if (!file) return false;

                    const ext = file.name.split('.').pop().toLowerCase();
                    if (!allowedExt.includes(ext)) {
                        notify('error', `"${file.name}" no es un formato válido. Solo .xlsx, .xls o .csv.`);
                        return false;
                    }

                    if (file.size > maxBytes) {
                        notify('error', `"${file.name}" supera el límite de 500MB.`);
                        return false;
                    }

                    const dt = new DataTransfer();
                    dt.items.add(file);
                    this.$refs.fileInput.files = dt.files;

                    this.fileName = file.name;
                    this.fileSizeLabel = formatBytes(file.size);
                    notify('success', 'Archivo listo para importar.');
                    return true;
                },

                handlePick(event) {
                    const file = event.target.files?.[0];
                    if (!file) return;
                    if (!this.assignFile(file)) {
                        event.target.value = '';
                    }
                },

                handleDrop(event) {
                    this.dragging = false;
                    const file = event.dataTransfer?.files?.[0];
                    if (!file) return;
                    this.assignFile(file);
                },

                clearFile() {
                    this.fileName = '';
                    this.fileSizeLabel = '';
                    this.$refs.fileInput.value = '';
                },

                onSubmit(event) {
                    if (!this.fileName) {
                        event.preventDefault();
                        notify('error', 'Selecciona un archivo Excel antes de importar.');
                        return;
                    }
                    this.uploading = true;
                },
            };
        }
    </script>
</x-app-layout>

<x-app-layout>
    <div class="abc-page-header">
            <div class="relative z-10">
                <h2 class="text-2xl font-bold tracking-tight">Registrar Documento</h2>
                <p class="text-sm text-white/70 mt-1">Complete los datos del nuevo documento</p>
            </div>
        </div>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="abc-card">
                {{-- Card header --}}
                {{-- Header con gradiente mejorado --}}
                <div class="relative overflow-hidden px-6 py-5 flex items-center gap-3"
                     style="background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-light) 50%, #0d9488 100%);">
                    <div class="absolute inset-0 opacity-10"
                         style="background: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,0.15) 10px, rgba(255,255,255,0.15) 20px);"></div>
                    <div class="relative z-10 w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center shadow-inner">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                    </div>
                    <div class="relative z-10">
                        <h3 class="text-white font-bold text-lg leading-tight">Registrar Nuevo Documento</h3>
                        <p class="text-white/70 text-xs mt-0.5">Complete todos los campos obligatorios (*)</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('notes.store') }}" enctype="multipart/form-data" class="p-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Caja (buscable) --}}
                        <div x-data="{
                            open: false,
                            search: '',
                            selectedId: '{{ old('box_id', '') }}',
                            selectedLabel: '',
                            boxes: @js($boxes->map(fn($b) => ['id' => $b->id, 'label' => $b->box_number . ' - ' . $b->description])),
                            get filtered() {
                                if (!this.search) return this.boxes;
                                let s = this.search.toLowerCase();
                                return this.boxes.filter(b => b.label.toLowerCase().includes(s));
                            },
                            init() {
                                if (this.selectedId) {
                                    let found = this.boxes.find(b => b.id == this.selectedId);
                                    if (found) this.selectedLabel = found.label;
                                }
                            },
                            select(box) {
                                this.selectedId = box.id;
                                this.selectedLabel = box.label;
                                this.search = box.label;
                                this.open = false;
                            }
                        }" @click.outside="open = false" class="relative">
                            <label for="box_search" class="abc-label">N° CAJA *</label>
                            <input type="hidden" name="box_id" :value="selectedId">
                            <input type="text" id="box_search" autocomplete="off"
                                   class="abc-input"
                                   placeholder="Buscar caja..."
                                   x-model="search"
                                   @focus="open = true; search = ''"
                                   @input="open = true"
                                   @keydown.escape="open = false"
                                   x-init="search = selectedLabel">
                            <div x-show="open && filtered.length > 0" x-cloak
                                 class="absolute z-50 w-full mt-1 bg-white border rounded-lg shadow-lg max-h-48 overflow-y-auto"
                                 style="border-color: var(--surface-border);">
                                <template x-for="box in filtered" :key="box.id">
                                    <div @click="select(box)"
                                         class="px-3 py-2 text-sm cursor-pointer hover:bg-blue-50 transition"
                                         :class="selectedId == box.id ? 'bg-blue-50 font-semibold' : ''"
                                         x-text="box.label"></div>
                                </template>
                            </div>
                            <div x-show="open && search && filtered.length === 0" x-cloak
                                 class="absolute z-50 w-full mt-1 bg-white border rounded-lg shadow-lg px-3 py-2 text-sm text-gray-400"
                                 style="border-color: var(--surface-border);">
                                No se encontraron cajas
                            </div>
                            @error('box_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- Col C: N° DE CARPETA --}}
                        <div>
                            <label for="folder_number" class="abc-label">N° DE CARPETA</label>
                            <input type="text" name="folder_number" id="folder_number" value="{{ old('folder_number') }}"
                                   class="abc-input" placeholder="Ej: CARP-001">
                            @error('folder_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Col D: N° DE DOCUMENTO --}}
                        <div>
                            <label for="internal_number" class="abc-label">N° DE DOCUMENTO *</label>
                            <input type="text" name="internal_number" id="internal_number" value="{{ old('internal_number') }}"
                                   class="abc-input" placeholder="Ej: NI-2026-001" required>
                            @error('internal_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Col E: FECHA de recepción --}}
                        <div>
                            <label for="note_date" class="abc-label">FECHA de recepción *</label>
                            <input type="date" name="note_date" id="note_date" value="{{ old('note_date', date('Y-m-d')) }}"
                                   class="abc-input" required>
                            @error('note_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Col G: DOC. ORIGINAL Y/O FOT. --}}
                        <div>
                            <label for="doc_type" class="abc-label">DOC. ORIGINAL Y/O FOT. *</label>
                            <select name="doc_type" id="doc_type" required class="abc-input">
                                <option value="">-- Seleccionar --</option>
                                <option value="ORIGINAL" @selected(old('doc_type') === 'ORIGINAL')>ORIGINAL</option>
                                <option value="FOTOCOPIA" @selected(old('doc_type') === 'FOTOCOPIA')>FOTOCOPIA</option>
                                <option value="AMBOS" @selected(old('doc_type') === 'AMBOS')>AMBOS</option>
                                <option value="FOTOGRAFÍA" @selected(old('doc_type') === 'FOTOGRAFÍA')>FOTOGRAFÍA</option>
                            </select>
                            @error('doc_type')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Col H: FOJAS --}}
                        <div>
                            <label for="pages" class="abc-label">FOJAS *</label>
                            <input type="number" name="pages" id="pages" value="{{ old('pages', 1) }}" min="1"
                                   class="abc-input" required>
                            @error('pages')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Col J: TIPO DOCUMENTACIÓN --}}
                        <div>
                            <label for="note_type" class="abc-label">TIPO DOCUMENTACIÓN *</label>
                            <select name="note_type" id="note_type" required class="abc-input">
                                <option value="">-- Seleccionar --</option>
                                <option value="NOTA INTERNA" @selected(old('note_type') === 'NOTA INTERNA')>NOTA INTERNA</option>
                                <option value="NOTA EXTERNA" @selected(old('note_type') === 'NOTA EXTERNA')>NOTA EXTERNA</option>
                                <option value="INFORME" @selected(old('note_type') === 'INFORME')>INFORME</option>
                                <option value="EVALUACIONES Y/O NOTAS DE LA CONTRALORIA GENERAL DEL ESTADO" @selected(old('note_type') === 'EVALUACIONES Y/O NOTAS DE LA CONTRALORIA GENERAL DEL ESTADO')>EVALUACIONES Y/O NOTAS DE LA CONTRALORIA GENERAL DEL ESTADO</option>
                            </select>
                            @error('note_type')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Col K: TIPOLOGIA --}}
                        <div>
                            <label for="tipologia" class="abc-label">TIPOLOGIA</label>
                            <input type="text" name="tipologia" id="tipologia" value="{{ old('tipologia') }}"
                                   class="abc-input" placeholder="Ej: ADMINISTRATIVA, LEGAL, TÉCNICA..." maxlength="150">
                            @error('tipologia')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Col L: ESTADO DE CONSERVACIÓN --}}
                        <div>
                            <label for="estado_conservacion" class="abc-label">ESTADO DE CONSERVACIÓN</label>
                            <input type="text" name="estado_conservacion" id="estado_conservacion"
                                   value="{{ old('estado_conservacion') }}"
                                   class="abc-input" placeholder="Ej: BUENO, REGULAR, MALO..." maxlength="100">
                            @error('estado_conservacion')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Col F: REFERENCIA --}}
                    <div class="mt-5">
                        <label for="reference" class="abc-label">REFERENCIA *</label>
                        <textarea name="reference" id="reference" rows="2"
                                  class="abc-input" placeholder="Descripción de la referencia..." required>{{ old('reference') }}</textarea>
                        @error('reference')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ======= SECCIÓN CORRESPONDENCIA ======= --}}
                    <div class="mt-6 rounded-xl border" style="border-color: var(--surface-border);">
                        <div class="gradient-teal px-5 py-3 flex items-center gap-2.5 rounded-t-xl">
                            <div class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                            </div>
                            <div>
                                <h4 class="text-white font-bold text-sm">Información de Correspondencia</h4>
                                <p class="text-white/70 text-[11px]">Datos del remitente, destinatario y vía de envío</p>
                            </div>
                        </div>
                        <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-5" style="background-color: var(--surface-card); overflow: visible;">
                            <div>
                                <label for="remitente" class="abc-label flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-teal-500 inline-block"></span>
                                    Remitente *
                                </label>
                                <input type="text" name="remitente" id="remitente"
                                       value="{{ old('remitente', '') }}"
                                       class="abc-input !focus:ring-teal-100 !focus:border-teal-400"
                                       placeholder="Escriba quién envía el documento" required>
                                @error('remitente')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div x-data="{
                                open: false,
                                search: '',
                                selectedValue: '{{ old('destinatario', '') }}',
                                users: @js($users->map(fn($u) => ['id' => $u->id, 'name' => $u->name, 'label' => $u->name . ' (' . $u->role . ')'])),
                                get filtered() {
                                    if (!this.search) return this.users;
                                    let s = this.search.toLowerCase();
                                    return this.users.filter(u => u.label.toLowerCase().includes(s));
                                },
                                init() {
                                    if (this.selectedValue) {
                                        let found = this.users.find(u => u.name.toLowerCase() === this.selectedValue.toLowerCase());
                                        if (found) {
                                            this.selectedValue = found.name;
                                            this.search = found.label;
                                        } else {
                                            this.selectedValue = '';
                                            this.search = '';
                                        }
                                    }
                                },
                                select(user) {
                                    this.selectedValue = user.name;
                                    this.search = user.label;
                                    this.open = false;
                                }
                            }" @click.outside="open = false" class="relative">
                                <label for="destinatario_search" class="abc-label flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-teal-600 inline-block"></span>
                                    Destinatario *
                                </label>
                                <input type="hidden" name="destinatario" :value="selectedValue">
                                <input type="text" id="destinatario_search" autocomplete="off"
                                       class="abc-input"
                                       placeholder="Seleccione a quién se enviará"
                                       x-model="search"
                                       @focus="open = true; search = ''"
                                       @input="open = true; selectedValue = ''"
                                       @keydown.escape="open = false"
                                       x-init="search = selectedValue">
                                <div x-show="open && filtered.length > 0" x-cloak x-transition
                                     class="absolute z-[9999] w-full mt-1 bg-white border-2 border-gray-300 rounded-lg max-h-60 overflow-y-auto"
                                     style="box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
                                    <template x-for="user in filtered" :key="user.id">
                                        <div @click="select(user)"
                                             class="px-4 py-2.5 text-sm cursor-pointer hover:bg-teal-50 hover:text-teal-700 transition-colors border-b border-gray-100 last:border-b-0"
                                             :class="selectedValue == user.name ? 'bg-teal-50 font-semibold text-teal-700' : 'text-gray-700'"
                                             x-text="user.label"></div>
                                    </template>
                                </div>
                                <div x-show="open && search && filtered.length === 0" x-cloak
                                     class="absolute z-[9999] w-full mt-1 bg-white border-2 border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-400"
                                     style="box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
                                    No se encontraron usuarios
                                </div>
                                <p class="mt-1 text-[11px] font-medium text-teal-700">
                                    Se enviará a:
                                    <span x-text="selectedValue || 'Seleccione un destinatario'" class="font-bold"></span>
                                </p>
                                @error('destinatario')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="via" class="abc-label flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-cyan-500 inline-block"></span>
                                   Nombre de Vía
                                </label>
                                <input type="text" name="via" id="via"
                                       value="{{ old('via') }}"
                                       class="abc-input"
                                       placeholder="texto..."
                                       maxlength="250">
                                @error('via')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- Col I: OBSERVACIONES --}}
                    <div class="mt-5">
                        <label for="observations" class="abc-label">OBSERVACIONES</label>
                        <textarea name="observations" id="observations" rows="2"
                                  class="abc-input" placeholder="Observaciones adicionales...">{{ old('observations') }}</textarea>
                        @error('observations')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Adjuntos --}}
                    <div class="mt-5 abc-folder-upload" x-data="fileUpload({ maxMB: 500, acceptedExtensions: ['.pdf'], acceptedLabel: 'PDF' })">
                        <label class="abc-label">Adjuntar documentos PDF</label>

                        <div class="abc-folder-dropzone mt-2"
                             :class="dragging ? 'is-dragging' : ''"
                             @dragover.prevent="dragging = true"
                             @dragleave.prevent="dragging = false"
                             @drop.prevent="handleDrop($event)">

                            <div class="abc-folder-container" @click="$refs.fileInput.click()">
                                <div class="abc-folder">
                                    <div class="abc-front-side">
                                        <div class="abc-tip"></div>
                                        <div class="abc-cover"></div>
                                    </div>
                                    <div class="abc-back-side abc-cover"></div>
                                </div>

                                <label class="abc-custom-file-upload" @click.stop>
                                    <input class="title"
                                           x-ref="fileInput"
                                           type="file"
                                           name="attachments[]"
                                           multiple
                                           accept=".pdf,application/pdf"
                                           @change="handleFiles($event)" />
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V7.5m0 0-3 3m3-3 3 3M6 16.5a4.5 4.5 0 0 1 .386-8.983 5.25 5.25 0 0 1 10.228 1.258A3.75 3.75 0 0 1 16.5 16.5H9.75"/>
                                    </svg>
                                    Subir PDF
                                </label>
                            </div>
                        </div>

                        <div class="mt-3 text-xs" style="color: var(--text-muted);">
                            Solo archivos PDF (máx. 500MB por archivo)
                        </div>

                        <template x-if="files.length > 0">
                            <div class="mt-4 space-y-3">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-bold flex items-center gap-2" style="color: var(--text-primary);">
                                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-red-100 text-red-600 text-xs font-bold" x-text="files.length"></span>
                                        <span>Archivo(s) PDF seleccionado(s)</span>
                                    </p>
                                    <button type="button" @click="clearAll()" class="text-xs text-red-500 hover:text-red-700 font-semibold transition">
                                        Quitar todos
                                    </button>
                                </div>

                                <template x-for="(file, index) in files" :key="`${file.name}-${file.lastModified}-${index}`">
                                    <div class="flex items-center gap-3 p-3 rounded-lg border transition-all"
                                         style="background: var(--surface-input); border-color: var(--surface-border); border-left: 4px solid #dc2626;">
                                        <div class="w-9 h-9 rounded-lg bg-red-50 dark:bg-red-900/30 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold truncate" style="color: var(--text-primary);" x-text="file.name"></p>
                                            <p class="text-xs" style="color: var(--text-muted);" x-text="formatSize(file.size)"></p>
                                        </div>
                                        <button type="button" @click="removeFile(index)" class="p-1.5 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition flex-shrink-0">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </template>

                        <template x-if="files.length === 0">
                            <p class="text-xs mt-3" style="color: var(--text-muted);">Sin archivos PDF seleccionados.</p>
                        </template>

                        @error('attachments')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                        @error('attachments.*')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Botones --}}
                    <div class="mt-8 flex justify-end gap-3 pt-5 border-t" style="border-color: var(--surface-border);" x-data="{ submitting: false }">
                        <a href="{{ route('notes.index') }}" class="abc-btn abc-btn-ghost">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                            Cancelar
                        </a>
                        <button type="button" class="abc-btn abc-btn-success" :disabled="submitting"
                                @click="submitting = true; $nextTick(() => { $el.closest('form').submit() })">
                            <template x-if="!submitting">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                    Guardar como Borrador
                                </span>
                            </template>
                            <template x-if="submitting">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    Subiendo archivos...
                                </span>
                            </template>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        .abc-folder-upload .abc-folder-dropzone {
            border: 1px dashed var(--surface-border);
            border-radius: 14px;
            padding: 20px 14px 16px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.7), rgba(248, 250, 252, 0.9));
            transition: border-color .25s ease, box-shadow .25s ease, transform .25s ease;
        }
        .abc-folder-upload .abc-folder-dropzone.is-dragging {
            border-color: #f87171;
            box-shadow: 0 0 0 3px rgba(248, 113, 113, 0.2);
            transform: translateY(-1px);
        }

        .abc-folder-upload .abc-folder-container {
            --transition: 350ms;
            --folder-W: 120px;
            --folder-H: 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            padding: 14px;
            background: linear-gradient(135deg, #6dd5ed, #2193b0);
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            min-height: calc(var(--folder-H) * 2.1);
            position: relative;
            cursor: pointer;
            overflow: visible;
        }

        .abc-folder-upload .abc-folder {
            position: absolute;
            top: 8px;
            left: calc(50% - 60px);
            animation: abc-folder-float 2.5s infinite ease-in-out;
            transition: transform var(--transition) ease;
            z-index: 2;
        }

        .abc-folder-upload .abc-folder-container:hover .abc-folder,
        .abc-folder-upload .abc-folder-dropzone.is-dragging .abc-folder {
            transform: scale(1.05);
        }

        .abc-folder-upload .abc-folder .abc-front-side,
        .abc-folder-upload .abc-folder .abc-back-side {
            position: absolute;
            transition: transform var(--transition);
            transform-origin: bottom center;
        }

        .abc-folder-upload .abc-folder .abc-back-side::before,
        .abc-folder-upload .abc-folder .abc-back-side::after {
            content: "";
            display: block;
            background-color: #fff;
            opacity: 0.55;
            width: var(--folder-W);
            height: var(--folder-H);
            position: absolute;
            transform-origin: bottom center;
            border-radius: 15px;
            transition: transform 350ms;
            z-index: 0;
        }

        .abc-folder-upload .abc-folder-container:hover .abc-back-side::before,
        .abc-folder-upload .abc-folder-dropzone.is-dragging .abc-back-side::before {
            transform: rotateX(-5deg) skewX(5deg);
        }
        .abc-folder-upload .abc-folder-container:hover .abc-back-side::after,
        .abc-folder-upload .abc-folder-dropzone.is-dragging .abc-back-side::after {
            transform: rotateX(-15deg) skewX(12deg);
        }

        .abc-folder-upload .abc-folder .abc-front-side {
            z-index: 1;
        }

        .abc-folder-upload .abc-folder-container:hover .abc-front-side,
        .abc-folder-upload .abc-folder-dropzone.is-dragging .abc-front-side {
            transform: rotateX(-40deg) skewX(15deg);
        }

        .abc-folder-upload .abc-folder .abc-tip {
            background: linear-gradient(135deg, #ff9a56, #ff6f56);
            width: 80px;
            height: 20px;
            border-radius: 12px 12px 0 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            position: absolute;
            top: -10px;
            z-index: 2;
        }

        .abc-folder-upload .abc-folder .abc-cover {
            background: linear-gradient(135deg, #ffe563, #ffc663);
            width: var(--folder-W);
            height: var(--folder-H);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        .abc-folder-upload .abc-custom-file-upload {
            font-size: .95rem;
            font-weight: 700;
            color: #fff;
            text-align: center;
            background: rgba(255, 255, 255, 0.25);
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            transition: background var(--transition) ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.55rem;
            width: auto;
            min-width: 190px;
            padding: 10px 22px;
            position: relative;
            z-index: 3;
            margin-top: auto;
        }

        .abc-folder-upload .abc-custom-file-upload:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        .abc-folder-upload .abc-custom-file-upload input[type="file"] {
            display: none;
        }

        @keyframes abc-folder-float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>
</x-app-layout>

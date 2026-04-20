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
                            <label for="box_search" class="abc-label">N. de Caja *</label>
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
   {{-- N° de Carpeta --}}
                        <div>
                            <label for="folder_number" class="abc-label">N° de Carpeta</label>
                            <input type="text" name="folder_number" id="folder_number" value="{{ old('folder_number') }}"
                                   class="abc-input" placeholder="Ej: CARP-001">
                            @error('folder_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- N. de CITE --}}
                        <div>
                            <label for="internal_number" class="abc-label">N. de CITE *</label>
                            <input type="text" name="internal_number" id="internal_number" value="{{ old('internal_number') }}"
                                   class="abc-input" placeholder="Ej: NI-2026-001" required>
                            @error('internal_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Fecha --}}
                        <div>
                            <label for="note_date" class="abc-label">Fecha *</label>
                            <input type="date" name="note_date" id="note_date" value="{{ old('note_date', date('Y-m-d')) }}"
                                   class="abc-input" required>
                            @error('note_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Estado del Documento --}}
                        <div>
                            <label for="doc_type" class="abc-label">Estado del Documento *</label>
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

                     

                        {{-- Nota Interno --}}
                        <div>
                            <label for="note_type" class="abc-label">Nota Interno *</label>
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

                        {{-- Fojas --}}
                        <div>
                            <label for="pages" class="abc-label">Fojas *</label>
                            <input type="number" name="pages" id="pages" value="{{ old('pages', 1) }}" min="1"
                                   class="abc-input" required>
                            @error('pages')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Referencia --}}
                    <div class="mt-5">
                        <label for="reference" class="abc-label">Referencia *</label>
                        <textarea name="reference" id="reference" rows="2"
                                  class="abc-input" placeholder="Descripcion de la referencia..." required>{{ old('reference') }}</textarea>
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
                                       value="{{ old('remitente', auth()->user()->name) }}"
                                       class="abc-input !focus:ring-teal-100 !focus:border-teal-400 bg-gray-50 cursor-not-allowed"
                                       placeholder="Nombre del remitente" readonly required>
                                @error('remitente')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div x-data="{
                                open: false,
                                search: '',
                                selectedValue: '{{ old('destinatario', '') }}',
                                users: @js($users->map(fn($u) => ['id' => $u->id, 'label' => $u->name . ' (' . $u->role . ')'])),
                                get filtered() {
                                    if (!this.search) return this.users;
                                    let s = this.search.toLowerCase();
                                    return this.users.filter(u => u.label.toLowerCase().includes(s));
                                },
                                init() {
                                    if (this.selectedValue) {
                                        this.search = this.selectedValue;
                                    }
                                },
                                select(user) {
                                    this.selectedValue = user.label.split(' (')[0];
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
                                       placeholder="Buscar destinatario..."
                                       x-model="search"
                                       @focus="open = true; search = ''"
                                       @input="open = true"
                                       @keydown.escape="open = false"
                                       x-init="search = selectedValue">
                                <div x-show="open && filtered.length > 0" x-cloak x-transition
                                     class="absolute z-[9999] w-full mt-1 bg-white border-2 border-gray-300 rounded-lg max-h-60 overflow-y-auto"
                                     style="box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
                                    <template x-for="user in filtered" :key="user.id">
                                        <div @click="select(user)"
                                             class="px-4 py-2.5 text-sm cursor-pointer hover:bg-teal-50 hover:text-teal-700 transition-colors border-b border-gray-100 last:border-b-0"
                                             :class="selectedValue == user.label.split(' (')[0] ? 'bg-teal-50 font-semibold text-teal-700' : 'text-gray-700'"
                                             x-text="user.label"></div>
                                    </template>
                                </div>
                                <div x-show="open && search && filtered.length === 0" x-cloak
                                     class="absolute z-[9999] w-full mt-1 bg-white border-2 border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-400"
                                     style="box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
                                    No se encontraron usuarios
                                </div>
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
                    <div class="mt-5">
                        <label for="observations" class="abc-label">Observaciones</label>
                        <textarea name="observations" id="observations" rows="2"
                                  class="abc-input" placeholder="Observaciones adicionales...">{{ old('observations') }}</textarea>
                        @error('observations')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Adjuntos --}}
                    <div class="mt-5" x-data="fileUpload({ maxMB: 500 })">
                        <label class="abc-label">Adjuntar archivos (PDF, JPG, PNG)</label>

                        {{-- Aceternity File Upload --}}
                        <div class="mt-2 relative w-full rounded-xl overflow-hidden cursor-pointer group transition-all duration-300"
                             :class="dragging
                                 ? 'ring-2 ring-blue-400/50'
                                 : ''"
                             style="background: var(--surface-card); border: 1px dashed var(--surface-border);"
                             @click="$refs.fileInput.click()"
                             @dragover.prevent="dragging = true"
                             @dragleave.prevent="dragging = false"
                             @drop.prevent="dragging = false; handleDrop($event)">

                            {{-- Dot-grid background --}}
                            <div class="absolute inset-0 pointer-events-none"
                                 style="background-image: radial-gradient(circle, rgba(128,128,128,0.12) 1px, transparent 1px); background-size: 16px 16px;"></div>

                            {{-- Radial fade from edges --}}
                            <div class="absolute inset-0 pointer-events-none"
                                 style="background: radial-gradient(ellipse at center, transparent 30%, var(--surface-card) 80%);"></div>

                            {{-- Top section: Title + subtitle --}}
                            <div class="relative z-10 text-center pt-10 pb-2 px-6">
                                <p class="text-base font-semibold transition-colors duration-300"
                                   :class="dragging ? 'text-blue-500' : ''"
                                   style="color: var(--text-primary);">
                                    <span x-show="!dragging">Subir archivos</span>
                                    <span x-show="dragging" x-cloak>Suelte los archivos aquí</span>
                                </p>
                                <p class="text-sm mt-1.5" style="color: var(--text-muted);">
                                    Arrastre y suelte, o haga clic para seleccionar
                                </p>
                            </div>

                            {{-- Center: Floating card with icon (Aceternity style) --}}
                            <div class="relative z-10 flex items-center justify-center py-8 px-6">
                                <div class="aceternity-upload-card relative w-24 h-28 rounded-lg flex flex-col items-center justify-center gap-1 transition-all duration-500"
                                     :class="dragging
                                         ? 'border-blue-400 bg-blue-50/70 dark:bg-blue-950/40 shadow-lg shadow-blue-500/10 -translate-y-1'
                                         : 'border-neutral-300/80 dark:border-neutral-600/60 bg-white dark:bg-neutral-900 shadow-md group-hover:shadow-lg group-hover:-translate-y-0.5'"
                                     style="border: 1px dashed;">
                                    <svg class="w-5 h-5 transition-colors duration-300"
                                         :class="dragging ? 'text-blue-500' : 'text-neutral-400 dark:text-neutral-500'"
                                         fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/>
                                    </svg>
                                </div>
                            </div>

                            {{-- Bottom info --}}
                            <div class="relative z-10 text-center pb-8 px-6">
                                <p class="text-xs" style="color: var(--text-muted); opacity: 0.6;">
                                    PDF, JPG, PNG &nbsp;&middot;&nbsp; Máx. {{ Auth::user()->isAdmin() ? '500' : '200' }} MB por archivo &nbsp;&middot;&nbsp; Múltiples archivos
                                </p>
                            </div>

                            <input x-ref="fileInput" type="file" name="attachments[]" multiple accept=".pdf,.jpg,.jpeg,.png" class="hidden" @change="handleFiles($event)">
                        </div>

                        {{-- Lista de archivos seleccionados --}}
                        <template x-if="files.length > 0">
                            <div class="mt-3 space-y-2">
                                <div class="flex items-center justify-between">
                                    <p class="text-xs font-bold" style="color: var(--text-primary);">
                                        <span x-text="files.length"></span> archivo(s) seleccionado(s)
                                    </p>
                                    <button type="button" @click="clearAll()" class="text-xs text-red-500 hover:text-red-700 font-medium transition">
                                        Quitar todos
                                    </button>
                                </div>
                                <template x-for="(file, index) in files" :key="index">
                                    <div class="flex items-center gap-3 p-2.5 rounded-lg border transition-all animate-fade-in-up"
                                         style="background: var(--surface-input); border-color: var(--surface-border);">
                                        {{-- Icono según tipo --}}
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                                             :class="file.type.includes('pdf') ? 'bg-red-50 dark:bg-red-900/30' : 'bg-blue-50 dark:bg-blue-900/30'">
                                            <template x-if="file.type.includes('pdf')">
                                                <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                                            </template>
                                            <template x-if="!file.type.includes('pdf')">
                                                <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z" /></svg>
                                            </template>
                                        </div>
                                        {{-- Info --}}
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium truncate" style="color: var(--text-primary);" x-text="file.name"></p>
                                            <p class="text-xs" style="color: var(--text-muted);" x-text="formatSize(file.size)"></p>
                                        </div>
                                        {{-- Quitar --}}
                                        <button type="button" @click="removeFile(index)" class="p-1 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </template>

                        @error('attachments.*')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
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
</x-app-layout>

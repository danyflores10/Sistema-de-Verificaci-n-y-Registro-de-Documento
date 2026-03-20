<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="abc-page-header">
            <div class="relative z-10">
                <h2 class="text-2xl font-bold tracking-tight">Editar Documento: <?php echo e($note->internal_number); ?></h2>
                <p class="text-sm text-white/70 mt-1">Modifique los datos del documento</p>
            </div>
        </div>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="abc-card">
                
                
                <div class="relative overflow-hidden px-6 py-5 flex items-center gap-3"
                     style="background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-light) 50%, #7c3aed 100%);">
                    <div class="absolute inset-0 opacity-10"
                         style="background: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,0.15) 10px, rgba(255,255,255,0.15) 20px);"></div>
                    <div class="relative z-10 w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center shadow-inner">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"/></svg>
                    </div>
                    <div class="relative z-10">
                        <h3 class="text-white font-bold text-lg leading-tight">Editar Documento</h3>
                        <p class="text-white/70 text-xs mt-0.5">Modifique los datos del documento &mdash; todos los campos (*) son obligatorios</p>
                    </div>
                </div>

                <form id="edit-note-form" method="POST" action="<?php echo e(route('notes.update', $note)); ?>" enctype="multipart/form-data" class="p-6">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        
                        <div x-data="{
                            open: false,
                            search: '',
                            selectedId: '<?php echo e(old('box_id', $note->box_id)); ?>',
                            selectedLabel: '',
                            boxes: <?php echo \Illuminate\Support\Js::from($boxes->map(fn($b) => ['id' => $b->id, 'label' => $b->box_number . ' - ' . $b->description]))->toHtml() ?>,
                            get filtered() {
                                if (!this.search) return this.boxes;
                                let s = this.search.toLowerCase();
                                return this.boxes.filter(b => b.label.toLowerCase().includes(s));
                            },
                            init() {
                                if (this.selectedId) {
                                    let found = this.boxes.find(b => b.id == this.selectedId);
                                    if (found) { this.selectedLabel = found.label; this.search = found.label; }
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
                                   @keydown.escape="open = false">
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
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['box_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <div>
                            <label for="internal_number" class="abc-label">N. de CITE *</label>
                            <input type="text" name="internal_number" id="internal_number"
                                   value="<?php echo e(old('internal_number', $note->internal_number)); ?>"
                                   class="abc-input" required>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['internal_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <div>
                            <label for="note_date" class="abc-label">Fecha *</label>
                            <input type="date" name="note_date" id="note_date"
                                   value="<?php echo e(old('note_date', $note->note_date->format('Y-m-d'))); ?>"
                                   class="abc-input" required>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['note_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <div>
                            <label for="doc_type" class="abc-label">Estado del Documento *</label>
                            <select name="doc_type" id="doc_type" required class="abc-input">
                                <option value="ORIGINAL" <?php if(old('doc_type', $note->doc_type) === 'ORIGINAL'): echo 'selected'; endif; ?>>ORIGINAL</option>
                                <option value="FOTOCOPIA" <?php if(old('doc_type', $note->doc_type) === 'FOTOCOPIA'): echo 'selected'; endif; ?>>FOTOCOPIA</option>
                                <option value="AMBOS" <?php if(old('doc_type', $note->doc_type) === 'AMBOS'): echo 'selected'; endif; ?>>AMBOS</option>
                                <option value="FOTOGRAFÍA" <?php if(old('doc_type', $note->doc_type) === 'FOTOGRAFÍA'): echo 'selected'; endif; ?>>FOTOGRAFÍA</option>
                            </select>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['doc_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        
                        <div>
                            <label for="folder_number" class="abc-label">N° de Carpeta</label>
                            <input type="text" name="folder_number" id="folder_number"
                                   value="<?php echo e(old('folder_number', $note->folder_number)); ?>"
                                   class="abc-input" placeholder="Ej: CARP-001">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['folder_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        
                        <div>
                            <label for="note_type" class="abc-label">Nota Interno *</label>
                            <select name="note_type" id="note_type" required class="abc-input">
                                <option value="">-- Seleccionar --</option>
                                <option value="NOTA INTERNA" <?php if(old('note_type', $note->note_type) === 'NOTA INTERNA'): echo 'selected'; endif; ?>>NOTA INTERNA</option>
                                <option value="NOTA EXTERNA" <?php if(old('note_type', $note->note_type) === 'NOTA EXTERNA'): echo 'selected'; endif; ?>>NOTA EXTERNA</option>
                                <option value="INFORME" <?php if(old('note_type', $note->note_type) === 'INFORME'): echo 'selected'; endif; ?>>INFORME</option>
                                <option value="EVALUACIONES Y/O NOTAS DE LA CONTRALORIA GENERAL DEL ESTADO" <?php if(old('note_type', $note->note_type) === 'EVALUACIONES Y/O NOTAS DE LA CONTRALORIA GENERAL DEL ESTADO'): echo 'selected'; endif; ?>>EVALUACIONES Y/O NOTAS DE LA CONTRALORIA GENERAL DEL ESTADO</option>
                            </select>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['note_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <div>
                            <label for="pages" class="abc-label">Fojas *</label>
                            <input type="number" name="pages" id="pages" value="<?php echo e(old('pages', $note->pages)); ?>" min="1"
                                   class="abc-input" required>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['pages'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <div class="mt-5">
                        <label for="reference" class="abc-label">Referencia *</label>
                        <textarea name="reference" id="reference" rows="2"
                                  class="abc-input" required><?php echo e(old('reference', $note->reference)); ?></textarea>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['reference'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    
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
                                       value="<?php echo e(old('remitente', $note->remitente)); ?>"
                                       class="abc-input"
                                       placeholder="Nombre del remitente" required>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['remitente'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div x-data="{
                                open: false,
                                search: '',
                                selectedValue: '<?php echo e(old('destinatario', $note->destinatario)); ?>',
                                users: <?php echo \Illuminate\Support\Js::from($users->map(fn($u) => ['id' => $u->id, 'label' => $u->name . ' (' . $u->role . ')']))->toHtml() ?>,
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
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['destinatario'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div>
                                <label for="via" class="abc-label flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-cyan-500 inline-block"></span>
                                    Vía
                                </label>
                                <input type="text" name="via" id="via"
                                       value="<?php echo e(old('via', $note->via)); ?>"
                                       class="abc-input"
                                       placeholder="Ej: Correo físico, mensajero, electrónico..."
                                       maxlength="250">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['via'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mt-5">
                        <label for="observations" class="abc-label">Observaciones</label>
                        <textarea name="observations" id="observations" rows="2"
                                  class="abc-input"><?php echo e(old('observations', $note->observations)); ?></textarea>
                    </div>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($note->attachments->count()): ?>
                        <div class="mt-6">
                            <label class="abc-label">Adjuntos existentes</label>
                            <div class="space-y-2 mt-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $note->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <div class="flex items-center justify-between bg-gray-50 border border-gray-100 p-3 rounded-lg">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg gradient-navy flex items-center justify-center flex-shrink-0">
                                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13"/></svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-700"><?php echo e($attachment->original_name); ?></p>
                                                <p class="text-xs text-gray-400">(<?php echo e(number_format($attachment->file_size / 1024, 1)); ?> KB)</p>
                                            </div>
                                        </div>
                                        <form method="POST" action="<?php echo e(route('attachments.destroy', $attachment)); ?>" class="inline" id="delete-attachment-<?php echo e($attachment->id); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="button" onclick="confirmarEliminarAdjunto('<?php echo e(addslashes($attachment->original_name)); ?>', 'delete-attachment-<?php echo e($attachment->id); ?>')" class="abc-btn abc-btn-danger text-xs !px-3 !py-1.5">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <div class="mt-5" x-data="fileUpload()">
                        <label class="abc-label">Agregar nuevos adjuntos</label>
                        <div class="mt-1 border-2 border-dashed rounded-xl p-6 text-center transition-all duration-200 cursor-pointer"
                             :class="dragging ? 'border-blue-400 bg-blue-50/50 dark:bg-blue-900/20 scale-[1.01]' : 'border-gray-200 dark:border-gray-700 hover:border-blue-300 hover:bg-blue-50/30 dark:hover:bg-blue-900/10'"
                             @click="$refs.fileInput.click()"
                             @dragover.prevent="dragging = true"
                             @dragleave.prevent="dragging = false"
                             @drop.prevent="dragging = false; handleDrop($event)">
                            <svg class="w-10 h-10 mx-auto mb-3 transition-colors" :class="dragging ? 'text-blue-400' : 'text-gray-300 dark:text-gray-600'" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/></svg>
                            <p class="text-sm font-medium" style="color: var(--text-secondary);">Haga clic o arrastre archivos aquí</p>
                            <p class="text-xs mt-1" style="color: var(--text-muted);">PDF, JPG, PNG &mdash; Máximo 10MB por archivo</p>
                            <input x-ref="fileInput" type="file" name="attachments[]" multiple accept=".pdf,.jpg,.jpeg,.png" class="hidden" @change="handleFiles($event)">
                        </div>

                        
                        <template x-if="files.length > 0">
                            <div class="mt-3 space-y-2">
                                <div class="flex items-center justify-between">
                                    <p class="text-xs font-bold" style="color: var(--text-primary);">
                                        <span x-text="files.length"></span> archivo(s) nuevo(s)
                                    </p>
                                    <button type="button" @click="clearAll()" class="text-xs text-red-500 hover:text-red-700 font-medium transition">
                                        Quitar todos
                                    </button>
                                </div>
                                <template x-for="(file, index) in files" :key="index">
                                    <div class="flex items-center gap-3 p-2.5 rounded-lg border transition-all animate-fade-in-up"
                                         style="background: var(--surface-input); border-color: var(--surface-border);">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                                             :class="file.type.includes('pdf') ? 'bg-red-50 dark:bg-red-900/30' : 'bg-blue-50 dark:bg-blue-900/30'">
                                            <template x-if="file.type.includes('pdf')">
                                                <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                                            </template>
                                            <template x-if="!file.type.includes('pdf')">
                                                <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z" /></svg>
                                            </template>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium truncate" style="color: var(--text-primary);" x-text="file.name"></p>
                                            <p class="text-xs" style="color: var(--text-muted);" x-text="formatSize(file.size)"></p>
                                        </div>
                                        <button type="button" @click="removeFile(index)" class="p-1 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>

                    
                    <div class="mt-8 flex justify-end gap-3 pt-5 border-t" style="border-color: var(--surface-border);" x-data="{ submitting: false }">
                        <a href="<?php echo e(route('notes.show', $note)); ?>" class="abc-btn abc-btn-ghost">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                            Cancelar
                        </a>
                        <button type="button" class="abc-btn abc-btn-success" :disabled="submitting"
                                @click="submitting = true; $nextTick(() => { document.getElementById('edit-note-form').submit() })">
                            <template x-if="!submitting">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                    Actualizar Nota
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

    <script>
        function confirmarEliminarAdjunto(nombre, formId) {
            Swal.fire({
                title: '¿Eliminar adjunto?',
                html: `Se eliminará el archivo <strong>${nombre}</strong> permanentemente.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\hp pavilion\OneDrive\Escritorio\System Correos\system-correos\resources\views/notes/edit.blade.php ENDPATH**/ ?>
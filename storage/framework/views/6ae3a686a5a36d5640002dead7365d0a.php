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
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold tracking-tight">Importar desde Excel</h2>
                <p class="text-sm text-white/70 mt-1">Carga masiva de documentos desde archivos Excel &mdash; Agencia Boliviana de Correos</p>
            </div>
            <a href="<?php echo e(route('notes.index')); ?>" class="abc-btn abc-btn-warning">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"/></svg>
                Volver a Documentos
            </a>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 flex items-start gap-3">
                    <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-emerald-800"><?php echo e(session('success')); ?></p>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 flex items-start gap-3">
                    <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-red-500 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-red-800"><?php echo e(session('error')); ?></p>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('import_errors')): ?>
                            <ul class="mt-2 text-xs text-red-600 list-disc list-inside space-y-1">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = session('import_errors'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <li><?php echo e($err); ?></li>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </ul>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div class="abc-card">
                <div class="p-6">
                    
                    <div class="mb-6 rounded-xl border border-blue-200 bg-blue-50 p-5">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-blue-900 text-sm mb-2">Formato requerido del Excel</h4>
                                <p class="text-xs text-blue-700 mb-3">El archivo Excel puede tener <strong>múltiples hojas</strong> (CAJA 12, CAJA 18, etc.) y debe tener estas columnas en la <strong>primera fila</strong> (encabezados):</p>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-2">
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Col. A</p>
                                        <p class="text-xs font-semibold text-blue-900">N° DE CAJA</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Col. B</p>
                                        <p class="text-xs font-semibold text-blue-900">N° DE CARPETA</p>
                                    </div>
                                    <div class="bg-white rounded-lg px-3 py-2 border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-500 uppercase">Col. C-D</p>
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
                                        <p class="text-xs font-semibold text-blue-900">DOC. ORIGINAL</p>
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
                                        <p class="text-xs font-semibold text-blue-900">TIPO DOC.</p>
                                    </div>
                                </div>
                                <p class="text-xs text-blue-600 mt-3">
                                    <strong>Nota:</strong> Se leen <strong>todas las hojas</strong> del archivo automáticamente. Si la caja no existe, se creará. Los documentos se importan con estado <strong>BORRADOR</strong>.
                                </p>
                            </div>
                        </div>
                    </div>

                    
                    <form action="<?php echo e(route('import.store')); ?>" method="POST" enctype="multipart/form-data"
                          x-data="{ fileName: '', uploading: false, dragOver: false }"
                          @submit="uploading = true">
                        <?php echo csrf_field(); ?>

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
                                        <p class="text-xs text-gray-400 mt-1">o haga clic para seleccionar &mdash; Formatos: .xlsx, .xls, .csv (máx. 500MB)</p>
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

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4 border-t" style="border-color: var(--surface-border);">
                            <a href="<?php echo e(route('notes.index')); ?>" class="abc-btn" style="background-color: var(--surface-hover);">
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
                                <tr><td class="py-2 px-3 font-mono text-xs">N° DE CARPETA</td><td class="py-2 px-3">N° de Carpeta</td><td class="py-2 px-3"><span class="text-gray-400 font-bold text-xs">NO</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">N° DE DOCUMENTO</td><td class="py-2 px-3">N. de CITE</td><td class="py-2 px-3"><span class="text-gray-400 font-bold text-xs">NO</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">FECHA de recepción</td><td class="py-2 px-3">Fecha</td><td class="py-2 px-3"><span class="text-gray-400 font-bold text-xs">NO</span></td></tr>
                                <tr><td class="py-2 px-3 font-mono text-xs">REFERENCIA</td><td class="py-2 px-3">Referencia</td><td class="py-2 px-3"><span class="text-gray-400 font-bold text-xs">NO</span></td></tr>
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
<?php /**PATH C:\Users\hp pavilion\OneDrive\Escritorio\System Correos\system-correos\resources\views/import/index.blade.php ENDPATH**/ ?>
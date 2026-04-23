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

<div x-data="notesPage()" @keydown.escape.window="close()">
    <div class="abc-page-header">
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold tracking-tight">Documentos</h2>
                <p class="text-sm text-white/70 mt-1">Gestión de documentos internos &mdash; Agencia Boliviana de Correos</p>
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                <a href="<?php echo e(route('reports.export.excel', request()->query())); ?>" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-xs font-semibold bg-emerald-500 hover:bg-emerald-600 text-white transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                    Excel
                </a>
                <a href="<?php echo e(route('reports.export.pdf', request()->query())); ?>" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-xs font-semibold bg-red-500 hover:bg-red-600 text-white transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                    PDF
                </a>
                <a href="<?php echo e(route('notes.create')); ?>" class="abc-btn abc-btn-warning">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Nueva Nota
                </a>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-[96rem] mx-auto px-3 sm:px-4 lg:px-6 xl:px-8">

            
            <div class="abc-filter-bar">
                <form method="GET" action="<?php echo e(route('notes.index')); ?>" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-7 gap-4 items-end">
                    <div>
                        <label class="abc-label">N° CAJA</label>
                        <select name="box_id" class="abc-input">
                            <option value="">-- Todas --</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $boxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $box): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <option value="<?php echo e($box->id); ?>" <?php if(request('box_id') == $box->id): echo 'selected'; endif; ?>><?php echo e($box->box_number); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                    <div>
                        <label class="abc-label">N° DE DOCUMENTO</label>
                        <input type="text" name="internal_number" value="<?php echo e(request('internal_number')); ?>"
                               class="abc-input" placeholder="Buscar...">
                    </div>
                    <div>
                        <label class="abc-label">N° DE CARPETA</label>
                        <input type="text" name="folder_number" value="<?php echo e(request('folder_number')); ?>"
                               class="abc-input" placeholder="Buscar...">
                    </div>
                    <div>
                        <label class="abc-label">Estado</label>
                        <select name="status" class="abc-input">
                            <option value="">-- Todos --</option>
                            <option value="BORRADOR" <?php if(request('status') === 'BORRADOR'): echo 'selected'; endif; ?>>BORRADOR</option>
                            <option value="ENVIADO" <?php if(request('status') === 'ENVIADO'): echo 'selected'; endif; ?>>ENVIADO</option>
                            <option value="VERIFICADO" <?php if(request('status') === 'VERIFICADO'): echo 'selected'; endif; ?>>VERIFICADO</option>
                            <option value="RECHAZADO" <?php if(request('status') === 'RECHAZADO'): echo 'selected'; endif; ?>>RECHAZADO</option>
                        </select>
                    </div>
                    <div>
                        <label class="abc-label">FECHA desde</label>
                        <input type="date" name="date_from" value="<?php echo e(request('date_from')); ?>" class="abc-input">
                    </div>
                    <div>
                        <label class="abc-label">FECHA hasta</label>
                        <input type="date" name="date_to" value="<?php echo e(request('date_to')); ?>" class="abc-input">
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="abc-btn abc-btn-primary">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                            Filtrar
                        </button>
                        <a href="<?php echo e(route('notes.index')); ?>" class="abc-btn abc-btn-ghost text-xs">Limpiar</a>
                    </div>
                </form>
            </div>

            
            <div class="flex items-center justify-between mb-3 px-1">
                <p class="text-sm" style="color: var(--text-muted);">
                    Mostrando <span class="font-semibold" style="color: var(--text-primary);"><?php echo e($notes->count()); ?></span> de <span class="font-semibold" style="color: var(--text-primary);"><?php echo e($notes->total()); ?></span> registros
                </p>
            </div>

            
            <div class="abc-card mobile-hide-table" style="border-radius: 0.75rem;">
                <div class="overflow-x-auto">
                    <table class="w-full notes-wide-table" style="min-width: 1720px;">
                        <thead>
                            <tr style="background: linear-gradient(135deg, var(--abc-navy) 0%, var(--abc-navy-light) 100%);">
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 40px;">N°</th>
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 80px;">N° CAJA</th>
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 85px;">N° DE CARPETA</th>
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 155px;">N° DE DOCUMENTO</th>
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 95px;">FECHA recepción</th>
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="min-width: 280px;">REFERENCIA</th>
                                <th class="px-3 py-3 text-center text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 90px;">DOC. ORIG./FOT.</th>
                                <th class="px-3 py-3 text-center text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 55px;">FOJAS</th>
                                <th class="px-3 py-3 text-center text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 120px;">TIPO DOC.</th>
                                <th class="px-3 py-3 text-center text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 110px;">TIPOLOGIA</th>
                                <th class="px-3 py-3 text-center text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 110px;">EST. CONSERV.</th>
                                <th class="px-3 py-3 text-left text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 210px;">OBSERVACIONES</th>
                                <th class="px-3 py-3 text-center text-[10px] font-bold text-white/90 uppercase tracking-wider" style="width: 100px;">Estado</th>
                                <th class="px-3 py-3 text-center text-[10px] font-bold text-white/90 uppercase tracking-wider sticky right-0" style="width: 140px; background: linear-gradient(135deg, var(--abc-navy) 0%, var(--abc-navy-light) 100%); box-shadow: -4px 0 8px -4px rgba(0,0,0,0.15);">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y" style="border-color: var(--surface-border-light);">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <?php
                                    $noteData = [
                                        'id'                  => $note->id,
                                        'box_id'              => $note->box_id,
                                        'box_number'          => $note->box->box_number ?? '',
                                        'folder_number'       => $note->folder_number,
                                        'internal_number'     => $note->internal_number,
                                        'note_date'           => $note->note_date->format('Y-m-d'),
                                        'note_date_display'   => $note->note_date->format('d/m/Y'),
                                        'reference'           => $note->reference,
                                        'doc_type'            => $note->doc_type,
                                        'pages'               => (int) $note->pages,
                                        'observations'        => $note->observations,
                                        'note_type'           => $note->note_type,
                                        'tipologia'           => $note->tipologia,
                                        'estado_conservacion' => $note->estado_conservacion,
                                        'remitente'           => $note->remitente,
                                        'destinatario'        => $note->destinatario,
                                        'via'                 => $note->via,
                                        'status'              => $note->status,
                                        'rejection_reason'    => $note->rejection_reason,
                                        'creator_name'        => $note->creator->name ?? '-',
                                        'verifier_name'       => $note->verifier->name ?? null,
                                        'verified_at'         => $note->verified_at?->format('d/m/Y H:i'),
                                        'can_update'          => auth()->user()->can('update', $note),
                                        'attachments'         => $note->attachments->map(fn($a) => [
                                            'id'           => $a->id,
                                            'name'         => $a->original_name,
                                            'url'          => asset('storage/' . $a->file_path),
                                            'mime_type'    => $a->mime_type,
                                            'size_kb'      => number_format($a->file_size / 1024, 1),
                                        ])->toArray(),
                                    ];
                                ?>
                                <tr class="group transition-colors duration-150 hover:bg-blue-50/40 dark:hover:bg-blue-900/10">
                                    <td class="px-3 py-2.5 text-xs font-medium" style="color: var(--text-muted);"><?php echo e($notes->firstItem() + $index); ?></td>
                                    <td class="px-3 py-2.5 text-xs font-bold" style="color: var(--text-primary);"><?php echo e($note->box->box_number ?? '-'); ?></td>
                                    <td class="px-3 py-2.5 text-xs" style="color: var(--text-secondary);"><?php echo e($note->folder_number ?? '-'); ?></td>
                                    <td class="px-3 py-2.5">
                                        <button type="button" @click="openView(<?php echo \Illuminate\Support\Js::from($noteData)->toHtml() ?>)" class="text-xs font-bold hover:underline" style="color: var(--abc-navy);">
                                            <?php echo e($note->internal_number); ?>

                                        </button>
                                    </td>
                                    <td class="px-3 py-2.5 text-xs whitespace-nowrap" style="color: var(--text-secondary);"><?php echo e($note->note_date->format('d/m/Y')); ?></td>
                                    <td class="px-3 py-2.5 text-xs" style="color: var(--text-secondary); max-width: 240px;">
                                        <span class="block truncate" title="<?php echo e($note->reference); ?>"><?php echo e($note->reference); ?></span>
                                    </td>
                                    
                                    <td class="px-3 py-2.5 text-center">
                                        <?php
                                            $docTypeColors = [
                                                'ORIGINAL'   => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
                                                'FOTOCOPIA'  => 'bg-sky-50 text-sky-700 ring-sky-200',
                                                'AMBOS'      => 'bg-violet-50 text-violet-700 ring-violet-200',
                                                'FOTOGRAFÍA' => 'bg-amber-50 text-amber-700 ring-amber-200',
                                            ];
                                            $docTypeClass = $docTypeColors[$note->doc_type] ?? 'bg-gray-50 text-gray-700 ring-gray-200';
                                        ?>
                                        <span class="inline-flex px-2 py-0.5 text-[10px] font-semibold rounded-md ring-1 ring-inset <?php echo e($docTypeClass); ?>"><?php echo e($note->doc_type); ?></span>
                                    </td>
                                    
                                    <td class="px-3 py-2.5 text-xs text-center font-semibold" style="color: var(--text-primary);"><?php echo e($note->pages); ?></td>
                                    
                                    <td class="px-3 py-2.5 text-center">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($note->note_type): ?>
                                            <span class="inline-flex px-2 py-0.5 text-[10px] font-semibold rounded-md ring-1 ring-inset bg-indigo-50 text-indigo-700 ring-indigo-200" title="<?php echo e($note->note_type); ?>">
                                                <?php echo e(\Illuminate\Support\Str::limit($note->note_type, 18)); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="text-[10px]" style="color: var(--text-muted);">-</span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                    
                                    <td class="px-3 py-2.5 text-center">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($note->tipologia): ?>
                                            <span class="inline-flex px-2 py-0.5 text-[10px] font-semibold rounded-md ring-1 ring-inset bg-teal-50 text-teal-700 ring-teal-200" title="<?php echo e($note->tipologia); ?>">
                                                <?php echo e(\Illuminate\Support\Str::limit($note->tipologia, 16)); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="text-[10px]" style="color: var(--text-muted);">-</span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                    
                                    <td class="px-3 py-2.5 text-center">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($note->estado_conservacion): ?>
                                            <?php
                                                $conservColors = match(strtoupper($note->estado_conservacion)) {
                                                    'BUENO', 'BUENA', 'EXCELENTE' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
                                                    'REGULAR'                     => 'bg-amber-50 text-amber-700 ring-amber-200',
                                                    'MALO', 'MALA', 'DETERIORADO' => 'bg-red-50 text-red-700 ring-red-200',
                                                    default                       => 'bg-slate-50 text-slate-700 ring-slate-200',
                                                };
                                            ?>
                                            <span class="inline-flex px-2 py-0.5 text-[10px] font-semibold rounded-md ring-1 ring-inset <?php echo e($conservColors); ?>" title="<?php echo e($note->estado_conservacion); ?>">
                                                <?php echo e(\Illuminate\Support\Str::limit($note->estado_conservacion, 14)); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="text-[10px]" style="color: var(--text-muted);">-</span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                    
                                    <td class="px-3 py-2.5 text-xs" style="color: var(--text-muted); max-width: 150px;">
                                        <span class="block truncate" title="<?php echo e($note->observations); ?>"><?php echo e($note->observations ?? '-'); ?></span>
                                    </td>
                                    <td class="px-3 py-2.5 text-center">
                                        <?php echo $__env->make('partials.status-badge', ['status' => $note->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                    </td>
                                    <td class="px-2 py-2.5 text-center sticky right-0 transition-colors duration-150" style="background-color: var(--surface-card); box-shadow: -4px 0 8px -4px rgba(0,0,0,0.08);">
                                        <div class="inline-flex items-center gap-1.5">
                                            
                                            <button type="button" @click="openView(<?php echo \Illuminate\Support\Js::from($noteData)->toHtml() ?>)"
                                                    class="action-btn action-btn-view"
                                                    title="Ver detalle completo">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                                            </button>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $note)): ?>
                                                
                                                <button type="button" @click="openEdit(<?php echo \Illuminate\Support\Js::from($noteData)->toHtml() ?>)"
                                                        class="action-btn action-btn-edit"
                                                        title="Editar documento">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"/></svg>
                                                </button>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $note)): ?>
                                                
                                                <form method="POST" action="<?php echo e(route('notes.destroy', $note)); ?>" class="inline" id="delete-form-<?php echo e($note->id); ?>" onsubmit="event.preventDefault(); confirmarEliminar('<?php echo e($note->internal_number); ?>', 'delete-form-<?php echo e($note->id); ?>')">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                    <button type="submit"
                                                            class="action-btn action-btn-delete"
                                                            title="Eliminar documento">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <tr>
                                    <td colspan="14" class="text-center py-16" style="border: none;">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="w-16 h-16 rounded-full flex items-center justify-center" style="background-color: var(--surface-border-light);">
                                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" style="color: var(--text-muted);"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9.75m3 0H9.75m0 0V18m-6-13.5V18a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25V6.108c0-.591-.239-1.16-.659-1.575l-2.847-2.784A2.25 2.25 0 0 0 12.172 1.5H8.25A2.25 2.25 0 0 0 6 3.75Z"/></svg>
                                            </div>
                                            <p class="font-semibold text-sm" style="color: var(--text-muted);">No hay documentos registrados</p>
                                            <a href="<?php echo e(route('notes.create')); ?>" class="abc-btn abc-btn-primary text-xs mt-1">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                                Crear primera nota
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($notes->hasPages()): ?>
                    <div class="px-5 py-3" style="border-top: 1px solid var(--surface-border);">
                        <?php echo e($notes->links()); ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="mobile-show-cards">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <?php
                        $mobileData = [
                            'id'                  => $note->id,
                            'box_id'              => $note->box_id,
                            'box_number'          => $note->box->box_number ?? '',
                            'folder_number'       => $note->folder_number,
                            'internal_number'     => $note->internal_number,
                            'note_date'           => $note->note_date->format('Y-m-d'),
                            'note_date_display'   => $note->note_date->format('d/m/Y'),
                            'reference'           => $note->reference,
                            'doc_type'            => $note->doc_type,
                            'pages'               => (int) $note->pages,
                            'observations'        => $note->observations,
                            'note_type'           => $note->note_type,
                            'tipologia'           => $note->tipologia,
                            'estado_conservacion' => $note->estado_conservacion,
                            'remitente'           => $note->remitente,
                            'destinatario'        => $note->destinatario,
                            'via'                 => $note->via,
                            'status'              => $note->status,
                            'rejection_reason'    => $note->rejection_reason,
                            'creator_name'        => $note->creator->name ?? '-',
                            'verifier_name'       => $note->verifier->name ?? null,
                            'verified_at'         => $note->verified_at?->format('d/m/Y H:i'),
                            'can_update'          => auth()->user()->can('update', $note),
                            'attachments'         => $note->attachments->map(fn($a) => [
                                'id'        => $a->id,
                                'name'      => $a->original_name,
                                'url'       => asset('storage/' . $a->file_path),
                                'mime_type' => $a->mime_type,
                                'size_kb'   => number_format($a->file_size / 1024, 1),
                            ])->toArray(),
                        ];
                    ?>
                    <div class="mobile-card-item">
                        
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold px-2 py-0.5 rounded-md" style="background: linear-gradient(135deg, var(--abc-navy), var(--abc-navy-light)); color: white;">
                                    <?php echo e($note->box->box_number ?? '-'); ?>

                                </span>
                                <button type="button" @click="openView(<?php echo \Illuminate\Support\Js::from($mobileData)->toHtml() ?>)" class="text-sm font-bold hover:underline" style="color: var(--accent-primary);">
                                    <?php echo e($note->internal_number); ?>

                                </button>
                            </div>
                            <?php echo $__env->make('partials.status-badge', ['status' => $note->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>

                        
                        <p class="text-xs mb-2 line-clamp-2" style="color: var(--text-secondary);" title="<?php echo e($note->reference); ?>">
                            <?php echo e($note->reference); ?>

                        </p>

                        
                        <div class="grid grid-cols-2 gap-x-4 gap-y-1">
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Fecha</span>
                                <span class="mobile-card-value text-xs"><?php echo e($note->note_date->format('d/m/Y')); ?></span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Fojas</span>
                                <span class="mobile-card-value text-xs font-semibold"><?php echo e($note->pages); ?></span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Estado Doc.</span>
                                <span class="mobile-card-value text-xs"><?php echo e($note->doc_type); ?></span>
                            </div>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Tipo</span>
                                <span class="mobile-card-value text-xs truncate"><?php echo e($note->note_type ?? '-'); ?></span>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($note->folder_number): ?>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Carpeta</span>
                                <span class="mobile-card-value text-xs"><?php echo e($note->folder_number); ?></span>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($note->tipologia): ?>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Tipología</span>
                                <span class="mobile-card-value text-xs truncate"><?php echo e($note->tipologia); ?></span>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($note->estado_conservacion): ?>
                            <div class="mobile-card-row">
                                <span class="mobile-card-label">Conservación</span>
                                <span class="mobile-card-value text-xs truncate"><?php echo e($note->estado_conservacion); ?></span>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($note->observations): ?>
                            <p class="text-[11px] mt-1.5 truncate" style="color: var(--text-muted);" title="<?php echo e($note->observations); ?>">
                                <span class="font-semibold">Obs:</span> <?php echo e($note->observations); ?>

                            </p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        
                        <div class="mobile-card-actions grid grid-cols-3 gap-2 mt-3">
                            <button type="button" @click="openView(<?php echo \Illuminate\Support\Js::from($mobileData)->toHtml() ?>)"
                                    class="inline-flex items-center justify-center gap-1.5 py-2 rounded-lg text-[11px] font-semibold text-blue-600 bg-blue-50 hover:bg-blue-600 hover:text-white transition-all duration-200 dark:bg-blue-900/20 dark:text-blue-400 dark:hover:bg-blue-600 dark:hover:text-white">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                                Ver
                            </button>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $note)): ?>
                                <button type="button" @click="openEdit(<?php echo \Illuminate\Support\Js::from($mobileData)->toHtml() ?>)"
                                        class="inline-flex items-center justify-center gap-1.5 py-2 rounded-lg text-[11px] font-semibold text-amber-600 bg-amber-50 hover:bg-amber-500 hover:text-white transition-all duration-200 dark:bg-amber-900/20 dark:text-amber-400 dark:hover:bg-amber-500 dark:hover:text-white">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"/></svg>
                                    Editar
                                </button>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $note)): ?>
                                <form method="POST" action="<?php echo e(route('notes.destroy', $note)); ?>" id="mobile-delete-<?php echo e($note->id); ?>" onsubmit="event.preventDefault(); confirmarEliminar('<?php echo e($note->internal_number); ?>', 'mobile-delete-<?php echo e($note->id); ?>')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit"
                                            class="w-full inline-flex items-center justify-center gap-1.5 py-2 rounded-lg text-[11px] font-semibold text-red-600 bg-red-50 hover:bg-red-600 hover:text-white transition-all duration-200 dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-600 dark:hover:text-white">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                                        Eliminar
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="flex flex-col items-center gap-3 py-12">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center" style="background-color: var(--surface-border-light);">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" style="color: var(--text-muted);"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9.75m3 0H9.75m0 0V18m-6-13.5V18a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25V6.108c0-.591-.239-1.16-.659-1.575l-2.847-2.784A2.25 2.25 0 0 0 12.172 1.5H8.25A2.25 2.25 0 0 0 6 3.75Z"/></svg>
                        </div>
                        <p class="font-semibold text-sm" style="color: var(--text-muted);">No hay documentos registrados</p>
                        <a href="<?php echo e(route('notes.create')); ?>" class="abc-btn abc-btn-primary text-xs mt-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            Crear primera nota
                        </a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($notes->hasPages()): ?>
                    <div class="mt-4">
                        <?php echo e($notes->links()); ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>

    
    <div x-show="viewing" x-cloak
         x-transition.opacity.duration.200ms
         class="fixed inset-0 z-[9999] overflow-y-auto"
         @click.self="close()"
         style="backdrop-filter: blur(8px); background-color: rgba(15, 23, 42, 0.55);">

        <div class="min-h-screen flex items-center justify-center p-4">
            <div x-show="viewing" x-cloak
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="relative w-full max-w-5xl rounded-2xl overflow-hidden shadow-2xl"
                 style="background-color: var(--surface-card);"
                 @click.stop>

                
                <div class="relative overflow-hidden px-6 py-5"
                     style="background: linear-gradient(135deg, #0c2340 0%, #1e3a8a 55%, #b91c1c 100%);">
                    <div class="absolute inset-0 opacity-10"
                         style="background: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,0.15) 10px, rgba(255,255,255,0.15) 20px);"></div>

                    <div class="relative flex items-start justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center shadow-inner">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                            </div>
                            <div>
                                <p class="text-[11px] uppercase tracking-[0.2em] font-bold text-white/60">Documento</p>
                                <h3 class="text-xl font-bold text-white leading-tight" x-text="viewing?.internal_number"></h3>
                                <div class="flex items-center gap-2 mt-1.5">
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded-md text-white ring-1 ring-white/20"
                                          :class="{
                                              'bg-slate-500/60': viewing?.status === 'BORRADOR',
                                              'bg-sky-500/70':   viewing?.status === 'ENVIADO',
                                              'bg-emerald-500/70': viewing?.status === 'VERIFICADO',
                                              'bg-red-500/70':   viewing?.status === 'RECHAZADO'
                                          }"
                                          x-text="viewing?.status"></span>
                                    <span class="text-[11px] text-white/70" x-text="'Caja: ' + (viewing?.box_number || '-')"></span>
                                </div>
                            </div>
                        </div>
                        <button type="button" @click="close()"
                                class="flex-shrink-0 w-9 h-9 rounded-lg bg-white/10 hover:bg-white/25 text-white transition-all duration-200 flex items-center justify-center hover:rotate-90"
                                title="Cerrar">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>

                
                <div class="max-h-[70vh] overflow-y-auto">
                    
                    <template x-if="viewing?.status === 'RECHAZADO' && viewing?.rejection_reason">
                        <div class="mx-6 mt-5 rounded-xl border-l-4 border-red-500 bg-red-50 dark:bg-red-900/10 p-4 flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-red-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                            </div>
                            <div>
                                <p class="text-[11px] uppercase tracking-wider font-bold text-red-700 dark:text-red-400">Motivo de rechazo</p>
                                <p class="text-sm text-red-600 dark:text-red-300 mt-0.5" x-text="viewing?.rejection_reason"></p>
                            </div>
                        </div>
                    </template>

                    
                    <div class="p-6">
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            <div class="rounded-lg p-3" style="background-color: var(--surface-input);">
                                <p class="text-[10px] uppercase font-bold tracking-wider" style="color: var(--text-muted);">N° CAJA</p>
                                <p class="text-sm font-bold mt-0.5" style="color: var(--text-primary);" x-text="viewing?.box_number || '-'"></p>
                            </div>
                            <div class="rounded-lg p-3" style="background-color: var(--surface-input);">
                                <p class="text-[10px] uppercase font-bold tracking-wider" style="color: var(--text-muted);">N° DE CARPETA</p>
                                <p class="text-sm font-semibold mt-0.5" style="color: var(--text-primary);" x-text="viewing?.folder_number || '-'"></p>
                            </div>
                            <div class="rounded-lg p-3" style="background-color: var(--surface-input);">
                                <p class="text-[10px] uppercase font-bold tracking-wider" style="color: var(--text-muted);">N° DE DOCUMENTO</p>
                                <p class="text-sm font-bold mt-0.5" style="color: var(--accent-primary);" x-text="viewing?.internal_number || '-'"></p>
                            </div>
                            <div class="rounded-lg p-3" style="background-color: var(--surface-input);">
                                <p class="text-[10px] uppercase font-bold tracking-wider" style="color: var(--text-muted);">FECHA de recepción</p>
                                <p class="text-sm font-semibold mt-0.5" style="color: var(--text-primary);" x-text="viewing?.note_date_display || '-'"></p>
                            </div>
                            <div class="rounded-lg p-3" style="background-color: var(--surface-input);">
                                <p class="text-[10px] uppercase font-bold tracking-wider" style="color: var(--text-muted);">DOC. ORIGINAL Y/O FOT.</p>
                                <span class="inline-flex mt-1 px-2 py-0.5 text-[11px] font-bold rounded-md ring-1 ring-inset bg-emerald-50 text-emerald-700 ring-emerald-200" x-text="viewing?.doc_type || '-'"></span>
                            </div>
                            <div class="rounded-lg p-3" style="background-color: var(--surface-input);">
                                <p class="text-[10px] uppercase font-bold tracking-wider" style="color: var(--text-muted);">FOJAS</p>
                                <p class="text-sm font-bold mt-0.5" style="color: var(--text-primary);" x-text="viewing?.pages ?? '-'"></p>
                            </div>
                            <div class="rounded-lg p-3" style="background-color: var(--surface-input);">
                                <p class="text-[10px] uppercase font-bold tracking-wider" style="color: var(--text-muted);">TIPO DOCUMENTACIÓN</p>
                                <span class="inline-flex mt-1 px-2 py-0.5 text-[11px] font-bold rounded-md ring-1 ring-inset bg-indigo-50 text-indigo-700 ring-indigo-200" x-text="viewing?.note_type || '-'"></span>
                            </div>
                            <div class="rounded-lg p-3" style="background-color: var(--surface-input);">
                                <p class="text-[10px] uppercase font-bold tracking-wider" style="color: var(--text-muted);">TIPOLOGIA</p>
                                <span class="inline-flex mt-1 px-2 py-0.5 text-[11px] font-bold rounded-md ring-1 ring-inset bg-teal-50 text-teal-700 ring-teal-200" x-text="viewing?.tipologia || '-'"></span>
                            </div>
                            <div class="rounded-lg p-3 col-span-2" style="background-color: var(--surface-input);">
                                <p class="text-[10px] uppercase font-bold tracking-wider" style="color: var(--text-muted);">ESTADO DE CONSERVACIÓN</p>
                                <span class="inline-flex mt-1 px-2 py-0.5 text-[11px] font-bold rounded-md ring-1 ring-inset bg-amber-50 text-amber-700 ring-amber-200" x-text="viewing?.estado_conservacion || '-'"></span>
                            </div>
                            <div class="rounded-lg p-3 col-span-2" style="background-color: var(--surface-input);">
                                <p class="text-[10px] uppercase font-bold tracking-wider" style="color: var(--text-muted);">Creado por</p>
                                <p class="text-sm font-semibold mt-0.5" style="color: var(--text-primary);" x-text="viewing?.creator_name || '-'"></p>
                            </div>
                        </div>

                        
                        <div class="mt-5 pt-5 border-t" style="border-color: var(--surface-border);">
                            <p class="text-[10px] uppercase tracking-wider font-bold mb-1.5" style="color: var(--text-muted);">REFERENCIA</p>
                            <p class="text-sm leading-relaxed p-3 rounded-lg" style="background-color: var(--surface-input); color: var(--text-primary);" x-text="viewing?.reference || '-'"></p>
                        </div>

                        
                        <template x-if="viewing?.observations">
                            <div class="mt-4">
                                <p class="text-[10px] uppercase tracking-wider font-bold mb-1.5" style="color: var(--text-muted);">OBSERVACIONES</p>
                                <p class="text-sm leading-relaxed p-3 rounded-lg" style="background-color: var(--surface-input); color: var(--text-secondary);" x-text="viewing?.observations"></p>
                            </div>
                        </template>

                        
                        <div class="mt-5 rounded-xl overflow-hidden border" style="border-color: #0d9488;">
                            <div class="gradient-teal px-4 py-2.5 flex items-center gap-2">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                                <span class="text-white font-bold text-xs uppercase tracking-wider">Información de Correspondencia</span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3" style="background: linear-gradient(135deg, rgba(13,148,136,0.04) 0%, rgba(6,182,212,0.04) 100%);">
                                <div class="p-3 border-b md:border-b-0 md:border-r" style="border-color: var(--surface-border);">
                                    <p class="text-[10px] uppercase font-bold tracking-wider text-teal-600">Remitente</p>
                                    <p class="text-sm font-semibold mt-0.5" style="color: var(--text-primary);" x-text="viewing?.remitente || '-'"></p>
                                </div>
                                <div class="p-3 border-b md:border-b-0 md:border-r" style="border-color: var(--surface-border);">
                                    <p class="text-[10px] uppercase font-bold tracking-wider text-cyan-600">Destinatario</p>
                                    <p class="text-sm font-semibold mt-0.5" style="color: var(--text-primary);" x-text="viewing?.destinatario || '-'"></p>
                                </div>
                                <div class="p-3">
                                    <p class="text-[10px] uppercase font-bold tracking-wider text-emerald-600">Vía</p>
                                    <p class="text-sm font-semibold mt-0.5" style="color: var(--text-primary);" x-text="viewing?.via || '-'"></p>
                                </div>
                            </div>
                        </div>

                        
                        <template x-if="viewing?.verifier_name">
                            <div class="mt-4 p-3 rounded-lg flex items-center gap-3" style="background: linear-gradient(135deg, rgba(16,185,129,0.08), rgba(5,150,105,0.08)); border: 1px solid rgba(16,185,129,0.25);">
                                <div class="w-9 h-9 rounded-lg bg-emerald-500 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase font-bold tracking-wider text-emerald-700 dark:text-emerald-400">Verificado por</p>
                                    <p class="text-sm font-semibold" style="color: var(--text-primary);">
                                        <span x-text="viewing?.verifier_name"></span>
                                        <span class="text-xs font-normal" style="color: var(--text-muted);">&mdash; <span x-text="viewing?.verified_at"></span></span>
                                    </p>
                                </div>
                            </div>
                        </template>

                        
                        <template x-if="viewing?.attachments && viewing.attachments.length > 0">
                            <div class="mt-5">
                                <p class="text-[10px] uppercase tracking-wider font-bold mb-2" style="color: var(--text-muted);">
                                    Adjuntos (<span x-text="viewing?.attachments.length"></span>)
                                </p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                    <template x-for="att in viewing?.attachments || []" :key="att.id">
                                        <a :href="att.url" target="_blank"
                                           class="flex items-center gap-3 p-2.5 rounded-lg border transition-colors duration-200 hover:shadow-sm"
                                           style="background-color: var(--surface-input); border-color: var(--surface-border);"
                                           :class="'hover:border-blue-400'">
                                            <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0"
                                                 :class="att.mime_type?.includes('pdf') ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600'">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-xs font-semibold truncate" style="color: var(--text-primary);" x-text="att.name"></p>
                                                <p class="text-[10px]" style="color: var(--text-muted);" x-text="att.size_kb + ' KB'"></p>
                                            </div>
                                            <svg class="w-4 h-4 flex-shrink-0" style="color: var(--text-muted);" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                
                <div class="px-6 py-4 flex items-center justify-between gap-3 border-t" style="background-color: var(--surface-card-hover); border-color: var(--surface-border);">
                    <button type="button" @click="close()"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-semibold transition-colors duration-200"
                            style="color: var(--text-secondary); background-color: var(--surface-input);">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                        Cerrar
                    </button>

                    <template x-if="viewing?.can_update">
                        <button type="button" @click="switchToEdit()"
                                class="inline-flex items-center gap-1.5 px-5 py-2 rounded-lg text-sm font-bold text-white shadow-md transition-all duration-200 hover:shadow-lg hover:scale-[1.02]"
                                style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"/></svg>
                            Editar documento
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>

    
    <div x-show="editing" x-cloak
         x-transition.opacity.duration.200ms
         class="fixed inset-0 z-[9999] overflow-y-auto"
         @click.self="close()"
         style="backdrop-filter: blur(8px); background-color: rgba(15, 23, 42, 0.55);">

        <div class="min-h-screen flex items-center justify-center p-4">
            <div x-show="editing" x-cloak
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="relative w-full max-w-5xl rounded-2xl overflow-hidden shadow-2xl"
                 style="background-color: var(--surface-card);"
                 @click.stop>

                <template x-if="editing">
                <div>
                
                <div class="relative overflow-hidden px-6 py-5"
                     style="background: linear-gradient(135deg, #d97706 0%, #f59e0b 50%, #fbbf24 100%);">
                    <div class="absolute inset-0 opacity-10"
                         style="background: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,0.15) 10px, rgba(255,255,255,0.15) 20px);"></div>

                    <div class="relative flex items-start justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center shadow-inner">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"/></svg>
                            </div>
                            <div>
                                <p class="text-[11px] uppercase tracking-[0.2em] font-bold text-white/70">Editar documento</p>
                                <h3 class="text-xl font-bold text-white leading-tight" x-text="editing.internal_number"></h3>
                            </div>
                        </div>
                        <button type="button" @click="close()"
                                class="flex-shrink-0 w-9 h-9 rounded-lg bg-white/10 hover:bg-white/25 text-white transition-all duration-200 flex items-center justify-center hover:rotate-90"
                                title="Cerrar">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>

                
                <form :action="`<?php echo e(url('/notes')); ?>/${editing.id}`" method="POST" enctype="multipart/form-data" x-ref="editForm" @submit="submitting = true">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>

                    <div class="max-h-[85vh] overflow-y-auto p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            
                            <div>
                                <label class="abc-label">N° CAJA *</label>
                                <select name="box_id" class="abc-input" required x-model="editing.box_id">
                                    <option value="">-- Seleccionar --</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $boxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $box): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                        <option value="<?php echo e($box->id); ?>"><?php echo e($box->box_number); ?> - <?php echo e(Str::limit($box->description, 40)); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                            </div>

                            
                            <div>
                                <label class="abc-label">N° DE CARPETA</label>
                                <input type="text" name="folder_number" class="abc-input" x-model="editing.folder_number" placeholder="Ej: CARP-001">
                            </div>

                            
                            <div>
                                <label class="abc-label">N° DE DOCUMENTO *</label>
                                <input type="text" name="internal_number" class="abc-input" x-model="editing.internal_number" required>
                            </div>

                            
                            <div>
                                <label class="abc-label">FECHA de recepción *</label>
                                <input type="date" name="note_date" class="abc-input" x-model="editing.note_date" required>
                            </div>

                            
                            <div>
                                <label class="abc-label">DOC. ORIGINAL Y/O FOT. *</label>
                                <select name="doc_type" class="abc-input" required x-model="editing.doc_type">
                                    <option value="ORIGINAL">ORIGINAL</option>
                                    <option value="FOTOCOPIA">FOTOCOPIA</option>
                                    <option value="AMBOS">AMBOS</option>
                                    <option value="FOTOGRAFÍA">FOTOGRAFÍA</option>
                                </select>
                            </div>

                            
                            <div>
                                <label class="abc-label">FOJAS *</label>
                                <input type="number" name="pages" class="abc-input" min="1" x-model="editing.pages" required>
                            </div>

                            
                            <div>
                                <label class="abc-label">TIPO DOCUMENTACIÓN *</label>
                                <select name="note_type" class="abc-input" required x-model="editing.note_type">
                                    <option value="NOTA INTERNA">NOTA INTERNA</option>
                                    <option value="NOTA EXTERNA">NOTA EXTERNA</option>
                                    <option value="INFORME">INFORME</option>
                                    <option value="EVALUACIONES Y/O NOTAS DE LA CONTRALORIA GENERAL DEL ESTADO">EVALUACIONES Y/O NOTAS CGE</option>
                                </select>
                            </div>

                            
                            <div>
                                <label class="abc-label">TIPOLOGIA</label>
                                <input type="text" name="tipologia" class="abc-input" x-model="editing.tipologia" maxlength="150" placeholder="Ej: ADMINISTRATIVA">
                            </div>

                            
                            <div class="md:col-span-2">
                                <label class="abc-label">ESTADO DE CONSERVACIÓN</label>
                                <input type="text" name="estado_conservacion" class="abc-input" x-model="editing.estado_conservacion" maxlength="100" placeholder="Ej: BUENO, REGULAR, MALO">
                            </div>
                        </div>

                        
                        <div class="mt-4">
                            <label class="abc-label">REFERENCIA *</label>
                            <textarea name="reference" class="abc-input" rows="4" x-model="editing.reference" required></textarea>
                        </div>

                        
                        <div class="mt-5 rounded-xl border overflow-hidden" style="border-color: var(--surface-border);">
                            <div class="gradient-teal px-4 py-2.5 flex items-center gap-2">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                                <span class="text-white font-bold text-xs uppercase tracking-wider">Información de Correspondencia</span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">
                                <div>
                                    <label class="abc-label">Remitente *</label>
                                    <input type="text" name="remitente" class="abc-input" x-model="editing.remitente" placeholder="Escriba quién envía el documento" required>
                                </div>
                                <div>
                                    <label class="abc-label">Destinatario *</label>
                                    <input type="text"
                                           name="destinatario"
                                           class="abc-input"
                                           x-model="editing.destinatario"
                                           required
                                           list="users-datalist"
                                           placeholder="Seleccione a quién se enviará">
                                    <datalist id="users-datalist">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                            <option value="<?php echo e($u->name); ?>"><?php echo e($u->name); ?> (<?php echo e($u->role); ?>)</option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </datalist>
                                    <p class="mt-1 text-[11px] font-medium text-teal-700">
                                        Se enviará a:
                                        <span class="font-bold" x-text="editing?.destinatario || 'Seleccione un destinatario'"></span>
                                    </p>
                                </div>
                                <div>
                                    <label class="abc-label">Vía</label>
                                    <input type="text" name="via" class="abc-input" x-model="editing.via" maxlength="100">
                                </div>
                            </div>
                        </div>

                        
                        <div class="mt-4">
                            <label class="abc-label">OBSERVACIONES</label>
                            <textarea name="observations" class="abc-input" rows="2" x-model="editing.observations" placeholder="Observaciones adicionales..."></textarea>
                        </div>

                        
                        <div class="mt-5 rounded-xl border overflow-hidden abc-folder-upload" style="border-color: var(--surface-border);" x-data="fileUpload({ maxMB: 500, acceptedExtensions: ['.pdf'], acceptedLabel: 'PDF', existingFiles: editing && editing.attachments ? editing.attachments : [], deleteUrlTemplate: '<?php echo e(url('/attachments/__ATTACHMENT_ID__')); ?>', csrfToken: '<?php echo e(csrf_token()); ?>' })">
                            <div class="gradient-teal px-4 py-2.5 flex items-center gap-2">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l3 3m0 0l3-3m-3 3v-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-white font-bold text-xs uppercase tracking-wider">Cargar Documentos PDF</span>
                                <span class="ml-auto text-white text-[10px] bg-white/20 px-2 py-1 rounded">Hasta 500MB</span>
                            </div>
                            <div class="p-4" style="background-color: var(--surface-card);">
                                <div class="abc-folder-dropzone"
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

                                <div class="mt-4 space-y-2 text-xs text-gray-600">
                                    <div class="flex items-center justify-between">
                                        <p class="font-semibold">PDF existentes:</p>
                                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded" x-text="`${existingFiles.length} guardado(s)`"></span>
                                    </div>
                                    <template x-if="existingFiles.length > 0">
                                        <div class="space-y-1 max-h-24 overflow-y-auto">
                                            <template x-for="att in existingFiles" :key="`existing-${att.id}`">
                                                <div class="flex items-center gap-2 justify-between bg-blue-50 p-2 rounded text-xs border border-blue-200">
                                                    <div class="min-w-0 flex-1">
                                                        <p class="truncate text-blue-800 font-semibold" :title="att.name" x-text="att.name"></p>
                                                        <p class="text-blue-600" x-text="formatExistingSize(att)"></p>
                                                    </div>
                                                    <button type="button"
                                                            @click="deleteExistingFile(att.id)"
                                                            :disabled="deletingExistingIds.includes(Number(att.id))"
                                                            class="inline-flex items-center justify-center rounded-md border border-red-200 text-red-700 hover:bg-red-100 transition px-3 py-1.5 font-semibold disabled:opacity-60 disabled:cursor-not-allowed"
                                                            title="Quitar PDF">
                                                        <span x-show="!deletingExistingIds.includes(Number(att.id))">Quitar</span>
                                                        <span x-show="deletingExistingIds.includes(Number(att.id))">Quitando...</span>
                                                    </button>
                                                </div>
                                            </template>
                                        </div>
                                    </template>
                                    <template x-if="existingFiles.length === 0">
                                        <p class="text-gray-400">Sin PDF guardados actualmente</p>
                                    </template>
                                </div>

                                <div class="mt-4 space-y-2 text-xs text-gray-600">
                                    <div class="flex items-center justify-between">
                                        <p class="font-semibold">Nuevos PDF seleccionados:</p>
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded" x-text="`${files.length} PDF(s)`"></span>
                                    </div>
                                    <template x-if="files.length > 0">
                                        <div class="space-y-1 max-h-20 overflow-y-auto">
                                            <template x-for="(file, idx) in files" :key="`${file.name}-${file.lastModified}-${idx}`">
                                                <div class="flex items-center justify-between bg-red-50 p-2 rounded text-xs border border-red-200">
                                                    <span x-text="file.name" class="truncate flex-1 text-red-700 font-semibold"></span>
                                                    <span class="text-red-600 flex-shrink-0" x-text="formatSize(file.size)"></span>
                                                </div>
                                            </template>
                                        </div>
                                    </template>
                                    <template x-if="files.length === 0">
                                        <p class="text-gray-400">Sin archivos PDF seleccionados</p>
                                    </template>
                                </div>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['attachments'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-xs mt-2"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['attachments.*'];
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
                        </div>
                    </div>

                    
                    <div class="px-6 py-4 flex items-center justify-end gap-3 border-t" style="background-color: var(--surface-card-hover); border-color: var(--surface-border);">
                        <button type="button" @click="close()"
                                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-semibold transition-colors duration-200"
                                style="color: var(--text-secondary); background-color: var(--surface-input);">
                            Cancelar
                        </button>
                        <button type="submit" :disabled="submitting"
                                class="inline-flex items-center gap-2 px-6 py-2 rounded-lg text-sm font-bold text-white shadow-md transition-all duration-200 hover:shadow-lg hover:scale-[1.02] disabled:opacity-60 disabled:cursor-not-allowed disabled:hover:scale-100"
                                style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <template x-if="!submitting">
                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                    Guardar cambios
                                </span>
                            </template>
                            <template x-if="submitting">
                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                                    Guardando...
                                </span>
                            </template>
                        </button>
                    </div>
                </form>
                </div>
                </template>
            </div>
        </div>
    </div>

</div>

    
    <style>
        [x-cloak] { display: none !important; }

        .notes-wide-table thead th {
            letter-spacing: .04em;
        }

        .notes-wide-table tbody td {
            vertical-align: middle;
        }

        .action-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 12px;
            transition: transform .18s ease, box-shadow .18s ease, background-color .18s ease, color .18s ease, filter .18s ease;
            cursor: pointer;
            border: 1px solid transparent;
            box-shadow: 0 6px 14px -6px rgba(15, 23, 42, 0.45);
        }
        .action-btn svg {
            width: 17px;
            height: 17px;
        }
        .action-btn:hover { transform: translateY(-2px) scale(1.02); }
        .action-btn:active { transform: translateY(0); }
        .action-btn:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px rgba(255,255,255,0.9), 0 0 0 6px rgba(59,130,246,0.45);
        }

        .action-btn-view {
            color: #fff;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border-color: #1e40af;
            box-shadow: 0 8px 16px -7px rgba(37,99,235,0.75);
        }
        .action-btn-view:hover {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            box-shadow: 0 12px 18px -8px rgba(37,99,235,0.85);
            filter: saturate(1.08);
        }

        .action-btn-edit {
            color: #fff;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border-color: #b45309;
            box-shadow: 0 8px 16px -7px rgba(217,119,6,0.75);
        }
        .action-btn-edit:hover {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            box-shadow: 0 12px 18px -8px rgba(217,119,6,0.9);
            filter: saturate(1.08);
        }

        .action-btn-delete {
            color: #fff;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border-color: #b91c1c;
            box-shadow: 0 8px 16px -7px rgba(220,38,38,0.78);
        }
        .action-btn-delete:hover {
            background: linear-gradient(135deg, #f87171, #ef4444);
            box-shadow: 0 12px 18px -8px rgba(220,38,38,0.9);
            filter: saturate(1.06);
        }

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

        /* Scrollbar ligero para modal */
        .max-h-\[70vh\]::-webkit-scrollbar,
        .max-h-\[65vh\]::-webkit-scrollbar { width: 8px; }
        .max-h-\[70vh\]::-webkit-scrollbar-thumb,
        .max-h-\[65vh\]::-webkit-scrollbar-thumb { background: rgba(100,116,139,0.35); border-radius: 4px; }
        .max-h-\[70vh\]::-webkit-scrollbar-thumb:hover,
        .max-h-\[65vh\]::-webkit-scrollbar-thumb:hover { background: rgba(100,116,139,0.55); }
    </style>

    <script id="notes-recipients-data" type="application/json">
        <?php echo json_encode($users->pluck('name')->values(), 15, 512) ?>
    </script>

    <script>
        function notesPage() {
            const recipientsNode = document.getElementById('notes-recipients-data');
            let recipients = [];

            if (recipientsNode) {
                try {
                    recipients = JSON.parse(recipientsNode.textContent || '[]');
                } catch (error) {
                    recipients = [];
                }
            }

            return {
                viewing: null,
                editing: null,
                submitting: false,
                navigating: false,
                recipients: Array.isArray(recipients) ? recipients : [],

                isValidRecipient(value) {
                    if (!value) return false;
                    const normalized = String(value).trim().toLowerCase();
                    return this.recipients.some((recipient) => String(recipient).trim().toLowerCase() === normalized);
                },

                openView(note) {
                    this.editing = null;
                    this.viewing = note;
                    document.body.style.overflow = 'hidden';
                },
                openEdit(note) {
                    this.viewing = null;
                    this.editing = JSON.parse(JSON.stringify(note)); // clon para no mutar
                    this.editing.remitente = '';
                    if (!this.isValidRecipient(this.editing.destinatario)) {
                        this.editing.destinatario = '';
                    }
                    this.submitting = false;
                    document.body.style.overflow = 'hidden';
                },
                switchToEdit() {
                    if (!this.viewing) return;
                    const n = this.viewing;
                    this.viewing = null;
                    this.$nextTick(() => this.openEdit(n));
                },
                close() {
                    this.viewing = null;
                    this.editing = null;
                    this.submitting = false;
                    document.body.style.overflow = '';
                },
                init() {
                    // Overlay de carga al navegar
                    window.addEventListener('beforeunload', () => {
                        this.navigating = true;
                    });
                    window.addEventListener('pageshow', (e) => {
                        this.navigating = false;
                        if (e.persisted) this.close();
                    });
                }
            };
        }

        function confirmarEliminar(cite, formId) {
            Swal.fire({
                title: '¿Eliminar esta nota?',
                html: 'Se eliminará permanentemente el CITE <strong style="color:#ef4444">' + cite + '</strong>.<br>Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
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
<?php /**PATH C:\Users\hp pavilion\OneDrive\Escritorio\System Correos\system-correos\resources\views\notes\index.blade.php ENDPATH**/ ?>
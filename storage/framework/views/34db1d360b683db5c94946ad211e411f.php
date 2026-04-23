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
                <div class="flex items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-bold tracking-tight">Documento: <?php echo e($note->internal_number); ?></h2>
                        <p class="text-sm text-white/70 mt-1">Detalle completo del documento</p>
                    </div>
                    <div class="ml-2">
                        <?php echo $__env->make('partials.status-badge', ['status' => $note->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
                <div class="flex gap-2">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $note)): ?>
                        <a href="<?php echo e(route('notes.edit', $note)); ?>" class="abc-btn abc-btn-warning">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125"/></svg>
                            Editar
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo e(route('notes.index')); ?>" class="abc-btn abc-btn-ghost !bg-white/10 !text-white hover:!bg-white/20">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                        Volver
                    </a>
                </div>
            </div>
        </div>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($note->isRechazado() && $note->rejection_reason): ?>
                <div class="mb-6 abc-card border-l-4 !border-l-red-500 !rounded-l-none">
                    <div class="p-5 flex items-start gap-3">
                        <div class="w-9 h-9 rounded-lg gradient-red flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-red-700 uppercase tracking-wide">Motivo de rechazo</p>
                            <p class="text-sm text-red-600 mt-1"><?php echo e($note->rejection_reason); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div class="abc-card mb-6">
                <div class="gradient-navy px-6 py-4 flex items-center gap-3">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                    <h3 class="text-white font-semibold">Información Completa del Registro</h3>
                </div>

                <div class="p-6">
                    
                    <div class="mb-6">
                        <h4 class="text-sm font-bold uppercase tracking-wide mb-3 flex items-center gap-2" style="color: var(--accent-primary)">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                            </svg>
                            <span>Identificación del Documento</span>
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div class="p-3 rounded-lg" style="background-color: var(--surface-card-hover);">
                                <span class="text-xs uppercase font-bold tracking-wider" style="color: var(--text-muted)">N° CAJA</span>
                                <p class="font-semibold mt-1" style="color: var(--text-primary)"><?php echo e($note->box->box_number ?? '-'); ?></p>
                            </div>
                            <div class="p-3 rounded-lg" style="background-color: var(--surface-card-hover);">
                                <span class="text-xs uppercase font-bold tracking-wider" style="color: var(--text-muted)">N° DE CARPETA</span>
                                <p class="font-semibold mt-1" style="color: var(--text-primary)"><?php echo e($note->folder_number ?? '-'); ?></p>
                            </div>
                            <div class="p-3 rounded-lg" style="background-color: var(--surface-card-hover);">
                                <span class="text-xs uppercase font-bold tracking-wider" style="color: var(--text-muted)">N° DE DOCUMENTO</span>
                                <p class="font-semibold mt-1" style="color: var(--text-primary)"><?php echo e($note->internal_number); ?></p>
                            </div>
                            <div class="p-3 rounded-lg" style="background-color: var(--surface-card-hover);">
                                <span class="text-xs uppercase font-bold tracking-wider" style="color: var(--text-muted)">FECHA RECEPCIÓN</span>
                                <p class="font-semibold mt-1" style="color: var(--text-primary)"><?php echo e($note->note_date->format('d/m/Y')); ?></p>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mb-6">
                        <h4 class="text-sm font-bold uppercase tracking-wide mb-3 flex items-center gap-2" style="color: var(--accent-primary)">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m4.5-3.75v13.5A2.25 2.25 0 0 1 17.25 21.75H6.75A2.25 2.25 0 0 1 4.5 19.5V6A2.25 2.25 0 0 1 6.75 3.75h2.25A2.25 2.25 0 0 0 11.25 6h1.5A2.25 2.25 0 0 0 15 3.75h2.25A2.25 2.25 0 0 1 19.5 6Z"/>
                            </svg>
                            <span>Características del Documento</span>
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div class="p-3 rounded-lg" style="background-color: var(--surface-card-hover);">
                                <span class="text-xs uppercase font-bold tracking-wider" style="color: var(--text-muted)">DOC. ORIGINAL/FOT.</span>
                                <p class="font-semibold mt-1" style="color: var(--text-primary);">
                                    <span class="inline-block px-2 py-1 rounded text-xs font-bold"
                                          :class="'<?php echo e($note->doc_type); ?>' === 'ORIGINAL' ? 'bg-emerald-100 text-emerald-700' : 'bg-blue-100 text-blue-700'">
                                        <?php echo e($note->doc_type); ?>

                                    </span>
                                </p>
                            </div>
                            <div class="p-3 rounded-lg" style="background-color: var(--surface-card-hover);">
                                <span class="text-xs uppercase font-bold tracking-wider" style="color: var(--text-muted)">FOJAS</span>
                                <p class="font-semibold mt-1" style="color: var(--text-primary);">
                                    <span class="inline-block px-3 py-1 bg-amber-100 text-amber-700 rounded-lg font-bold text-center"><?php echo e($note->pages); ?></span>
                                </p>
                            </div>
                            <div class="p-3 rounded-lg" style="background-color: var(--surface-card-hover);">
                                <span class="text-xs uppercase font-bold tracking-wider" style="color: var(--text-muted)">TIPO DOCUMENTACIÓN</span>
                                <p class="font-semibold mt-1" style="color: var(--text-primary)"><?php echo e($note->note_type ?? '-'); ?></p>
                            </div>
                            <div class="p-3 rounded-lg" style="background-color: var(--surface-card-hover);">
                                <span class="text-xs uppercase font-bold tracking-wider" style="color: var(--text-muted)">TIPOLOGÍA</span>
                                <p class="font-semibold mt-1" style="color: var(--text-primary)"><?php echo e($note->tipologia ?? '-'); ?></p>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mb-6">
                        <h4 class="text-sm font-bold uppercase tracking-wide mb-3 flex items-center gap-2" style="color: var(--accent-primary)">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 12.75 2.25 2.25 3.75-3.75M12 3c-1.77 0-3.45.402-4.95 1.122A12.06 12.06 0 0 1 3 6c0 6.075 3.433 11.348 9 13.5 5.567-2.152 9-7.425 9-13.5a12.06 12.06 0 0 1-4.05-1.878A11.96 11.96 0 0 0 12 3Z"/>
                            </svg>
                            <span>Estado y Conservación</span>
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="p-3 rounded-lg" style="background-color: var(--surface-card-hover);">
                                <span class="text-xs uppercase font-bold tracking-wider" style="color: var(--text-muted)">ESTADO DE CONSERVACIÓN</span>
                                <p class="font-semibold mt-1" style="color: var(--text-primary);">
                                    <span class="inline-block px-2 py-1 rounded text-xs font-bold"
                                          :class="'<?php echo e($note->estado_conservacion); ?>' === 'BUENA' ? 'bg-emerald-100 text-emerald-700' : (('<?php echo e($note->estado_conservacion); ?>' === 'REGULAR' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700'))">
                                        <?php echo e($note->estado_conservacion ?? '-'); ?>

                                    </span>
                                </p>
                            </div>
                            <div class="p-3 rounded-lg" style="background-color: var(--surface-card-hover);">
                                <span class="text-xs uppercase font-bold tracking-wider" style="color: var(--text-muted)">CREADO POR</span>
                                <p class="font-semibold mt-1" style="color: var(--text-primary)"><?php echo e($note->creator->name ?? '-'); ?></p>
                            </div>
                            <div class="p-3 rounded-lg" style="background-color: var(--surface-card-hover);">
                                <span class="text-xs uppercase font-bold tracking-wider" style="color: var(--text-muted)">CREADO EL</span>
                                <p class="font-semibold mt-1" style="color: var(--text-primary)"><?php echo e($note->created_at->format('d/m/Y H:i')); ?></p>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mt-6">
                        <h4 class="text-sm font-bold uppercase tracking-wide mb-3 flex items-center gap-2" style="color: var(--accent-primary)">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                            </svg>
                            <span>Información de Correspondencia</span>
                        </h4>
                        <div class="rounded-xl overflow-hidden border" style="border-color: #0d9488;">
                            <div class="gradient-teal px-4 py-2.5 flex items-center gap-2">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                                <span class="text-white font-bold text-sm">Datos de Remitente, Destinatario y Vía</span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-5" style="background: linear-gradient(135deg, rgba(13,148,136,0.04) 0%, rgba(6,182,212,0.04) 100%);">
                                <div class="p-4 rounded-lg" style="background-color: var(--surface-card-hover); border: 1px solid var(--surface-border);">
                                    <span class="text-xs uppercase font-bold tracking-wider text-teal-600 dark:text-teal-400 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0"/>
                                        </svg>
                                        Remitente
                                    </span>
                                    <p class="font-semibold mt-2" style="color: var(--text-primary)"><?php echo e($note->remitente ?? '-'); ?></p>
                                </div>
                                <div class="p-4 rounded-lg" style="background-color: var(--surface-card-hover); border: 1px solid var(--surface-border);">
                                    <span class="text-xs uppercase font-bold tracking-wider text-cyan-600 dark:text-cyan-400 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.742-.478 3 3 0 0 0-4.682-2.72m.94 3.198v.001c0 .687-.041 1.365-.12 2.03m.12-2.03a8.966 8.966 0 0 1-5.379 2.078 8.966 8.966 0 0 1-5.379-2.078m10.758 0a8.966 8.966 0 0 0-10.758 0m10.758 0A9.094 9.094 0 0 1 21 12.75a9.094 9.094 0 0 1-.489 2.97M3 12.75a9.094 9.094 0 0 1 .489-2.97m0 0a9.094 9.094 0 0 1 3.742.478m-3.742-.478A3 3 0 0 1 8.17 12.5m0 0a3 3 0 0 1-4.681 2.72M8.17 12.5a3 3 0 1 0 5.66 0 3 3 0 0 0-5.66 0Zm9.66-2.72a3 3 0 1 0-5.66 0 3 3 0 0 0 5.66 0Z"/>
                                        </svg>
                                        Destinatario
                                    </span>
                                    <p class="font-semibold mt-2" style="color: var(--text-primary)"><?php echo e($note->destinatario ?? '-'); ?></p>
                                </div>
                                <div class="p-4 rounded-lg" style="background-color: var(--surface-card-hover); border: 1px solid var(--surface-border);">
                                    <span class="text-xs uppercase font-bold tracking-wider text-emerald-600 dark:text-emerald-400 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/>
                                        </svg>
                                        Vía de Envío
                                    </span>
                                    <p class="font-semibold mt-2" style="color: var(--text-primary)"><?php echo e($note->via ?? '-'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mt-6">
                        <h4 class="text-sm font-bold uppercase tracking-wide mb-3 flex items-center gap-2" style="color: var(--accent-primary)">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 7.125 16.862 4.487"/>
                            </svg>
                            <span>Contenido del Registro</span>
                        </h4>
                        
                        <div class="mb-4 p-4 rounded-lg" style="background-color: var(--surface-card-hover); border-left: 4px solid #0d9488;">
                            <span class="text-xs uppercase font-bold tracking-wider" style="color: var(--text-muted)">REFERENCIA *</span>
                            <p class="mt-2 leading-relaxed" style="color: var(--text-secondary); white-space: pre-wrap; word-break: break-word;"><?php echo e($note->reference); ?></p>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($note->observations): ?>
                            <div class="p-4 rounded-lg" style="background-color: var(--surface-card-hover); border-left: 4px solid #f59e0b;">
                                <span class="text-xs uppercase font-bold tracking-wider" style="color: var(--text-muted)">OBSERVACIONES</span>
                                <p class="mt-2 leading-relaxed" style="color: var(--text-secondary); white-space: pre-wrap; word-break: break-word;"><?php echo e($note->observations); ?></p>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($note->verifier): ?>
                        <div class="mt-6">
                            <h4 class="text-sm font-bold uppercase tracking-wide mb-3 flex items-center gap-2" style="color: var(--accent-primary)">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <span>Información de Verificación</span>
                            </h4>
                            <div class="p-4 rounded-lg" style="background: linear-gradient(135deg, rgba(34,197,94,0.1) 0%, rgba(74,222,128,0.1) 100%); border-left: 4px solid #22c55e;">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-xs uppercase font-bold tracking-wider" style="color: var(--text-muted)">Verificado por</span>
                                        <p class="font-semibold mt-1" style="color: var(--text-primary)"><?php echo e($note->verifier->name); ?></p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs uppercase font-bold tracking-wider" style="color: var(--text-muted)">Fecha de Verificación</span>
                                        <p class="font-semibold mt-1" style="color: var(--text-primary)"><?php echo e($note->verified_at?->format('d/m/Y H:i')); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <div class="mt-6 pt-5 flex flex-wrap gap-2" style="border-top: 1px solid var(--border-primary)">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('send', $note)): ?>
                            <form method="POST" action="<?php echo e(route('notes.send', $note)); ?>" id="send-form-<?php echo e($note->id); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="button" onclick="confirmarEnvio('<?php echo e($note->internal_number); ?>', 'send-form-<?php echo e($note->id); ?>')" class="abc-btn abc-btn-primary flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/></svg>
                                    <span>Enviar para Revisión</span>
                                </button>
                            </form>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('verify', $note)): ?>
                            <form method="POST" action="<?php echo e(route('verification.verify', $note)); ?>" id="verify-form-<?php echo e($note->id); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="button" onclick="confirmarAprobacion('<?php echo e($note->internal_number); ?>', 'verify-form-<?php echo e($note->id); ?>')" class="abc-btn abc-btn-success flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                    <span>Aprobar</span>
                                </button>
                            </form>

                            <div x-data="{ showReject: false }">
                                <button @click="showReject = !showReject" type="button" class="abc-btn abc-btn-danger flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                    <span>Rechazar</span>
                                </button>

                                
                                <div x-show="showReject" x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
                                     class="mt-4 abc-card border-l-4 !border-l-red-500 !rounded-l-none" x-cloak>
                                    <div class="p-5">
                                        <form method="POST" action="<?php echo e(route('verification.reject', $note)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <label class="abc-label text-red-700 font-bold">Motivo de rechazo *</label>
                                            <textarea name="rejection_reason" rows="3" required
                                                      class="abc-input !border-red-200 !focus:border-red-400 !focus:ring-red-100"
                                                      placeholder="Indique el motivo de rechazo..."></textarea>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['rejection_reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <div class="mt-4 flex justify-end gap-2">
                                                <button type="button" @click="showReject = false" class="abc-btn abc-btn-ghost">
                                                    Cancelar
                                                </button>
                                                <button type="submit" class="abc-btn abc-btn-danger flex items-center gap-1.5">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                                    <span>Confirmar Rechazo</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <div class="abc-card mb-6">
                <div class="gradient-navy px-6 py-4 flex items-center gap-3">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13"/></svg>
                    <h3 class="text-white font-semibold">Adjuntos (<?php echo e($note->attachments->count()); ?>)</h3>
                </div>

                <div class="p-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($note->attachments->count()): ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $note->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <div class="flex items-center justify-between p-4 rounded-xl" style="background-color: var(--surface-card-hover); border: 1px solid var(--border-primary)">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg gradient-navy flex items-center justify-center flex-shrink-0">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(str_contains($attachment->mime_type, 'pdf')): ?>
                                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                                            <?php else: ?>
                                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5a2.25 2.25 0 0 0 2.25-2.25V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z"/></svg>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                        <div>
                                            <a href="<?php echo e(asset('storage/' . $attachment->file_path)); ?>" target="_blank"
                                               class="text-sm font-semibold text-abc-navy hover:underline">
                                                <?php echo e($attachment->original_name); ?>

                                            </a>
                                            <p class="text-xs mt-0.5" style="color: var(--text-muted)">
                                                <?php echo e($attachment->mime_type); ?> -- <?php echo e(number_format($attachment->file_size / 1024, 1)); ?> KB
                                                -- Subido por <?php echo e($attachment->uploader->name ?? '-'); ?>

                                            </p>
                                        </div>
                                    </div>
                                    <a href="<?php echo e(asset('storage/' . $attachment->file_path)); ?>" download
                                       class="inline-flex items-center justify-center w-9 h-9 rounded-lg hover:text-blue-600 hover:bg-blue-50 transition" style="color: var(--text-muted)" title="Descargar">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                    </a>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-8">
                            <svg class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13"/></svg>
                            <p class="text-sm font-medium" style="color: var(--text-muted)">No hay archivos adjuntos</p>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            
            <div class="abc-card">
                <div class="gradient-navy px-6 py-4 flex items-center gap-3">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                    <h3 class="text-white font-semibold">Historial de Cambios</h3>
                </div>

                <div class="p-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($auditLogs->count()): ?>
                        <div class="relative">
                            
                            <div class="absolute left-[7px] top-3 bottom-3 w-0.5 bg-gray-200"></div>

                            <div class="space-y-5">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $auditLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <div class="relative flex items-start gap-4 pl-6">
                                        
                                        <div class="absolute left-0 top-1 w-[15px] h-[15px] rounded-full border-2 border-white shadow-sm flex-shrink-0
                                            <?php if(str_contains($log->action, 'CREAR')): ?> bg-emerald-500
                                            <?php elseif(str_contains($log->action, 'EDITAR')): ?> bg-amber-500
                                            <?php elseif(str_contains($log->action, 'ENVIAR')): ?> bg-blue-500
                                            <?php elseif(str_contains($log->action, 'VERIFICAR')): ?> bg-emerald-500
                                            <?php elseif(str_contains($log->action, 'RECHAZAR')): ?> bg-red-500
                                            <?php elseif(str_contains($log->action, 'ELIMINAR')): ?> bg-gray-500
                                            <?php else: ?> bg-gray-400
                                            <?php endif; ?>
                                        "></div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm" style="color: var(--text-secondary)">
                                                <span class="font-bold" style="color: var(--text-primary)"><?php echo e($log->user->name ?? 'Sistema'); ?></span>
                                                realizo
                                                <span class="font-semibold text-abc-navy"><?php echo e($log->action); ?></span>
                                            </p>
                                            <p class="text-xs mt-0.5" style="color: var(--text-muted)">
                                                <?php echo e($log->created_at->format('d/m/Y H:i:s')); ?>

                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($log->ip_address): ?> -- IP: <?php echo e($log->ip_address); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-8">
                            <svg class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                            <p class="text-sm font-medium" style="color: var(--text-muted)">Sin historial de cambios</p>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmarEnvio(cite, formId) {
            Swal.fire({
                title: '¿Enviar para revisión?',
                html: 'Se enviará el CITE <strong style="color:#0ea5e9">' + cite + '</strong> para su verificación.<br>Una vez enviado, no podrás editarlo.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0c2340',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }

        function confirmarAprobacion(cite, formId) {
            Swal.fire({
                title: '¿Aprobar esta nota?',
                html: 'Estás a punto de verificar y aprobar el CITE <strong style="color:#10b981">' + cite + '</strong>.<br>Esta acción cambiará su estado a <strong>VERIFICADO</strong>.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Aceptar',
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
<?php /**PATH C:\Users\hp pavilion\OneDrive\Escritorio\System Correos\system-correos\resources\views\notes\show.blade.php ENDPATH**/ ?>
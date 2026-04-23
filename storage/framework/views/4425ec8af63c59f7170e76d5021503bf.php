<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Documentos - ABC</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10px;
            color: #333;
            margin: 0;
            padding: 15px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px solid #0c2340;
            padding-bottom: 12px;
        }
        .header h1 {
            font-size: 18px;
            color: #0c2340;
            margin: 0 0 2px 0;
            letter-spacing: 1px;
        }
        .header .subtitle {
            font-size: 11px;
            color: #c8102e;
            font-weight: bold;
            margin: 2px 0;
        }
        .header p {
            font-size: 10px;
            color: #666;
            margin: 3px 0;
        }
        .header .gold-line {
            width: 80px;
            height: 3px;
            background-color: #f4b223;
            margin: 8px auto 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #0c2340;
            color: white;
            padding: 7px 4px;
            text-align: left;
            font-size: 8.5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        td {
            padding: 5px 4px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 9px;
        }
        tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .status-borrador { color: #6b7280; font-weight: bold; }
        .status-enviado { color: #0ea5e9; font-weight: bold; }
        .status-verificado { color: #059669; font-weight: bold; }
        .status-rechazado { color: #c8102e; font-weight: bold; }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 8px;
            color: #999;
            border-top: 2px solid #0c2340;
            padding-top: 8px;
        }
        .footer .gold-accent {
            color: #f4b223;
            font-weight: bold;
        }
        .total-row {
            font-weight: bold;
            background-color: #0c2340;
            color: white;
        }
        .total-row td {
            border-bottom: none;
            padding: 7px 4px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>AGENCIA BOLIVIANA DE CORREOS</h1>
        <p class="subtitle">Sistema de Verificación y Registro de Documentos</p>
        <p>Reporte generado el <?php echo e(now()->format('d/m/Y H:i:s')); ?></p>
        <div class="gold-line"></div>
    </div>

    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>N° CAJA</th>
                <th>N° DE DOCUMENTO</th>
                <th>FECHA</th>
                <th>REFERENCIA</th>
                <th>ESTADO DOC.</th>
                <th>NOTA INTERNO</th>
                <th>FOJAS</th>
                <th>ESTADO</th>
                <th>CREADO POR</th>
                <th>VERIFICADO POR</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($note->box->box_number ?? '-'); ?></td>
                    <td><?php echo e($note->internal_number); ?></td>
                    <td><?php echo e($note->note_date->format('d/m/Y')); ?></td>
                    <td style="max-width: 200px; overflow: hidden;"><?php echo e(Str::limit($note->reference, 60)); ?></td>
                    <td><?php echo e($note->doc_type); ?></td>
                    <td><?php echo e($note->note_type ?? '-'); ?></td>
                    <td style="text-align: center;"><?php echo e($note->pages); ?></td>
                    <td class="status-<?php echo e(strtolower($note->status)); ?>"><?php echo e($note->status); ?></td>
                    <td><?php echo e($note->creator->name ?? '-'); ?></td>
                    <td><?php echo e($note->verifier->name ?? '-'); ?></td>
                </tr>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <tr>
                    <td colspan="10" style="text-align: center; color: #999;">No hay registros.</td>
                </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="6" style="text-align: right;">Total registros:</td>
                <td style="text-align: center;"><?php echo e($notes->sum('pages')); ?></td>
                <td colspan="3"><?php echo e($notes->count()); ?> notas</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <span class="gold-accent">ABC</span> — Agencia Boliviana de Correos · Sistema de Verificación de Documentos &copy; <?php echo e(date('Y')); ?>

    </div>
</body>
</html>
<?php /**PATH C:\Users\hp pavilion\OneDrive\Escritorio\System Correos\system-correos\resources\views\reports\pdf.blade.php ENDPATH**/ ?>
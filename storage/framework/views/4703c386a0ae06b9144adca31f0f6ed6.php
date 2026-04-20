<?php extract((new \Illuminate\Support\Collection($attributes->getAttributes()))->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>

<?php if (isset($component)) { $__componentOriginald21e8de47ce37c3f2b5bc52e4a9b9c82 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald21e8de47ce37c3f2b5bc52e4a9b9c82 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'pulse::components.icons.scale','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('pulse::icons.scale'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


<?php echo e($slot ?? ""); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald21e8de47ce37c3f2b5bc52e4a9b9c82)): ?>
<?php $attributes = $__attributesOriginald21e8de47ce37c3f2b5bc52e4a9b9c82; ?>
<?php unset($__attributesOriginald21e8de47ce37c3f2b5bc52e4a9b9c82); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald21e8de47ce37c3f2b5bc52e4a9b9c82)): ?>
<?php $component = $__componentOriginald21e8de47ce37c3f2b5bc52e4a9b9c82; ?>
<?php unset($__componentOriginald21e8de47ce37c3f2b5bc52e4a9b9c82); ?>
<?php endif; ?><?php /**PATH C:\Users\hp pavilion\OneDrive\Escritorio\System Correos\system-correos\storage\framework\views/a789bdc175e830f5d1ec613761a31bf7.blade.php ENDPATH**/ ?>
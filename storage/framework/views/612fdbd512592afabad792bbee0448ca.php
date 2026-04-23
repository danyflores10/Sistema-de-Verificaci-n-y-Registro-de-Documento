<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php switch($status):
    case ('BORRADOR'): ?>
        <span class="abc-badge abc-badge-borrador">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>
            BORRADOR
        </span>
        <?php break; ?>
    <?php case ('ENVIADO'): ?>
        <span class="abc-badge abc-badge-enviado">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>
            ENVIADO
        </span>
        <?php break; ?>
    <?php case ('VERIFICADO'): ?>
        <span class="abc-badge abc-badge-verificado">
            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
            VERIFICADO
        </span>
        <?php break; ?>
    <?php case ('RECHAZADO'): ?>
        <span class="abc-badge abc-badge-rechazado">
            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
            RECHAZADO
        </span>
        <?php break; ?>
<?php endswitch; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\Users\hp pavilion\OneDrive\Escritorio\System Correos\system-correos\resources\views\partials\status-badge.blade.php ENDPATH**/ ?>
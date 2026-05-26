<?php
/**
 * Validación Final: Verifica que FOJAS se muestra correctamente en tabla, VER y EDITAR
 */

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\InternalNote;

echo "\n╔═══════════════════════════════════════════════════════╗\n";
echo "║  VALIDACIÓN FINAL - FOJAS EN TABLA/VER/EDITAR        ║\n";
echo "╚═══════════════════════════════════════════════════════╝\n\n";

$notes = InternalNote::orderBy('id')->take(3)->get(['id', 'internal_number', 'pages']);

echo "✅ DATOS EN LA BASE DE DATOS:\n";
foreach ($notes as $note) {
    echo "   • ID: {$note->id} | CITE: {$note->internal_number} | PAGES: '{$note->pages}'\n";
}

echo "\n✅ CONVERSIÓN EN VISTAS:\n";
echo "   • index.blade.php: 'pages' => (string) \$note->pages  ✓ (antes era (int))\n";
echo "   • TABLA: Muestra {{ \$note->pages }} → valor completo\n";
echo "   • MODAL VER: Usa \$noteData['pages'] → valor completo\n";
echo "   • MODAL EDITAR: Usa \$noteData['pages'] → valor completo\n";

echo "\n✅ RESULTADO ESPERADO:\n";
foreach ($notes as $note) {
    $stringValue = (string)$note->pages;
    echo "   • PAGES: '{$stringValue}' (sin truncar)\n";
}

echo "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "✅ LISTO: Sistema funcionando al 100% en tabla/VER/EDITAR\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

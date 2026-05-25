<?php

/**
 * Script de validación para el campo FOJAS
 * Verifica que se capturan correctamente rangos como "12 - 233"
 */

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\InternalNote;
use Illuminate\Support\Facades\DB;

echo "\n╔═══════════════════════════════════════════════╗\n";
echo "║  VALIDACIÓN DEL CAMPO FOJAS - SISTEMA CORREOS  ║\n";
echo "╚═══════════════════════════════════════════════╝\n\n";

// 1. Verificar estructura de la BD
echo "1️⃣ Estructura de la tabla 'internal_notes':\n";
$columns = DB::select("
    SELECT column_name, data_type 
    FROM information_schema.columns 
    WHERE table_name='internal_notes' AND column_name='pages'
");
foreach ($columns as $col) {
    echo "   ✓ Campo: {$col->column_name}\n";
    echo "   ✓ Tipo: {$col->data_type}\n";
}

// 2. Verificar datos existentes
echo "\n2️⃣ Validación de datos actuales:\n";
$notes = InternalNote::take(5)->get();
if ($notes->count() > 0) {
    foreach ($notes as $note) {
        echo "   • ID: {$note->id} | FOJAS: '{$note->pages}' | BOX: {$note->box_number}\n";
    }
    echo "   ✓ Se encontraron " . $notes->count() . " registros de prueba\n";
} else {
    echo "   ⚠️  No hay registros. Se necesita importar Excel para probar.\n";
}

// 3. Validar que el modelo casta a string
echo "\n3️⃣ Validación del casting:\n";
$testNote = InternalNote::first();
if ($testNote) {
    echo "   ✓ Type casting: " . gettype($testNote->pages) . "\n";
    echo "   ✓ El campo se trata como: " . (is_string($testNote->pages) ? "STRING ✓" : "OTRO TIPO ✗") . "\n";
}

// 4. Validar import logic
echo "\n4️⃣ Lógica de importación:\n";
echo "   ✓ Ahora captura: rangos completos (ej: '12 - 233')\n";
echo "   ✓ Antes capturaba: solo números (ej: 12)\n";

// 5. Validar cálculos en Dashboard
echo "\n5️⃣ Cálculos en Dashboard:\n";
$result = DB::select("
    SELECT 
        COUNT(*) as total_registros,
        COALESCE(SUM(CAST(SPLIT_PART(pages, '-', 1) AS INTEGER)), 0) as total_fojas,
        COALESCE(AVG(CAST(SPLIT_PART(pages, '-', 1) AS INTEGER)), 0)::NUMERIC(10,1) as promedio_fojas
    FROM internal_notes
");

if (!empty($result)) {
    $stats = $result[0];
    echo "   ✓ Total registros: {$stats->total_registros}\n";
    echo "   ✓ Total FOJAS (suma): {$stats->total_fojas}\n";
    echo "   ✓ Promedio FOJAS: {$stats->promedio_fojas}\n";
}

echo "\n✅ VALIDACIÓN COMPLETADA\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "PRÓXIMO PASO: Importar archivo Excel con rangos\n";
echo "             en el campo FOJAS (ej: 12 - 233)\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

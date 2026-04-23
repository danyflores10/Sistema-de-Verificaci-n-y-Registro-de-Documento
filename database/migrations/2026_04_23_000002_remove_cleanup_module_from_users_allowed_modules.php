<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $validModules = [
            'dashboard',
            'boxes',
            'notes',
            'import',
            'reports',
            'verification',
            'users',
            'audit',
            'permissions',
            'pulse',
            'log-viewer',
        ];

        DB::table('users')
            ->select('id', 'allowed_modules')
            ->orderBy('id')
            ->chunkById(100, function ($users) use ($validModules): void {
                foreach ($users as $user) {
                    if (is_null($user->allowed_modules)) {
                        continue;
                    }

                    $currentModules = $this->decodeModules($user->allowed_modules);
                    if (is_null($currentModules)) {
                        continue;
                    }

                    $normalized = array_values(array_unique(array_intersect($currentModules, $validModules)));

                    if (!in_array('dashboard', $normalized, true)) {
                        array_unshift($normalized, 'dashboard');
                    }

                    if ($normalized === $currentModules) {
                        continue;
                    }

                    DB::table('users')
                        ->where('id', $user->id)
                        ->update(['allowed_modules' => json_encode($normalized)]);
                }
            });
    }

    public function down(): void
    {
        // No reversible: solo limpia módulos obsoletos en allowed_modules.
    }

    private function decodeModules(mixed $raw): ?array
    {
        if (is_array($raw)) {
            return array_values(array_filter($raw, 'is_string'));
        }

        if (!is_string($raw) || trim($raw) === '') {
            return null;
        }

        $decoded = json_decode($raw, true);

        if (!is_array($decoded)) {
            return null;
        }

        return array_values(array_filter($decoded, 'is_string'));
    }
};

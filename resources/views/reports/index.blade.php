<x-app-layout>
    {{-- Page Header --}}
    <div class="abc-page-header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-white flex items-center gap-3">
                    <svg class="w-7 h-7 text-[var(--abc-yellow)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg>
                    Reportes y Exportación
                </h1>
                <p class="text-blue-200 text-sm mt-1">Genera reportes en Excel y PDF del registro documental</p>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Exportación --}}
            <div class="abc-card overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-[var(--abc-navy)] to-[#1a3c68] px-6 py-4">
                    <h3 class="text-white font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5 text-[var(--abc-yellow)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                        Exportar Listado de Documentos
                    </h3>
                </div>
                <div class="p-6">
                    <form id="export-form" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                        <div>
                            <label class="abc-label">N° Caja</label>
                            <select name="box_id" class="abc-input">
                                <option value="">-- Todas --</option>
                                @foreach($boxes as $box)
                                    <option value="{{ $box->id }}">{{ $box->box_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="abc-label">Estado</label>
                            <select name="status" class="abc-input">
                                <option value="">-- Todos --</option>
                                <option value="BORRADOR">BORRADOR</option>
                                <option value="ENVIADO">ENVIADO</option>
                                <option value="VERIFICADO">VERIFICADO</option>
                                <option value="RECHAZADO">RECHAZADO</option>
                            </select>
                        </div>
                        <div>
                            <label class="abc-label">Desde</label>
                            <input type="date" name="date_from" class="abc-input">
                        </div>
                        <div>
                            <label class="abc-label">Hasta</label>
                            <input type="date" name="date_to" class="abc-input">
                        </div>
                        <div class="flex gap-2">
                            <button type="button" onclick="exportData('excel')"
                                    class="abc-btn-success flex-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                Excel
                            </button>
                            <button type="button" onclick="exportData('pdf')"
                                    class="abc-btn-danger flex-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/></svg>
                                PDF
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Resumen por caja --}}
            <div class="abc-card overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-[var(--abc-navy)] flex items-center gap-2">
                        <svg class="w-5 h-5 text-[var(--abc-sky)]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125"/></svg>
                        Resumen por Caja
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="abc-table">
                        <thead>
                            <tr>
                                <th>N° Caja</th>
                                <th>Descripción</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Borradores</th>
                                <th class="text-center">Enviados</th>
                                <th class="text-center">Verificados</th>
                                <th class="text-center">Rechazados</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($boxes as $box)
                                <tr>
                                    <td>
                                        <span class="font-semibold text-[var(--abc-navy)]">{{ $box->box_number }}</span>
                                    </td>
                                    <td>
                                        <span class="text-sm text-gray-500 max-w-xs truncate block">{{ $box->description ?? '—' }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[var(--abc-navy)] text-white text-sm font-bold">
                                            {{ $box->internal_notes_count }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 ring-1 ring-inset ring-gray-500/10">
                                            {{ $box->borradores_count }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-sky-100 text-sky-700 ring-1 ring-inset ring-sky-600/20">
                                            {{ $box->enviados_count }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                                            {{ $box->verificados_count }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700 ring-1 ring-inset ring-red-600/20">
                                            {{ $box->rechazados_count }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-12">
                                        <div class="flex flex-col items-center gap-3">
                                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375"/></svg>
                                            <p class="text-gray-400 text-sm">No hay cajas registradas</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function exportData(type) {
            const form = document.getElementById('export-form');
            const formData = new FormData(form);
            const params = new URLSearchParams(formData).toString();

            if (type === 'excel') {
                window.location.href = '{{ route("reports.export.excel") }}?' + params;
            } else {
                window.location.href = '{{ route("reports.export.pdf") }}?' + params;
            }
        }
    </script>
</x-app-layout>


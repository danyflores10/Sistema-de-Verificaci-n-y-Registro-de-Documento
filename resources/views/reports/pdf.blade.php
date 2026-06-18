<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Documentos — AGBC</title>
    <style>
        @page {
            margin: 24px 22px 52px 22px;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 9.5px;
            color: #1f2937;
            margin: 0;
            padding: 0;
        }

        /* ═══ Header institucional con franjas ═══ */
        .header {
            border-bottom: 2px solid #0c2340;
            padding: 0 0 10px 0;
            margin-bottom: 14px;
            position: relative;
        }
        .header::before {
            content: "";
            display: block;
            height: 6px;
            background: linear-gradient(to right, #0c2340 0%, #0c2340 33%, #c8102e 33%, #c8102e 66%, #f4b223 66%, #f4b223 100%);
            margin-bottom: 10px;
        }
        .header-table { width: 100%; border-collapse: collapse; }
        .header-table td { vertical-align: middle; padding: 0; }
        .brand-block {
            background: #0c2340;
            color: white;
            padding: 10px 14px;
            border-radius: 4px;
            display: inline-block;
        }
        .brand-block .b1 {
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 1px;
            line-height: 1;
        }
        .brand-block .b2 {
            font-size: 8px;
            color: #f4b223;
            margin-top: 4px;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }
        .report-meta {
            text-align: right;
            font-size: 8.5px;
            color: #475569;
            line-height: 1.5;
        }
        .report-meta .big {
            font-size: 12px;
            font-weight: bold;
            color: #0c2340;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 4px;
        }
        .report-meta .pill {
            display: inline-block;
            background: #fffbeb;
            border: 1px solid #fde68a;
            color: #92400e;
            padding: 2px 8px;
            border-radius: 9999px;
            font-size: 7.5px;
            font-weight: bold;
            margin-top: 4px;
        }

        /* ═══ Filtros aplicados ═══ */
        .filters-box {
            background: #f8fafc;
            border-left: 4px solid #0c2340;
            padding: 6px 12px;
            margin-bottom: 10px;
            font-size: 8.5px;
            color: #334155;
            border-radius: 2px;
        }
        .filters-box .lbl {
            color: #0c2340;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 7.5px;
            letter-spacing: 0.6px;
            margin-right: 6px;
        }
        .filters-box .chip {
            display: inline-block;
            background: white;
            border: 1px solid #cbd5e1;
            color: #334155;
            padding: 1px 7px;
            border-radius: 9999px;
            font-size: 7.5px;
            font-weight: 600;
            margin-right: 3px;
        }

        /* ═══ KPI Cards ═══ */
        .kpi-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 5px 0;
            margin-bottom: 10px;
        }
        .kpi-table td {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 8px 10px;
            width: 16.66%;
            position: relative;
            border-top: 3px solid #0c2340;
        }
        .kpi-table .label {
            font-size: 7px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            font-weight: bold;
            display: block;
            margin-bottom: 3px;
        }
        .kpi-table .value {
            font-size: 16px;
            font-weight: bold;
            color: #0f172a;
            line-height: 1;
            letter-spacing: -0.5px;
        }
        .kpi-table .sub {
            font-size: 7.5px;
            color: #94a3b8;
            margin-top: 2px;
        }
        .k-total      { border-top-color: #0c2340 !important; }
        .k-borrador   { border-top-color: #f59e0b !important; }
        .k-borrador   .value { color: #b45309; }
        .k-enviado    { border-top-color: #0ea5e9 !important; }
        .k-enviado    .value { color: #0369a1; }
        .k-verificado { border-top-color: #10b981 !important; }
        .k-verificado .value { color: #047857; }
        .k-rechazado  { border-top-color: #ef4444 !important; }
        .k-rechazado  .value { color: #b91c1c; }
        .k-fojas      { border-top-color: #6366f1 !important; }
        .k-fojas      .value { color: #4338ca; }

        /* ═══ Distribución visual (mini barra horizontal) ═══ */
        .distribution {
            margin-bottom: 12px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 8px 12px;
        }
        .distribution .title {
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #0c2340;
            font-weight: bold;
            margin-bottom: 6px;
        }
        .dist-bar {
            width: 100%;
            height: 14px;
            background: #f1f5f9;
            border-radius: 7px;
            overflow: hidden;
            position: relative;
            line-height: 0;
        }
        .dist-segment {
            display: inline-block;
            height: 14px;
            vertical-align: top;
        }
        .dist-legend {
            margin-top: 6px;
            font-size: 7.5px;
        }
        .dist-legend .item {
            display: inline-block;
            margin-right: 10px;
            color: #475569;
        }
        .dist-legend .dot {
            display: inline-block;
            width: 7px;
            height: 7px;
            border-radius: 2px;
            margin-right: 4px;
            vertical-align: middle;
        }

        /* ═══ Sección title ═══ */
        .section-title {
            font-size: 9px;
            font-weight: bold;
            color: #0c2340;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 0 6px 0;
            padding: 4px 0 4px 8px;
            border-left: 3px solid #f4b223;
        }

        /* ═══ Tabla principal ═══ */
        table.main {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }
        table.main th {
            background: #0c2340;
            color: white;
            padding: 7px 4px;
            text-align: left;
            font-size: 7.5px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            font-weight: bold;
            border-right: 1px solid #1a3c68;
        }
        table.main th:last-child { border-right: none; }
        table.main td {
            padding: 5px 4px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 8.5px;
            vertical-align: top;
        }
        table.main tr:nth-child(even) td {
            background: #f8fafc;
        }
        table.main tr:hover td { background: #fef3c7; }
        .nowrap { white-space: nowrap; }
        .center { text-align: center; }
        .right  { text-align: right; }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 2px 7px;
            border-radius: 9999px;
            font-size: 7px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border: 1px solid transparent;
        }
        .badge-borrador   { background: #fef3c7; color: #92400e; border-color: #fde68a; }
        .badge-enviado    { background: #e0f2fe; color: #075985; border-color: #bae6fd; }
        .badge-verificado { background: #d1fae5; color: #065f46; border-color: #a7f3d0; }
        .badge-rechazado  { background: #fee2e2; color: #991b1b; border-color: #fecaca; }

        .id-cell {
            background: #0c2340;
            color: white;
            border-radius: 3px;
            padding: 2px 5px;
            font-weight: bold;
            font-size: 7.5px;
            display: inline-block;
        }

        .box-tag {
            display: inline-block;
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
            padding: 1px 6px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 8px;
        }

        .total-row td {
            background: #0c2340 !important;
            color: white;
            font-weight: bold;
            font-size: 9.5px;
            padding: 8px 5px;
            border-bottom: none;
            border-top: 2px solid #f4b223;
        }
        .total-row .total-label {
            text-align: right;
            color: #f4b223;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* ═══ Empty state ═══ */
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #94a3b8;
            font-style: italic;
            background: #f8fafc;
            border: 2px dashed #cbd5e1;
            border-radius: 4px;
        }

        /* ═══ Footer ═══ */
        .footer {
            position: fixed;
            bottom: 18px;
            left: 22px;
            right: 22px;
            border-top: 1px solid #e2e8f0;
            padding-top: 6px;
            font-size: 7.5px;
            color: #64748b;
        }
        .footer-table { width: 100%; border-collapse: collapse; }
        .footer-table td { padding: 0; }
        .footer .gold { color: #f4b223; font-weight: bold; }
        .footer .right { text-align: right; }
        .footer .center { text-align: center; }
        .page-number:after {
            content: counter(page) " / " counter(pages);
        }
    </style>
</head>
<body>

    {{-- ══════════ Header institucional ══════════ --}}
    <div class="header">
        <table class="header-table">
            <tr>
                <td style="width: 55%;">
                    <div class="brand-block">
                        <div class="b1">CORREOS DE BOLIVIA</div>
                        <div class="b2">Sistema de Verificación y Registro de Documentos</div>
                    </div>
                </td>
                <td style="width: 45%;" class="report-meta">
                    <div class="big">Reporte de Documentos</div>
                    <div>Generado el <strong>{{ now()->format('d/m/Y') }}</strong> a las <strong>{{ now()->format('H:i:s') }}</strong></div>
                    @auth
                        <div>Emitido por: <strong>{{ auth()->user()->name }}</strong></div>
                    @endauth
                    <div class="pill">DOCUMENTO OFICIAL · CONFIDENCIAL</div>
                </td>
            </tr>
        </table>
    </div>

    {{-- ══════════ Filtros aplicados ══════════ --}}
    @if(!empty($appliedFilters))
        <div class="filters-box">
            <span class="lbl">Filtros aplicados</span>
            @foreach($appliedFilters as $filter)
                <span class="chip">{{ $filter }}</span>
            @endforeach
        </div>
    @endif

    {{-- ══════════ KPIs ══════════ --}}
    <p class="section-title">Resumen Ejecutivo</p>
    <table class="kpi-table">
        <tr>
            <td class="k-total">
                <span class="label">Total Docs</span>
                <span class="value">{{ number_format($summary['total']) }}</span>
                <span class="sub">Registros en período</span>
            </td>
            <td class="k-borrador">
                <span class="label">Borradores</span>
                <span class="value">{{ number_format($summary['borradores']) }}</span>
                <span class="sub">{{ $summary['total'] > 0 ? round($summary['borradores'] / $summary['total'] * 100, 1) : 0 }}% del total</span>
            </td>
            <td class="k-enviado">
                <span class="label">Enviados</span>
                <span class="value">{{ number_format($summary['enviados']) }}</span>
                <span class="sub">{{ $summary['total'] > 0 ? round($summary['enviados'] / $summary['total'] * 100, 1) : 0 }}% del total</span>
            </td>
            <td class="k-verificado">
                <span class="label">Verificados</span>
                <span class="value">{{ number_format($summary['verificados']) }}</span>
                <span class="sub">{{ $summary['total'] > 0 ? round($summary['verificados'] / $summary['total'] * 100, 1) : 0 }}% del total</span>
            </td>
            <td class="k-rechazado">
                <span class="label">Rechazados</span>
                <span class="value">{{ number_format($summary['rechazados']) }}</span>
                <span class="sub">{{ $summary['total'] > 0 ? round($summary['rechazados'] / $summary['total'] * 100, 1) : 0 }}% del total</span>
            </td>
            <td class="k-fojas">
                <span class="label">Total Fojas</span>
                <span class="value">{{ number_format($summary['total_fojas']) }}</span>
                <span class="sub">Páginas procesadas</span>
            </td>
        </tr>
    </table>

    {{-- ══════════ Distribución visual ══════════ --}}
    @if($summary['total'] > 0)
        @php
            $t = $summary['total'];
            $segBor = round($summary['borradores']   / $t * 100, 2);
            $segEnv = round($summary['enviados']     / $t * 100, 2);
            $segVer = round($summary['verificados']  / $t * 100, 2);
            $segRej = round($summary['rechazados']   / $t * 100, 2);

            // Atributos de estilo pre-computados para cada segmento.
            // Los inyectamos vía PHP echo en el atributo (sin Blade dentro
            // de style="" para evitar falsos positivos del parser CSS).
            $styleBor = sprintf('style="width:%s%%;background:#f59e0b;"', $segBor);
            $styleEnv = sprintf('style="width:%s%%;background:#0ea5e9;"', $segEnv);
            $styleVer = sprintf('style="width:%s%%;background:#10b981;"', $segVer);
            $styleRej = sprintf('style="width:%s%%;background:#ef4444;"', $segRej);
        @endphp

        <div class="distribution">
            <div class="title">Distribución por Estado</div>
            <div class="dist-bar">
                @if($segBor > 0)<span class="dist-segment" {!! $styleBor !!}></span>@endif
                @if($segEnv > 0)<span class="dist-segment" {!! $styleEnv !!}></span>@endif
                @if($segVer > 0)<span class="dist-segment" {!! $styleVer !!}></span>@endif
                @if($segRej > 0)<span class="dist-segment" {!! $styleRej !!}></span>@endif
            </div>
            <div class="dist-legend">
                <span class="item"><span class="dot" style="background: #f59e0b;"></span>Borradores {{ $segBor }}%</span>
                <span class="item"><span class="dot" style="background: #0ea5e9;"></span>Enviados {{ $segEnv }}%</span>
                <span class="item"><span class="dot" style="background: #10b981;"></span>Verificados {{ $segVer }}%</span>
                <span class="item"><span class="dot" style="background: #ef4444;"></span>Rechazados {{ $segRej }}%</span>
            </div>
        </div>
    @endif

    {{-- ══════════ Tabla principal ══════════ --}}
    <p class="section-title">Detalle de Documentos ({{ number_format($summary['total']) }} registros)</p>
    <table class="main">
        <thead>
            <tr>
                <th style="width: 3.5%;">N°</th>
                <th style="width: 7%;">CAJA</th>
                <th style="width: 10%;">N° DOCUMENTO</th>
                <th style="width: 7%;">FECHA</th>
                <th style="width: 23%;">REFERENCIA</th>
                <th style="width: 7%;">DOC.</th>
                <th style="width: 8%;">TIPO NOTA</th>
                <th style="width: 5%;" class="center">FOJAS</th>
                <th style="width: 8.5%;">ESTADO</th>
                <th style="width: 10.5%;">CREADO POR</th>
                <th style="width: 10.5%;">VERIFICADO POR</th>
            </tr>
        </thead>
        <tbody>
            @forelse($notes as $index => $note)
                <tr>
                    <td class="center"><span class="id-cell">{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}</span></td>
                    <td class="nowrap"><span class="box-tag">{{ $note->box->box_number ?? '—' }}</span></td>
                    <td class="nowrap"><strong>{{ $note->internal_number }}</strong></td>
                    <td class="nowrap">{{ optional($note->note_date)->format('d/m/Y') ?? '—' }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($note->reference ?? '', 90) }}</td>
                    <td>{{ $note->doc_type ?? '—' }}</td>
                    <td>{{ $note->note_type ?? '—' }}</td>
                    <td class="center"><strong>{{ $note->pages ?? '—' }}</strong></td>
                    <td>
                        <span class="badge badge-{{ strtolower($note->status) }}">{{ $note->status }}</span>
                    </td>
                    <td>{{ $note->creator->name ?? '—' }}</td>
                    <td>{{ $note->verifier->name ?? '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="11">
                        <div class="empty-state">No se encontraron documentos con los filtros aplicados.</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
        @if($notes->count() > 0)
            <tfoot>
                <tr class="total-row">
                    <td colspan="7" class="total-label">▸ TOTALES</td>
                    <td class="center">{{ number_format($summary['total_fojas']) }}</td>
                    <td colspan="3">{{ number_format($summary['total']) }} documento(s) registrado(s)</td>
                </tr>
            </tfoot>
        @endif
    </table>

    {{-- ══════════ Footer fijo con paginación ══════════ --}}
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td style="width: 33%;">
                    <span class="gold">AGBC</span> · Correos de Bolivia
                </td>
                <td style="width: 34%;" class="center">
                    Sistema de Verificación de Documentos · &copy; {{ date('Y') }}
                </td>
                <td style="width: 33%;" class="right">
                    Página <span class="page-number"></span>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>

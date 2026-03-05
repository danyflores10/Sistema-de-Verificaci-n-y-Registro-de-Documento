<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::with('user')->latest('created_at');

        if ($action = $request->get('action')) {
            $query->where('action', $action);
        }
        if ($entity = $request->get('entity')) {
            $query->where('entity', $entity);
        }
        if ($userId = $request->get('user_id')) {
            $query->where('user_id', $userId);
        }
        if ($dateFrom = $request->get('date_from')) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }
        if ($dateTo = $request->get('date_to')) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        $logs  = $query->paginate(25)->withQueryString();
        $users = User::orderBy('name')->get();

        $actions = AuditLog::select('action')->distinct()->pluck('action');
        $entities = AuditLog::select('entity')->distinct()->pluck('entity');

        return view('audit.index', compact('logs', 'users', 'actions', 'entities'));
    }
}

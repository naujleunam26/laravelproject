<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $currentDay = Carbon::now()->toDateString();

        // Ventas totales del mes actual
        $totalVentasMes = Venta::whereMonth('fecha', $currentMonth)->sum('precio');

        // Ventas totales del día actual
        $totalVentasDiarias = Venta::whereDate('fecha', $currentDay)->sum('precio');

        // Ventas por usuario
        $ventasPorUsuario = Venta::select(DB::raw('users.name as usuario, SUM(precio) as total_ventas'))
            ->join('users', 'ventas.user_id', '=', 'users.id')
            ->groupBy('users.name')
            ->get();

        return view('dashboard', compact('totalVentasMes', 'totalVentasDiarias', 'ventasPorUsuario'));
    }
}

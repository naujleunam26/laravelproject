<?php

namespace App\Http\Controllers;

use App\Models\OrdenServicio;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdenServicioController extends Controller
{
    public function index()
    {
        $ordenes = OrdenServicio::with('cliente', 'user')->get();
        return view('ordenes.index', compact('ordenes'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        return view('ordenes.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'modelo_telefono' => 'required|string',
            'marca' => 'nullable|string',
            'imei' => 'nullable|string',
            'codigo_de_bloque' => 'nullable|string',
            'problema_reportado' => 'required|string',
            'costo_estimado' => 'nullable|numeric|min:0',
            'costo_repuestos' => 'nullable|numeric|min:0',
            'abono' => 'nullable|numeric|min:0',
            'fecha_entrega' => 'nullable|date',
            'estado' => 'required|in:pendiente,en_proceso,completado,cancelado'
        ]);

        OrdenServicio::create([
            'cliente_id' => $request->cliente_id,
            'modelo_telefono' => $request->modelo_telefono,
            'marca' => $request->marca,
            'imei' => $request->imei,
            'codigo_de_bloque' => $request->codigo_de_bloque,
            'problema_reportado' => $request->problema_reportado,
            'costo_estimado' => $request->costo_estimado,
            'costo_repuestos' => $request->costo_repuestos,
            'abono' => $request->abono,
            'fecha_ingreso' => now(),
            'fecha_entrega' => $request->fecha_entrega,
            'estado' => $request->estado,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('ordenes.index')->with('success', 'Orden de servicio creada exitosamente.');
    }

    public function show($id)
    {
        $orden = OrdenServicio::with('cliente', 'user')->findOrFail($id);
        return view('ordenes.show', compact('orden'));
    }

    public function edit($id)
    {
        $orden = OrdenServicio::findOrFail($id);
        $clientes = Cliente::all();
        return view('ordenes.edit', compact('orden', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'modelo_telefono' => 'required|string',
            'marca' => 'nullable|string',
            'imei' => 'nullable|string',
            'codigo_de_bloque' => 'nullable|string',
            'problema_reportado' => 'required|string',
            'costo_estimado' => 'nullable|numeric|min:0',
            'costo_repuestos' => 'nullable|numeric|min:0',
            'abono' => 'nullable|numeric|min:0',
            'fecha_entrega' => 'nullable|date',
            'estado' => 'required|in:pendiente,en_proceso,completado,cancelado'
        ]);

        $orden = OrdenServicio::findOrFail($id);
        $orden->update([
            'cliente_id' => $request->cliente_id,
            'modelo_telefono' => $request->modelo_telefono,
            'marca' => $request->marca,
            'imei' => $request->imei,
            'codigo_de_bloque' => $request->codigo_de_bloque,
            'problema_reportado' => $request->problema_reportado,
            'costo_estimado' => $request->costo_estimado,
            'costo_repuestos' => $request->costo_repuestos,
            'abono' => $request->abono,
            'fecha_entrega' => $request->fecha_entrega,
            'estado' => $request->estado
        ]);

        return redirect()->route('ordenes.index')->with('success', 'Orden de servicio actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $orden = OrdenServicio::findOrFail($id);
        $orden->delete();
        return redirect()->route('ordenes.index')->with('success', 'Orden de servicio eliminada exitosamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Accesorio;
use App\Models\FacturaCompra;
use App\Models\DetalleFactura;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class FacturaCompraController extends Controller
{
    public function index()
    {
        // Lista las facturas con sus proveedores
        $facturas = FacturaCompra::with('proveedor')->get();
        return view('facturas.index', compact('facturas'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        $accesorios = Accesorio::all();
        

        // Generar el siguiente número de factura
        $ultimoNumeroFactura = FacturaCompra::max('numero_factura');
        $nuevoNumeroFactura = $ultimoNumeroFactura ? $ultimoNumeroFactura + 1 : 1;

        return view('facturas.create', compact('proveedores', 'accesorios', 'nuevoNumeroFactura'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_factura' => 'required|unique:facturas_compras,numero_factura',
            'proveedor_id' => 'required|exists:proveedores,id',
            'fecha' => 'required|date',
            'accesorios' => 'required|array',
            'accesorios.*.accesorio_id' => 'required|exists:accesorios,id', 
            'accesorios.*.cantidad' => 'required|integer|min:1',
            'accesorios.*.precio_unitario' => 'required|numeric|min:0',
        ]);
    
        // Crear factura
        $factura = FacturaCompra::create([
            'numero_factura' => $validated['numero_factura'],
            'proveedor_id' => $validated['proveedor_id'],
            'fecha' => $validated['fecha'],
            'total' => 0,
        ]);
    
        $total = 0;
    
        // Insertar detalles de la factura
        foreach ($validated['accesorios'] as $detalle) {
            // Verificar si $detalle['accesorio_id'] no es null
            if (is_null($detalle['accesorio_id'])) {
                return back()->withErrors('El accesorio es obligatorio.');
            }
        
            $subtotal = $detalle['cantidad'] * $detalle['precio_unitario'];
        
            DetalleFactura::create([
                'factura_compra_id' => $factura->id,
                'accesorio_id' => $detalle['accesorio_id'],
                'cantidad' => $detalle['cantidad'],
                'precio_unitario' => $detalle['precio_unitario'],
                'subtotal' => $subtotal,
            ]);
        
            // Actualizar el accesorio
            $accesorio = Accesorio::find($detalle['accesorio_id']);
            if ($accesorio) {
                $accesorio->cantidad += $detalle['cantidad'];
                $accesorio->codigo_factura = "Factura #{$factura->numero_factura}";
                $accesorio->save();
            }
        
            $total += $subtotal;
        }
        
    
        // Actualizar el total de la factura
        $factura->update(['total' => $total]);
    
        return redirect()->route('facturas.index')->with('success', 'Factura registrada exitosamente.');
    }
    

    public function show($id)
    {
        // Mostrar factura con detalles y proveedor
        $factura = FacturaCompra::with(['proveedor', 'detalles.accesorio'])->findOrFail($id);
        return view('facturas.show', compact('factura'));
    }

    public function search(Request $request)
{
    $query = $request->get('q');  // Obtener el término de búsqueda

    if (!$query) {
        return response()->json([]);  // Si no hay consulta, retorna un array vacío
    }

    // Realiza la búsqueda de accesorios por nombre usando LIKE
    $accesorios = Accesorio::where('nombre', 'LIKE', "%{$query}%")
        ->get(['id', 'nombre']);  // Solo obtenemos el id y nombre del accesorio

    return response()->json($accesorios);  // Devuelve los accesorios encontrados en formato JSON
}



}

<?php
    namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Accesorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;
use App\Models\DetalleFactura;



class VentaController extends Controller
{

    
    public function index()
    {
        $ventas = Venta::where('user_id', Auth::id())->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
{
    $clientes = Cliente::all(); // Asume que tienes un modelo Cliente
    return view('ventas.create', compact('clientes'));
}

public function store(Request $request)
{
    $request->validate([
        'accesorio_id' => 'required|exists:accesorios,id',
        'cantidad' => 'required|integer|min:1',
        'precio' => 'required|numeric|min:0',
        'cliente_id' => 'required|exists:clientes,id',
        
    ]);

    // Buscar el accesorio relacionado
    $accesorio = Accesorio::find($request->accesorio_id);

    // Validar que el accesorio exista
    if (!$accesorio) {
        return redirect()->back()->with('error', 'Accesorio no encontrado.');
    }

    

    // Verificar que haya stock suficiente
    if ($accesorio->cantidad < $request->cantidad) {
        // Retornar a la vista con información para mostrar el modal
        return redirect()->back()->with([
            'showModal' => true,
            'modalMessage' => 'No hay suficiente stock para el accesorio seleccionado.',
        ]);
    }
    
    // Suponiendo que detalle_facturas tiene accesorio_id:
$detalle = DetalleFactura::where('accesorio_id', $request->accesorio_id)->first();

if (!$detalle) {
    return redirect()->back()->with('error', 'No se encontró el detalle de factura para el accesorio seleccionado.');
}

$valor_compra = $detalle->precio_unitario; // Obtenemos el precio_unitario

$venta = Venta::create([
    'accesorio_id' => $request->accesorio_id,
    'cantidad' => $request->cantidad,
    'precio' => $request->precio,
    'valor_compra' => $valor_compra,
    'cliente_id' => $request->cliente_id,
    'fecha' => now(),
    'user_id' => Auth::id(),
]);

    // Actualizar el stock del accesorio
    $accesorio->cantidad -= $request->cantidad;
    $accesorio->save();

    return redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente.');
}






    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

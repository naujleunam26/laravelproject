<?php

namespace App\Http\Controllers;

use App\Models\Accesorio;
use App\Models\Categoria;
use Illuminate\Http\Request;

class AccesorioController extends Controller
{
    // Mostrar todos los accesorios
    public function index()
{
    $accesorios = Accesorio::with('categoria')->get(); // Obtiene los accesorios junto con su categoría
    $categorias = Categoria::all(); // Obtiene todas las categorías
    return view('accesorios.index', compact('accesorios', 'categorias'));
}
public function search(Request $request)
{
    $query = $request->get('q');  // Obtiene el término de búsqueda

    if (!$query) {
        return response()->json([]);  // Si no hay consulta, devuelve un array vacío
    }

    // Realiza la búsqueda de accesorios por nombre usando LIKE
    $accesorios = Accesorio::where('nombre', 'LIKE', "%{$query}%")
    ->get(['id', 'nombre']); // Sin 'precio_venta'


    return response()->json($accesorios);  // Retorna los resultados en formato JSON
}



    // Mostrar el formulario de creación
    public function create()
    {
        $categorias = Categoria::all();
        return view('accesorios.create', compact('categorias'));
    }

    // Guardar un nuevo accesorio
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nombre' => 'required|string|max:255',
        'categoria_id' => 'required|exists:categorias,id', // Valida la relación con categorías
        'codigo_factura' => 'nullable|string|max:255',
    ]);

    Accesorio::create($validatedData);

    return redirect()->route('accesorios.index')->with('success', 'Accesorio agregado exitosamente');
}


    // Mostrar el formulario de edición
    public function edit(Accesorio $accesorio)
    {
        $categorias = Categoria::all();
        return view('accesorios.edit', compact('accesorio', 'categorias'));
    }

    // Actualizar un accesorio
    public function update(Request $request, Accesorio $accesorio)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id', // Relacionado con categorías
            'cantidad' => 'required|integer|min:0',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
        ]);

        $accesorio->update($validatedData);
        return redirect()->route('accesorios.index')->with('success', 'Accesorio actualizado exitosamente');
    }

    // Eliminar un accesorio
    public function destroy(Accesorio $accesorio)
    {
        $accesorio->delete();
        return redirect()->route('accesorios.index')->with('success', 'Accesorio eliminado exitosamente');
    }
}

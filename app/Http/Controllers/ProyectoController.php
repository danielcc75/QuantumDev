<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index()
    {
        return Proyecto::all();
    }

    public function store(Request $request)
    {
        return Proyecto::create($request->all());
    }

    public function show($id)
    {
        return Proyecto::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->update($request->all());
        return $proyecto;
    }

    public function destroy($id)
    {
        Proyecto::destroy($id);
        return response()->json(['mensaje' => 'Eliminado']);
    }
}
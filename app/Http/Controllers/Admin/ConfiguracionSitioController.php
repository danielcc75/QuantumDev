<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\LogsActivity;
use App\Models\ConfiguracionSitio;
use Illuminate\Http\Request;

class ConfiguracionSitioController extends Controller
{
    use LogsActivity;

    public function index()
    {
        $config = ConfiguracionSitio::actual();
        return view('admin.configuracion.index', compact('config'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nombre_empresa' => 'required|string|max:100',
            'descripcion'    => 'required|string|max:1000',
            'email_contacto' => 'required|email|max:150',
            'telefono'       => 'required|string|max:30',
        ]);

        $config = ConfiguracionSitio::actual();
        $config->update($validated);

        $this->logAdminAction('configuracion_sitio_actualizada', 'Configuración del sitio actualizada');

        return back()->with('success', 'Configuración actualizada correctamente');
    }
}

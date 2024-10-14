<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DudasController extends Controller
{
    public function mostrarFormulario()
    {
        return view('welcome');
    }

    public function guardarDuda(Request $request)
    {
        // Validación
        $request->validate([
            'correo' => 'required|email', 
            'asunto' => 'required|string|max:50',
            'descripcion' => 'required|string|max:300',
        ], [
            'correo.required' => 'El campo correo es obligatorio.',
            'correo.email' => 'El correo debe tener un formato válido.',
            'asunto.required' => 'El campo asunto es obligatorio.',
            'asunto.max' => 'El asunto no puede tener más de 50 caracteres.',
            'asunto.not_regex' => 'El asunto no puede ser solo numérico.',
            'descripcion.required' => 'El campo descripción es obligatorio.',
            'descripcion.max' => 'La descripción no puede tener más de 300 caracteres.',
        ]);

        // Recibir datos
        $correo = $request->correo;
        $modulo = $request->modulo;
        $asunto = $request->asunto;
        $descripcion = $request->descripcion;
        $temas = isset($request->temas) ? implode(',', $request->temas) : '';

        // Línea en formato CSV
        $linea = sprintf('"%s";"%s";"%s";"%s";"%s"' . PHP_EOL,
            $correo, $modulo, $asunto, $descripcion, $temas
        );

        // Ruta del archivo
        $archivo = storage_path('app/dudas.csv');

        // Escribir en el archivo
        file_put_contents($archivo, $linea, FILE_APPEND | LOCK_EX);

        // Redirigir a la vista de confirmación
        return view('enviado');
    }
}


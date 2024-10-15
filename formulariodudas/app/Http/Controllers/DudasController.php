<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
            'modulo' => 'required|string|in:Programación,Base de Datos,Sistemas,Entornos de Desarrollo,Desarrollo Web',
            'asunto' => 'required|string|max:50|regex:/^[^0-9]*$/',
            'descripcion' => 'required|string|max:300'
        ]);

        // Recibir datos
        $correo = $request->correo;
        $modulo = $request->modulo;
        $asunto = $request->asunto;
        $descripcion = $request->descripcion;

        // Línea en formato CSV
        $linea = sprintf('"%s";"%s";"%s";"%s";"%s"' . PHP_EOL,
            $correo, $modulo, $asunto, $descripcion
        );

        // Ruta del archivo
        $archivo = storage_path('app/dudas.csv');

        // Escribir en el archivo
        file_put_contents($archivo, $linea, FILE_APPEND | LOCK_EX);

        // Redirigir a la vista de confirmación
        return view('enviado');
    }
}


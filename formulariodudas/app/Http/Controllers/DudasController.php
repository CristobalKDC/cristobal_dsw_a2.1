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
<<<<<<< HEAD
            'correo' => 'required|email',
            'modulo' => 'required|string|in:Programación,Base de Datos,Sistemas,Entornos de Desarrollo,Desarrollo Web',
            'asunto' => 'required|string|max:50|regex:/^[^0-9]*$/',
            'descripcion' => 'required|string|max:300'
=======
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
>>>>>>> a9ead9542c74bed984dca57bf5b387b8f1f167ff
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


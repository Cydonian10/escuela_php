<?php

namespace App\Http\Controllers;

use App\Http\Resources\TramiteResource;
use App\Models\Tramites;
use Illuminate\Http\Request;

class TramiteController extends Controller
{

    public function index()
    {
        $tramite = Tramites::orderBy('id', 'desc')->paginate();

        return response()->json([
            'message' => 'Todos los tramites paginados',
            'data' => $tramite
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'apellidos' => 'required',
            'dni' => 'required',
            'email' => 'required',
            'descriptcion_padre' => 'nullable',
            'tramite_nombre' => 'required',
            'telefono' => 'required',

            'archivo_padre' => 'nullable',
            'fecha' => 'nullable',
            'tramite_estado' => 'in:pendiente,rechazado,aceptado,proceso',
            'archivo_descargar_admin' => 'nullable',
            'visto' => 'in:false,true',
            'descriptcion_recepcionista' => 'nullable',
        ]);

        $tramite = Tramites::create($request->all());
        $tramite->save();

        return response()->json([
            'message' => 'Creando un tramite',
            'data' => new TramiteResource($tramite)
        ]);
    }


    public function show($id)
    {
        $tramite = Tramites::find($id);

        if (!$tramite) {
            return response()->json([
                'message' => 'No se encontro el tramite con el id' . ' ' . "#$id",
            ]);
        }

        return response()->json([
            'message' => 'Un tramite',
            'data' => $tramite
        ]);
    }


    public function update(Request $request, $id)
    {
        $tramite = Tramites::find($id);

        if (!$tramite) {
            return response()->json([
                'message' => 'No se encontro el tramite con el id' . ' ' . "#$id",
            ]);
        }

        $tramite->fill($request->all());
        $tramite->save();

        return response()->json([
            "message" => "Tramite actulizado",
            "data" => $tramite
        ]);
    }

    public function destroy($id)
    {
        $tramite = Tramites::find($id);

        if (!$tramite) {
            return response()->json([
                'message' => 'No se encontro el tramite con el id' . ' ' . "#$id",
            ]);
        }

        $tramite->delete();

        return response()->json([
            'message' => "Eliminado",
        ]);
    }
}

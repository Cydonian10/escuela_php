<?php

namespace App\Http\Controllers;

use App\Http\Resources\AsistenciaResource;
use App\Models\Asitencia;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{

    public function myAsistencia($id)
    {
        $asistencias = Asitencia::where('user_id', '=', $id)->get();

        if (!$asistencias) {
            return response()->json([
                'message' => 'no se encontro asistencias'
            ]);
        }

        return response()->json([
            'message' => 'users un asistencias one',
            'data' => $asistencias
        ]);
    }


    public function index()
    {
        $asistencias = Asitencia::latest()->get();

        return response()->json([
            'message' => 'Todos los asistencias',
            'data' =>  $asistencias
        ]);
    }

    public function store(Request $request)
    {
        $asistencia = Asitencia::create([
            'user_id' => $request->user_id,
        ] + $request->all());

        return response()->json([
            'message' => 'Creando un asistencia',
            'data' => new AsistenciaResource($asistencia)
        ]);
    }

    public function show($id)
    {
        $asistencia = Asitencia::where(["id" => $id])->first();
        return response()->json([
            'message' => 'Una sola asistencia',
            'data' => $asistencia
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hora_salida' =>  'required',
        ]);

        $asistencia = Asitencia::find($id);

        $asistencia->fill($request->all());
        $asistencia->save();

        return response()->json([
            "message" => "Asistencia actulizado",
            "data" => $asistencia
        ]);
    }

    public function destroy($id)
    {
        $asistencia = Asitencia::find($id);

        if (!$asistencia) {
            return response()->json([
                'message' => 'no se encontro la asistencia'
            ]);
        }

        $asistencia->delete();
        return response()->json([
            'message' => 'Eliminado'
        ]);
    }

    public function asistenciasByUserForFehca(Request $request, $id)
    {
        // $asistencias =  Asitencia::whereBetween('fecha', ['2022-01-27', '2022-01-29'])->where('user_id', '=', '2')->get();
        $asistencias =  Asitencia::whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin])->where('user_id', '=', $id)->get();

        return response()->json([
            'message' => 'Asistecias por fecha',
            'data' =>  AsistenciaResource::collection($asistencias)
        ]);
    }
}

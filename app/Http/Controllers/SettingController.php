<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'nombre_escuela' => 'required',
            'telefono_escuela' => 'required',
            'facebook_esculea' => 'required',
            'frase_escuela' => 'required',
            'description' => 'required',
        ]);

        $setting = Setting::create($request->all());

        return response()->json([
            'message' => 'Creando nueva escuela',
            'data' => $setting
        ]);
    }


    public function show($id)
    {
        $setting = Setting::find($id);

        if (!$setting) {
            return response()->json([
                'message' => 'no se encontro el id'
            ]);
        }

        return response()->json([
            'message' => 'Un registro',
            'data' => $setting
        ]);
    }


    public function update(Request $request, $id)
    {
        $setting = Setting::find($id);

        if (!$setting) {
            return response()->json([
                'message' => 'no se encontro el id'
            ]);
        }

        $setting->fill($request->all());
        $setting->save();

        return response()->json([
            'message' => 'Actulizado',
            'data' => $setting
        ]);
    }
}

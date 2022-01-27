<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json([
            'message' => 'todos lo usuarios',
            'data' => $users
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
            ]);
        }

        return response()->json([
            'message' => 'Un usuario',
            'data' => $user
        ]);
    }

    public function userByEmail($email)
    {
        $user = User::where('email', '=', $email)->get();
        return response()->json([
            'message' => 'Usuario by email',
            'data' => $user[0]
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'name' => 'required',
            'last_name' => 'required',
            'dni' => 'required',
            'telefono' => 'required',
            'grado_seccion' => 'required',
            'rol' => 'in:admin,profesor,asistencias',
        ]);

        $user = User::create([
            'password' => Hash::make($request->password)
        ] + $request->all());

        $user->save();

        return response()->json([
            "message" => "Registro de usuario exitoso",
            "data" => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where("email", "=", $request->email)->first();
        if (isset($user->id)) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken("auth_token")->plainTextToken;
                return response()->json([
                    "message" => "Usuario logeado correctamente",
                    "acces_token" => $token
                ]);
            } else {
                return response()->json([
                    "message" => "El password es incorrecta"
                ]);
            }
        } else {
            return response()->json([
                "message" => "El usuario no existe"
            ]);
        }
    }

    public function userProfile()
    {
        return response()->json([
            "message" => "Acerca del perfil del usuario",
            "data" => auth()->user()
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            "message" => "Cierre de Session",
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'email|unique:users,email,' . auth()->user()->id,
            'password' => 'min:4',
            'name' => 'min:4',
            'last_name' => 'min:4',
            'dni' => 'size:8',
            'telefono' => 'size:9',
            'grado_seccion' => 'min:1',
            'rol' => 'in:admin,profesor,asistencias',
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'No se encontro el usuario con el id' . ' ' . "#$id",
            ]);
        }

        if ($request->password) {
            $user->fill([
                'password' => Hash::make($request->password)
            ] + $request->all());
        } else {
            $user->fill($request->all());
        }

        $user->save();

        return response()->json([
            "message" => "User actulizado",
            "data" => $user
        ]);
    }

    public function remove($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'No se encontro el usuario con el id' . ' ' . "#$id",
            ]);
        }

        $user->delete();

        return response()->json([
            'message' => "Eliminado",
            'data' => $user
        ]);
    }
}

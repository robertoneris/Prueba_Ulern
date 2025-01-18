<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller

{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "password" => "required|string",
            "email" => "required|email",
        ], [
            "email.required" => "Este campo es obligartorio.",
            "email.email" => "el correo tiene el formato incorrecto.",
        ]);
        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }
        $credentials = request(["email","password"]);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(["error"=> "
            Datos de acceso incorrector. Por favor, Email o Contraseña incorrecto"], Response::HTTP_UNAUTHORIZED);
        }
        return $this->respondWithToken($token);
    }
    public function unauthorized()
    {
        return redirect(route("login"));
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:100|min:2",
            "lastname" => "required|string|max:100|min:2",
            "password" => "required|string|max:255|min:8",
            "email" => "required|email|unique:users,email",
            "cell_number" => "required|string|max:9|min:9"
        ], [
            "name.required" => "El campo es obligatorio",
            "name.min" => "el nombre no puede tener menos de :min caracteres",
            "name.max" => "el nombre no puede tener mas de :max caracteres",
            "lastname.required" => "El campo es obligatorio",
            "lastname.min" => "El apellido debe tener al menos :min caracteres",
            "lastname.max" => "el nombre no puede tener mas de :max caracteres",
            "password.required" => "El campo es obligatorio",
            "password.min" => "la contraseña debe tener al menos :min caracteres",
            "email.required" => "El campo es obligatorio",
            "email.unique" => "El correo ya esta registrado",
            "email.email" => "el correo no tiene el formato correcto",
            "cell_number.required" => "El campo es obligatorio",
            "cell_number.min" => "el numero no corresponde, recuerde incluir el 9",
            "cell_number.max" => "el numero no corresponde, recuerde incluir el 9",

        ]);
        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }
        $exists = User::where("email", htmlspecialchars($request->input("email")))->first();
        if (!$exists) {
            $new = User::create([
                "name" => htmlspecialchars($request->input("name")),
                "lastname" => htmlspecialchars($request->input("lastname")),
                "email" => htmlspecialchars($request->input("email")),
                "password" => Hash::make($request->input("password")),
                "cell_number" => htmlspecialchars($request->input("cell_number")),
            ]);
            if (!$new) {
                return response()->json(["error" => "no se logro crear"], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            return response()->json($new, Response::HTTP_CREATED);;
        } else {
            return response()->json(["error" => "ya existe un usuario con ese email"], Response::HTTP_BAD_REQUEST);
        }
}
public function me()
{
    return response()->json(auth()->user());
 }
 public function logout()
 {
    auth()->logout();
    try {
        $token = JWTAuth::getTokeToken();
        if (!$token) {
            return response()->json(["error" => "token no encontrado"] , Response::HTTP_BAD_REQUEST);
             }
             JWTAuth::invalidToken($token);
             return response()->json(["message" => "sesion cerrada correctamente"], Response::HTTP_OK);
            } catch (\TokenInvalidException $e) {
                return response()->json(["error"=> "token invalido"] , Response::HTTP_UNAUTHORIZED);
            } catch (\Exception $e) {
                return response()->json(["error"=> "No se pudo cerrar la sesion correctamente"] , Response::
                HTTP_INTERNAL_SERVER_ERROR);
            }
        }
 public function refresh()
 {
    try{
        $token = JWTAuth::getToken();
        if (!$token) {
            return response()->json(["error"=> "Token no encontrado"] , Response::HTTP_BAD_REQUEST);
        }

        $nuevo_token = auth()->refresh();
        //invalida token actual
        JWTAuth::invalidate($token);
        return $this->respondWithToken($nuevo_token);
    } catch (\TokenInvalidException $e) {
        return response()->json(["error"=> "token invalido"] , Response::HTTP_UNAUTHORIZED);
    } catch (\Exception $e) {
        return response()->json(["error"=> "No se pudo cerrar la sesion"] , Response::
        HTTP_INTERNAL_SERVER_ERROR);
    }
}
protected function respondWithToken($token)
{
    return response()->json([
        "access_token" => $token,
        "token_type" => "beares",
        "expire_in" => auth()->factory()->getTTL() * 60,
    ] , Response::HTTP_OK);
}
}

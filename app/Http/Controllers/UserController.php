<?php

namespace App\Http\Controllers;

use App\Http\Requests\{CreateUserRequest, SignInRequest};
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
class UserController extends Controller
{
    public function signUp(CreateUserRequest $request): JsonResponse  {
        $data = $request->only(["name","email","password","state_id"]);
        $data['password'] = Hash::make($data['password'] );
        $user = User::create($data);

        $response = ['error' =>'', 'token' => $user->createToken('Register_token')->plainTextToken];

        return response()->json($response);
    }
    public function signIn(SignInRequest $request): JsonResponse {
        $data = $request->only(["email","password"]);

        $data = Auth::attempt($data);

        if ($data ) {
            $user = Auth::user();
            $response = ['error' =>'', 'token' => $user->createToken('Register_token')->plainTextToken];
            return response()->json($response);
        }
        return response()->json(['error' => 'Usuário ou Senha inválido']);
    }
    public function signMe(): JsonResponse  {
        $user = Auth::user();

        $response = [
            'nome' => $user->name,
            'email' => $user->email,
            'estado' => $user->state->name,
        ];
        return response()->json([$response]);
    }
}

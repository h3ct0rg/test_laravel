<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Listar todos los Usuarios.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $users = User::all(['name', 'email']);
            return response()->json(
                [
                    'success' => true,
                    'data' => $users
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error al obtener los usuarios',
                    'error' => $e->getMessage()
                ],
                500
            );
        }
    }
}

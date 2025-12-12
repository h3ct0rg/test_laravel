<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'titulo' => 'sometimes|required|string|max:255',
            'descripcion' => 'sometimes|nullable|string',
            'estado' => 'sometimes|required|in:pendiente,en_progreso,completada',
            'user_id' => 'sometimes|required|exists:users,id',
        ];
    }
}

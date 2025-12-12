<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Listar todas las tareas con su usuario.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $tasks = Task::with('user')->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $tasks
        ]);
    }

    /**
     * Crear una nueva tarea.
     *
     * @param StoreTaskRequest $request
     * @return JsonResponse
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());

        return response()->json([
            'success' => true,
            'data' => $task
        ], 201);
    }

    /**
     * Mostrar una tarea específica.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $task = Task::with('user')->find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => '¡Tarea no encontrada!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $task
        ]);
    }

    /**
     * Actualizar una tarea.
     *
     * @param UpdateTaskRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateTaskRequest $request, int $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => '¡Tarea no encontrada!'
            ], 404);
        }

        $task->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => $task
        ]);
    }

    /**
     * Eliminar una tarea.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => '¡Tarea no encontrada!'
            ], 404);
        }

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => '¡Tarea eliminada con éxito!'
        ]);
    }
}

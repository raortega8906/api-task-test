<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;
use App\Models\Task;

class TaskController extends Controller
{
    public function index($id)
    {
        $category = Category::find($id);

        if(!$category) {
            return response()->json([

                'status' => 404,
                'message' => 'Categoría no encontrada.'

            ], 404);
        }

        $tasks = Task::all();

        if($tasks->isEmpty()) {
             return response()->json([

                'status' => 200,
                'message' => 'No se ha registrado ninguna Tarea aún.',

            ], 200);
        }

        return response()->json([

            'status' => 200,
            'message' => 'Tareas encontradas.',
            'data' => $tasks

        ], 200);
    }

    public function store($id, StoreTaskRequest $request)
    {
        $category = Category::find($id);

        if(!$category) {
            return response()->json([

                'status' => 404,
                'message' => 'Categoría no encontrada.'

            ], 404);
        }

        $validated = $request->validated([
            // 'category_id' => $id,
            // 'user_id' => 1
        ]);

        $task = Task::create($validated);
        return response()->json([

            'status' => 201,
            'message' => 'Tarea creada correctamente.',
            'data' => $task

        ], 201);
    }

    public function show($id, $idTask) 
    {
        $category = Category::find($id);

        if(!$category) {
            return response()->json([

                'status' => 404,
                'message' => 'Categoría no encontrada.'

            ], 404);
        }

        $task = Task::find($idTask);

        if(!$task) {
            return response()->json([

                'status' => 404,
                'message' => 'Tarea no encontrada.'

            ], 404);
        }

        return response()->json([

            'status' => 200,
            'message' => 'Tarea encontrada.',
            'data' => $task

        ], 200);
    }

    public function update($id, UpdateTaskRequest $request, $idTask)
    {
        $category = Category::find($id);

        if(!$category) {
            return response()->json([

                'status' => 404,
                'message' => 'Categoría no encontrada.'

            ], 404);
        }

        $task = Task::find($idTask);

        if(!$task) {
            return response()->json([

                'status' => 404,
                'message' => 'Tarea no encontrada.'

            ], 404);
        }

        $validated = $request->validated();
        
        $task->update($validated);
        return response()->json([

            'status' => 200,
            'message' => 'Tarea actualizada correctamente.',
            'data' => $task

        ], 200);
    }

    public function destroy($id, $idTask)
    {
        $category = Category::find($id);

        if(!$category) {
            return response()->json([

                'status' => 404,
                'message' => 'Categoría no encontrada.'

            ], 404);
        }

        $task = Task::find($idTask);

        if(!$task) {
            return response()->json([

                'status' => 404,
                'message' => 'Tarea no encontrada.'

            ], 404);
        }

        $task->delete();
        return response()->json([

            'status' => 200,
            'message' => 'Tarea eliminada correctamente.',
            'data' => $task

        ], 200);
    }
    
}

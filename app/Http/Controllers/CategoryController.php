<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();

        if($categories->isEmpty()) {
            return response()->json([

                'status' => 200,
                'message' => 'No se ha registrado ninguna Categoría aún.',

            ], 200);
        }
        
        return response()->json([

            'status' => 200,
            'message' => 'Categorías encontradas.',
            'data' => $categories

        ], 200);
    }

    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        $category = Category::create($validated);
        return response()->json([

            'status' => 201,
            'message' => 'Categoría creada correctamente.',
            'data' => $category

        ], 201);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([

                'status' => 404,
                'message' => 'Categoría no encontrada.'

            ], 404);
        }

        return response()->json([

            'status' => 200,
            'message' => 'Categoría encontrada.',
            'data' => $category

        ], 200);
    }

    public function update($id, UpdateCategoryRequest $request)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([

                'status' => 404,
                'message' => 'Categoría no encontrada.'

            ], 404);
        }

        $validated = $request->validated();

        $category->update($validated);
        return response()->json([

            'status' => 200,
            'message' => 'Categoría actualizada correctamente.',
            'data' => $category

        ], 200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([

                'status' => 404,
                'message' => 'Categoría no encontrada.'

            ], 404);
        }

        $category->delete();
        return response()->json([

            'status' => 200,
            'message' => 'Categoría eliminada correctamente.',
            'data' => $category

        ], 200);
    }

}

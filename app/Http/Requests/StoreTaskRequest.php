<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(response()->json([
            'status' => 422,
            'message' => 'Error en la validación de datos.',
            'errors' => $validator->errors()
        ], 422));
    }

    public function messages(): array
    {
        return [
            'title.required' => 'El título es obligatorio.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'status.required' => 'El estado es obligatorio.',
            'status.in' => 'El estado debe ser pendiente o completado.',
            'category_id.required' => 'El ID de la categoría es obligatorio.',
            'category_id.exists' => 'La categoría seleccionada no existe.',
            'user_id.required' => 'El ID del usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
        ];
    }

    
}

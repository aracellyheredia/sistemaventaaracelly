<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'nombre' => 'required|max:100',
            'id_categoria' => 'required|exists:categoria,id_categoria',
            'codigo' => 'required|max:50',
            'stock' => 'required|integer|min:0',
            'descripcion' => 'nullable|max:256',
            'imagen' => 'nullable|image|max:2048', // Máximo 2MB
        ];
    }
}

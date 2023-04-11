<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:categories',
            'order_by' => 'required|numeric',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'slug.required' => 'O campo URL é obrigatório',
            'slug.min'  => 'O campo URL  deve ter pelo menos 3 caracteres',
            'slug.max'  => 'O campo URL  deve ter pelo menos 255 caracteres',

            'order_by.required'  => 'O campo categoria serial é obrigatório',
            'order_by.numeric'  => 'O campo categoria serial deve ser um número',

        ];
    }


}

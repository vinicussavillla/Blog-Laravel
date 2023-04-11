<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpadateRequest extends FormRequest
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
            'title' => 'required|min:3|max:130', 
            'slug' => 'required|max:130|unique:posts,slug'.$this->id,
            'status' => 'required',
            'category_id' => 'required', 
            'sub_category_id' => 'required', 
            'description' => 'required|min:20',
            'tag_ids' => 'required', 
        ];
    }
}

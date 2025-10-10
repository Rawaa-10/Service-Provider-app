<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'provider_id' => 'required|exists:users,id' , 
            'category_id' => 'required|exists:categories,id', 
            'title' => 'required|string|max:255', 
            'slug' => 'required|string|max:255', 
            'description' => 'required|string|max:500', 
            'price' => 'required|decimal:2,4', 
            'is_active' => 'required','boolean',Rule::in(['true', 'false'])
        ];
    }
}

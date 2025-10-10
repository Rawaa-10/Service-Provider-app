<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'provider_id' => 'nullable|exists:users,id' , 
            'category_id' => 'nullable|exists:categories,id', 
            'title' => 'required|string|max:255', 
            'slug' => 'nullable|string|max:255', 
            'description' => 'nullable|string|max:500', 
            'price' => 'required|decimal:2,4', 
            'is_active' => 'nullable','boolean',Rule::in(['true', 'false'])
        ];
    }
}

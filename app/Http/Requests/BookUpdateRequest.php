<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string|max:255',
            'author' => 'string|max:255',
            'description' => 'string|min:100',
            'page_count' => 'string|min:1',
            'status' => 'string|in:available, borrowed',
            'category_id' => 'string|max:255'
        ];
    }
}

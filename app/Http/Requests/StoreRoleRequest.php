<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:roles,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Название роли обязательно для заполнения.',
            'name.string' => 'Название роли должно быть строкой.',
            'name.max' => 'Название роли не должно превышать 255 символов.',
            'name.unique' => 'Роль с таким названием уже существует.',
        ];
    }
}

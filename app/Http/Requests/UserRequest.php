<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role_id' => [
                'required', 'exists:roles,id'
            ],
            'name' => [
                'required', 'min:3'
            ],
            'email' => [
                'required', 'email', Rule::unique('users')->ignore($this->route()->user->id ?? null)
            ],
            'password' => $this->route()->user ? ['nullable', 'confirmed', 'min: 6'] : ['required', 'min:6']
        ];
    }

    public function messages()
    {
        return [
            'role_id.required' => 'Please select a designated role for the user.'
        ];
    }
}

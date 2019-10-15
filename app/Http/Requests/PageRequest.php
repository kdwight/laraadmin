<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'banner' => 'required|mimes:jpeg,jpg,png|max:2048',
            'title' => 'required|string|max:65',
            'details' => 'required|string',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string'
        ];
    }
}

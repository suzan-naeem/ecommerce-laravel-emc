<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        if ($this->method() == 'POST') {
            return [
                'name_ar'   => 'required|between:3,100|unique:categories,name_ar',
                'name_en'   => 'required|between:3,100|unique:categories,name_en',
                'image'     => 'required|image',
                'display'   => 'required|boolean',
            ];
        } else {
            return [
                'name_ar'   => 'required|between:3,100|unique:categories,name_ar,' . $this->route('category'),
                'name_en'   => 'required|between:3,100|unique:categories,name_en,' . $this->route('category'),
                'image'     => 'nullable|image',
                'display'   => 'required|boolean',
            ];
        }
    }
}

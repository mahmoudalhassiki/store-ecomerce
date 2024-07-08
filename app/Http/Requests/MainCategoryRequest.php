<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required",
            "type" => "required|in:1,2",
            "slug" => "required|unique:categories,slug,".$this->id,
        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('admin/sidebar.you must enter the name'),
            'type.required' => __('admin/sidebar.you must enter the type'),
            'type.in' => __('admin/sidebar.this type does not exist'),
            'slug.required' => __('admin/sidebar.you must enter an slug'),
            'slug.unique' => __('admin/sidebar.the slug has already been used'),
        ];
    }
}

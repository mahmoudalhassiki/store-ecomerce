<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            "parent_id" => "required|exists:categories,id",
            "name" => "required",
            "slug" => "required|unique:categories,slug,".$this->id,
        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('admin/sidebar.you must enter the name'),
            'slug.required' => __('admin/sidebar.you must enter an slug'),
            'slug.unique' => __('admin/sidebar.the slug has already been used'),
            'parent_id.required' => __('admin/sidebar.you must enter the category name'),
            'parent_id.exists' => __('admin/sidebar.this main category does not exist'),
        ];
    }
}

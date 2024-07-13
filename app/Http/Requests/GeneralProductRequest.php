<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralProductRequest extends FormRequest
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
            'name' => 'required|max:100',
            'slug' => 'required|unique:products,slug,'.$this->id,
            'description' => 'required|max:1000',
            'short_description' => 'nullable|max:500',
            'categories' => 'array|min:1',
            'categories.*' => 'numeric|exists:categories,id',
            'tags' => 'nullable|array|min:1',
            'brand_id' => 'required|exists:brands,id',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('admin/sidebar.you must enter the name'),
            'name.max' => __('admin.sidebar.you exceeded the permissible limit'),
            'slug.required' => __('admin/sidebar.you must enter an slug'),
            'slug.unique' => __('admin/sidebar.this type does not exist'),
            'descrption.required' =>  __('admin/sidebar.this field is required'),
            'descrption.max' => __('admin.sidebar.you exceeded the permissible limit'),
            'short_descrption.max' => __('admin.sidebar.you exceeded the permissible limit'),
            'categories.array' => __('admin/sidebar.this field is an array'),
            'categories.min' =>  __('admin/sidebar.this field is required'),
            'tags.array' => __('admin/sidebar.this field is an array'),
            'tags.min' =>  __('admin/sidebar.this field is required'),
            'brand_id.required' =>  __('admin/sidebar.this field is required'),
            'brand_id.exists' => __('admin/sidebar.this brand does not exist'),

        ];
    }

}

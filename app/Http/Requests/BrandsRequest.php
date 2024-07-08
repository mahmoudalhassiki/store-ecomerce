<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandsRequest extends FormRequest
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
            "photo" => "required_without:id|mimes:jpg, jpeg, png",
        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('admin/sidebar.you must enter the name'),
            'photo.required_without' => __('admin/sidebar.you must enter an photo'),
        ];
    }
}

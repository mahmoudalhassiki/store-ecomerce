<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingsRequest extends FormRequest
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
            'id' => 'required|exists:settings',
            'value' => 'required',
            'plain_value' => 'nullable|numeric'
        ];
    }
    public function messages()
    {
        return[
            "id.exist" => __('admin/sidebar.something went wrong, please contact your system administrator'),
            //'id.exist' => "يوجد خطأ ما يرجى التصالى بمدير النظام",
            "value.required" => __('admin/sidebar.you must enter the name'),
            "plain_value.numeric" => __('admin/sidebar.must be numbers'),
        ];

    }
}

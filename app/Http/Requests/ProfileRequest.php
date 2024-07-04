<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$this -> id,
            'password' => 'nullable|confirmed|min:8'
        ];
    }
    public function messages()
    {
        return [
            "name.required" => __('admin/sidebar.you must enter the name'),
            'email.required' => __('admin/sidebar.you must enter an email'),
            'email.email' => __('admin/sidebar.email format is incorrect'),
            'email.unique' => __('admin/sidebar.the email has already been used'),
            'password.confirmed' => __('admin/sidebar.the password must be confirmed'),
            'password.min' => __('admin/sidebar.password at least 8 characters'),
        ];
    }
}

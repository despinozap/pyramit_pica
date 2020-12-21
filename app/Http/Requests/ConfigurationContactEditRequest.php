<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigurationContactEditRequest extends FormRequest
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
            'name' => 'min:2|max:60|required',
            'subname' => 'min:2|max:60|required',
            'email' => 'min:5|max:255|email|required',
            'phone' => 'min:4|max:255|required',
            'facebook' => 'min:6|max:200|url|required',
            'twitter' => 'min:6|max:200|url|required'
        ];
    }
}

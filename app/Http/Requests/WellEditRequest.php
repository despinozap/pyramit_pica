<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WellEditRequest extends FormRequest
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
            'name' => 'min:8|max:60|required',
            'description' => 'min:20|max:500|required',
            'author' => 'min:4|max:60|required',
            'link' => 'min:6|max:200|url|required'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
             'email' => 'min:5|max:255|email|required',
             'type' => 'min:4|max:255|required',
             'name' => 'min:4|max:255|required',
             'phone' => 'min:4|max:255|required',
             'company' => 'min:2|max:255|required'
         ];
     }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactSendmailRequest extends FormRequest
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
                    'id'    =>  'exists:contacts,id|required',
                    'name'  =>  'min:3|required',
                    'email'  =>  'email|required',
                    'phone'  =>  'min:6|required',
                    'comment'  =>  'min:10|required',
        ];
    }
}

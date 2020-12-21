<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentCreateRequest extends FormRequest
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
            'title' => 'min:8|max:60|required',
            'category' => 'required',
            'file' => 'max:10240|mimes:doc,docx,xls,xlsx,pdf|required',
            'image_data' => 'required'
        ];
    }
}

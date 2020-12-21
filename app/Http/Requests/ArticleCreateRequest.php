<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleCreateRequest extends FormRequest
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
            'title' => 'min:8|max:120|required|unique:articles',
            'category_id' => 'required',
            'description' => 'min:20|max:500|required',
            'content' => 'min:20|required',
            'image_data' => 'required'
        ];
    }
}

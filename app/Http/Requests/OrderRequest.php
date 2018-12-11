<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'message' => 'required|string|min:3',
            'file' => 'nullable|file',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    /*public function messages()
    {
        return [
            'title.required' => 'Заполните поле Тема',
            'message.required' => 'Заполните поле Текст сообщения',
            'message.min:3' => 'Поле Текст сообщения должно содержать минимум 3 символа',
        ];
    }*/
}

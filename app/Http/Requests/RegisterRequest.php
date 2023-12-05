<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Controllers\API\Response;

class RegisterRequest extends FormRequest
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


    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            $response = Response::SendResponse(422, 'Error while submitting your data', $validator->messages()->all());
            throw new HttpResponseException($response);
        }

        parent::failedValidation($validator);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|min:4|max:255',
            'phone'=>'required|size:11|unique:users',
            'username'=>'required|min:4|max:255|unique:users',
            'email'=>'required|min:4|max:255|unique:users|email',
            'password'=>'required|min:4|max:255',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Http\Controllers\API\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddressRequest extends FormRequest
{

    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            $response = Response::SendResponse(422, 'Error while submitting your data', $validator->messages()->all());
            throw new HttpResponseException($response);
        }

        parent::failedValidation($validator);
    }


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
            'street'=>'required|min:5|max:255',
            'city'=>'required|min:5|max:255',
            'government'=>'required|min:5|max:255',
            'zip_code'=>'required|digits:5|numeric',
        ];
    }
}

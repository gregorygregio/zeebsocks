<?php

namespace App\Http\Requests;

use App\Rules\ZipCodeExists;
use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{

    const ADDRESS_NUMBER_MAX_DIGITS = 5;
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
            'number' => 'required|max:' . self::ADDRESS_NUMBER_MAX_DIGITS,
            'state' => 'required|max:2|exists:states,sigla',
            'country' => 'required|in:BRA',
            'zipcode' => [ 'required', new ZipCodeExists, "max:10" ],
        ];
    }





    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [

            'number.required' => 'É necessário informar o número do endereço',
            'number.max'  => "O número do endereço deve ter no máximo ".self::ADDRESS_NUMBER_MAX_DIGITS." dígitos",

            'state.required' => 'É necessário informar um estado',
            'state.max'  => "O estado deve ser informado por sua sigla, contendo 2 dígitos",
            'state.exists'  => "O estado informado não é válido",

            'country.required'  => "É necessário informar um país",
            'country.in'  => "O país informado é inválido",

            'zipcode.required'  => "É necessário informar um CEP",
            'zipcode.max'  => "O CEP informado é inválido",
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class ProductRequest extends FormRequest
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
            'color' => [
                'bail',
                'required',
                'max:20',
                //TODO: Sanitize
                //TODO: fix price validation issue(1.111)
                Rule::unique('products', 'color')
                    ->where('size', $this->input('size'))
                    ->where('price', $this->input('price'))
            ],
            'productType' => 'required|max:20',
            'size'        => 'required|max:20',
            'price'       => 'required|numeric|max:10000'
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
            'color.unique'  => 'Color, size and price must be unique',
            'price.max'     => 'Price limit is 10000',
            '*.max'         => 'Length limit is 20 chars',
            '*.required'    => 'productType, color, size and price fields are required',
            'price|numeric' => 'Price field must be numeric',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(response()->json(
            ['errors' => $errors],
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}

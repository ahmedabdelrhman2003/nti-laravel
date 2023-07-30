<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => ['required','unique:products','max:255'],
            'brand' => ['required','string'],
            'price' => ['required','numeric','min:0.5'],
            'code' => ['required','integer',"unique:products,code,id"],
            'quantity' => ['required','integer'],
            'desc' => ['required','string'],
            'image'=>['nullable','mimes:png,jpg,jpeg']
        ];
    }
}
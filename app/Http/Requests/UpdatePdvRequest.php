<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePdvRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "id" => "required|exists:pdvs,id",
            "name" => "required|max:128",
            "cep" => "required|string|max:8",
            "city" => "exists:cities,id",
            "address" => "required|string|max:128",
            "number" => "required|string|max:32",
            "complement" => "max:128",
            "district" => "required|string|max:128",
            "flag" => "exists:flags,id",
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyProfileRequest extends FormRequest
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
            'company_name'      => 'required|string|max:255',
            'email'             => 'required|email|max:255|unique:users,email,' . $this->user()->id,
            'address'           => 'nullable|string|max:255',
            'website'           => 'nullable|string|max:255',
            'representative'    => 'nullable|string|max:255',
            'employee'          => 'nullable|integer',
            'capital'           => 'nullable|numeric',
            'annualsales'       => 'nullable|numeric',
            'description'       => 'nullable|string',
            'avatar'            => 'mimes:jpeg,jpg,png,gif|max:1048'
        ];
    }
}

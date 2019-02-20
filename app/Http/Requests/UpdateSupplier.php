<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplier extends FormRequest
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
            'nama' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('supplier')->ignore($this->supplier),
            ],
            'city_id' => 'required|integer',
            'tahun_lahir' => 'required|integer',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'nama' => 'Nama',
            'email' => 'Email',
            'city_id' => 'Kota Asal',
            'tahun_lahir' => 'Tahun Kelahiran',
        ];
    }
}

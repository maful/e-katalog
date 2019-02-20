<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
            'supplier_id' => 'required|integer',
            'harga_jual' => 'required|integer',
            'status' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:1024',
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
            'supplier_id' => 'Supplier',
            'harga_jual' => 'Harga Jual',
            'gambar' => 'Gambar',
        ];
    }
}

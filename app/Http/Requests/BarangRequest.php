<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama_barang' => [
              'required', 'unique:barang', 'string'
            ],
            'stok_barang' => [
              'required','integer'
            ],
            'tahun_barang' =>[
              'required','string'
            ],
            'harga_barang' =>[
              'required','integer'
            ],
            'id_status' =>[
              'required','integer'
            ],
            'foto_barang' =>[
              'image'
            ]
        ];
    }
}

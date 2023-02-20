<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
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
            'supplier_id' => 'required|string',
            'purchase_type' => 'required|string',
            'purchase_dp' => 'nullable|string',
            'subtotal' => 'required|string',
            'paid' => 'required|string',
            'remain' => 'required|string',
            'chalan_number' => 'required|string'
        ];
    }
}
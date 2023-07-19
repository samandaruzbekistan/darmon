<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'name' => 'required|string',
            'sex' => 'required|string',
            'phone' => 'required|numeric|digits:12',
            'phone2' => 'required|numeric|digits:12',
            'birth_date' => 'required|date',
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date',
            'doctor' => 'required|string',
            'ward_id' => 'required|numeric',
            'block_id' => 'required|numeric',
            'region_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'quarter_id' => 'required|numeric',
        ];
    }
}

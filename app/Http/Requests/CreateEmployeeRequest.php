<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class CreateEmployeeRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'identify' => 'required|numeric',
            'password' => 'required|string',
            'dob' => 'required|date',
            'address' => 'required|string',
            'phone' => 'required|numeric',
        ];
    }

    public function prepareForValidation()
    {
            // dd($this->password);
        if($this->password == null) {
            $this->request->remove('password');
        }else{
            $this->password = Hash::make($this->password);

        }
    }
}

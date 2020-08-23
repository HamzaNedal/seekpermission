<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeReqest extends FormRequest
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
            'email' => 'required|email|unique:users,email,'.$this->id,
            'identify' => 'required|numeric',
            // 'dob' => 'required|date',
            'address' => 'required|string',
            'phone' => 'required|numeric',
        ];
    }

    public function prepareForValidation()
    {
        if($this->password == null) {
            $this->request->remove('password');
        }else{
            $this->request['password'] = Hash::make($this->request['password']);
        }
    }
}

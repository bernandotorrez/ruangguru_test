<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitSubmissionRequest extends FormRequest
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
            'user_id' => 'required',
            'delivery_address' => 'required|max:500|min:5',
            'contact_number' => 'required|alpha_num|max:15|min:10',
            'contact_person' => 'required|max:100|min:3',
            'is_eligible' => 'required|digits_between:0,1',
            'user_email' => 'required|min:5|max:100'
        ];
    }
}

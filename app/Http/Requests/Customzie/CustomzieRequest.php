<?php

namespace App\Http\Requests\Customzie;

use Illuminate\Foundation\Http\FormRequest;

class CustomzieRequest extends FormRequest
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
            'name'=>['required','min:2','max:255'],
            'phone'=>['required','min:2','max:255'],
            'email'=>['required','min:2','max:255'],
            'city_id'=>['required'],
            'number_of_people'=>['required'],
            'date_from'=>['required'],
            'date_to'=>['required'],
            'message'=>['required','min:2','max:4000'],
            'url'=>['required'],
        ];
    }
}
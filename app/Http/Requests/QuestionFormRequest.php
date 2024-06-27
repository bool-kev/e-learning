<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionFormRequest extends FormRequest
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
        $optRules=['string','nullable'];
        return [
            'intitule'=>['required','string'],
            'opt1'=>$optRules,
            'opt2'=>$optRules,
            'opt3'=>$optRules,
            'opt4'=>$optRules,
            'reponse'=>['required','string']

        ];
    }
}

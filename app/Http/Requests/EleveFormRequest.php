<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EleveFormRequest extends FormRequest
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
        return [
            'nom'=>['string','min:2','nullable'],
            'prenom'=>['string','min:2','nullable'],
            'telephone'=>['string','digits:8','numeric','required','unique:users,telephone'],
            'niveau'=>['required','exists:niveaux,id'],
            'email'=>['email','required','unique:users,email'],
            'password'=>['required','min:4','confirmed'],
        ];
    }
}

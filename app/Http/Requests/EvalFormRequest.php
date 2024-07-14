<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvalFormRequest extends FormRequest
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
            "intitule"=>['required','string','min:4','max:240'],
            'date'=>['required','date_format:Y-m-d\TH:i','after:now'],
            'duree'=>['required','numeric','min:2','max:30'],
            'matiere_id'=>['required','numeric','exists:matieres,id']
        ];

    }
    public function messages(){
        return [
            'matiere_id'=>'La matiere cible n\'existe pas!'
        ];
    }
}

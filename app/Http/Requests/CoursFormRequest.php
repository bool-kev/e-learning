<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursFormRequest extends FormRequest
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
            'titre'=>['required','string','min:4'],
            'description'=>['string','nullable'],
            'content'=>['required','string'],
            'cover'=>['image','max:2048'],
            'files'=>['array','max:5'],
            'files.*'=>['file','mimes:pdf,mp4,avi,webp,png,jpg','max:10240']
        ];
    }

    public function messages()
    {
        return [
            'files.*.max'=>'la taille doit de chaque fichier doit etre <=10Mo',
            'files.*.mimes'=>'les fichiers doivent etre de type pdf,image ou video',
            'files.*.file'=>'type fichier requis',
        ];
    }
}

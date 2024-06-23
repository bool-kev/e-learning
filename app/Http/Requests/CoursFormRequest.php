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
            'cover'=>['nullable','image','max:3072'],
            'files'=>['array','nullable'],
            'files.*'=>['file','mimes:pdf,mp4,avi,webp','nullable']
        ];
    }

    public function messages()
    {
        return [
            'files.*'=>"Tous les fichiers doivent etre de type PDF ou VIDEOS"
        ];
    }
}

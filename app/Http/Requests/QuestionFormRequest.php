<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class QuestionFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user=User::find(14);
        // dd($user->is_staff());
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
            'enonce'=>['required','string'],
            'options'=>['array','max:4'],
            'options.*'=>['string','required'],
            'reponse'=>['required','string'],
            'evaluation_id'=>['required','exists:evaluations,id']
        ];
    }
}

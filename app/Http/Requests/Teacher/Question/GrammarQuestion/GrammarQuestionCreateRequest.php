<?php

namespace App\Http\Requests\Teacher\Question;

use Illuminate\Foundation\Http\FormRequest;

class GrammarQuestionCreateRequest extends FormRequest
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
            'exam_name' => 'required|max:255|string',
            'question_set' => 'required|max:255|string',
            'question' => 'required|max:255|string',
            'option_1' => 'required|max:255|string',
            'option_2' => 'required|max:255|string',
            'option_3' => 'required|max:255|string',
            'answer' => 'required|max:255|string',
        ];
    }
}

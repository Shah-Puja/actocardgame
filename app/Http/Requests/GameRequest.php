<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidCardsRule;
use App\Rules\MinCardsRule;

class GameRequest extends FormRequest
{
    /*
    * Validator instance updated on failedValidation
    *
    * @var \Illuminate\Contracts\Validation\Validator
    */
    public $validator = null;

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
            'player_name'   => 'required|string',
            'player_cards'  => ['required', 'string', new MinCardsRule, new ValidCardsRule]
        ];
    }

    
    /**
     * Overrid Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }
}

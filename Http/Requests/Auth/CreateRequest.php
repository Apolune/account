<?php

namespace Apolune\Account\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * The input keys that should not be flashed on redirect.
     *
     * @var array
     */
    protected $dontFlash = ['password', 'password_confirmation'];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ! $this->container['auth']->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => ['required', 'min:6', 'max:30', 'alphanum', 'contains_alpha', 'unique:accounts,name'],
            'email'     => ['required', 'email', 'max:255', 'unique:accounts'],
            'password'  => ['required', 'min:8', 'max:30', 'contains_alpha', 'contains_nonalpha', 'confirmed'],
            'player'    => ['required', 'min:2', 'max:29', 'alpha_space', 'no_initial_space', 'no_final_space', 'no_multiple_spaces', 
                            'max_words:3', 'short_words', 'long_words', 'no_vowelless_words', 'no_repeated_characters', 'unique:players,name'],
            'sex'       => ['gender'],
            'vocation'  => ['vocation:starter'],
            'town'      => ['town:starter'],
            'world'     => ['world'],
            'terms'     => ['accepted'],
        ];
    }
}

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
            'name'      => ['required', 'min:5', 'max:23', 'unique:accounts'],
            'email'     => ['required', 'email', 'max:255', 'unique:accounts'],
            'password'  => ['required', 'confirmed', 'min:6'],
            'player'    => ['required', 'min:3', 'max:30', 'min_words', 'max_words:3', 'unique:players,name'],
            'sex'       => ['required', 'gender'],
            'vocation'  => ['required', 'vocation:starter'],
            'world'     => ['required', 'world'],
            'terms'     => ['accepted'],
        ];
    }
}

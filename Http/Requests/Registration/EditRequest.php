<?php

namespace Apolune\Account\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->container['auth']->check() and $this->container['auth']->user()->isRegistered();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => ['required', 'min:2', 'max:50', 'alpha_space'],
            'surname'   => ['required', 'min:2', 'max:50', 'alpha_space'],
            'country'   => ['required', 'country'],
            'password'  => ['required', 'current'],
        ];
    }
}

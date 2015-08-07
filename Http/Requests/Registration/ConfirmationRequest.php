<?php

namespace Apolune\Account\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->container['auth']->check() and ! $this->container['auth']->user()->isRegistered() and 
               $this->get('_token') or $this->container['session.store']->getOldInput('_token');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $years = implode(',', [(date('Y') - 105), (date('Y') - 5)]);

        return [
            'firstname' => ['required', 'min:2', 'max:50', 'alpha_space'],
            'surname'   => ['required', 'min:2', 'max:50', 'alpha_space'],
            'country'   => ['required', 'country'],
            'day'       => ['required', 'integer', 'range:0,31'],
            'month'     => ['required', 'integer', 'range:1,12'],
            'year'      => ['required', 'integer', 'range:'.$years],
            'gender'    => ['required', 'gender'],
        ];
    }

    /**
     * Validate the class instance.
     *
     * @return void
     */
    public function validate()
    {
        $instance = $this->getValidatorInstance();

        if (! $this->passesAuthorization()) {
            $this->failedAuthorization();
        } elseif ($this->method() === 'POST' and ! $instance->passes()) {
            $this->failedValidation($instance);
        }
    }
}

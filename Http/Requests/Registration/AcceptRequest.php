<?php

namespace Apolune\Account\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class AcceptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->container['auth']->check() and $this->container['auth']->user()->canAcceptPendingRegistration();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}

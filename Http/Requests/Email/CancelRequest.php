<?php

namespace Apolune\Account\Http\Requests\Email;

use Illuminate\Foundation\Http\FormRequest;

class CancelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->container['auth']->check() and $this->container['auth']->user()->hasPendingEmail();
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

    /**
     * Get the response for a forbidden operation.
     *
     * @return \Illuminate\Http\Response
     */
    public function forbiddenResponse()
    {
        if ($this->container['request']->ajax()) {
            return new Response('Forbidden', 403);
        }

        return redirect('/account/email');
    }
}

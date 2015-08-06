<?php

namespace Apolune\Account\Http\Requests\Player;

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
        return $this->container['auth']->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'hide'      => ['in:on'],
            'comment'   => ['min:5', 'max:300', 'string'],
            'signature' => ['min:5', 'max:300', 'string'],
        ];
    }
}

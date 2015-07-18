<?php

namespace Apolune\Account\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        if ($this->has('back')) {
            return [];
        }

        $years = implode(',', [(date('Y') - 105), (date('Y') - 5)]);

        $rules = [
            'firstname' => ['required', 'min:2', 'max:50', 'alpha_space'],
            'surname'   => ['required', 'min:2', 'max:50', 'alpha_space'],
            'country'   => ['required', 'country'],
            'day'       => ['required', 'integer', 'range:0,31'],
            'month'     => ['required', 'integer', 'range:1,12'],
            'year'      => ['required', 'integer', 'range:'.$years],
            'gender'    => ['required', 'in:female,male'],
        ];

        if ($this->has('verify')) {
            $this->flash();
            
            return array_merge($rules, [
                'password' => 'required',
            ]);
        }

        return $rules;
    }
}

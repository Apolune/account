<?php

namespace Apolune\Account\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->container['auth']->check() and ! $this->container['auth']->user()->isRegistered();
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
            'day'       => ['required', 'integer', 'range:0,31'],
            'month'     => ['required', 'integer', 'range:1,12'],
            'year'      => ['required', 'integer', 'range:'.$this->years()],
            'gender'    => ['required', 'in:female,male'],
            'password'  => ['required', 'current'],
        ];
    }

    /**
     * Compile an array of years.
     *
     * @param  integer  $amount  100
     * @return array
     */
    protected function years($amount = 100)
    {
        $start = (date('Y') - ($amount + 5));
        $end   = (date('Y') - 5);

        return sprintf("%d,%d", $start, $end);
    }
}

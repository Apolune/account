<?php

namespace Apolune\Account;

use Carbon\Carbon;
use Apolune\Core\Database\Eloquent\Model;
use Apolune\Contracts\Account\AccountRegistration as Contract;

class AccountRegistration extends Model implements Contract
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '__pandaac_registration';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['account_id', 'firstname', 'surname', 'country', 'birthday', 'gender'];

    /**
     * Retrieve the firstname.
     *
     * @return string
     */
    public function firstname()
    {
        return $this->firstname;
    }

    /**
     * Retrieve the surname.
     *
     * @return string
     */
    public function surname()
    {
        return $this->surname;
    }

    /**
     * Retrieve the country.
     *
     * @return \Apolune\Contracts\Server\Country
     */
    public function country()
    {
        return country($this->country);
    }

    /**
     * Retrieve the country code.
     *
     * @return string
     */
    public function countryCode()
    {
        return $this->country;
    }

    /**
     * Retrieve the birthday.
     *
     * @return \Carbon\Carbon
     */
    public function birthday()
    {
        return new Carbon($this->birthday);
    }

    /**
     * Retrieve the gender.
     *
     * @return string
     */
    public function gender()
    {
        return $this->gender;
    }

    /**
     * Retrieve the requested date.
     *
     * @return \Carbon\Carbon
     */
    public function requestDate()
    {
        $days = config('pandaac.apolune.account.registration-days');

        return (new Carbon($this->request_date))->addDays($days);
    }

    /**
     * Retrieve the requested firstname.
     *
     * @return string
     */
    public function requestFirstname()
    {
        return $this->request_firstname;
    }

    /**
     * Retrieve the requested surname.
     *
     * @return string
     */
    public function requestSurname()
    {
        return $this->request_surname;
    }

    /**
     * Retrieve the requested country.
     *
     * @return \Apolune\Contracts\Server\Country
     */
    public function requestCountry()
    {
        return country($this->request_country);
    }

    /**
     * Retrieve the requested country code.
     *
     * @return string
     */
    public function requestCountryCode()
    {
        return $this->request_country;
    }
}

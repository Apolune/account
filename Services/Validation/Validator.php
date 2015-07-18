<?php

namespace Apolune\Account\Services\Validation;

class Validator
{
    /**
     * A validation rule that checks the validity of a country.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    public function validateCountry($attribute, $value, array $parameters)
    {
        return (boolean) country($value);
    }

    /**
     * A validation rule that checks the validity of a gender.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    public function validateGender($attribute, $value, array $parameters)
    {
        return (boolean) gender($value);
    }

    /**
     * A validation rule that checks the validity of a vocation.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    public function validateVocation($attribute, $value, array $parameters)
    {
        return (boolean) vocation($value, !! head($parameters));
    }

    /**
     * A validation rule that checks the validity of a world.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    public function validateWorld($attribute, $value, array $parameters)
    {
        return (boolean) world($value);
    }

    /**
     * A validation rule that checks that at least X words are present.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    public function validateMinWords($attribute, $value, array $parameters)
    {
        return (boolean) (str_word_count($value) >= ((int) head($parameters) ?: 1));
    }

    /**
     * A validation rule that checks that no more than X words are present.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    public function validateMaxWords($attribute, $value, array $parameters)
    {
        return (boolean) (str_word_count($value) <= ((int) head($parameters) ?: 1));
    }

    /**
     * A validation rule that checks if the value contains only alphabetical characters and spaces.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    public function validateAlphaSpace($attribute, $value, array $parameters)
    {
        return preg_match('/^([a-z ]+)$/i', $value);
    }

    /**
     * A validation rule that checks if the value contains at least one alphabetical character.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    public function validateContainsAlpha($attribute, $value, array $parameters)
    {
        return preg_match('/([a-z]+)/i', $value);
    }

    /**
     * A validation rule that checks if the value contains at least one non-alphabetical character.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    public function validateContainsNonalpha($attribute, $value, array $parameters)
    {
        return preg_match('/([^a-z]+)/i', $value);
    }

    /**
     * A validation rule that makes sure the value doesn't contain a leading space.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    public function validateNoInitialSpace($attribute, $value, array $parameters)
    {
        return ! preg_match('/^\s/', $value);
    }

    /**
     * A validation rule that makes sure the value doesn't end with a space.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    public function validateNoFinalSpace($attribute, $value, array $parameters)
    {
        return ! preg_match('/\s$/', $value);
    }

    /**
     * A validation rule that makes sure the words only have one space inbetween them.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    public function validateNoMultipleSpaces($attribute, $value, array $parameters)
    {
        return ! preg_match('/\b\s{2,}\b/', $value);
    }

    /**
     * A validation rule that makes sure every word is at least X characters long.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    public function validateShortWords($attribute, $value, array $parameters)
    {
        $length = (int) head($parameters) ?: 1;

        return ! preg_match(sprintf('/(^|\s)(\w){%d}(\s|$)/', $length), $value);
    }

    /**
     * A validation rule that makes sure every word is no more than X characters long.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    public function validateLongWords($attribute, $value, array $parameters)
    {
        $length = (int) head($parameters) ?: 15;

        return ! preg_match(sprintf('/\S{%d,}/', $length), $value);
    }

    /**
     * A validation rule that makes sure every word contains at least one vowel.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    public function validateNoVowellessWords($attribute, $value, array $parameters)
    {
        return ! preg_match('/(^|\s)([^aeiou\s]+)(\s|$)/i', $value);
    }

    /**
     * A validation rule that makes sure the value doesn't contain any successively repeated characters.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    public function validateNoRepeatedCharacters($attribute, $value, array $parameters)
    {
        $length = (int) head($parameters) ?: 2;

        return ! preg_match(sprintf('/(.)\1{%d,}/', $length), $value);
    }

    /**
     * A validation rule that makes sure the values is within the specified boundaries.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @return void
     */
    public function validateRange($attribute, $value, array $parameters)
    {
        list($min, $max) = array_values($parameters);

        return in_array($value, range($min, $max));
    }
}

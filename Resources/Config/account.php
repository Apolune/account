<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Account Verification
    |--------------------------------------------------------------------------
    |
    | Whether to send an email containing a verification code when a new account
    | is created or not. This is enabled by default.
    |
    */
   
    'verification-notification' => true,

    /*
    |--------------------------------------------------------------------------
    | Accepted Email Address
    |--------------------------------------------------------------------------
    |
    | Whether to send an email containing a new password when an user accepts
    | their new email address or not. This is enabled by default.
    |
    */
   
    'accepted-notification' => true,

    /*
    |--------------------------------------------------------------------------
    | Account Registration
    |--------------------------------------------------------------------------
    |
    | The amount of days in which the user needs to wait before they may accept 
    | their new registration data. If set to false or 0, registration changes
    | will take effect immediately.
    |
    */
   
    'registration-days' => 5,

    /*
    |--------------------------------------------------------------------------
    | Email Change
    |--------------------------------------------------------------------------
    |
    | The amount of days in which the user needs to wait before they may accept 
    | their new email address. If set to false or 0, email address changes
    | will take effect immediately.
    |
    */
   
    'emailchange-days' => 5,

    /*
    |--------------------------------------------------------------------------
    | Account & Character Deletion
    |--------------------------------------------------------------------------
    |
    | The amount of days in which the user needs to wait before their account
    | is terminated, or their character is deleted. If set to false or 0,
    | termination & deletions will take effect immediately.
    |
    */
   
    'deletion-days' => 10,

];

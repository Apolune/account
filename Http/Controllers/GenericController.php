<?php

namespace Apolune\Account\Http\Controllers;

use Apolune\Core\Http\Controllers\Controller;

class GenericController extends Controller
{
    /**
     * Show the download client page.
     *
     * @return \Illuminate\Http\Response
     */
    public function download()
    {
        return view('theme::account.download');
    }
}

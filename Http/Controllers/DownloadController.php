<?php

namespace Apolune\Account\Http\Controllers;

use Apolune\Core\Http\Controllers\Controller;

class DownloadController extends Controller
{
    /**
     * Show the download client page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('theme::account.download');
    }
}

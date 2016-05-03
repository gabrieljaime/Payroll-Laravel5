<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

abstract class Controller extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Base Controller Call and Entendor
    |--------------------------------------------------------------------------
    |
    | Create Controllers to extent this Class
    |
    */
    use DispatchesCommands, ValidatesRequests;

    function _construct()
    {
        view()->share('signedIn', Auth::check());
        view()->share('user', Auth::user());

    }


}

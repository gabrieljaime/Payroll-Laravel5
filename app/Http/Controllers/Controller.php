<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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

}

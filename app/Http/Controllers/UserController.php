<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Employees;
use App\Models\EstadosRevista;
use App\Payrool\Entities\Liquidacion;
use Carbon\Carbon;

class UserController extends Controller {

//NEW AUTH

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = \Auth::user();
        $userRole = $user->hasRole('user');
        $editorRole = $user->hasRole('editor');
        $adminRole = $user->hasRole('administrator');

        if ($userRole)
        {
            $access = 'User';
        } elseif ($editorRole)
        {
            $access = 'Editor';
        } elseif ($adminRole)
        {
            $access = 'Administrator';
        }
        $today = Carbon::today();
        $año = $today->year;                                         // int(2012)
        $mes = $today->month;
        $Activos =Employees::Activos()->count();
        $Bajas = EstadosRevista::BajasDelMes($año,$mes)->count();
        $AltasNuevas = Employees::Activos()->get()->sortBy('Fecha_Ingreso')->forPage(1, 8);
        $Liquidaciones = Liquidacion::where('año',$año)->where('mes','<=',12)->whereNull('deleted_at')->orderBy('mes')->get();
        $UltimaLiquidacion= Liquidacion::where('año',$año)->where('mes','<=',12)->whereNull('deleted_at')->orderBy('mes', 'desc')->first();
        $AnteUltimaLiquidacion= Liquidacion::where('año',$año)->where('mes','<=',$UltimaLiquidacion->mes)->whereNull('deleted_at')->orderBy('mes', 'desc')->first();
        $Meses=$Liquidaciones->sortByDesc('mes')->lists('mes');
        $Reten=$Liquidaciones->sortByDesc('mes')->lists('total_retenciones')->toArray();
        $Debes=$Liquidaciones->sortByDesc('mes')->lists('total_debes')->toArray();



        setlocale(LC_TIME, 'Spanish');
        $MesesEsp=[];
        foreach ($Meses as $MesEsp)
        {
            $MesesEsp=array_prepend($MesesEsp,'"'.Carbon::createFromDate($año,$MesEsp,1)->formatLocalized('%B').'"');
        }

        return view('admin.pages.user-home', compact('Activos','Bajas','AltasNuevas', 'Liquidaciones','UltimaLiquidacion','AnteUltimaLiquidacion','MesesEsp','Debes','Reten'))->withUser($user)->withAccess($access);
    }

    public function getHome()
    {
        return view('admin.pages.user-home');
    }

//OLD LTE

    /**
     * Show the User DASHBOARD Page
     *
     * @return View
     */
    public function showUserDashboard()
    {
        return view('admin.layouts.dashboard');
    }

    /**
     * Show the User PROFILE Page
     *
     * @return View
     */
    public function showUserProfile()
    {
        return view('admin.layouts.user-profile');
    }

    public function show($id)
    {
        //
    }

}

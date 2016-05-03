<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
| http://laravel.com/docs/5.1/authentication
| http://laravel.com/docs/5.1/authorization
| http://laravel.com/docs/5.1/routing
| http://laravel.com/docs/5.0/schema
| http://socialiteproviders.github.io/
|
*/

// HOMEPAGE ROUTE

Route::get('/', function ()
{
    return redirect('/auth/login');
});

Route::get('/recibo/', function ()
{
    $pdf = PDF2::loadView('reports.recibos.recibo')->setPaper('a4', 'landscape')
        ->setOption('margin-left',15)
        ->setOption('margin-right',15)
        ->setOption('margin-bottom', 2)
        ->setOption('margin-top', 2)
        ->setOption('grayscale', true);

    return $pdf->stream();
});
Route::get('/printRecibo/{legajo}/{anio}/{mes}', 'ReportController@printrecibo');
Route::get('/printRecibos/{anio}/{mes}', 'ReportController@printrecibos');

Route::get('/downloadRecibo/{legajo}/{anio}/{mes}', 'ReportController@downloadrecibo');



route::get('/createemployees', function ()
{
    $pdf = PDF2::loadView('reports.createemployees');

    return $pdf->stream();
});


Route::get('/twitter', function ()
{

    return Twitter::getUserTimeline(['screen_name' => 'jeremyekenedy', 'count' => 20, 'format' => 'json']);

    //return Twitter::getHomeTimeline(['count' => 20, 'format' => 'json']);

    //return Twitter::getMentionsTimeline(['count' => 20, 'format' => 'json']);

    //return Twitter::postTweet(['status' => 'Laravel is beautiful', 'format' => 'json']);

});


// ALL AUTHENTICATION ROUTES - HANDLED IN THE CONTROLLERS
Route::controllers([
    'auth'     => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
// REGISTRATION EMAIL CONFIRMATION ROUTES
Route::get('/resendEmail', [
    'as'   => 'user',
    'uses' => 'Auth\AuthController@resendEmail'
]);
Route::get('/activate/{code}', [
    'as'   => 'user',
    'uses' => 'Auth\AuthController@activateAccount'
]);

// CUSTOM REDIRECTS
Route::get('restart', function ()
{
    \Auth::logout();

    return redirect('auth/register')->with('anError', \Lang::get('auth.loggedOutLocked'));
});
Route::get('another', function ()
{
    \Auth::logout();

    return redirect('auth/login')->with('anError', \Lang::get('auth.tryAnother'));
});

// LARAVEL SOCIALITE AUTHENTICATION ROUTES
Route::get('/social/redirect/{provider}', [
    'as'   => 'social.redirect',
    'uses' => 'Auth\AuthController@getSocialRedirect'
]);
Route::get('/social/handle/{provider}', [
    'as'   => 'social.handle',
    'uses' => 'Auth\AuthController@getSocialHandle'
]);

// AUTHENTICATION ALIASES/REDIRECTS
Route::get('login', function ()
{
    return redirect('/auth/login');
});
Route::get('logout', function ()
{
    return redirect('/auth/logout');
});
Route::get('register', function ()
{
    return redirect('/auth/register');
});
Route::get('reset', /**
 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
 */
    function ()
    {
        return redirect('/password/email');
    });
Route::get('admin', function ()
{
    return redirect('/dashboard');
});
Route::get('home', function ()
{
    return redirect('/dashboard');
});

// USER PAGE ROUTES - RUNNING THROUGH AUTH MIDDLEWARE
Route::group(['middleware' => 'auth'], function ()
{

    // USER DASHBOARD ROUTE
    Route::get('/dashboard', [
        'as'   => 'dashboard',
        'uses' => 'UserController@index'
    ]);


//For DataTables data
    Route::get('empresas/data', 'EmpresaController@data');

    Route::resource('empresas', 'EmpresaController');

    Route::get('empresas/{id}/delete', [
        'as' => 'empresas.delete',
        'uses' => 'EmpresaController@destroy',
    ]);

    Route::match(['get', 'post'],'recibos/', [
        'as' => 'reports.recibos',
        'uses' => 'ReciboController@index',
    ]);



    //Employees Routes

    Route::get('employees/data/{TODOS}', 'EmployeesController@data');
    Route::patch('employees/cambiar_revista/{id} ', [
        'as'   => 'employees.cambiar_revista',
        'uses' => 'EmployeesController@cambiar_revista',
    ]);
    Route::resource('employees', 'EmployeesController');

    Route::get('employees/{id}/delete', [
        'as'   => 'employees.delete',
        'uses' => 'EmployeesController@destroy',
    ]);

    // ComboOptions Route
    //For DataTables data
    Route::get('comboOptions/data', 'ComboOptionController@data');
    Route::resource('comboOptions', 'ComboOptionController');

    Route::get('comboOptions/{id}/delete', [
        'as'   => 'comboOptions.delete',
        'uses' => 'ComboOptionController@destroy',
    ]);

    // ComboTypes Route
    //For DataTables data
    Route::get('comboTypes/data', 'ComboTypeController@data');

    Route::resource('comboTypes', 'ComboTypeController');

    Route::get('comboTypes/{id}/delete', [
        'as'   => 'comboTypes.delete',
        'uses' => 'ComboTypeController@destroy',
    ]);
//For DataTables data
    Route::get('obrasSociales/data', 'ObraSocialController@data');

    Route::resource('obrasSociales', 'ObraSocialController');

    Route::get('obrasSociales/{id}/delete', [
        'as'   => 'obrasSociales.delete',
        'uses' => 'ObraSocialController@destroy',
    ]);
//For DataTables data
    Route::get('categories/data', 'CategoryController@data');
    Route::get('categories/specialities/{id}', 'CategoryController@specialities');
    Route::resource('categories', 'CategoryController');


    Route::get('conceptos/categorias/dataFijo/{categoria}', 'ConceptoCategoryController@dataFijo');
    Route::get('conceptos/categorias/data', 'ConceptoCategoryController@data');

    Route::resource('conceptos/categorias', 'ConceptoCategoryController');

    Route::get('conceptos/categories/{id}/delete', [
        'as'   => 'categories.delete',
        'uses' => 'CategoryController@destroy',
    ]);

    Route::get('categories/{id}/delete', [
        'as'   => 'categories.delete',
        'uses' => 'CategoryController@destroy',
    ]);

    Route::get('conceptofijo/{id}/delete', [
        'as'   => 'conceptofijo.delete',
        'uses' =>  'ConceptoFijoController@destroy',
    ]);
    Route::patch('conceptofijo/{concepto}/{empleado}', [
    'as'   => 'conceptofijo.update',
    'uses' =>  'ConceptoFijoController@update',
    ]);


    Route::resource('conceptofijo', 'ConceptoFijoController');

    Route::get('conceptovariable/{id}/delete', [
        'as'   => 'conceptovariable.delete',
        'uses' => 'ConceptoVariableController@destroy',
    ]);

    Route::resource('conceptovariable', 'ConceptoVariableController');

    Route::get('conceptos/asignacion/datafijo/{legajos}/{conceptos}', 'ConceptoFijoController@data');
    Route::get('conceptos/asignacion/datavariable/{month}/{year}/{legajos}/{conceptos}', 'ConceptoVariableController@data');

    Route::resource('conceptos/asignacion', 'AsignacionConceptoController');


        Route::post('liquidacion/liquidar',
        [
            'as'   => 'liquidacion.liquidar',
            'uses' => 'LiquidacionController@liquidar'
        ]
    );
    Route::resource('liquidacion', 'LiquidacionController');


//For DataTables data
    Route::get('conceptosRevista/data', 'concepto_revistaController@data');

    Route::resource('conceptosRevista', 'concepto_revistaController');

    Route::get('conceptosRevista/{id}/delete', [
        'as' => 'conceptosRevista.delete',
        'uses' => 'concepto_revistaController@destroy',
    ]);

//For DataTables data
    Route::get('conceptos/data', 'ConceptoController@data');

    Route::resource('conceptos', 'ConceptoController');

    Route::get('conceptos/{id}/delete', [
        'as'   => 'conceptos.delete',
        'uses' => 'ConceptoController@destroy',
    ]);


//For DataTables data
    Route::get('specialties/data', 'SpecialtyController@data');



    Route::resource('specialties', 'SpecialtyController');

    Route::get('specialties/{id}/delete', [
        'as'   => 'specialties.delete',
        'uses' => 'SpecialtyController@destroy',
    ]);

    // USERS VIEWABLE PROFILE
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@show'
    ]);
    Route::get('dashboard/profile/{username}', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@show'
    ]);

    // MIDDLEWARE INCEPTIONED - MAKE SURE THIS IS THE CURRENT USERS PROFILE TO EDIT
    Route::group(['middleware' => 'currentUser'], function ()
    {
        Route::resource(
            'profile',
            'ProfilesController', [
                'only' => [
                    'show',
                    'edit',
                    'update'
                ]
            ]
        );
    });

});

// ADMINISTRATOR ACCESS LEVEL PAGE ROUTES - RUNNING THROUGH ADMINISTRATOR MIDDLEWARE
Route::group(['middleware' => 'administrator'], function ()
{

    // SHOW ALL USERS PAGE ROUTE
    Route::resource('users', 'UsersManagementController');
    Route::get('users', [
        'as'   => '{username}',
        'uses' => 'UsersManagementController@showUsersMainPanel'
    ]);

    // EDIT USERS PAGE ROUTE
    Route::get('edit-users', [
        'as'   => '{username}',
        'uses' => 'UsersManagementController@editUsersMainPanel'
    ]);

    // TAG CONTROLLER PAGE ROUTE
    Route::resource('admin/skilltags', 'SkillsTagController', ['except' => 'show']);

    // TEST ROUTE ONLY ROUTE
    Route::get('administrator', function ()
    {
        echo 'Welcome to your ADMINISTRATOR page ' . Auth::user()->email . '.';
    });

});

// EDITOR ACCESS LEVEL PAGE ROUTES - RUNNING THROUGH EDITOR MIDDLEWARE
Route::group(['middleware' => 'editor'], function ()
{

    //TEST ROUTE ONLY
    Route::get('editor', function ()
    {
        echo 'Welcome to your EDITOR page ' . Auth::user()->email . '.';
    });

});

// CATCH ALL ERROR FOR USERS AND NON USERS
Route::any('/{page?}', function ()
{
    if (Auth::check())
    {
        return view('admin.errors.users404');
    } else
    {
        return View('errors.404');
    }
})->where('page', '.*');



//***************************************************************************************//
//***************************** USER ROUTING EXAMPLES BELOW *****************************//
//***************************************************************************************//

//** OPTION - ALL FOLLOWING ROUTES RUN THROUGH AUTHETICATION VIA MIDDLEWARE **//
/*
Route::group(['middleware' => 'auth'], function () {

	// OPTION - GO DIRECTLY TO TEMPLATE
	Route::get('/', function () {
	    return view('pages.user-home');
	});

	// OPTION - USE CONTROLLER
	Route::get('/', [
	    'as' 			=> 'user',
	    'uses' 			=> 'UsersController@index'
	]);

});
*/
//** OPTION - SINGLE ROUTE USING A CONTROLLER AND AUTHENTICATION VIA MIDDLEWARE **//
/*
Route::get('/', [
    'middleware' 	=> 'auth',
    'as' 			=> 'user',
    'uses' 			=> 'UsersController@index'
]);
*/












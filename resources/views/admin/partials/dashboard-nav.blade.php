<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle buttonLara -->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </a>
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">

      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <span class="glyphicon glyphicon-user"></span><span class="hidden-xs">
                    {!! HTML::show_username() !!}

                  </span>	<span class="caret"></span>


        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header bg-light-blue">
           <img src="/storage/legajos/@if(is_null(Auth::user()->Empleado->photo)or Auth::user()->Empleado->photo=="" )icon-user-default.png @else{{Auth::user()->Empleado->photo}} @endif" alt="User Image" class="profile-user-img img-responsive img-circle">


            <p>
              {{ (Auth::user()->name === Auth::user()->email) ? ((is_null(Auth::user()->first_name)) ? (Auth::user()->name) : (Auth::user()->first_name)) : (((is_null(Auth::user()->name)) ? (Auth::user()->email) : (Auth::user()->name))) }}

              <small>{{\App\Models\Category::find(Auth::user()->Empleado->categoria)->category}}    {{\App\Models\Specialty::find(Auth::user()->Empleado->subcategoria)->specialty}} </small>
               <small>Usuario desde  {{Lang::get('meses.'.Auth::user()->created_at->format('F')).' '.Auth::user()->created_at->format('Y')}}
               </small>
            </p>
          </li>
          <!-- Menu Body -->
          {{--                   <li class="user-body">
                              <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                              </div>
                              <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                              </div>
                              <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                              </div>
                            </li> --}}
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="/employees/{{Auth::user()->employees_id}}/edit" class="btn btn-default">Editar Legajo</a>
            </div>
            <div class="pull-right">
              <a href="/logout" class="btn btn-default "> <span class="fa fa-sign-out text-red"></span>Salir</a>
            </div>
          </li>
        </ul>
      </li>
      <!-- Control Sidebar Toggle Button -->
      {{--<li>--}}
        {{--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>--}}
      {{--</li>--}}
    </ul>
  </div>
</nav>
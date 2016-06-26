{{--  LEFT SIDEBAR WITH AVIGATION AND LOGO --}}
<aside class="main-sidebar">

    {{--  SIDEBAR: style can be found in sidebar.less --}}
    <section class="sidebar">

        {{--  GRAVATAR AND USE STATUS PANEL --}}
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/storage/legajos/@if(is_null(Auth::user()->Empleado->photo)or Auth::user()->Empleado->photo=="" )icon-user-default.png @else{{Auth::user()->Empleado->photo}} @endif" alt="User Image" class="profile-user-img img-responsive img-circle">



            </div>
            <div class="pull-left info">
                <p>
                    {{ Lang::get('sidebar-nav.user-panel_hello') }}   {!! HTML::show_username() !!}
                </p>
                 <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
            </div>
        </div>

        {{-- SIDEBAR SEARCH FORM --}}
        @include('admin.forms.sidebar-search')

        {{-- SIDEBAR NAVIGATION: style sidebar.less --}}
        <ul class="sidebar-menu">

            <li class="header">
                {{ Lang::get('sidebar-nav.nav_title') }}
            </li>

            <li {{ (Request::is('dashboard') ? ' class=active' : '') }}>
                {!! HTML::icon_link( "/dashboard", 'fa '.Lang::get('sidebar-nav.link_icon_dashboard'), "<span>".Lang::get('sidebar-nav.link_title_dashboard')."</span>", array('title' => Lang::get('sidebar-nav.link_title_dashboard'))) !!}
            </li>




            @if (Auth::user()->hasRole('administrator'))
                <li class="treeview  {{  (Request::is('employees' ) || Request::is('employees/create' )   ? ' active' : '' ) }} ">
                    {!! HTML::icon_link( "/employees", 'fa '.Lang::get('sidebar-nav.link_icon_employees'), "<span>".Lang::get('sidebar-nav.title_employees')."</span><i class='fa ".Lang::get('sidebar-nav.caret_folded')." pull-right'></i>", array('title' => Lang::get('sidebar-nav.title_conceptos'))) !!}
                    <ul class="treeview-menu">
                        <li  {{ (Request::is('users' ) ? ' class=active' : '')}}>
                            {!! HTML::icon_link( "/employees", 'fa '.Lang::get('sidebar-nav.link_icon_employees_view'), Lang::get('sidebar-nav.link_title_employees_view'), array('title' => Lang::get('sidebar-nav.link_title_employees_view'))) !!}
                        </li>
                        <li {{ (Request::is('conceptos/create' ) ? ' class=active' : '')}} >
                            {!! HTML::icon_link( "/employees/create", 'fa '.Lang::get('sidebar-nav.link_icon_employees_create'), Lang::get('sidebar-nav.link_title_employees_create'), array('title' => Lang::get('sidebar-nav.link_title_employees_create'))) !!}
                        </li>
                        <li {{ (Request::is('recibos' ) ? ' class=active' : '')}} >
                            {!! HTML::icon_link( "/recibos", 'fa '.Lang::get('sidebar-nav.link_icon_recibos_view'), Lang::get('sidebar-nav.link_title_recibos_view'), array('title' => Lang::get('sidebar-nav.link_title_recibos_view'))) !!}
                        </li>
                        <li >
                            {!! HTML::icon_link( "/conceptos/asignacion", 'fa '.Lang::get('sidebar-nav.link_icon_conceptos_asignacion'), Lang::get('sidebar-nav.link_title_conceptos_asignacion'), array('title' => Lang::get('sidebar-nav.link_title_conceptos_asignacion'))) !!}
                        </li>


                    </ul>
                </li>
            @endif
            @if (Auth::user()->hasRole('administrator'))
                <li class="treeview  {{  (Request::is('liquidacion' )   ? ' active' : '' ) }} ">
                    {!! HTML::icon_link( "/liquidacion", 'fa '.Lang::get('sidebar-nav.link_icon_liquidacion'), "<span>".Lang::get('sidebar-nav.title_liquidacion')."</span><i class='fa ".Lang::get('sidebar-nav.caret_folded')." pull-right'></i>", array('title' => Lang::get('sidebar-nav.title_liquidacion'))) !!}
                    <ul class="treeview-menu">
                        <li  {{ (Request::is('liquidacion' ) ? ' class=active' : '')}}>
                            {!! HTML::icon_link( "/liquidacion", 'fa '.Lang::get('sidebar-nav.link_icon_liquidacion_view'), Lang::get('sidebar-nav.link_title_liquidacion_view'), array('title' => Lang::get('sidebar-nav.link_title_liquidacion_view'))) !!}
                        </li>
                        <li {{ (Request::is('conceptos/create' ) ? ' class=active' : '')}} >
                            {!! HTML::icon_link( "/conceptos/create", 'fa '.Lang::get('sidebar-nav.link_icon_conceptos_create'), Lang::get('sidebar-nav.link_title_conceptos_create'), array('title' => Lang::get('sidebar-nav.link_title_conceptos_create'))) !!}
                        </li>
                        <li {{ (Request::is('conceptos/categorias' ) ? ' class=active' : '')}} >
                            {!! HTML::icon_link( "/conceptos/categorias", 'fa '.Lang::get('sidebar-nav.link_icon_conceptos_categorias'), Lang::get('sidebar-nav.link_title_conceptos_categorias'), array('title' => Lang::get('sidebar-nav.link_title_conceptos_categorias'))) !!}
                        </li>
                        <li {{ (Request::is('conceptos/asignacion' ) ? ' class=active' : '')}} >
                            {!! HTML::icon_link( "/conceptos/asignacion", 'fa '.Lang::get('sidebar-nav.link_icon_conceptos_asignacion'), Lang::get('sidebar-nav.link_title_conceptos_asignacion'), array('title' => Lang::get('sidebar-nav.link_title_conceptos_asignacion'))) !!}
                        </li>


                    </ul>
                </li>
            @endif
            @if (Auth::user()->hasRole('administrator'))
                <li class="treeview  {{  (Request::is('conceptos' ) || Request::is('conceptos/create' ) || Request::is('conceptos/asignacion' )  || Request::is('conceptos/categorias')  ? ' active' : '' ) }} ">
                    {!! HTML::icon_link( "/conceptos", 'fa '.Lang::get('sidebar-nav.link_icon_conceptos'), "<span>".Lang::get('sidebar-nav.title_conceptos')."</span><i class='fa ".Lang::get('sidebar-nav.caret_folded')." pull-right'></i>", array('title' => Lang::get('sidebar-nav.title_conceptos'))) !!}
                    <ul class="treeview-menu">
                        <li  {{ (Request::is('users' ) ? ' class=active' : '')}}>
                            {!! HTML::icon_link( "/conceptos", 'fa '.Lang::get('sidebar-nav.link_icon_conceptos_view'), Lang::get('sidebar-nav.link_title_conceptos_view'), array('title' => Lang::get('sidebar-nav.link_title_conceptos_view'))) !!}
                        </li>
                        <li {{ (Request::is('conceptos/create' ) ? ' class=active' : '')}} >
                            {!! HTML::icon_link( "/conceptos/create", 'fa '.Lang::get('sidebar-nav.link_icon_conceptos_create'), Lang::get('sidebar-nav.link_title_conceptos_create'), array('title' => Lang::get('sidebar-nav.link_title_conceptos_create'))) !!}
                        </li>
                        <li {{ (Request::is('conceptos/categorias' ) ? ' class=active' : '')}} >
                            {!! HTML::icon_link( "/conceptos/categorias", 'fa '.Lang::get('sidebar-nav.link_icon_conceptos_categorias'), Lang::get('sidebar-nav.link_title_conceptos_categorias'), array('title' => Lang::get('sidebar-nav.link_title_conceptos_categorias'))) !!}
                        </li>
                        <li {{ (Request::is('conceptos/asignacion' ) ? ' class=active' : '')}} >
                            {!! HTML::icon_link( "/conceptos/asignacion", 'fa '.Lang::get('sidebar-nav.link_icon_conceptos_asignacion'), Lang::get('sidebar-nav.link_title_conceptos_asignacion'), array('title' => Lang::get('sidebar-nav.link_title_conceptos_asignacion'))) !!}
                        </li>


                    </ul>
                </li>
            @endif
            @if (Auth::user()->hasRole('administrator'))
                <li class=" treeview  {{  (Request::is('obrasSociales' ) || Request::is('obrasSociales/create' ) || Request::is('specialties/create' ) || Request::is('categories' ) || Request::is('categories/create' ) || Request::is('comboTypes' ) || Request::is('comboTypes/create' ) || Request::is('comboOptions/create' ) ? ' active' : '' ) }} ">
                    {!! HTML::icon_link( "/configurar", 'fa '.Lang::get('sidebar-nav.link_icon_configuracion'), "<span>".Lang::get('sidebar-nav.title_configuracion')."</span><i class='fa ".Lang::get('sidebar-nav.caret_folded')." pull-right'></i>", array('title' => Lang::get('sidebar-nav.title_configuracion'))) !!}
                    <ul class="treeview-menu">
                        <li class="treeview  {{  (Request::is('obrasSociales' ) || Request::is('obrasSociales/create' )   ? ' active' : '' ) }} ">
                            {!! HTML::icon_link( "/obrasSociales", 'fa '.Lang::get('sidebar-nav.link_icon_obrasSociales'), "<span>".Lang::get('sidebar-nav.title_obrasSociales')."</span><i class='fa ".Lang::get('sidebar-nav.caret_folded')." pull-right'></i>", array('title' => Lang::get('sidebar-nav.title_obrasSociales'))) !!}
                            <ul class="treeview-menu">
                                <li  {{ (Request::is('obrasSociales' ) ? ' class=active' : '')}}>
                                    {!! HTML::icon_link( "/obrasSociales", 'fa '.Lang::get('sidebar-nav.link_icon_obrasSociales_view'), Lang::get('sidebar-nav.link_title_obrasSociales_view'), array('title' => Lang::get('sidebar-nav.link_title_obrasSociales_view'))) !!}
                                </li>
                                <li {{ (Request::is('obrasSociales/create' ) ? ' class=active' : '')}} >
                                    {!! HTML::icon_link( "/obrasSociales/create", 'fa '.Lang::get('sidebar-nav.link_icon_obrasSociales_create'), Lang::get('sidebar-nav.link_title_obrasSociales_create'), array('title' => Lang::get('sidebar-nav.link_title_obrasSociales_create'))) !!}
                                </li>


                            </ul>
                        </li>
                        <li class="treeview  {{  (Request::is('categories' ) || Request::is('categories/create' )|| Request::is('specialties/create' )   ? ' active' : '' ) }} ">
                            {!! HTML::icon_link( "/categories", 'fa '.Lang::get('sidebar-nav.link_icon_categorias'), "<span>".Lang::get('sidebar-nav.title_categorias')."</span><i class='fa ".Lang::get('sidebar-nav.caret_folded')." pull-right'></i>", array('title' => Lang::get('sidebar-nav.title_categorias'))) !!}
                            <ul class="treeview-menu">
                                <li  {{ (Request::is('categories' ) ? ' class=active' : '')}}>
                                    {!! HTML::icon_link( "/categories", 'fa '.Lang::get('sidebar-nav.link_icon_categorias_view'), Lang::get('sidebar-nav.link_title_categorias_view'), array('title' => Lang::get('sidebar-nav.link_title_categorias_view'))) !!}
                                </li>
                                <li >
                                    {!! HTML::icon_link( "/conceptos/categorias", 'fa '.Lang::get('sidebar-nav.link_icon_conceptos_categorias'), Lang::get('sidebar-nav.link_title_conceptos_categorias'), array('title' => Lang::get('sidebar-nav.link_title_conceptos_categorias'))) !!}
                                </li>

                            </ul>
                        </li>

                                <li  {{ (Request::is('comboTypes' ) || Request::is('comboTypes/create' ) || Request::is('comboOptions/create' ) ? ' class=active' : '')}}>
                                    {!! HTML::icon_link( "/comboTypes", 'fa '.Lang::get('sidebar-nav.link_icon_opciones'), Lang::get('sidebar-nav.link_title_opciones'), array('title' => Lang::get('sidebar-nav.link_title_opciones'))) !!}
                                </li>




                    </ul>
                </li>
            @endif

            {{--@if (Auth::user()->profile)--}}
                {{--<li class="treeview {{ (Request::is('profile/*' ) ? ' active' : '') }} " >--}}
                    {{--{!! HTML::icon_link( "/profile/".Auth::user()->name, 'fa '.Lang::get('sidebar-nav.link_icon_profile_top'), "<span>".Lang::get('sidebar-nav.link_title_profile_top')."</span><i class='fa ".Lang::get('sidebar-nav.caret_folded')." pull-right'></i>", array('title' => Lang::get('sidebar-nav.link_title_profile_top'))) !!}--}}
                    {{--<ul class="treeview-menu" >--}}
                        {{--<li {{ (Request::is('profile/'.Auth::user()->name ) ? ' class=active' : '')}}>--}}
                            {{--{!! HTML::icon_link( "/profile/".Auth::user()->name, 'fa '.Lang::get('sidebar-nav.link_icon_profile_view'), Lang::get('sidebar-nav.link_title_profile_view'), array('title' => Lang::get('sidebar-nav.link_title_profile_view'))) !!}--}}
                        {{--</li>--}}
                        {{--@if (Auth::user()->id == Auth::user()->id)--}}
                            {{--<li {{ (Request::is('profile/'.Auth::user()->name.'/edit' ) ? ' class=active' : '')}}>--}}
                                {{--{!! HTML::icon_link( "/profile/".Auth::user()->name."/edit", 'fa '.Lang::get('sidebar-nav.link_icon_profile_edit'), Lang::get('sidebar-nav.link_title_profile_edit'), array('title' => Lang::get('sidebar-nav.link_title_profile_edit'))) !!}--}}
                            {{--</li>--}}
                        {{--@endif--}}
                    {{--</ul>--}}
                {{--</li>--}}
            {{--@endif--}}




            @if (Auth::user()->hasRole('administrator'))
                <li class="treeview  {{ (Request::is('users' ) || Request::is('users/create' ) || Request::is('edit-users' ) ? ' active' : '' ) }} ">
                    {!! HTML::icon_link( "/users", 'fa '.Lang::get('sidebar-nav.link_icon_users'), "<span>".Lang::get('sidebar-nav.link_title_users')."</span><i class='fa ".Lang::get('sidebar-nav.caret_folded')." pull-right'></i>", array('title' => Lang::get('sidebar-nav.link_title_users'))) !!}
                    <ul class="treeview-menu">
                        <li  {{ (Request::is('users' ) ? ' class=active' : '')}}>
                            {!! HTML::icon_link( "/users", 'fa '.Lang::get('sidebar-nav.link_icon_users_view'), Lang::get('sidebar-nav.link_title_users_view'), array('title' => Lang::get('sidebar-nav.link_title_users_view'))) !!}
                            {{--   <a href="/users">
                                <i class="fa {{ Lang::get('sidebar-nav.link_icon_users_view') }}"></i>
                                <span>
                                  {{ Lang::get('sidebar-nav.link_title_users_view') }}
                                </span>
                                <small class="label pull-right bg-blue">
                                  {{$total_users}}
                                </small>
                              </a> --}}
                        </li>
                        <li  {{ (Request::is('edit-users' ) ? ' class=active' : '')}}>
                            {!! HTML::icon_link( "/edit-users/", 'fa '.Lang::get('sidebar-nav.link_icon_users_edit'), Lang::get('sidebar-nav.link_title_users_edit'), array('title' => Lang::get('sidebar-nav.link_title_users_edit'))) !!}
                        </li>
                        <li {{ (Request::is('users/create' ) ? ' class=active' : '')}} >
                            {!! HTML::icon_link( "/users/create", 'fa '.Lang::get('sidebar-nav.link_icon_user_create'), Lang::get('sidebar-nav.link_title_user_create'), array('title' => Lang::get('sidebar-nav.link_title_user_create'))) !!}
                        </li>


                    </ul>
                </li>
            @endif

            <li class="header"></li>

            <li>
                {!! HTML::icon_link( "/logout", 'fa '.Lang::get('sidebar-nav.link_icon_logout'), "<span>".Lang::get('sidebar-nav.link_title_logout')."</span>", array('title' => Lang::get('sidebar-nav.link_title_logout'))) !!}
            </li>

        </ul>
    </section>
</aside>
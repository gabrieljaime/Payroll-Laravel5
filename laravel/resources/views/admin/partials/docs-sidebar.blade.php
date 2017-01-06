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

            @if (Auth::user()->hasRole('administrator'))

                    {!! $index !!}

            @endif



    </section>
</aside>
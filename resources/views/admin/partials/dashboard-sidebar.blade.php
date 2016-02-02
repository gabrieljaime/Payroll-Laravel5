{{--  LEFT SIDEBAR WITH NAVIGATION AND LOGO --}}
<aside class="main-sidebar">

    {{--  SIDEBAR: style can be found in sidebar.less --}}
    <section class="sidebar">

        {{--  GRAVATAR AND USE STATUS PANEL --}}
        <div class="user-panel">
            <div class="pull-left image">
              {!! HTML::show_gravatar() !!}
            </div>
            <div class="pull-left info">
                <p>
                    {{ Lang::get('sidebar-nav.user-panel_hello') }}   {!! HTML::show_username() !!}
                </p>
                 <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
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

            @if (Auth::user()->profile)
                <li class="treeview {{ (Request::is('profile/*' ) ? ' active' : '') }} " >
                    {!! HTML::icon_link( "/profile/".Auth::user()->name, 'fa '.Lang::get('sidebar-nav.link_icon_profile_top'), "<span>".Lang::get('sidebar-nav.link_title_profile_top')."</span><i class='fa ".Lang::get('sidebar-nav.caret_folded')." pull-right'></i>", array('title' => Lang::get('sidebar-nav.link_title_profile_top'))) !!}
                    <ul class="treeview-menu" >
                        <li {{ (Request::is('profile/'.Auth::user()->name ) ? ' class=active' : '')}}>
                            {!! HTML::icon_link( "/profile/".Auth::user()->name, 'fa '.Lang::get('sidebar-nav.link_icon_profile_view'), Lang::get('sidebar-nav.link_title_profile_view'), array('title' => Lang::get('sidebar-nav.link_title_profile_view'))) !!}
                        </li>
                        @if (Auth::user()->id == Auth::user()->id)
                            <li {{ (Request::is('profile/'.Auth::user()->name.'/edit' ) ? ' class=active' : '')}}>
                                {!! HTML::icon_link( "/profile/".Auth::user()->name."/edit", 'fa '.Lang::get('sidebar-nav.link_icon_profile_edit'), Lang::get('sidebar-nav.link_title_profile_edit'), array('title' => Lang::get('sidebar-nav.link_title_profile_edit'))) !!}
                            </li>
                        @endif
                    </ul>
                </li>
            @endif




          @if (Auth::user()->hasRole('administrator'))
            <li class="treeview  {{ (Request::is('users' ) || Request::is('edit-users' ) || Request::is('users/create' )  ? ' active' : '' ) }} ">
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
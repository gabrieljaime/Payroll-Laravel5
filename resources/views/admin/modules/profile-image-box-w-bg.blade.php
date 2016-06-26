{{-- Profile Image Box with Background --}}
<div class="box box-widget widget-user-2">
    <div class="widget-user-header bg-light-blue">
        <div class="widget-user-image">
            <img src="/storage/legajos/@if(is_null($user->Empleado->photo)or$user->Empleado->photo=="" )icon-user-default.png @else{{$user->Empleado->photo}} @endif" alt="User Image" class="img-circle">

        </div>
        <h3 class="widget-user-username">{{ $user->name }} </h3>
        <h5 class="widget-user-desc"> 	{{\App\Models\Category::find($user->Empleado->categoria)->category}}    {{\App\Models\Specialty::find($user->Empleado->subcategoria)->specialty}}
        </h5>
    </div>

        @if ($user->profile->twitter_username)

            <div class="box-footer no-padding">
                <ul class="nav nav-stacked">

                    @if ($user->profile->twitter_username)
                        <li>
                            {!! HTML::twitter_followers($user) !!}
                        </li>


                    @endif

                    {{--
                    <li><a href="#">Projects <span class="pull-right badge bg-blue">31</span></a></li>
                    <li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
                    <li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
                    --}}

                </ul>
            </div>

    @endif

</div>
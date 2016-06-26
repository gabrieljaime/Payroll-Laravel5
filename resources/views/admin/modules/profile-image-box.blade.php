{{-- Profile Image Box --}}
<div class="box box-primary">
    <div class="box-body box-profile">

        <img src="/storage/legajos/@if(is_null($user->Empleado->photo)or$user->Empleado->photo=="" )icon-user-default.png @else{{$user->Empleado->photo}} @endif" alt="User Image" class="profile-user-img img-responsive img-circle">


        <h3 class="profile-username text-center">
        	{{ $user->name }}
        </h3>

        <p class="text-muted text-center">
        	{{\App\Models\Category::find($user->Empleado->categoria)->category}}    {{\App\Models\Specialty::find($user->Empleado->subcategoria)->specialty}}
        </p>

    </div>
</div>
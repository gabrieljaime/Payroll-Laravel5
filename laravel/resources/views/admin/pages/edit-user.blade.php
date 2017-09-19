@extends('admin.layouts.dashboard')

@section('template_title')
	Mostrando Usuario {{ $user->name }}
@endsection

@section('template_fastload_css')
@endsection

@section('content')
	 <div class="content-wrapper">
	    <section class="content-header">

	    	<h1>
	    		Editar {{ $user->name }}
	    	</h1>

			{!! Breadcrumbs::render('edit_user_admin_view', $user) !!}

	    </section>
	    <section class="content">
			@include('admin.modules.profile-image-box-w-bg')






{!! Form::model($user, array('action' => array('UsersManagementController@update', $user->id), 'method' => 'PUT')) !!}

@include('admin.partials.return-messages')

	<div class="form-group">
		{!! Form::label('name', 'Usuario') !!}
		{!! Form::text('name', null, array('class' => 'form-control')) !!}
	</div>

	<div class="form-group">
		{!! Form::label('email', 'Email') !!}
		{!! Form::email('email', null, array('class' => 'form-control', 'readonly'=>'readonly')) !!}
	</div>

	<div class="form-group">
		{!! Form::label('role_id', 'Nivel de Acceso') !!}
		{!! Form::select('role_id', array(''=>'', '1' => 'Empleado', '2' => 'Recursos Humanos', '3' => 'Administrador'), $access, array('class' => 'form-control')) !!}
	</div>


	{!! Form::submit('Editar Usuario', array('class' => 'btn btn-primary')) !!}


			{!! HTML::icon_link( "/password/email", 'fa fa-lock', '&nbsp;Cambiar Contraseña', array('title' => 'Cambiar Contraseña', 'class' => 'btn btn-info ')) !!}



			{!! Form::close() !!}





	    </section>
	</div>
@endsection

@section('template_scripts')
	<script type="text/javascript">

		$(document).ready(function () {
	// select2 style
	$('#role_id').select2({
	placeholder: "Seleccione"
	});
		});
	</script>

	@include('admin.structure.dashboard-scripts')



@endsection
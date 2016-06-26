{!! Form::open(array('action' => 'UsersManagementController@store', 'method' => 'POST', 'role' => 'form')) !!}
{{-- -or- {!! Form::open(array('url' => url('/users'), 'method' => 'POST', 'method' => 'POST', 'role' => 'form')) !!} --}}

	{!! csrf_field() !!}
<div class="form-group has-feedback">

	{!! Form::label('legajo','Empleado: ', array('class' => 'col-md-3 control-label margin-bottom-half')); !!}
	<div class="input-group">
		{!! Form::select('empleado', $Legajos, null, array('id' => 'empleado', 'class' => 'form-control')) !!}
		<label class="input-group-addon" for="name"><i class="fa fa-fw {{ Lang::get('forms.create_user_icon_username') }}" aria-hidden="true"></i></label>

	</div>


</div>

	<div class="form-group has-feedback">
		{!! Form::label('email', Lang::get('forms.create_user_label_email'), array('class' => 'col-md-3 control-label margin-bottom-half')); !!}
      	<div class="input-group">
        	{!! Form::text('email', NULL, array('id' => 'email', 'class' => 'form-control', 'placeholder' => Lang::get('forms.create_user_ph_email'))) !!}
        	<label class="input-group-addon" for="email"><i class="fa fa-fw {{ Lang::get('forms.create_user_icon_email') }}" aria-hidden="true"></i></label>
      	</div>
	</div>

	<div class="form-group has-feedback">
		{!! Form::label('name','Nombre', array('class' => 'col-md-3 control-label margin-bottom-half')); !!}
      	<div class="input-group">
        	{!! Form::text('name', NULL, array('id' => 'name', 'class' => 'form-control', 'placeholder' => Lang::get('forms.create_user_ph_username'))) !!}
        	<label class="input-group-addon" for="name"><i class="fa fa-fw {{ Lang::get('forms.create_user_icon_username') }}" aria-hidden="true"></i></label>
      	</div>
	</div>

	<div class="form-group has-feedback">
		{!! Form::label('user_level', 'Nivel de Acceso' , array('class' => 'col-md-3 control-label margin-bottom-half')); !!}
		<div class="input-group">
        	{!! Form::select('user_level', array(''=>'', '1' => 'Empleado', '2' => 'Recursos Humanos', '3' => 'Administrador'), NULL, array('class' => 'form-control','placeholder' => 'Seleccione' )) !!}
			<label class="input-group-addon" for="user_level"><i class="fa fa-fw fa-exclamation-circle" aria-hidden="true"></i></label>
		</div>
	</div>

	<div class="form-group has-feedback">
		{!! Form::label('password', Lang::get('forms.create_user_label_password'), array('class' => 'col-md-3 control-label margin-bottom-half')); !!}
      	<div class="input-group">
        	{!! Form::password('password', array('id' => 'password', 'class' => 'form-control ', 'placeholder' => Lang::get('forms.create_user_ph_password'))) !!}
        	<label class="input-group-addon" for="password"><i class="fa fa-fw {{ Lang::get('forms.create_user_icon_password') }}" aria-hidden="true"></i></label>
      	</div>
	</div>

	<div class="form-group has-feedback">
		{!! Form::label('password_confirmation', Lang::get('forms.create_user_label_pw_confirmation'), array('class' => 'col-md-3 control-label margin-bottom-half')); !!}
      	<div class="input-group">
        	{!! Form::text('password_confirmation', NULL, array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => Lang::get('forms.create_user_ph_pw_confirmation'))) !!}
        	<label class="input-group-addon" for="password_confirmation"><i class="fa fa-fw {{ Lang::get('forms.create_user_icon_pw_confirmation') }}" aria-hidden="true"></i></label>
      	</div>
	</div>





	{!! Form::button('<i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;' . Lang::get('forms.create_user_button_text'), array('class' => 'btn btn-primary btn-flat btn-lg margin-bottom-1 col-md-offset-3','type' => 'submit')) !!}
</div>

{!! Form::close() !!}
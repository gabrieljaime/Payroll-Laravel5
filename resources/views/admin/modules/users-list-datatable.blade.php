<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            {{$total_users}} Registrados
			@if ($total_users > 2)
				Usuarios
			@else
				Usuario
			@endif
        </h3>

        <div class="box-tools pull-right">
            {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' => 'tooltip')) !!}
            {!! Form::button('<i class="fa fa-times"></i>', array('class' => 'btn btn-box-tool','title' => 'close', 'data-widget' => 'remove', 'data-toggle' => 'tooltip')) !!}
        </div>
    </div>
	<div class="box-body table-responsive">

		<table id="user_table" class="table table-striped table-hover table-condensed">
			<thead>
				<tr class="success">
					<th>Imagen</th>
					<th>ID</th>
					<th>Nombre</th>
					<th>Email</th>
					<th>Creado</th>
					<th>Actualizado</th>
				</tr>
			</thead>
			<tbody>
		        @foreach ($users as $a_user)
					<tr>
						<td>
							<img src="/storage/legajos/@if(is_null($a_user->Empleado->photo)or$a_user->Empleado->photo=="" )icon-user-default.png @else{{$a_user->Empleado->photo}} @endif" alt="User Image" draggable="false" class="profile-user-img img-responsive img-circle">
						</td>
						<td>{{$a_user->id}} </td>
						<td>{{$a_user->name}} </td>
						<td>{{$a_user->email}} </td>
						<td>{{$a_user->created_at}} </td>
						<td>{{$a_user->updated_at}} </td>
					</tr>
		        @endforeach
			</tbody>
		</table>

	</div>
</div>
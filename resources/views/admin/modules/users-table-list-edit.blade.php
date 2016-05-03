<div class="table-responsive">
	<table class="table table-striped table-hover table-condensed">
		<thead>
			<tr>
				<th width="20%">Acciones</th>
				<th>ID</th>
				<th>Usuario</th>
				<th>Email</th>

			</tr>
		</thead>
		<tbody>
			@foreach($users as $key => $value)
				<tr>
					<td>
						{!! Form::open(array('url' => 'users/' . $value->id, 'class' => '')) !!}
						<div class="btn-group">

						{!! Form::hidden('_method', 'DELETE') !!}
						{!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> Borrar', array('class' => 'btn btn-xs btn-danger ','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete PUtos', 'data-message' => 'Are you sure Esta seguro de borar putose this user ?')) !!}



						<a class="btn btn-xs btn-success" href="{{ URL::to('users/' . $value->id) }}">
							<i class="fa fa-eye fa-fw"></i>
								Mostrar
						</a>

						<a class="btn btn-xs btn-info " href="{{ URL::to('users/' . $value->id . '/edit') }}">
							<i class="fa fa-pencil fa-fw"></i>
							Editar</a>
						</div>
						{!! Form::close() !!}
					</td>
					<td>{{ $value->id }}</td>
					<td>{{ $value->name }}

					</td>
					<td>
						<a href="mailto:{{ $value->email }}" title="Send email to {{ $value->email }}">
							{{ $value->email }}
						</a>
					</td>

				</tr>
			@endforeach
		</tbody>
	</table>
</div>



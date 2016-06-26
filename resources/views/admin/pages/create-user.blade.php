@extends('admin.layouts.dashboard')

@section('template_title')
	Crear un nuevo Usuario
@endsection

@section('template_fastload_css')
@endsection

@section('content')

	 <div class="right-side content-wrapper">
	    <section class="content-header">

			<h1>
				Crear un nuevo usuario
			</h1>

			{!! Breadcrumbs::render('create_user_admin_view') !!}

	    </section>
	    <section class="content">

			@include('admin.partials.return-messages')





			@include('admin.forms.create-user-form')

	    </section>
	</div>
@endsection

@section('template_scripts')
		<script type="text/javascript">

		$(document).ready(function () {
			// select2 style
			$('#empleado').select2({
				placeholder: "Seleccione",

			});
			$('#user_level').select2({
				placeholder: "Seleccione"
			});


			var $empleado = $('#empleado');

			$('#empleado').addClass('form-control select2');
			{{--alert(" {{ App\Models\Emplyees::find($empleado.val())->email }}");--}}
			$empleado.on('change', function() {
				$.ajax({
					url:"{{ URL::to('employees') }}/buscar/" + $empleado.val(), // if you say $(this) here it will refer to the ajax call not $('.company2')
					type:'GET',
					success:function(data) {
						$('#email').attr("value", data[0]["email"])
						$('#name').attr("value", data[0]["nombre"])


					}
				});

			});

			//iCheck for checkbox and radio inputs

			});
		</script>
    @include('admin.structure.dashboard-scripts')
	@include('scripts.html5-password-check');
	@include('scripts.show-hide-passwords');
	@include('scripts.address-lookup-g-api')

@endsection
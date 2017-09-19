
@extends('admin.layouts.dashboard')

@section('template_title')
	View ObraSocial
@endsection

@section('template_fastload_css')


@endsection

@section('content')
	<div class="content-wrapper">
		<section class="content-header">

			<h1>
				View ObraSocial
			</h1>

			{{--{!! Breadcrumbs::render('view_obrasSociales') !!}--}}

		</section>
		<section class="content">
	 		@include('obrasSociales.show_fields')
	 		 <div class="form-group col-sm-12">
                        {!! link_to('/obrasSociales', 'Back', ['class' => 'btn btn-warning']) !!}
              </div>
		</section>
		<br>
		<br>
		<br>
	</div>



@endsection
		@section('template_scripts')


			@include('admin.structure.dashboard-scripts')
			@include('scripts.address-lookup-g-api')
			@include('scripts.modals')

		@endsection


@extends('admin.layouts.dashboard')

@section('template_title')
	View ConceptosNovedades
@endsection

@section('template_fastload_css')


@endsection

@section('content')
	<div class="content-wrapper">
		<section class="content-header">

			<h1>
				View ConceptosNovedades
			</h1>

			{{--{!! Breadcrumbs::render('view_conceptosNovedades') !!}--}}

		</section>
		<section class="content">
	 		@include('novedades.conceptos.show_fields')
	 		 <div class="form-group col-sm-12">
                        {!! link_to('/conceptosNovedades', 'Back', ['class' => 'btn btn-warning']) !!}
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

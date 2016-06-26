@extends('admin.layouts.dashboard')


@section('template_title')
	Bienvenido {{ $user->name }}
@endsection

@section('template_fastload_css')
@endsection

@section('content')
	 <div class="content-wrapper">
	    <section class="content-header">

			<h1>
				{{ Lang::get('pages.dashboard-welcome',['username' => $user->name] ) }} <small> {{ Lang::get('pages.dashboard-access-level',['access' => $access] ) }} </small>
			</h1>

			{!! Breadcrumbs::render() !!}

	    </section>
	    <section class="content">

			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3>{{$Activos}}</h3>

							<p>Empleados Activos</p>
						</div>
						<div class="icon">
							<i class="ion ion-ios-people"></i>
						</div>
						<a href="{{route('employees.index')}}" class="small-box-footer">Ver listado <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-green">
						<div class="inner">
							<h3>20<sup style="font-size: 20px">%</sup></h3>

							<p>Rato de Rotación</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="#" class="small-box-footer">Datos <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3>10</h3>

							<p>Ausencias en el Mes</p>
						</div>
						<div class="icon">
							<i class="ion ion-medkit"></i>
						</div>
						<a href="#" class="small-box-footer">Ver listado <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-red">
						<div class="inner">
							<h3>{{$Bajas}}</h3>

							<p>Bajas del Mes</p>
						</div>
						<div class="icon">
							<i class="ion ion-sad"></i>
						</div>
						<a href="#" class="small-box-footer">Ver bajas <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>
			<!-- /.row -->

			<!-- /.box -->
			<div class="row">

				<div class="col-md-6">
					<!-- USERS LIST -->
					<div class="box box-danger">
						<div class="box-header with-border">
							<h3 class="box-title">Ultimos Empleados Ingresados</h3>

							<div class="box-tools pull-right">
								<span class="label label-danger">{{count($AltasNuevas)}} Nuevos Empleados</span>
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
								</button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body no-padding">
							<ul class="users-list clearfix">
								@foreach ($AltasNuevas->sortBy('fecha_ingreso') as $Alta)
								<li>

									<img src="/storage/legajos/@if(is_null($Alta->photo)or$Alta->photo=="" )icon-user-default.png @else{{$Alta->photo}} @endif" alt="User Image" class="img-circle">
									<a class="users-list-name" href="{{URL::to('employees/' .$Alta->id .'/edit' ) }}">{{$Alta->nombre}}</a>
									<span class="users-list-date"><strong>Legajo {{ $Alta->id}}</strong></span>
									<span class="users-list-date">{{ $Alta->fecha_ingreso->format('d/m/Y')}}</span>

								</li>
								@endforeach
							</ul>
							<!-- /.users-list -->
						</div>
						<!-- /.box-body -->
						<div class="box-footer text-center">
							<a href="{{route('employees.index')}}" class="uppercase">Ver todos los empleados</a>
						</div>
						<!-- /.box-footer -->
					</div>
					<!--/.box -->
				</div>
				<!-- /.col -->
				<div class="col-md-6">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Liquidaciones de Sueldo Mensuales</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">


									<p class="text-center">
										<strong>Del	 {{$Liquidaciones->min('mes')}} de {{$Liquidaciones->min('año')}} al {{$Liquidaciones->max('mes')}}  de {{$Liquidaciones->max('año')}}</strong>
									</p>

									<div class="chart">
										<!-- Sales Chart Canvas -->
										<canvas id="salesChart" style="height: 180px;"></canvas>
									</div>
									<!-- /.chart-responsive -->


						</div>
						<!-- ./box-body -->
						<div class="box-footer">
							<div class="row">
								<div class="col-sm-3 col-xs-6">
									<div class="description-block border-right">
										@if ($AnteUltimaLiquidacion->total_retenciones>$UltimaLiquidacion->total_retenciones)
										<span class="description-percentage text-red"><i class="fa fa-caret-down"></i> {{number_format($AnteUltimaLiquidacion->total_retenciones/$UltimaLiquidacion->total_retenciones)}}%</span>
										@elseif ($AnteUltimaLiquidacion->total_retenciones=$UltimaLiquidacion->total_retenciones)
											<span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
										@else
											<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> {{number_format($UltimaLiquidacion->total_retenciones/$AnteUltimaLiquidacion->total_retenciones)}}%</span>

										@endif
											<h5 class="description-header">${{number_format($UltimaLiquidacion->total_retenciones, 2)}}</h5>
										<span class="description-text" style="font-size: smaller">Sujeto a Retención</span>
									</div>
									<!-- /.description-block -->
								</div>
								<!-- /.col -->
								<div class="col-sm-3 col-xs-6">
									<div class="description-block border-right">
										@if ($AnteUltimaLiquidacion->total_cargas>$UltimaLiquidacion->total_cargas)
											<span class="description-percentage text-red"><i class="fa fa-caret-down"></i> {{number_format($AnteUltimaLiquidacion->total_cargas/$UltimaLiquidacion->total_cargas)}}%</span>
										@elseif ($AnteUltimaLiquidacion->total_cargas=$UltimaLiquidacion->total_cargas)
											<span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
										@else
											<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> {{number_format($UltimaLiquidacion->total_cargas/$AnteUltimaLiquidacion->total_cargas)}}%</span>

										@endif
										
										
										<h5 class="description-header">${{number_format($UltimaLiquidacion->total_cargas, 2)}}</h5>
										<span class="description-text" style="font-size: smaller" >Cargas</span>
									</div>
									<!-- /.description-block -->
								</div>
								<!-- /.col -->
								<div class="col-sm-3 col-xs-6">
									<div class="description-block border-right">
										@if ($AnteUltimaLiquidacion->total_debes>$UltimaLiquidacion->total_debes)
											<span class="description-percentage text-red"><i class="fa fa-caret-down"></i> {{number_format($AnteUltimaLiquidacion->total_debes/$UltimaLiquidacion->total_debes)}}%</span>
										@elseif ($AnteUltimaLiquidacion->total_debes=$UltimaLiquidacion->total_debes)
											<span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
										@else
											<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> {{number_format($UltimaLiquidacion->total_debes/$AnteUltimaLiquidacion->total_debes)}}%</span>

										@endif

										<h5 class="description-header">${{number_format($UltimaLiquidacion->total_debes, 2)}}</h5>
										<span class="description-text"style="font-size: smaller">Retenciones</span>
									</div>
									<!-- /.description-block -->
								</div>
								<!-- /.col -->
								<div class="col-sm-3 col-xs-6">
									<div class="description-block">
										@if ($AnteUltimaLiquidacion->total_netos>$UltimaLiquidacion->total_netos)
											<span class="description-percentage text-red"><i class="fa fa-caret-down"></i> {{number_format($AnteUltimaLiquidacion->total_netos/$UltimaLiquidacion->total_netos)}}%</span>
										@elseif ($AnteUltimaLiquidacion->total_netos=$UltimaLiquidacion->total_netos)
											<span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
										@else
											<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> {{number_format($UltimaLiquidacion->total_netos/$AnteUltimaLiquidacion->total_netos)}}%</span>

										@endif

										<h5 class="description-header">${{number_format($UltimaLiquidacion->total_netos, 2)}}</h5>
										<span class="description-text"style="font-size: smaller">Netos</span>
									</div>
									<!-- /.description-block -->
								</div>
							</div>
							<!-- /.row -->
						</div>
						<!-- /.box-footer -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->

	    </section>
	</div>
@endsection

@section('template_scripts')
<script>

	//-----------------------
	//- MONTHLY SALES CHART -
	//-----------------------

	// Get context with jQuery - using jQuery's .get() method.
	var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
	// This will get the first returned node in the jQuery collection.
	var salesChart = new Chart(salesChartCanvas);

	var salesChartData = {
		labels: [{!! implode(',',$MesesEsp)!!}],
		datasets: [
			{
				label: "Sujeto a Retencion",
				fillColor: "rgb(210, 214, 222)",
				strokeColor: "rgb(210, 214, 222)",
				pointColor: "rgb(210, 214, 222)",
				pointStrokeColor: "#c1c7d1",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgb(220,220,220)",
				data: [{!! implode(',',$Reten)!!}]
			},
			{
				label: "Retenciones",
				fillColor: "rgba(60,141,188,0.9)",
				strokeColor: "rgba(60,141,188,0.8)",
				pointColor: "#3b8bba",
				pointStrokeColor: "rgba(60,141,188,1)",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(60,141,188,1)",
				data: [{!! implode(',',$Debes)!!}]
			}
		]
	};

	var salesChartOptions = {
		//Boolean - If we should show the scale at all
		showScale: true,
		//Boolean - Whether grid lines are shown across the chart
		scaleShowGridLines: false,
		//String - Colour of the grid lines
		scaleGridLineColor: "rgba(0,0,0,.05)",
		//Number - Width of the grid lines
		scaleGridLineWidth: 1,
		//Boolean - Whether to show horizontal lines (except X axis)
		scaleShowHorizontalLines: true,
		//Boolean - Whether to show vertical lines (except Y axis)
		scaleShowVerticalLines: true,
		//Boolean - Whether the line is curved between points
		bezierCurve: true,
		//Number - Tension of the bezier curve between points
		bezierCurveTension: 0.3,
		//Boolean - Whether to show a dot for each point
		pointDot: false,
		//Number - Radius of each point dot in pixels
		pointDotRadius: 4,
		//Number - Pixel width of point dot stroke
		pointDotStrokeWidth: 1,
		//Number - amount extra to add to the radius to cater for hit detection outside the drawn point
		pointHitDetectionRadius: 20,
		//Boolean - Whether to show a stroke for datasets
		datasetStroke: true,
		//Number - Pixel width of dataset stroke
		datasetStrokeWidth: 2,
		//Boolean - Whether to fill the dataset with a color
		datasetFill: true,
		//String - A legend template
		legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
		//Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
		maintainAspectRatio: true,
		//Boolean - whether to make the chart responsive to window resizing
		responsive: true
	};

	//Create the line chart
	salesChart.Line(salesChartData, salesChartOptions);

	//---------------------------
	//- END MONTHLY SALES CHART -
	//---------------------------

</script>
    @include('admin.structure.dashboard-scripts')

@endsection
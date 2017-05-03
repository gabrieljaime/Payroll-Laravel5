@extends('admin.layouts.dashboard')

@section('template_title')
   Listado de Cuotas Solidarias
@endsection

@section('template_fastload_css')

    @media print {
    body, page[size="A4"] {
    margin: 0;
    box-shadow: 0;
    }
    }

    label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 1px;
    font-weight: bold;
    }
    .content {
    min-height: 250px;
    margin-right: 0;
    margin-left: 0;
    background: white;
    }
    .box {
    padding: 0px;
    border: black;
    margin-bottom: 1px;
    }
    .box-header {
    color: black;
    display: block;
    padding: 3px;
    position: relative;
    }
    .tab-head{
    color: #444;
    text-align: center;
    vertical-align: middle;
    font-size: 100%;
    border-bottom: 1px solid #f4f4f4;
    }
    .nopadding{padding:1px; }
    .box.box-solid.box-default {
    border: 1px solid black;
    }
    .table   {
    border-radius: 3px;
    border-bottom:  0px solid black;
    border-right:  0px solid black;
    font-size: 80%;

    }
    .table > thead > tr > th {
    border-bottom:  1px solid black;
    border-right:  1px solid black;
    vertical-align: middle;
    padding: 3px;

    }
    .table > thead > tr > th:last-child  {
    border-bottom:  1px solid black;
    border-right:  0px solid black;
    padding: 3px;
    }
    .table > thead > tr > td {
    border-right:  1px solid black;
    border-bottom:  1px solid black;
    padding: 3px;


    }
    .table > thead > tr > td:last-child {
    border-right:  0px solid black;
    border-bottom:  1px solid black;
    padding: 3px;

    }
    .table > tfoot > tr > th {
    border-top:  1px solid black;
    border-bottom:  1px solid black;
    border-right:  1px solid black;
    padding: 3px;
    }
    .table > tfoot > tr > th:last-child  {
    border-top:  1px solid black;
    border-bottom:  1px solid black;
    border-right:  0px solid black;
    padding: 3px;
    }
    .table > tbody > tr > td {
    border-right:  1px solid black;
    border-top:  none;
    border-bottom:  none;
    padding: 2px;


    }
    .table > tbody > tr > td:last-child {
    border-right:  none;
    border-top:  none ;
    border-bottom: none;
    padding: 2px;



    }
    .table > tfoot > tr > td {
    border-right:  1px solid black;
    border-bottom:  0px solid black;
    padding: 3px;

    }
    .table > tfoot > tr > td:last-child {
    border-right:  0px solid black;
    border-bottom:  0px solid black;
    padding: 3px;

    }

    h4{
    margin-top: 0px;
    margin-bottom: 0px;
    font-size: 75%;
    }
    .w545{ width:600px;
    margin-right: 10px}


@endsection


@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Listado Cuota Solidaria
                <small> </small>
            </h1>

            {{-- {!! Breadcrumbs::render('conceptos') !!}--}}


        </section>


        <section class="content">


         {{--   @include('flash::message')--}}

            <div class="col-md-8">
                <div class="box box-primary container-fluid" >
                    {!! Form::open(['action' => 'ReportController@listadocuotasolidaria','enctype' => 'multipart/form-data']  ) !!}


                    <div class="box-header">


                    <i class="fa fa-calendar" ></i>
                        <h3 class="box-title">Periodo</h3>

                    </div>
                    <div class="box-body">
                         <div class="form-inline">
                             <div class="col-md-4">

                                {!! Form::label('mes', 'Mes:', ['class'=>'control-label']) !!}
                               @include('liquidacion.selectmeses')
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('año', 'Año:',['class'=>'control-label']) !!}
                                {!! Form::selectYear('año', 2003 , $año+5, $año, ['class' => 'form-control','id'=>'año'])!!}
                            </div>


                        </div>
                    </div>

                    <hr>

                    <div class="box-header">

                        <i class="fa fa-cogs"></i>

                        <h3 class="box-title">Generar Reporte </h3>

                    </div>
                    <div class="box-body">
                        <div class="form-inline text-center col-md-4">
                            {!! Form::submit('Consultar', ['class' => 'btn btn-primary btn-block']) !!}




                        </div>
                    </div>


                    <!-- Submit Field -->

                    {!! Form::close() !!}
                </div>
            </div>


            <!-- /.box -->


        </section>

    </div>

@endsection

@section('template_scripts')

    @include('admin.structure.dashboard-scripts')
    @include('scripts.address-lookup-g-api')
    @include('scripts.modals')
    @include('admin.modals.flash_message')
@endsection

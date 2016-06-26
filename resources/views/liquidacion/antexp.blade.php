@extends('admin.layouts.dashboard')

@section('template_title')
   Generacion de Liquidacion Mensual de conceptos especiales
@endsection

@section('template_fastload_css')



@endsection


@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Liquidacion
                <small> </small>
            </h1>

            {{-- {!! Breadcrumbs::render('conceptos') !!}--}}


        </section>


        <section class="content">


         {{--   @include('flash::message')--}}

            <div class="col-md-6 col-md-offset-3">
                <div class="box box-primary container-fluid">
                    {!! Form::open(['action' => 'LiquidacionController@liquidarantexp','enctype' => 'multipart/form-data'] ) !!}
                    {!! csrf_field() !!}

                    <div class="box-header">

                        <i class="fa fa-user"></i>

                        <h3 class="box-title">Empleados a liquidar</h3>

                    </div>
                    <div class="box-body">

                        <div class="form-group form-inline">

                            {!! Form::label('legajo', 'Legajos:', ['class'=>'control-label ']) !!}
                            {!! Form::select('legajo', $Legajos, null, ['class' => 'form-control', 'disabled'=>'true'])
                            !!}
                            <div class="form-control pull-right">
                                <label class="control-label">
                                    <input type="checkbox" name="todos" id="todos" checked="true" class="minimal">
                                    Seleccionar Todos
                                </label>
                            </div>
                        </div>

                    </div>

                    <hr>

                    <div class="box-header">

                        <i class="fa fa-calendar"></i>

                        <h3 class="box-title">Periodo</h3>

                    </div>
                    <div class="box-body">
                        <div class="form-inline">
                            <div class="col-md-4">
                                {!! Form::label('mes', 'Mes:', ['class'=>'control-label']) !!}
                                @include('liquidacion.selectmeses')
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('anio', 'Año:',['class'=>'control-label']) !!}
                                {!! Form::selectYear('año', $año-5 , $año+5, $año, ['class' => 'form-control',
                                'id'=>'anio'])
                                !!}
                            </div>

                        </div>
                    </div>

                    <hr>

                    <div class="box-header">

                        <i class="fa fa-cogs"></i>

                        <h3 class="box-title">Generar Liquidacion </h3>

                    </div>
                    <div class="box-body">
                        <div class="form-inline text-center">

                            {!! Form::submit('Generar', ['class' => 'btn btn-primary btn-block']) !!}

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
    <script type="text/javascript">

        $(document).ready(function () {
            // select2 style
            $('#legajo').select2({
                placeholder: "Seleccione"
            });
            $('input[type="checkbox"].minimal').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                increaseArea: '20%' // optional
            });
            $('#legajo').addClass('form-control select2');
            $('#legajo').val(null).trigger("change");
            $('#todos').on('ifChecked', function () {
                $("#legajo > option").removeAttr("selected");// Select All Options
                $("#legajo").trigger("change");// Trigger change to select 2
                $("#legajo").prop("disabled", true);
            });
            $('#todos').on('ifUnchecked', function () {
                $("#legajo").prop("disabled", false);
                $("#legajo > option").removeAttr("selected");
                $("#legajo").trigger("change");// Trigger change to select 2
            });


            //iCheck for checkbox and radio inputs

        });
    </script>



    @include('admin.structure.dashboard-scripts')
    @include('scripts.address-lookup-g-api')
    @include('scripts.modals')
    @include('admin.modals.flash_process')
@endsection

@extends('admin.layouts.dashboard')

@section('template_title')
   Ver Recibos Mensual
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
                Recibos
                <small> </small>
            </h1>

            {{-- {!! Breadcrumbs::render('conceptos') !!}--}}


        </section>


        <section class="content">


         {{--   @include('flash::message')--}}

            <div class="col-sm-4">
                <div class="box box-primary container-fluid" >
                    {!! Form::open(['action' => 'ReciboController@index','enctype' => 'multipart/form-data']  ) !!}
                    {!! csrf_field() !!}

                    <div class="box-header">

                        <i class="fa fa-user"></i>

                        <h3 class="box-title">Empleados a consultar</h3>

                    </div>
                    <div class="box-body">
                        <div class="form-group form-inline">
                            {!! Form::label('legajo', 'Legajos:', ['class'=>'control-label ']) !!}
                            @if ($esconsulta)
                            {!! Form::select('legajo', $Legajos, $recibo->empleado->id , ['class' => 'form-control', 'required'])!!}
                            @else
                                {!! Form::select('legajo', $Legajos, 0 , ['class' => 'form-control', 'required'])!!}
                            @endif
                        </div>

                    </div>

                    <div class="box-header">


                    <i class="fa fa-calendar" ></i>
                        <h3 class="box-title">Periodo</h3>

                    </div>
                    <div class="box-body">
                         <div class="form-inline">
                             <div class="col-md-4">

                                {!! Form::label('mes', 'Mes:', ['class'=>'control-label']) !!}
                                {!! Form::selectMonth('mes', $mes, ['class' => 'form-control' ,'placeholder'=>'Mes'])!!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('anio', 'Año:',['class'=>'control-label']) !!}
                                {!! Form::selectYear('año', $año-5 , $año+5, $año, ['class' => 'form-control','id'=>'anio'])!!}
                            </div>

                        </div>
                    </div>

                    <hr>

                    <div class="box-header">

                        <i class="fa fa-cogs"></i>

                        <h3 class="box-title">Consultar Recibos </h3>

                    </div>
                    <div class="box-body">
                        <div class="form-inline text-center">
                            {!! Form::submit('Consultar', ['class' => 'btn btn-primary btn-block']) !!}


                        </div>
                    </div>


                    <!-- Submit Field -->

                    {!! Form::close() !!}
                </div>
            </div>


            <!-- /.box -->




            <div class="col-sm-6 w545" style=" border: 1px solid #000000; border-radius: 4px ;height:23cm" @if (!$esconsulta) hidden="true" @endif >

                <div class="row nopadding">
                    <div class="col-xs-6 nopadding">
                        <div class="col-xs-4 nopadding" >
                            {!! HTML::image('storage/logorecibo.png' ,'Imagen', array('width' => '100px', 'style'=>'opacity: 0.8;')) !!}
                        </div>
                        <div class="col-xs-8 " style="padding:0px 0px 0px 10px; text-align: center">
                            <span style="font-size: small;"> {{$empresa->Nombre_chico}} </span> </br>
                            <strong style="font-size:large">{{$empresa->Nombre_grande}} </strong> </br>
                            <span style="font-size: smaller;">{{$empresa->Direccion}} </span> </br>
                            <span style="font-size: smaller;">{{$empresa->Telefono}}</span></br>
                            <span style="font-size: small;">C.U.I.T {{$empresa->Cuil}}</span>
                        </div>

                    </div>
                    <div class="col-xs-6 nopadding">
                        <div class="box box-default box-solid " style="border-width: 1px">
                            <div class="box-head">
                                <table class="table  table-hover" style="margin-bottom: 0px">

                                    <thead>



                                   <tr>
                                       <th class="tab-head" width="30%">Legajo</th>
                                       <th class="tab-head" width="60%">Nombre y Apellido</th>
                                   </tr>
                                   <tr align="center">

                                       <td>{{$recibo->empleado->id}}</td>
                                        <td><strong>{{$recibo->empleado->nombre}}</strong></td>
                                    </tr>
                                    <tr>
                                        <th class="tab-head">Numero Recibo
                                        </th>
                                        <th class="tab-head">C.U.I.L</th>
                                    </tr>
                                    <tr align="center">

                                        <td>{{$recibo->id}}</td>
                                        <td>{{$recibo->empleado->cuil}}</td>
                                    </tr>
                                    </thead>


                                </table>

                            </div>

                        </div>
                        <div style="text-align: right">
                            <strong> ORIGINAL</strong>
                        </div>
                    </div>

                </div>

                <div class="row nopadding">

                    <div class="box box-default box-solid " style="border-width: 1px;">
                        <div class="box-head">
                            <table class="table  table-hover" style="margin-bottom: 0px">

                                <thead>

                                <tr>
                                    <th class="tab-head" width="30%">Fecha de Ingreso</th></th>
                                    <th class="tab-head" width="30%">Fecha de Egreso</th></th>
                                    <th class="tab-head" width="10%">Mes</th></th>
                                    <th class="tab-head" width="30%">Periodo de Pago</th></th>
                                </tr>
                                <tr align="center">
                                    {{\Carbon\Carbon::setLocale('es')}}
                                    <td>{{  \Carbon\Carbon::createFromFormat('Y-m-d',$recibo->empleado->fecha_ingreso)->format('d/m/Y')}}</td>
                                    <td></td>

                                    <td>{{Lang::get('meses.'.\Carbon\Carbon::create($recibo->año,$recibo->mes)->format('F'))}}</td>
                                    <td>{{\Carbon\Carbon::create($recibo->año,$recibo->mes)->lastOfMonth()->format('d/m/Y')}}</td>
                                </tr>
                                </thead>


                            </table>

                            <table class="table  table-hover" style="margin-bottom: 0px">

                                <thead>

                                <tr>
                                    <th class="tab-head" width="50%">Categoria</th></th>
                                    <th class="tab-head" width="50%">Subcategoria</th></th>

                                </tr>
                                <tr>

                                    <td align="center">{{\App\Models\Category::find($recibo->empleado->categoria)->category}}</td>
                                    <td align="center">{{\App\Models\Specialty::find($recibo->empleado->subcategoria)->specialty}}</td>
                                </tr>
                                </thead>


                            </table>

                            <table class="table" style="margin-bottom: 0px; height:10cm; background: url('{{ URL::asset('storage/logorecibo_transparent.png') }}') no-repeat center">

                                <thead>

                                <tr>
                                    <th class="tab-head" width="50px">Código</th>
                                    <th class="tab-head" width="224px">Concepto</th>
                                    <th class="tab-head" width="50px">Cantidad</th>
                                    <th class="tab-head" width="109px">Haberes</th>
                                    <th class="tab-head" width="109px">Descuentos</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($conceptos as $concepto)


                                    <tr class="nopadding" style="height: 10px">
                                        <td align="center"> {{ $concepto->concepto->codigo }}</td>
                                        <td>{{ $concepto->concepto->detalle }}</td>
                                        <td align="center">{{ $concepto->cantidad }}</td>
                                        @if( $concepto->concepto->haberdebe=="H")

                                            <td align="right">{{$concepto->importe}}</td>

                                        @else

                                            <td align="right"></td>

                                        @endif

                                        @if( $concepto->concepto->haberdebe=="D")

                                            <td align="right">{{$concepto->importe}} </td>

                                        @else

                                            <td align="right"></td>

                                        @endif


                                    </tr>
                                @endforeach

                                <tr>
                                    <td align="center"></td>
                                    <td></td>
                                    <td align="center"></td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                </tr>

                                </tbody>
                            </table>
                            <table  class="table" style="margin-bottom: 0px;">
                                <tfoot>
                                <tr>
                                    <th class="tab-head" width="327px">Totales</th>
                                    <th   width="109px" style="text-align: center;">{{$recibo->total_haber}}</th>
                                    <th   width="109px" style="text-align: center;">{{$recibo->total_debe}}</th>
                                </tr>
                                <tr>
                                    <th class="tab-head" width="327px">Neto a Cobrar (En Letras)</th>
                                    <th class="tab-head"  colspan="2">Neto a Cobrar </th>
                                </tr>
                                <tr>

                                    <td width="321px"  align="center" >{{ $f->format($recibo->total_neto)}} </td>
                                    <td colspan="2" align="center" ><strong style="font-size:120%;">{{$recibo->total_neto}}</strong></td>
                                </tr>

                                </tfoot>
                            </table>
                            <table class="table" style="margin-bottom: 0px;">
                                <tfoot>
                                <tr>
                                    <th class="tab-head">Forma de Pago</th>
                                </tr>

                                <tr>

                                    <td  align="center" >{{$empresa->FormaPago}} en {{$empresa->BancoPago}}</td>
                                </tr>
                                </tfoot>
                            </table>

                        </div>

                    </div>

                    <div  style="margin:3px 0px 3px 1px ; font-size: smaller">
                        <span>Mensaje Legal</span>
                    </div>
                    <div class="box box-default box-solid" style="padding:0px;position: absolute;bottom: 2.7cm;font-size: small; width: 595px">


                        <table class="table nopadding" style="margin-bottom: 0px;">
                            <thead>
                            <tr>
                                <th class="tab-head" colspan="3">Impuesto a las Ganacias Importes Acumulados</th>
                            </tr>
                            <tr>
                                <th class="tab-head" width="33%">Minimo Anual No imponible</th>
                                <th class="tab-head" width="33%">Imponible Percibido</th>
                                <th class="tab-head" width="33%">Imponible Pagado</th>
                            </tr>

                            </thead>
                            <tfoot>
                            <tr >
                                <th style="text-align: center">2800554</th>
                                <th style="text-align: center">2800554</th>
                                <th style="text-align: center">2800554</th>

                            </tr>

                            </tfoot>

                            </tfoot>
                        </table>

                    </div>
                    <div   style="border-width: 1px;position: absolute;bottom: 0; margin-top:5px;height: 2.6cm">
                        <div  style="width:7.5cm;float:left;margin:3px 0px 3px 7px;border: 1px solid black; border-radius:4px;height: 2.4cm">
                            <div style="position: absolute;bottom: 2px; width:263px;text-align: center; font-size: smaller; margin-bottom:1px;">
                                Buenos Aires, __/__/2015 <br>
                                <span style="font-size: smaller"> Lugar y Fecha </span>
                            </div>
                        </div>
                        <div style="width:7.5cm;float:left;margin:3px 0px 3px 17px;border: 1px solid black;border-radius:4px;height: 2.4cm">
                            <div style="position: absolute;bottom: 2px; width:263px;text-align: center; font-size: smaller; margin-bottom:2px;">
                                Gabriel Jaime<br>
                                <span style="font-size: smaller"> Gerente Departamental</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2" @if (!$esconsulta) hidden="true" @endif >
                <a class="btn btn-primary btn-block" id="imprimir" > <i class="fa fa-print"> </i> Imprimir </a>
                <a class="btn btn-success btn-block" id="descargar" > <i class="fa fa-download "> </i> Descargar </a>
            </div>
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

            $('#imprimir').click(function() {

                document.location.href ='{{ URL::to('printRecibo/'.$recibo->empleado->id.'/'.$año.'/'.$mes)}}'




            });

            $('#descargar').click(function() {

                document.location.href ='{{ URL::to('downloadRecibo/'.$recibo->empleado->id.'/'.$año.'/'.$mes)}}'




            });


            //iCheck for checkbox and radio inputs

        });
    </script>



    @include('admin.structure.dashboard-scripts')
    @include('scripts.address-lookup-g-api')
    @include('scripts.modals')
    @include('admin.modals.flash_message')
@endsection

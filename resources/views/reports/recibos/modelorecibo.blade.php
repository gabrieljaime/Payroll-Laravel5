<div class="col-xs-6 w545" style=" border: 1px solid #000000; border-radius: 4px ;height:23cm" @if (!$esconsulta) hidden="true" @endif >

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
        <div class="col-xs-3 nopadding"  >
            <div class="box box-default box-solid " style="border-width: 1px">
                <div class="box-head">
                    <table class="table  table-hover" style="margin-bottom: 0px">
                        <thead>

                        <tr>
                            <th class="tab-head" width="30%">Legajo</th>
                          </tr>
                        <tr align="center">

                            <td rowspan="3">{{$recibo->empleado->id}}</td>
                        </tr>

                        </thead>


                    </table>

                </div>

            </div>

        </div>
        <div class="col-xs-3 nopadding">
            <div class="box box-default box-solid " style="border-width: 1px">
                <div class="box-head">
                    <table class="table  table-hover" style="margin-bottom: 0px; ">
                        <thead>

                        <tr>
                            <th class="tab-head" width="60%">Nombre y Apellido</th>
                        </tr>
                        <tr align="center">

                         <td><strong>{{$recibo->empleado->nombre}}</strong></td>
                        </tr>
                        <tr>

                            <th class="tab-head">C.U.I.L</th>
                        </tr>
                        <tr align="center">


                            <td>{{$recibo->empleado->cuil}}</td>
                        </tr>
                        </thead>


                    </table>

                </div>

            </div>
            <div style="text-align: right">
                <strong> {{$copia }}</strong>
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
                        <th class="tab-head" width="20%">Periodo</th></th>
                        <th class="tab-head" width="20%">Fecha Pago</th></th>
                    </tr>
                    <tr align="center">
                        {{\Carbon\Carbon::setLocale('es')}}
                        <td>{{  $recibo->empleado->fecha_ingreso->format('d/m/Y')}}</td>
                        <td></td>
                        @if (($recibo->mes==13) or ($recibo->mes==14))
                            @if ($recibo->mes==13)
                                <td>S.A.C 1</td>
                                <td> 18/06/{{$recibo->año}}</td>
                            @else
                                <td>S.A.C 2</td>
                                <td> 20/12/{{$recibo->año}} </td>
                            @endif
                        @else
                            <td>{{Lang::get('meses.'.\Carbon\Carbon::createFromDate($recibo->año,$recibo->mes,1)->format('F')).' '.$recibo->año}}</td>
                            <td>{{$recibo->liquidacion->fecha_pago->format('d/m/Y')}}</td>
                        @endif

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
                    @foreach ($recibo->conceptos->sortBy('codigo') as $concepto)


                        <tr class="nopadding" style="height: 10px">
                            <td align="center"> {{ str_pad($concepto->concepto->codigo, 4, "0", STR_PAD_LEFT) }}</td>
                            <td>{{ $concepto->concepto->detalle }}</td>
                            <td align="center"> @if ($concepto->cantidad>0) {{$concepto->cantidad}} @endif</td>
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

                        <td width="321px"  align="center" >{{ $f->format($recibo->total_haber-$recibo->total_debe)}} </td>
                        <td colspan="2" align="center" ><strong style="font-size:120%;">{{$recibo->total_haber-$recibo->total_debe}}</strong></td>
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
            <span>{{$empresa->Legal}}</span>
        </div>
        {{--<div class="box box-default box-solid" style="padding:0px;position: absolute;bottom: 2.7cm;font-size: small; width: 595px">--}}


        {{--<table class="table nopadding" style="margin-bottom: 0px;">--}}
        {{--<thead>--}}
        {{--<tr>--}}
        {{--<th class="tab-head" colspan="3">Impuesto a las Ganacias Importes Acumulados</th>--}}
        {{--</tr>--}}
        {{--<tr>--}}
        {{--<th class="tab-head" width="33%">Minimo Anual No imponible</th>--}}
        {{--<th class="tab-head" width="33%">Imponible Percibido</th>--}}
        {{--<th class="tab-head" width="33%">Imponible Pagado</th>--}}
        {{--</tr>--}}

        {{--</thead>--}}
        {{--<tfoot>--}}
        {{--<tr >--}}
        {{--<th style="text-align: center">2800554</th>--}}
        {{--<th style="text-align: center">2800554</th>--}}
        {{--<th style="text-align: center">2800554</th>--}}

        {{--</tr>--}}

        {{--</tfoot>--}}

        {{--</tfoot>--}}
        {{--</table>--}}

        {{--</div>--}}
        <div   style="border-width: 1px;position: absolute;bottom: 0; margin-top:5px;height: 2.6cm">
            <div  style="width:7.5cm;float:left;margin:3px 0px 3px 7px;border: 1px solid black; border-radius:4px;height: 2.4cm">
                <div style="position: absolute;bottom: 2px; width:263px;text-align: center; font-size: smaller; margin-bottom:1px;">

                Firma Empleado
            </div>
        </div>
        <div style="width:7.5cm;float:left;text-align:center;margin:3px 0px 3px 17px;border: 1px solid black;border-radius:4px;height: 2.4cm;  ">
            {!! HTML::image('storage/firmaEdgardo.png' ,'Imagen', array('style'=>'height: 3cm; display:inline-block; margin-top:-20px')) !!}
                <div style="position: absolute;bottom: 2px; width:263px; font-size: smaller; margin-bottom:2px;">
                     <strong>{{$empresa->Firmante}}</strong>
                    <br>
                    Firma Apoderado
                </div>

            </div>
        </div>
    </div>
</div>


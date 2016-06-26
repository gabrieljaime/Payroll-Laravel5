
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>   Crear empleados
        |  LaraAdmin | Dashboard</title>
    <meta name="description" content="">


    <link type="text/css" rel="stylesheet" media="all" href="http://payrool/assets/css/admin/admin.css">
    <style>
        @media print {
            body, page[size="A4"] {
                margin: 0;
                box-shadow: 0;
            }
        }
        div.page
        {
            page-break-inside: avoid;
        }
        label {
            display: inline-block;
            max-width: 100%;
            margin-bottom: 1px;
            font-weight: bold;
        }
        .content {
            min-height: 250px;
            margin-right: auto;
            margin-left: auto;
            background: white;
        }
        .nopadding{padding:1px; }

    </style>

</head>

<body class="hold-transition skin-blue sidebar-mini fixed ">




<div class="content">

    <section class="content">
        <div class="page">
            <div style="height: 3cm">

            </div>
        <p>DESGLOCE POR CONCEPTO EN FORMA GENERAL MES DE Mayo del 2016</p>
        <table width="100%">
            <thead>
            <th width="50%">
                Detalle
            </th>
            <th width="30%">
                Cantidad
            </th>
            <th width="20%">
                Importe
            </th>
            </thead>
            <tbody>
                    @foreach ($Conceptos as $conceto)
                      <tr>
                          <td>
                              {{ $conceto->codigo }}       {{ $conceto->detalle }}
                          </td>
                          <td>
                              {{ $conceto->cantidad }}
                          </td>
                          <td style="text-align:right; padding-right: 60px" >

                              {{number_format( $conceto->importe, 2)  }}

                          </td>

                      </tr>
                    @endforeach
            </tbody>
        </table>
            <div class="page" style="height: 2cm"></div>
            <table>
            <tr>
                <td> TOTALES </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>TOTAL SUJETO A RETENCION</td>
                <td>:</td>
                <td style="text-align: right">{{number_format( $Liquid->total_retenciones, 2)}}</td>
            </tr>
            <tr>
                <td></td>
                <td>TOTAL ASIGNACIONES FAMILIARES</td>
                <td>:</td>
                <td style="text-align: right">{{number_format($Liquid->total_cargas,2)}}</td>
            </tr>
            <tr>
                <td></td>
                <td>TOTAL RETENCIONES</td>
                <td>:</td>
                <td style="text-align: right">{{number_format($Liquid->total_debes,2)}}</td>
            </tr>
            <tr>
                <td></td>
                <td>TOTAL NETO A PAGAR</td>
                <td>:</td>
                <td style="text-align: right">{{number_format($Liquid->total_netos,2)}}</td>
            </tr>
            <tr>
                <td></td>
                <td>TOTAL DE AGENTES</td>
                <td>:</td>
                <td style="text-align: right">{{number_format($Liquid->cant_legajos,2)}}</td>
            </tr>
        </table>
        </div>
    <div style="height: 5cm"></div>

        @foreach ($recibos->chunk(4) as $chunk)
        <div class="page">
    <div style="height: 3cm"></div>
            <p>Planilla de Haberes Ley N 20744 (t.o.) - Art 52</p>
            <p>Periodo Mayo 2016</p>
            <p>*****************************************************************************************</p>

            @foreach ($chunk as $recibo)
                <div class="row"  >
           <div class="row">
            <div class="col-xs-12 nopadding">
              <table width="100%">
                  <tr>
                      <td>
                          <strong>   Legajo :</strong> {{$recibo->empleado->id}}
                      </td>
                      <td>
                          <strong>  Nombre : </strong>{{$recibo->empleado->nombre}}
                      </td>
                  </tr>

                  <tr>
                      <td>
                          <strong> Especialidad :</strong> {{\App\Models\Category::find($recibo->empleado->categoria)->category}}  {{\App\Models\Specialty::find($recibo->empleado->subcategoria)->specialty}}
                      </td>
                      <td>
                          <strong>DNI :</strong>  {{$recibo->empleado->numero_documento}}
                      </td>

                  </tr>
                  <tr>
                      <td colspan="2">
                          <strong>Domicilio :</strong> {{$recibo->empleado->direccion}}
                      </td>


                  </tr>
                  <tr>
                      <td>
                          <strong> Fecha de Ingreso :</strong> {{  $recibo->empleado->fecha_ingreso->format('d/m/Y')}}
                      </td>
                      <td>
                          <strong>Estado Civil :</strong>{{\App\Models\ComboOption::find($recibo->empleado->estado_civil)->description}}
                      </td>
                  </tr>
              </table>
            </div>
           </div>
            <div class="row">
            <div class="col-xs-4 nopadding">
                <table width="100%">
                    <thead>
                    <th width="50%">
                        Concepto
                    </th>
                    <th align="center" width="20%">
                        Cant.
                    </th>
                    <th width="30%">
                        Haber
                    </th>
                    </thead>
                    <tbody>
                    @foreach ($recibo->conceptos->where('haberdebe','H')->sortBy('codigo') as $concepto)
                        <tr>
                            <td style="font-size:smaller">{{ substr($concepto->concepto->detalle,0,18) }}</td>
                            <td align="center"> @if ($concepto->cantidad>0) {{$concepto->cantidad}} @endif</td>
                            <td align="right">{{number_format($concepto->importe,2)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-xs-4 nopadding">
                <table width="100%">
                    <thead>
                    <th width="50%">
                        Concepto
                    </th>
                    <th width="20%">
                        Cant.
                    </th>
                    <th width="30%">
                        Asign.
                    </th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="col-xs-4 nopadding">
                <table width="100%">
                    <thead>
                    <th width="50%">
                        Concepto
                    </th>
                    <th width="20%">
                        Cant.
                    </th>
                    <th width="30%">
                        Reten.
                    </th>
                    </thead>
                    <tbody>
                    @foreach ($recibo->conceptos->where('haberdebe','D')->sortBy('codigo') as $concepto)

                        <tr>
                            <td style="font-size: smaller">{{ substr($concepto->concepto->detalle,0,18) }}</td>
                            <td align="center"> @if ($concepto->cantidad>0) {{$concepto->cantidad}} @endif</td>
                            <td align="right">{{number_format($concepto->importe,2)}}</td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
            <div style="height: 10px"></div>
                <hr>
                </div>
                    @endforeach

        </div>
        @endforeach
    </section>

</div>

</body>
</html>
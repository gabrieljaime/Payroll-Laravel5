
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>   Recibo de Sueldo
        |  Los Cedros S.A. | Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=29.7,height=21, initial-scale=1">

    <link type="text/css" rel="stylesheet" media="all" href="http://payrool/assets/css/admin/admin.css">
    <style>
        
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
            background: #d2d6de;
            background-color: #d2d6de;
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

    </style>

</head>

<body class="hold-transition skin-blue sidebar-mini">


<div class="content">



    <section class="content">

        <div class="row nopadding" >
            <div class="col-xs-6 w545" style=" border: 1px solid #000000; border-radius: 4px ;height:23cm">
                <div class="row nopadding">
                    <div class="col-xs-6 nopadding">
                       <div class="col-xs-4 nopadding" >
                            {!! HTML::image('storage/logorecibo.png' ,'Imagen', array('width' => '100px', 'style'=>'opacity: 0.8;')) !!}
                        </div>
                        <div class="col-xs-8 " style="padding:0px 0px 0px 10px; text-align: center">
                            <span style="font-size: small;"> CLINICA MODELO </span> </br>
                            <strong style="font-size:large"> LOS CEDROS S.A. </strong> </br>
                            <span style="font-size: smaller;"> Dr. A Ilia 2275/97 , San Justo </span> </br>
                             <span style="font-size: smaller;">Tel 4254-4444 Liena Rotativas</span></br>
                            <span style="font-size: small;">C.U.I.T 30-3233554-3</span>
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

                                        <td>762</td>
                                        <td><strong>Edgardo Arturo Girardi</strong></td>
                                    </tr>
                                    <tr>
                                        <th class="tab-head">Numero Recibo
                                        </th>
                                        <th class="tab-head">C.U.I.L</th>
                                    </tr>
                                    <tr align="center">

                                        <td>1</td>
                                        <td>20-10713784-0</td>
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

                                    <td>01/11/2010</td>
                                    <td></td>
                                    <td>Enero</td>
                                    <td>31/01/2015</td>
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

                                    <td align="center">Responsable</td>
                                    <td align="center"></td>
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
                                <tr class="nopadding" style="height: 10px">
                                    <td align="center">20</td>
                                    <td>Basico</td>
                                    <td align="center">1</td>
                                    <td align="right"> 10000,50</td>
                                    <td align="right"></td>
                                </tr>
                                <tr class="nopadding" style="height: 10px">
                                    <td align="center">23</td>
                                    <td>Antiguedad</td>
                                    <td align="center">50</td>
                                    <td align="right"> 2000,00</td>
                                    <td align="right"></td>
                                </tr>
                                <tr class="nopadding" style="height: 10px">
                                    <td align="center">11</td>
                                    <td>Art 10 ppp</td>
                                    <td align="center">1</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                </tr>
                                <tr class="nopadding" style="height: 10px">
                                    <td align="center">38</td>
                                    <td>Jubilacion</td>
                                    <td align="center">11</td>
                                    <td align="right"></td>
                                    <td align="right">1000</td>
                                </tr>

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
                                    <th   width="109px" style="text-align: center;">800</th>
                                    <th   width="109px" style="text-align: center;">8000</th>
                                </tr>
                                <tr>
                                    <th class="tab-head" width="327px">Neto a Cobrar (En Letras)</th>
                                    <th class="tab-head"  colspan="2">Neto a Cobrar </th>
                                </tr>
                                <tr>

                                    <td width="321px"  align="center" >Trecientos Pesos </td>
                                    <td colspan="2" align="center" ><strong style="font-size:120%;">300</strong></td>
                                </tr>

                                </tfoot>
                            </table>
                            <table class="table" style="margin-bottom: 0px;">
                                <tfoot>
                                <tr>
                                    <th class="tab-head">Forma de Pago</th>
                                </tr>

                                <tr>

                                    <td  align="center" >Deposito en banco credicotp</td>
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
            <div class="col-xs-6 w545" style=" border: 1px solid #000000; border-radius: 4px ;height:23cm">
                <div class="row nopadding">
                    <div class="col-xs-6 nopadding">
                        <div class="col-xs-4 nopadding" >
                            {!! HTML::image('storage/logorecibo.png' ,'Imagen', array('width' => '100px', 'style'=>'opacity: 0.8;')) !!}
                        </div>
                        <div class="col-xs-8 " style="padding:0px 0px 0px 10px; text-align: center">
                            <span style="font-size: small;"> CLINICA MODELO </span> </br>
                            <strong style="font-size:large"> LOS CEDROS S.A. </strong> </br>
                            <span style="font-size: smaller;"> Dr. A Ilia 2275/97 , San Justo </span> </br>
                            <span style="font-size: smaller;">Tel 4254-4444 Liena Rotativas</span></br>
                            <span style="font-size: small;">C.U.I.T 30-3233554-3</span>
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

                                        <td>762</td>
                                        <td><strong>Edgardo Arturo Girardi</strong></td>
                                    </tr>
                                    <tr>
                                        <th class="tab-head">Numero Recibo
                                        </th>
                                        <th class="tab-head">C.U.I.L</th>
                                    </tr>
                                    <tr align="center">

                                        <td>1</td>
                                        <td>20-10713784-0</td>
                                    </tr>
                                    </thead>


                                </table>

                            </div>

                        </div>
                        <div style="text-align: right">
                            <strong> COPIA EMPLEADO</strong>
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

                                    <td>01/11/2010</td>
                                    <td></td>
                                    <td>Enero</td>
                                    <td>31/01/2015</td>
                                </tr>
                                </thead>


                            </table>

                            <table class="table  table-hover" style="margin-bottom: 0px">

                                <thead>

                                <tr>
                                    <th class="tab-head" width="50%">Categoria</th></th>
                                    <th class="tab-head" width="50%">Función</th></th>

                                </tr>
                                <tr>

                                    <td align="center">Responsable</td>
                                    <td align="center"></td>
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
                                <tr class="nopadding" style="height: 10px">
                                    <td align="center">20</td>
                                    <td>BASICO</td>
                                    <td align="center">1</td>
                                    <td align="right"> 20.715,53</td>
                                    <td align="right"></td>
                                </tr>
                                <tr class="nopadding" style="height: 10px">
                                    <td align="center">23</td>
                                    <td>Antiguedad</td>
                                    <td align="center">50</td>
                                    <td align="right"> 2000,00</td>
                                    <td align="right"></td>
                                </tr>
                                <tr class="nopadding" style="height: 10px">
                                    <td align="center">11</td>
                                    <td>Art 10 ppp</td>
                                    <td align="center">1</td>
                                    <td align="right"></td>
                                    <td align="right"></td>
                                </tr>
                                <tr class="nopadding" style="height: 10px">
                                    <td align="center">38</td>
                                    <td>Jubilacion</td>
                                    <td align="center">11</td>
                                    <td align="right"></td>
                                    <td align="right">1000</td>
                                </tr>

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
                                    <th   width="109px" style="text-align: center;">800</th>
                                    <th   width="109px" style="text-align: center;">8000</th>
                                </tr>
                                <tr>
                                    <th class="tab-head" width="327px">Neto a Cobrar (En Letras)</th>
                                    <th class="tab-head"  colspan="2">Neto a Cobrar </th>
                                </tr>
                                <tr>

                                    <td width="321px"  align="center" >Trecientos Pesos </td>
                                    <td colspan="2" align="center" ><strong style="font-size:120%;">300</strong></td>
                                </tr>

                                </tfoot>
                            </table>
                            <table class="table" style="margin-bottom: 0px;">
                                <tfoot>
                                <tr>
                                    <th class="tab-head">Forma de Pago</th>
                                </tr>

                                <tr>

                                    <td  align="center" >Deposito en banco credicotp</td>
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
                            <div style="position: absolute;bottom: 3px; width:263px;text-align: center; font-size: smaller; margin-bottom:1px;">
                                Buenos Aires, __/__/2015 <br>
                                <span style="font-size: smaller"> Lugar y Fecha </span>
                            </div>
                        </div>
                        <div style="width:7.5cm;float:left;margin:3px 0px 3px 17px;border: 1px solid black;border-radius:4px;height: 2.4cm">
                            <div style="position: absolute;bottom: 3px; width:263px;text-align: center; font-size: smaller; margin-bottom:2px;">
                                Gabriel Jaime<br>
                                <span style="font-size: smaller"> Gerente Departamental</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>

    </section>

</div>

</body>

</html>
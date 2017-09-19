@extends('admin.layouts.dashboard')

@section('template_title')
    Listado de Fichadas
@endsection

@section('template_fastload_css')


@endsection


@section('content')
   <div class="content-wrapper">
           <section class="content-header">
               <h1>
                   Fichadas Diarias
                   <small> Listado </small>
               </h1>

              {{-- {!! Breadcrumbs::render('input') !!}--}}


           </section>
           <section class="content">
                <div class="box box-primary">

                    @include('flash::message')
                        @include('admin.modals.confirm-delete-gr')

                    <div class="box-header">


                        <i class="fa fa-calendar" ></i>
                        <h3 class="box-title">Periodo</h3>

                    </div>
                    <div class="box-body">
                        <div class="form-inline col-md-4">
                            <div class="col-md-4">

                                {!! Form::label('mes', 'Mes:', ['class'=>'control-label']) !!}
                                @include('liquidacion.selectmeses')
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('anio', 'Año:',['class'=>'control-label']) !!}
                                {!! Form::selectYear('año', $año-5 , $año+5, $año, ['class' => 'form-control','id'=>'anio'])!!}
                            </div>
                            <div style="padding-top: 20px;">
                                {!! Form::submit('Consultar', ['class' => 'btn btn-primary', 'id'=>'buscar']) !!}




                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="box-header">
                        <div class="pull-right box-tools">

                            <a href="#" onClick="table.fnReloadAjax()" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>
                        </div>
                        <i class="fa fa-user"></i>
                        <h3 class="box-title">Detalle por empleado</h3>

                    </div>


         <div class="box-body">
            @if($inputRelojs->isEmpty())
                <div class="well text-center">No hay fichadas cargadas.</div>
            @else
                 @include('reloj.input.table')
            @endif
            </div>
        </div>
        </section>
    </div>

@endsection

@section('template_scripts')


    <!-- DataTables -->


    <script type="text/javascript">
           $(function() {
               // Setup - add a text input to each footer cell
               $('#TableinputRelojs tfoot th').each( function () {
                   var title = $(this).text();
                   if ( (title== "Legajo") || (title== "Nombre")||(title== "Observaciones")||  (title=="Fecha") )
                   {
                       $(this).html( '<input type="search" id="search'+title+'" class="form-control" placeholder="Buscar x '+title+'" />' );
                   }
                   else
                   {
                       $(this).html( '' );
                   }
               } );
               var r = $('#TableinputRelojs tfoot tr');
               r.find('th').each(function(){
                   $(this).css('padding', 5);
               });
               $('#TableinputRelojs thead').prepend(r);

                 $('#TableinputRelojs').DataTable({
                   "scrollX": true,
                   "processing": true,
                 "serverSide": true,
                   "autoFill": true,
                    "dom": 'lrtip<"clear">',
                 "ajax": {
                    "url": '{{ URL::to('reloj/input/data').'/'.$mes.'/'.$año }}'
                },
                    buttons: {
                        dom: {
                                button: {
                                tag: 'a',
                                className: 'btn btn-s btn-primary'
                            }
                        },
                    buttons:  [{
                        extend: 'colvis',
                        text: 'Hide Columns'
                    }, {
                        extend: 'copyHtml5',
                        text: 'Copy'
                    },{
                        extend: 'excelHtml5',
                        text: 'To Excel',
                        title: 'Table input'
                    }, {
                        extend: 'pdfHtml5',
                        text: 'To PDF',
                        title: 'Table input'
                    }
                    ]},
                "columns": [
                    { "targets" : [0],"data": "actions", orderable: false, searchable: false  },
                    { "targets" : [1],"data": "legajo" },
                    { "targets" : [2],"data": "apynom" },
                    { "targets" : [3],"data": "fechadate" },
                    { "targets" : [4],"data": "fichadas" },
                    { "targets" : [5],"data": "hpausa"},
                    { "targets" : [6],"data": "hnormales" },
                    { "targets" : [7],"data": "htarde" },
                    { "targets" : [8],"data": "vtarde" },
                    { "targets" : [9],"data": "hanticipado" },
                    { "targets" : [10],"data": "vanticipado" },
                    { "targets" : [11],"data": "hausente" },
                    { "targets" : [12],"data": "vausente" },
                    { "targets" : [13],"data": "dtrabajados" },
                    { "targets" : [14],"data": "hferiado" },
                    { "targets" : [15],"data": "hdescuento" },
                    { "targets" : [16],"data": "hreales" },
                    { "targets" : [17],"data": "observaciones" }
                ]
            });

               var table = $('#TableinputRelojs').DataTable();
               // Apply the search
               table.columns().each( function () {
                   var that = this;
                   $( 'input', this.footer() ).on( 'keydown blur', function (ev) {

                       if (ev.keyCode == 13 ) { //only on enter keypress (code 13)
                           that
                                   .column(this.parentNode.cellIndex)
                                   .search( this.value )
                                   .draw();
                       }
                   } );
               } );
               $( "#buscar" ).click(function() {



                   var mes=$('#mes').val();
                   var anio=$('#anio').val();

                   table.ajax.url( '{{ URL::to('reloj/input/data/') }}/'+ mes +'/'+ anio).load();

               });


           });

    </script>
           <script type="text/javascript">

           $(document).ready(function() {
               // select2 style
               $('.select2').select2();

               $('.dataTable thead tr:nth-child(2)').addClass('bg-blue');
               // dataTables bootstrap style
               $('.dataTables_filter input').addClass('form-control')



           });
    </script>
    @include('admin.structure.dashboard-scripts')
    @include('scripts.address-lookup-g-api')
    @include('scripts.modals')

@endsection

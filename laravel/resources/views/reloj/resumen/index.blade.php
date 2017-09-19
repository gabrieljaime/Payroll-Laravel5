@extends('admin.layouts.dashboard')

@section('template_title')
    Listado de Fichadas Mensual
@endsection

@section('template_fastload_css')


@endsection


@section('content')
   <div class="content-wrapper">
           <section class="content-header">
               <h1>
                   Resumen de Fichada Mensual
                   <small> Listado </small>
               </h1>

              {{-- {!! Breadcrumbs::render('input') !!}--}}


           </section>
           <section class="content">
               {!! Form::open(['url' => URL::to('novedades/procesar/'), 'method' => 'patch' , 'id'=>'confirmar_novedades']) !!}
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
                                {!! Form::button('Consultar', ['class' => 'btn btn-primary', 'id'=>'buscar']) !!}




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
            @if(empty( $resumen))
                <div class="well text-center">No hay fichadas cargadas.</div>
            @else
                 @include('reloj.resumen.table')
            @endif
            </div>
        </div>
               <div class="box box-primary container-fluid">



                   <div class="col-md-4">
                       <div class="box-header">


                           <i class="fa fa-check-square-o" ></i>
                           <h3 class="box-title">Cargar Novedades</h3>

                       </div>
                       <div class="box-body">

                           <div class="form-inline">
                               <div style="padding-top: 20px;">

                                   {!! Form::button('Cargar a Novedades',['class' => 'btn btn-primary', 'id'=>'confirmar'])!!}


                               </div>
                           </div>


                       </div>
                   </div>


               </div>
               {!!Form::close()!!}
        </section>
    </div>

@endsection

@section('template_scripts')


    <!-- DataTables -->


    <script type="text/javascript">
           $(function() {
               // Setup - add a text input to each footer cell
               $('#TableResumen tfoot th').each( function () {
                   var title = $(this).text();
                   if ( (title== "Legajo") )
                   {
                       $(this).html( '<input type="search" id="search'+title+'" class="form-control" placeholder="Buscar x '+title+'" />' );
                   }
                   else
                   {
                       $(this).html( '' );
                   }
               } );
               var r = $('#TableResumen tfoot tr');
               r.find('th').each(function(){
                   $(this).css('padding', 5);
               });
              $('#TableResumen thead').prepend(r);
               $('#search_0').css('text-align', 'center');
               $('#TableResumen').DataTable({
                   "scrollX": true,
                   "processing": true,
                 "serverSide": true,
                    "dom": 'lrtip',
                 "ajax": {
                            "url": '{{ URL::to('reloj/resumen/data').'/'.$mes.'/'.$año }}'
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
                    { "targets" : [2],"data": "nombre" },
                    { "targets" : [3],"data": "dias_trabajados" },
                    { "targets" : [4],"data": "feriados_trabajados" },
                    { "targets" : [5],"data": "dias_descuentos"},
                    { "targets" : [6],"data": "horas_descuentos" },
                    { "targets" : [7],"data": "horas_extras" }
                ]
            });

               var table =  $('#TableResumen').DataTable();
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


               $('#buscar').click(function() {


                   var mes=$('#mes').val();
                   var anio=$('#anio').val();

                   table.ajax.url('{{ URL::to('reloj/resumen/data/') }}/'+ mes +'/'+ anio).load();


               });
               $('#confirmar').click(function() {

                   var mes=$('#mes').val();
                   var anio=$('#anio').val();

                   swal({
                               title: "Esta seguro?",
                               text: "Usted esta seguro que confirmar las novedades del periodo: "+anio+"/"+mes,
                               type: "warning",
                               showCancelButton: true,
                               confirmButtonColor: "#DD6B55",
                               confirmButtonText: "Si, Confirmar!",
                               cancelButtonText: "Cancelar",
                               closeOnConfirm: false
                           },
                           function(){
                               $("#confirmar_novedades").submit();
                           });





               });


           });

    </script>
           <script type="text/javascript">

           $(document).ready(function() {
               $('.select2').select2();

               // dataTables bootstrap style

               $('.dataTables_filter input').addClass('form-control')




               // add blue bg on header
               $('.dataTable thead th').addClass('bg-blue');



           });
    </script>
    @include('admin.structure.dashboard-scripts')
    @include('scripts.address-lookup-g-api')
    @include('scripts.modals')

@endsection

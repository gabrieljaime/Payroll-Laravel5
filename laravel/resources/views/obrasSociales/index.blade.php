@extends('admin.layouts.dashboard')

@section('template_title')
    Listado de Obras Sociales
@endsection

@section('template_fastload_css')


@endsection


@section('content')
   <div class="content-wrapper">
           <section class="content-header">
               <h1>
                   Obras Sociales
                   <small> Listado </small>
               </h1>

              {{-- {!! Breadcrumbs::render('obrasSociales') !!}--}}


           </section>
           <section class="content">
                <div class="box box-primary">

                    @include('flash::message')
                        @include('admin.modals.confirm-delete-gr')
                    <div class="box-header">
                        <div class="pull-right box-tools">
                            <a href="{{route('obrasSociales.create')}}" class="btn btn-primary btn-sm iframe">
                                <span class="fa fa-plus-circle"></span> Crear Nuevo
                            </a>
                            <a href="#" onClick="table.fnReloadAjax()" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>
                        </div>
                        <i class="fa fa-user"></i>
                        <h3 class="box-title">Obras Sociales</h3>

                    </div>


         <div class="box-body">
            @if($obrasSociales->isEmpty())
                <div class="well text-center">No se encontraron Obras Sociales.</div>
            @else
                 @include('obrasSociales.table')
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
               $('#TableobrasSociales tfoot th').each( function () {
                   var title = $(this).text();
                   if (title!= "Accion")
                   {
                       $(this).html( '<input type="search" id="search'+title+'" class="form-control" placeholder="Buscar X '+title+'" />' );
                   }
                   else
                   {
                       $(this).html( '' );
                   }
               } );
               var r = $('#TableobrasSociales tfoot tr');
               r.find('th').each(function(){
                   $(this).css('padding', 5);
               });
               $('#TableobrasSociales thead').prepend(r);

               $('#search_0').css('text-align', 'center');
                $('#TableobrasSociales').DataTable({
                   "scrollX": true,
                   "processing": true,
                  "serverSide": true,
                   "autoFill": true,
                   "dom": 'lfrtip<"clear"B>',
                "ajax": {
                    "url": '{{ URL::to('obrasSociales/data') }}'
                },
                    buttons: {
                        dom: {
                                button: {
                                tag: 'a',
                                className: 'btn btn-s btn-primary'
                            }
                        },
                    buttons:  [ {
                        extend: 'copyHtml5',
                        text: 'Copar'
                    },{
                        extend: 'excelHtml5',
                        text: 'A Excel',
                        title: 'Obras Sociales'
                    }, {
                        extend: 'pdfHtml5',
                        text: 'A Pdf',
                        title: 'Obras Sociales'
                    }
                    ]},
                "columns": [
                    { "targets" : [0],"data": "actions" , orderable: false, searchable: false },
                    { "targets" : [1],"data": "codigo" },
                    { "targets" : [2],"data": "nombre" },
                ]
            });

               var table = $('#TableobrasSociales').DataTable();
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
           });

    </script>
           <script type="text/javascript">

           $(document).ready(function() {
               // select2 style
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

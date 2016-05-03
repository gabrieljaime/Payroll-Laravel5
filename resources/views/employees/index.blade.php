@extends('admin.layouts.dashboard')

@section('template_title')
    Listado de Employees
@endsection

@section('template_fastload_css')


@endsection


@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Employees
                <small> Carga de Empleados </small>
            </h1>

            {!! Breadcrumbs::render('employees') !!}

        </section>
        <section class="content">

        <div class="box box-primary">


                @include('admin.modals.confirm-delete-gr')

                <div class="box-header">
                    <div class="pull-right box-tools">
                        <label class="control-label">
                            <input type="checkbox" name="todos" id="todos" checked="true" class="minimal">
                           Solo Activos
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{route('employees.create')}}" class="btn btn-primary btn-sm iframe">
                            <span class="fa fa-plus-circle"></span> Create New
                        </a>
                        <a href="#" onClick="table.fnReloadAjax()" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>
                    </div>
                    <i class="fa fa-user"></i>
                    <h3 class="box-title">Employees </h3>





                </div>
                <div class="box-body">
                    @if($employees->isEmpty())
                        <div  class="well text-center">No se encontraron employees </div>
                    @else
                            @include('employees.table')

                    @endif
                </div>
         </div>
        </section>
    </div>


        <!-- include('common.paginate', ['records' => $employees]) -->




@endsection


@section('template_scripts')


    <!-- DataTables -->




    <script type="text/javascript">
           $(function() {
               // Setup - add a text input to each footer cell
               $('#TableEmployees tfoot th').each( function () {
                   var title = $(this).text();
                   if (title!= " Action")
                   {
                       $(this).html( '<input type="search" id="search'+title+'" class="form-control" placeholder="Buscar '+title+'" />' );
                   }
                   else
                   {
                       $(this).html( '' );
                   }
                  } );
               var r = $('#TableEmployees tfoot tr');
               r.find('th').each(function(){
                   $(this).css('padding', 5);
               });
               $('#TableEmployees thead').prepend(r);

               $('#search_0').css('text-align', 'center');
                $('#TableEmployees').DataTable({
                   "scrollX": true,
                       "processing": true,
                 "serverSide": true,
                    "dom": 'lfrtip<"clear"B>',
                "ajax": {
                    "url": '{{ URL::to('employees/data/ACTIVOS') }}'
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
                        text: 'Ocultar Columnas'
                    }, {
                        extend: 'copyHtml5',
                        text: 'Copiar'
                    },{
                        extend: 'excelHtml5',
                        text: 'A Excel',
                        title: 'Tabla $MODEL_NAME_PLURAL_CAMEL$'
                    }, {
                        extend: 'pdfHtml5',
                        text: 'A PDF',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        title: 'Tabla $MODEL_NAME_PLURAL_CAMEL$'
                    }
                    ]},
                "columns": [
                    { "targets" : [0],"data": "actions", orderable: false, searchable: false },
                    { "targets" : [1],"data": "id" },
                    { "targets" : [2],"data": "nombre" },
                    { "targets" : [3],"data": "cuil" },
                    { "targets" : [4],"data": "fecha_ingreso" },
                    { "targets" : [5],"data": "categoria" },
                    { "targets" : [6],"data": "subcategoria" },
                    { "targets" : [7],"data": "tipo_documento" },
                    { "targets" : [8],"data": "numero_documento" },
                    { "targets" : [9],"data": "basico" },
                    { "targets" : [10],"data": "activo" },
                    { "targets" : [11],"data": "estado" }
                ]
            });

               var table = $('#TableEmployees').DataTable();
               // Apply the search
               table.columns().each( function () {
                   var that = this;

                   $( 'input', this.footer() ).on( 'keydown blur', function (ev) {


                       if (ev.keyCode == 13 ) { //only on enter keypress (code 13)
                           that
                                   .column(this.parentNode.cellIndex )
                                   .search( this.value )
                                   .draw();
                       }
                   } );
               } );



               $('input[type="checkbox"].minimal').iCheck({
                   checkboxClass: 'icheckbox_square-blue',
                   increaseArea: '20%' // optional
               });
               $('#todos').on('ifChecked', function () {
                   table.ajax.url( '{{ URL::to('employees/data/ACTIVOS') }}/').load();
               });
               $('#todos').on('ifUnchecked', function () {
                   table.ajax.url( '{{ URL::to('employees/data/TODOS') }}/').load();
               });
           });

    </script>
           <script type="text/javascript">

           $(document).ready(function() {
               // select2 style
               $('.select2').select2();

               // dataTables bootstrap style
               $('.dataTables_length select').select2({width: 80})
               $('.dataTables_filter input').addClass('form-control')




             // add blue bg on header
               $('.dataTable thead th').addClass('bg-blue');


           });
    </script>
    @include('admin.structure.dashboard-scripts')
    @include('scripts.address-lookup-g-api')
    @include('scripts.modals')

    @include('admin.modals.flash_message')

@endsection

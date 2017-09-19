@extends('admin.layouts.dashboard')

@section('template_title')
    Listado de Trabajdos
@endsection

@section('template_fastload_css')


@endsection


@section('content')
   <div class="content-wrapper">
           <section class="content-header">
               <h1>
                   Trabajos Programados
                   <small>  </small>
               </h1>

              {{-- {!! Breadcrumbs::render('jobs') !!}--}}


           </section>
           <section class="content">
                <div class="box box-primary">

                    @include('flash::message')
                        @include('admin.modals.confirm-delete-gr')
                    <div class="box-header">
                        <div class="pull-right box-tools">

                            <a href="#" id="cargar" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>
                        </div>
                        <i class="fa fa-user"></i>
                        <h3 class="box-title">jobs</h3>

                    </div>


         <div class="box-body">
            @if($jobs->isEmpty())
                <div class="well text-center">No found any jobs.</div>
            @else
                 @include('jobs.table')
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

               $('#search_0').css('text-align', 'center');
                $('#Tablejobs').DataTable({
                   "scrollX": true,
                   "processing": true,
                 "serverSide": true,
                   "autoFill": true,
                    "dom": 'lfrtip',
                "ajax": {
                    "url": '{{ URL::to('jobs/data') }}'
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
                        title: 'Table jobs'
                    }, {
                        extend: 'pdfHtml5',
                        text: 'To PDF',
                        title: 'Table jobs'
                    }
                    ]},
                "columns": [
                    { "targets" : [0],"data": "actions", orderable: false, searchable: false  },
                    { "targets" : [1],"data": "queue" },
                    { "targets" : [2],"data": "payload" },
                    { "targets" : [3],"data": "attempts" },
                    { "targets" : [4],"data": "reserved" },
                    { "targets" : [5],"data": "reserved_at" },
                    { "targets" : [6],"data": "available_at" },
                    { "targets" : [7],"data": "created_at" },
                ]
            });

               var table = $('#Tablejobs').DataTable();
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

               $('#cargar').on('click', function(){
                   table.ajax.reload();
               });
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

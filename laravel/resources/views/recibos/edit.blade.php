@extends('admin.layouts.dashboard')

@section('template_title')
   Editar Recibos
@endsection

@section('template_fastload_css')



@endsection


@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Recibo
                <small> Edición Manual de Recibos </small>
            </h1>

            {{-- {!! Breadcrumbs::render('conceptos') !!}--}}


        </section>


        <section class="content">

            @include('admin.modals.confirm-delete-gr')
            @include('recibos.updateconcepto')

            <div class="box box-primary container-fluid">



                <div class="row">


                    <div class="col-md-12">
                        <div class="box-header">

                            <i class="fa fa-file-text-o"></i>

                            <h3 class="box-title">Datos del Recibo</h3>

                        </div>
                        <div class="box-body">

                            <div class="col-md-6">
                                <i class="fa fa-user"></i>
                                <strong>Legajo: </strong> {{$empleado->id}} - {{$empleado->nombre}}
                            </div>
                            <div class="col-md-6">
                                <i class="fa fa-calendar"></i>
                                <strong>Periodo: </strong> {{Lang::get('meses.'.\Carbon\Carbon::createFromDate($recibo->año,$recibo->mes,1)->format('F')).' '.$recibo->año}}
                            </div>


                        </div>
                        <div class="box-header">

                            <i class="fa fa-usd"></i>

                            <h3 class="box-title">Importes totales</h3>

                        </div>
                        <div class="box-body">

                            <div class="col-md-3">

                                <strong>Sujeto a Retención: </strong>$ {{number_format( $recibo->total_retenciones, 2)}}
                            </div>
                            <div class="col-md-3">

                                <strong>Asignaciones Familiares: </strong>$ {{number_format( $recibo->total_cargas, 2)}}

                            </div>
                            <div class="col-md-3">

                                <strong>Renteciones: </strong>$ {{number_format( $recibo->total_debe, 2)}}


                            </div>
                            <div class="col-md-3">

                                <strong>Neto a Pagar: </strong>$ {{number_format( $recibo->total_neto, 2)}}

                            </div>



                        </div>
                    </div>

                </div>

            </div>



                    <!-- Submit Field -->




            <div class="container-fluid">
                <div class="row">
                    <div class="box box-primary">
                        <div class="box-header">

                            <i class="fa fa-cogs"></i>

                            <h3 class="box-title">Conceptos en Recibo </h3>


                        </div>
                        <div class="box-body">


                            @if($conceptos->isEmpty())
                                <div class="well text-center">No hay conceptos para el recibo.</div>
                            @else
                                @include('recibos.tableconceptos')
                            @endif

                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>

@endsection

@section('template_scripts')
    <script type="text/javascript">
        $(function () {



            var variables= $('#Tableconceptos').DataTable({
                "scrollX": true,
                "processing": true,
                "serverSide": true,
                "autoFill": true,
                "autoWidth": false,
                "dom": 'rtip',
                "ajax": {
                    "url": '{{ URL::to('recibos/data/'.$recibo->id) }}'
                },
                buttons: {
                    dom: {
                        button: {
                            tag: 'a',
                            className: 'btn btn-s btn-primary'
                        }
                    },
                    buttons: [{
                        extend: 'colvis',
                        text: 'Hide Columns'
                    }, {
                        extend: 'copyHtml5',
                        text: 'Copy'
                    }, {
                        extend: 'excelHtml5',
                        text: 'To Excel',
                        title: 'Table conceptos'
                    }, {
                        extend: 'pdfHtml5',
                        text: 'To PDF',
                        title: 'Table conceptos'
                    }
                    ]
                },
                "columns": [
                    {"targets": [0], "data": "actions", orderable: false, searchable: false},
                    {"targets": [1], "data": "codigo"},
                    {"targets": [2], "data": "detalle"},
                    {"targets": [3], "data": "cantidad"},
                    {"targets": [4], "data": "importe"}

                ]
            });

            // add blue bg on header
            $('.dataTable thead th').addClass('bg-blue');
        });

    </script>

    <script>


        $('#confirmUpdateConcepto').on('show.bs.modal', function (e) {
            var message = $(e.relatedTarget).attr('data-message');
            var title = $(e.relatedTarget).attr('data-title');
            var action= $(e.relatedTarget).attr('data-id');
            var detalle = $(e.relatedTarget).attr('data-detalle');
            var codigo = $(e.relatedTarget).attr('data-codigo');
            var importe =$(e.relatedTarget).attr('data-importe');
            var cantidad =$(e.relatedTarget).attr('data-cantidad');
            $(this).find('.modal-body p').text(message);
            $(this).find('.modal-title').text(title);
            $('#codigo').val(codigo);
            $('#detalle').val(detalle);
            $('#importe').val(importe);
            $('#cantidad').val(cantidad);
            $('#update').attr('action',action);


        });
        $('#confirmUpdateConcepto').find('.modal-footer #confirm').on('click', function(){
            $(this).data('form').submit();
        });



    </script>
    @include('admin.structure.dashboard-scripts')
    @include('scripts.address-lookup-g-api')
    @include('scripts.modals')
    @include('admin.modals.flash_message')
@endsection

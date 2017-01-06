@extends('admin.layouts.dashboard')

@section('template_title')
    Imprimir recibos generados
@endsection

@section('template_fastload_css')


@endsection


@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Recibos
                <small> Listados </small>
            </h1>

            {{-- {!! Breadcrumbs::render('specialties') !!}--}}


        </section>
        <section class="content">

            <div class="box box-primary" >

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

                <div class="box-body">
                    @if($recibos->isEmpty())
                        <div class="well text-center">No se encontraron recibos para imprimir.</div>
                    @else
                        @include('reports.recibos.tableimp')
                    @endif
                </div>
            </div>

            <!-- Submit Field -->

        </section>
    </div>

@endsection

@section('template_scripts')


    <!-- DataTables -->


    <script type="text/javascript">
        $(function() {
            // Setup - add a text input to each footer cell
            $('#TableImpresiones tfoot th').each( function () {
                var title = $(this).text();
                if ((title!= "Accion") &&(title!= "Año")  &&(title!= "Mes") &&(title!= "Ultima descarga")&&(title!= "Parcial"))
                {
                    $(this).html( '<input type="search" id="search'+title+'" class="form-control" placeholder="Buscar '+title+'" />' );
                }
                else
                {
                    $(this).html( '' );
                }
            } );
            var r = $('#TableImpresiones tfoot tr');
            r.find('th').each(function(){
                $(this).css('padding', 5);
            });
            $('#TableImpresiones thead').prepend(r);

            $('#search_0').css('text-align', 'center');
            $('#TableImpresiones').DataTable({
                "scrollX": true,
                "processing": true,
                "serverSide": true,
                "dom": 'lfrtip<"clear">',
                "ajax": {
                    "url": '{{ URL::to('impresionrecibo/data/').'/'.$mes.'/'.$año }}'
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
                        title: 'Tabla Empleados'
                    }, {
                        extend: 'pdfHtml5',
                        text: 'A PDF',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        title: 'Tabla Empleados'
                    }
                    ]},
                "columns": [
                    { "targets" : [0],"data": "actions", orderable: false, searchable: false  },
                    { "targets" : [1],"data": "año" },
                    { "targets" : [2],"data": "mes" },
                    { "targets" : [3],"data": "parte" },
                    {    "targets" : [4],"data": "tipo" },
                    { "targets" : [6],"data": "descargado" },
                    { "targets" : [7],"data": "fecha_descarga" }
                ]
            });

            var table = $('#TableImpresiones').DataTable();
            // Apply the search
            table.columns().each( function () {
                var that = this;
                $( 'input', this.footer() ).on( 'keydown blur', function (ev) {

                    if (ev.keyCode == 13 ) { //only on enter keypress (code 13)
                        that
                                .column(this.parentNode.cellIndex-1)
                                .search( this.value )
                                .draw();
                    }
                } );
            } );
            $( "#buscar" ).click(function() {



                var mes=$('#mes').val();
                var anio=$('#anio').val();

                table.ajax.url( '{{ URL::to('impresionrecibo/data/') }}/'+ mes +'/'+ anio).load();

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

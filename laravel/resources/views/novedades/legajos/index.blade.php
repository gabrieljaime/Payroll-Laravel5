@extends('admin.layouts.dashboard')

@section('template_title')
   Listado de Novedades por Legajo
@endsection

@section('template_fastload_css')


@endsection


@section('content')
   <div class="content-wrapper">
           <section class="content-header">
               <h1>
                   Novedades
                   <small> Listado </small>
               </h1>

              {{-- {!! Breadcrumbs::render('novedades') !!}--}}


           </section>
           <section class="content">
               <div class="box box-primary container-fluid">



                   <div class="row">
                       <div class="col-md-4">
                           <div class="box-header">

                               <i class="fa fa-calendar"></i>

                               <h3 class="box-title">Periodo</h3>

                           </div>
                           <div class="box-body">
                               <div class="form-inline">
                                   <div class="col-md-6">

                                       {!! Form::label('mes', 'Mes:', ['class'=>'control-label']) !!}
                                       @include('liquidacion.selectmeses')
                                   </div>
                                   <div class="col-md-6">
                                       {!! Form::label('anio', 'Año:',['class'=>'control-label']) !!}
                                       {!! Form::selectYear('año', $año-5 , $año+5, $año, ['class' => 'form-control', 'id'=>'anio'])
                                       !!}
                                   </div>

                               </div>
                           </div>
                       </div>
                       <div class="col-md-2">
                           <div class="box-header">

                               <i class="fa fa-search"></i>

                               <h3 class="box-title">Buscar</h3>

                           </div>

                           <div class="box-body">
                               <div class="form-inline text-center">


                                   <a class="btn btn-primary btn-block" id="buscar" > Buscar</a>

                               </div>
                           </div>

                       </div>


                       <!-- Submit Field -->


                   </div>
               </div>
                <div class="box box-primary">

                    @include('flash::message')
                        @include('admin.modals.confirm-delete-gr')
                    <div class="box-header">
                        <div class="pull-right box-tools">
                            <a href="#" onClick="table.fnReloadAjax()" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>
                        </div>
                        <i class="fa fa-user"></i>
                        <h3 class="box-title">Novedades</h3>

                    </div>


         <div class="box-body">
            @if($novedades->isEmpty())
                <div class="well text-center">No se encontraro novedades.</div>
            @else
                 @include('novedades.legajos.table')
            @endif
            </div>
               </div>
               </section>
               </div>

@endsection

@section('template_scripts')

<script type="text/javascript">
    $(function() {
    var novedades = $('#Tablenovedadeslegajos').DataTable({
        "scrollX": true,
        "processing": true,
        "serverSide": true,
        "autoFill": true,
        "dom": 'lrtip<"clear"B>',
        "ajax": {
            "url": '{{ URL::to('novedades/datalegajos/'.$año.'/'.$mes) }}'
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
                title: 'Table novedades'
            }, {
                extend: 'pdfHtml5',
                text: 'To PDF',
                title: 'Table novedades'
            }
            ]
        },
        "columns": [
            {"targets": [0], "data": "actions", orderable: false, searchable: false},
            {"targets": [1], "data": "legajo"},
            {"targets": [2], "data": "nombre"},
            {"targets": [3], "data": "periodo", orderable: false, searchable: false},
            {"targets": [4], "data": "novedad1"},
            {"targets": [5], "data": "novedad2"},
            {"targets": [6], "data": "novedad3"},
            {"targets": [7], "data": "novedad4"},
            {"targets": [8], "data": "novedad5"}
        ]
    });


        // Apply the search
        $("#buscar").click(function () {


            var mes = $('#mes').val();
            var anio = $('#anio').val();

            novedades.ajax.url('{{ URL::to('novedades/datalegajos') }}/' + anio + '/' + mes).load();

        });
    });

</script>

    @include('admin.structure.dashboard-scripts')
    @include('scripts.address-lookup-g-api')
    @include('scripts.modals')

@endsection

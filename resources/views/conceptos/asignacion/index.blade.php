@extends('admin.layouts.dashboard')

@section('template_title')
    Lista de Conceptos Asignados
@endsection

@section('template_fastload_css')



@endsection


@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Concepto
                <small> List</small>
            </h1>

            {{-- {!! Breadcrumbs::render('conceptos') !!}--}}


        </section>


        <section class="content">
            <div class="box box-primary container-fluid">
                <div class="row">

                        <div class="col-md-6">
                            <div class="box-header">

                                <i class="fa fa-user"></i>

                                <h3 class="box-title">Conceptos</h3>

                            </div>
                            <div class="box-body">
                                {!! Form::open(['route' => 'conceptos.asignacion.index','enctype' =>'multipart/form-data','class'=>'form-inline'] ) !!}

                                <div class="form-group">

                                    {!! Form::label('legajo', 'Legajos:', ['class'=>'control-label']) !!}
                                    {!! Form::select('legajo', $Legajos, null, ['class' => 'form-control']) !!}
                                    <div class="form-control">
                                        <label class="control-label">
                                            <input type="checkbox" name="todos" id="todos" class="minimal">
                                            Seleccionar Todos
                                        </label>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="box-header">

                                <i class="fa fa-calendar"></i>

                                <h3 class="box-title">Periodo</h3>

                            </div>
                            <div class="box-body">
                                <div class="form-inline">
                                    <div class="col-md-6">
                                        {!! Form::label('periodos', 'Mes:', ['class'=>'control-label']) !!}
                                        {!! Form::selectMonth('mes', $mes, ['class' => 'form-control' ,
                                        'placeholder'=>'Enter password'])!!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::label('periodos', 'Año:',['class'=>'control-label']) !!}
                                        {!! Form::selectYear('año', $año-5 , $año+5, $año, ['class' => 'form-control'])
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

                                    {!! Form::submit('Buscar', ['class' => 'btn btn-primary btn-block']) !!}
                                </div>
                            </div>

                        </div>

                        {!! Form::close() !!}
                        <!-- Submit Field -->


                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="box box-primary">
                        <div class="box-header">

                            <i class="fa fa-user"></i>

                            <h3 class="box-title">Conceptos Variables</h3>

                            <div class="box-tools pull-right">
                                {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn
                                btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' =>
                                'tooltip')) !!}
                            </div>

                        </div>
                        <div class="box-body">


                            @if($conceptosvariables->isEmpty())
                                <div class="well text-center">No found any Conceptos.</div>
                            @else
                                @include('conceptos.asignacion.tablevariable')
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="box box-primary">
                        <div class="box-header">

                            <i class="fa fa-user"></i>

                            <h3 class="box-title">Conceptos Fijos</h3>

                            <div class="box-tools pull-right">
                                {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn
                                btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' =>
                                'tooltip')) !!}
                            </div>

                        </div>
                        <div class="box-body">


                            @if($conceptosfijos->isEmpty())
                                <div class="well text-center">No found any Conceptos.</div>
                            @else
                                @include('conceptos.asignacion.tablefijo')
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.box -->



        </section>

    </div>

@endsection

@section('template_scripts')
    <script type="text/javascript">
        $(function () {
            // Setup - add a text input to each footer cell
            $('#Tableconceptosvariables tfoot th').each(function () {
                var title = $(this).text();
                if (title != "Action") {
                    $(this).html('<input type="search" id="search' + title + '" class="form-control" placeholder="Search ' + title + '" />');
                }
                else {
                    $(this).html('');
                }
            });
            var r = $('#Tableconceptosvariables tfoot tr');
            r.find('th').each(function () {
                $(this).css('padding', 5);
            });
            $('#Tableconceptosvariables thead').prepend(r);

            $('#search_0').css('text-align', 'center');
            $('#Tableconceptosvariables').DataTable({
                "scrollX": true,
                "processing": true,
                "serverSide": true,
                "autoFill": true,
                "autoWidth": true,
                "dom": 'lfrtip<"clear"B>',
                "ajax": {
                    "url": '{{ URL::to('conceptos/asignacion/datavariable') }} /$mes/$año'
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
                    {"targets": [3], "data": "importe"},
                    {"targets": [4], "data": "porcentaje"},
                    {"targets": [5], "data": "imp_por"}
                ]
            });

            var table = $('#Tableconceptosvariables').DataTable();
            // Apply the search
            table.columns().each(function () {
                var that = this;
                $('input', this.footer()).on('keydown blur', function (ev) {

                    if (ev.keyCode == 13) { //only on enter keypress (code 13)
                        that
                                .column(this.parentNode.cellIndex)
                                .search(this.value)
                                .draw();
                    }
                });
            });

            // Setup - add a text input to each footer cell
            $('#Tableconceptosfijos tfoot th').each(function () {
                var title = $(this).text();
                if (title != "Action") {
                    $(this).html('<input type="search" id="search' + title + '" class="form-control" placeholder="Search ' + title + '" />');
                }
                else {
                    $(this).html('');
                }
            });
            var r = $('#Tableconceptosfijos tfoot tr');
            r.find('th').each(function () {
                $(this).css('padding', 5);
            });
            $('#Tableconceptosfijos thead').prepend(r);

            $('#search_0').css('text-align', 'center');
            $('#Tableconceptosfijos').DataTable({
                "scrollX": true,
                "processing": true,
                "serverSide": true,
                "autoFill": true,
                "autoWidth": true,
                "dom": 'lfrtip<"clear"B>',
                "ajax": {
                    "url": '{{ URL::to('conceptos/asignacion/datafijo') }}'
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
                    {"targets": [3], "data": "importe"},
                    {"targets": [4], "data": "porcentaje"},
                    {"targets": [5], "data": "imp_por"}

                ]
            });

            var table = $('#Tableconceptosfijos').DataTable();
            // Apply the search
            table.columns().each(function () {
                var that = this;
                $('input', this.footer()).on('keydown blur', function (ev) {

                    if (ev.keyCode == 13) { //only on enter keypress (code 13)
                        that
                                .column(this.parentNode.cellIndex)
                                .search(this.value)
                                .draw();
                    }
                });
            });
        });

    </script>
    <script type="text/javascript">

        $(document).ready(function () {
            // select2 style
            $('#legajo').select2({
                allowClear: true,
                multiple: true,
                placeholder: "Seleccione"
            });
            $('input[type="checkbox"].minimal').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                increaseArea: '20%' // optional
            });
            $('#legajo').addClass('form-control select2');
            $('#legajo').val(null).trigger("change");
            $('input[type="checkbox"].minimal').on('ifChecked', function () {
                $("#legajo > option").removeAttr("selected");// Select All Options
                $("#legajo").trigger("change");// Trigger change to select 2
                $("#legajo").prop("disabled", true);
            });
            $('input[type="checkbox"].minimal').on('ifUnchecked', function () {
                $("#legajo").prop("disabled", false);
                $("#legajo > option").removeAttr("selected");
                $("#legajo").trigger("change");// Trigger change to select 2

            });

            //iCheck for checkbox and radio inputs

        });
    </script>

    @include('admin.structure.dashboard-scripts')
    @include('scripts.address-lookup-g-api')
    @include('scripts.modals')

@endsection

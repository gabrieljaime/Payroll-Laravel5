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

            @include('admin.modals.confirm-delete-gr')
            @include('conceptos.fijos.confirm-update')
            @include('conceptos.fijos.create')
            @include('conceptos.variables.create')
            @include('conceptos.variables.update')

            <div class="box box-primary container-fluid">



                <div class="row">

                        <div class="col-md-6">
                            <div class="box-header">

                                <i class="fa fa-user"></i>

                                <h3 class="box-title">Filtros</h3>

                            </div>
                            <div class="box-body">

                                <div class="form-group form-inline">

                                    {!! Form::label('legajo', 'Legajos:', ['class'=>'control-label ']) !!}
                                    {!! Form::select('legajo', $Legajos, null, ['class' => 'form-control', 'disabled'=>'true']) !!}
                                    <div class="form-control pull-right">
                                        <label class="control-label">
                                            <input type="checkbox" name="todos" id="todos" checked="true" class="minimal">
                                            Seleccionar Todos
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group form-inline ">
                                    {!! Form::label('concepto', 'Conceptos:', ['class'=>'control-label ']) !!}
                                    {!! Form::select('concepto', $Conceptos, null, ['class' => 'form-control ','disabled'=>'true']) !!}
                                    <div class="form-control pull-right">
                                        <label class="control-label">
                                            <input type="checkbox" id="todosconceptos" id="todos" checked="true" class="minimal">
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
                                        {!! Form::label('mes', 'Mes:', ['class'=>'control-label']) !!}
                                        {!! Form::selectMonth('mes', $mes, ['class' => 'form-control' ,
                                        'placeholder'=>'Enter password'])!!}
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

            <div class="container-fluid">
                <div class="row">
                    <div class="box box-primary">
                        <div class="box-header">

                            <i class="fa fa-user"></i>

                            <h3 class="box-title">Conceptos Variables</h3>

                            <div class="box-tools pull-right">
                                <a class="btn btn-primary btn-sm iframe" type="button" data-toggle="modal"
                                         id="btnAsociarVariable" data-target="#confirmAsociarConceptoVariable"
                                         data-categoria_id="0" data-categoria="TODAS" data-title="Asociar Concepto"
                                         data-id="{{route('conceptovariable.store')}}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>Asociar Concepto Variable
                                </a>

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
                                <a class="btn btn-primary btn-sm iframe" type="button" data-toggle="modal"
                                   id="btnAsociar" data-target="#confirmAsociarConceptoFijo"
                                   data-categoria_id="0" data-categoria="TODAS" data-title="Asociar Concepto"
                                   data-id="{{route('conceptofijo.store')}}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>Asociar Concepto Fijo
                                </a>

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



           var variables= $('#Tableconceptosvariables').DataTable({
                "scrollX": true,
                "processing": true,
                "serverSide": true,
                "autoFill": true,
                "autoWidth": false,
                "dom": 'lrtip<"clear"B>',
                "ajax": {
                    "url": '{{ URL::to('conceptos/asignacion/datavariable/'.$mes.'/'.$año.'/todos/todos') }}'
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
                    {"targets": [1], "data": "concepto.codigo"},
                    {"targets": [2], "data": "concepto.detalle"},
                    {"targets": [3], "data": "employees_id"},
                    {"targets": [4], "data": "empleado.nombre"},
                    {"targets": [5], "data": "cantidad"},
                    {"targets": [6], "data": "importe"}

                ]
            });
            var fijos = $('#Tableconceptosfijos').DataTable({
                "scrollX": true,
                "processing": true,
                "serverSide": true,
                "autoFill": true,
                "autoWidth": false,
                "dom": 'lrtip<"clear"B>',
                "ajax": {
                    "url": '{{ URL::to('conceptos/asignacion/datafijo/todos/todos') }}'
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
                    {"targets": [1], "data": "concepto.codigo"},
                    {"targets": [2], "data": "concepto.detalle"},
                    {"targets": [3], "data": "employees_id"},
                    {"targets": [4], "data": "empleado.nombre"},
                    {"targets": [5], "data": "cantidad"},
                    {"targets": [6], "data": "importe"}

                ]
            });

            // add blue bg on header
            $('.dataTable thead th').addClass('bg-blue');
            $( "#buscar" ).click(function() {




                var mes=$('#mes').val();
                var anio=$('#anio').val();
                var todos=false;
                var legajos;
                var conceptos;
                if($('#todos').is(":checked")) {legajos = 'todos';}
                else {legajos=$("#legajo").val();};
                if($('#todosconceptos').is(":checked")) {conceptos = 'todos';}
                else {conceptos=$("#concepto").val();};

                $('#mes_cr').val(mes);
                $('#año_cr').val(anio);

                $("#employees_id_cr").val($("#legajo").val()).trigger("change");
                $("#concepto_id_cr").val($("#concepto").val()).trigger("change");

                $("#employees_id_cf").val($("#legajo").val()).trigger("change");
                $("#concepto_id_cf").val($("#concepto").val()).trigger("change");

                fijos.ajax.url( '{{ URL::to('conceptos/asignacion/datafijo') }}/'+ legajos +'/'+ conceptos).load();
                variables.ajax.url( '{{ URL::to('conceptos/asignacion/datavariable') }}/'+mes +'/'+anio+'/'+ legajos+'/'+ conceptos ).load();

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
            }).on("change", function(e) {
                // mostly used event, fired to the original element when the value changes
                $("#employees_id_cr").val($("#legajo").val()).trigger("change");
                $("#employees_id_cf").val($("#legajo").val()).trigger("change");
            });
            $('#concepto').select2({
                allowClear: true,
                multiple: true,
                placeholder: "Seleccione"
            }) .on("change", function(e) {
                // mostly used event, fired to the original element when the value changes
                $("#concepto_id_cr").val($("#concepto").val()).trigger("change");
                $("#concepto_id_cf").val($("#concepto").val()).trigger("change");
            });
            $('#concepto_id_cr').select2({
                placeholder: "Seleccione"
            });
            $('#employees_id_cr').select2({
                allowClear: true,
                multiple: true,
                placeholder: "Seleccione"
            });
            $('#concepto_id_cf').select2({
                placeholder: "Seleccione"
            });
            $('#employees_id_cf').select2({
                allowClear: true,
                multiple: true,
                placeholder: "Seleccione"
            });
            $('input[type="checkbox"].minimal').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                increaseArea: '20%' // optional
            });
            $('#concepto_id_cr').addClass('form-control select2');
            $('#concepto_id_cr').val(null).trigger("change");
            $('#employees_id_cr').addClass('form-control select2');
            $('#employees_id_cr').val(null).trigger("change");
            $('#concepto_id_cf').addClass('form-control select2');
            $('#concepto_id_cf').val(null).trigger("change");
            $('#employees_id_cf').addClass('form-control select2');
            $('#employees_id_cf').val(null).trigger("change");
            $('#legajo').addClass('form-control select2');
            $('#legajo').val(null).trigger("change");
            $('#concepto').addClass('form-control select2');
            $('#concepto').val(null).trigger("change");
            $('#todosconceptos').on('ifChecked', function () {
                $("#concepto > option").removeAttr("selected");// Select All Options
                $("#concepto").trigger("change");// Trigger change to select 2
                $("#concepto").prop("disabled", true);
                $("#concepto_id_cr > option").removeAttr("selected");
                $("#concepto_id_cr").trigger("change");// Trigger change to select 2
                $("#concepto_id_cr").prop("disabled", true);
                $("#concepto_id_cf > option").removeAttr("selected");
                $("#concepto_id_cf").trigger("change");// Trigger change to select 2
                $("#concepto_id_cf").prop("disabled", true);

            });
            $('#todosconceptos').on('ifUnchecked', function () {
                $("#concepto").prop("disabled", false);
                $("#concepto > option").removeAttr("selected");
                $("#concepto").trigger("change");// Trigger change to select

                $("#concepto_id_cr").prop("disabled", false);
                $("#concepto_id_cr").prop("readonly", "readonly");
                $("#concepto_id_cr > option").removeAttr("selected");
                $("#concepto_id_cr").trigger("change");// Trigger change to select
                $("#concepto_id_cf").prop("disabled", false);
                $("#concepto_id_cf").prop("readonly", "readonly");
                $("#concepto_id_cf > option").removeAttr("selected");
                $("#concepto_id_cf").trigger("change");// Trigger change to select
            });
            $('#todos').on('ifChecked', function () {
                $("#legajo > option").removeAttr("selected");// Select All Options
                $("#legajo").trigger("change");// Trigger change to select 2
                $("#legajo").prop("disabled", true);

                $("#employees_id_cr > option").removeAttr("selected");// Select All Options
                $("#employees_id_cr").trigger("change");// Trigger change to select 2
                $("#employees_id_cr").prop("disabled", true);
                $("#todos_cr").iCheck('check');
                $("#employees_id_cf > option").removeAttr("selected");// Select All Options
                $("#employees_id_cf").trigger("change");// Trigger change to select 2
                $("#employees_id_cf").prop("disabled", true);
                $("#todos_cf").iCheck('check');

            });
            $('#todos').on('ifUnchecked', function () {
                $("#legajo").prop("disabled", false);
                $("#legajo > option").removeAttr("selected");
                $("#legajo").trigger("change");// Trigger change to select 2

                $("#employees_id_cr").prop("disabled", false);
                $("#employees_id_cr").prop("readonly", "readonly");
                $("#employees_id_cr > option").removeAttr("selected");
                $("#employees_id_cr").trigger("change");// Trigger change to select 2
                $("#todos_cr").iCheck('uncheck');

                $("#employees_id_cf").prop("disabled", false);
                $("#employees_id_cf").prop("readonly", "readonly");
                $("#employees_id_cf > option").removeAttr("selected");
                $("#employees_id_cf").trigger("change");// Trigger change to select 2
                $("#todos_cf").iCheck('uncheck');
            });



            //iCheck for checkbox and radio inputs

        });
    </script>




  <script>

      $('#confirmAsociarConceptoVariable').on('show.bs.modal', function (e) {
          var message = $(e.relatedTarget).attr('data-message');
          var title = $(e.relatedTarget).attr('data-title');
          var action= $(e.relatedTarget).attr('data-id');
          var categoria_id = $(e.relatedTarget).attr('data-categoria_id');
          var categoria = $(e.relatedTarget).attr('data-categoria');
          $(this).find('.modal-body p').text(message);
          $(this).find('.modal-title').text(title);
          $('#categoria_id').val(categoria_id);
          $('#categoria_create').val(categoria);
          $('#store').attr('action',action);


      });
      $('#confirmAsociarConceptoVariable').find('.modal-footer #confirm').on('click', function(){
          $(this).data('form').submit();
      });
      $('#confirmAsociarConceptoFijo').on('show.bs.modal', function (e) {
          var message = $(e.relatedTarget).attr('data-message');
          var title = $(e.relatedTarget).attr('data-title');
          var action= $(e.relatedTarget).attr('data-id');
          var categoria_id = $(e.relatedTarget).attr('data-categoria_id');
          var categoria = $(e.relatedTarget).attr('data-categoria');
          $(this).find('.modal-body p').text(message);
          $(this).find('.modal-title').text(title);
          $('#categoria_id_cf').val(categoria_id);
          $('#categoria_create_cf').val(categoria);
          $('#store').attr('action',action);


      });
      $('#confirmAsociarConceptoFijo').find('.modal-footer #confirm').on('click', function(){
          $(this).data('form').submit();
      });

      $('#confirmUpdateConceptoVariable').on('show.bs.modal', function (e) {
          var message = $(e.relatedTarget).attr('data-message');
          var title = $(e.relatedTarget).attr('data-title');
          var action= $(e.relatedTarget).attr('data-id');
          var mes= $(e.relatedTarget).attr('data-mes');
          var anio= $(e.relatedTarget).attr('data-anio');
          var concepto_id = $(e.relatedTarget).attr('data-concepto_id');
          var employees_id = $(e.relatedTarget).attr('data-employees_id');
          var importe =$(e.relatedTarget).attr('data-importe');
          var cantidad =$(e.relatedTarget).attr('data-cantidad');
          $(this).find('.modal-body p').text(message);
          $(this).find('.modal-title').text(title);
          $('#mes_up').val(mes);
          $('#mes_up_h').val(mes);
          $('#año_up_h').val(anio);
          $('#mes_up').val(mes);
          $('#concepto_id_up').val(concepto_id);
          $('#concepto_id_up_h').val(concepto_id);
          $('#employees_id_up').val(employees_id);
          $('#employees_id_up_h').val(employees_id);
          $('#importe_up').val(importe);
          $('#cantidad_up').val(cantidad);
          $('#update').attr('action',action);


      });
      $('#confirmUpdateConceptoVariable').find('.modal-footer #confirm').on('click', function(){
          $(this).data('form').submit();
      });
            // CONFIRMATION edit MODAL
      $('#confirmEditConceptoFijo').on('show.bs.modal', function (e) {
          var message = $(e.relatedTarget).attr('data-message');
          var title = $(e.relatedTarget).attr('data-title');
          var action= $(e.relatedTarget).attr('data-id');
          var concepto_id = $(e.relatedTarget).attr('data-concepto_id');
          var detalle = $(e.relatedTarget).attr('data-concepto');
          var employees_id = $(e.relatedTarget).attr('data-employees_id');
          var nombre = $(e.relatedTarget).attr('data-nombre');
          var importe =$(e.relatedTarget).attr('data-importe');
          var cantidad =$(e.relatedTarget).attr('data-cantidad');
          $(this).find('.modal-body p').text(message);
          $(this).find('.modal-title').text(title);
          $('#concepto_id').val(concepto_id);
          $('#detalle').val(detalle);
          $('#employees_id').val(employees_id);
          $('#nombre').val(nombre);
          $('#importe').val(importe);
          $('#cantidad').val(cantidad);
          $('#update_cv').attr('action',action);


      });
      $('#confirmEditConceptoFijo').find('.modal-footer #confirm').on('click', function(){
          $(this).data('form').submit();
      });


  </script>
    @include('admin.structure.dashboard-scripts')
    @include('scripts.address-lookup-g-api')
    @include('scripts.modals')
    @include('admin.modals.flash_message')
@endsection

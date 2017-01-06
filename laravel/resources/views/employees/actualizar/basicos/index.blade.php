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
                Empleados
                <small> Actualizar sueldos Basicos </small>
            </h1>

            {!! Breadcrumbs::render('employees') !!}

        </section>
        <section class="content">

            <div class="box box-primary container-fluid">
                @include('employees.actualizar.basicos.update')


                <div class="row">
                    {!! Form::open(['route' => 'actualizar.basicos.update', 'method' => 'patch' ,'enctype' => 'multipart/form-data', 'id'=>'actualizar_basicos']  ) !!}
                    <div class="col-md-6">
                        <div class="box-header">

                            <i class="fa fa-user"></i>

                            <h3 class="box-title">Filtros</h3>

                        </div>
                        <div class="box-body">

                            <div class="form-group ">

                                {!! Form::label('legajo', 'Legajos:', ['class'=>'control-label ']) !!}
                                {!! Form::select('legajo', $Legajos, null, ['class' => 'form-control', 'disabled'=>'true', 'style'=>'width: 100%']) !!}
                                <label class="control-label" style="margin-top: 5px">
                                    <input type="checkbox" name="todos" id="todos" checked="true" class="minimal">
                                    Seleccionar Todos
                                </label>

                            </div>
                            <div class="form-group ">

                                    <div class=" col-md-6">

                                {!! Form::label('categorialbl', 'Categoria:') !!}
                                 {!! Form::select('categoria', $Category ,null, ['class' => 'form-control','disabled'=>'true', 'id'=>'categoria']) !!}
                                        <label class="control-label" style="margin-top: 5px">
                                            <input type="checkbox" name="todasC" id="todasC" checked="true" class="minimal">
                                            Seleccionar Todas
                                        </label>
                                    </div>
                <div class="col-md-6">
                    {!! Form::label('subcategoria', 'Subcategoria:') !!}
                    {!! Form::select('subcategoria',$Specialty, null, ['class' => 'form-control','disabled'=>'true']) !!}
                    <label class="control-label" style="margin-top: 5px">
                        <input type="checkbox" name="todasS" id="todasS" checked="true" class="minimal">
                        Seleccionar Todas
                    </label>
                </div>


                <!-- Subcategoria Field -->

            </div>

                 </div>

                </div>


                <div class="col-md-4">
                    <div class="box-header">

                        <i class="fa fa-money"></i>

                        <h3 class="box-title">Cambios de Sueldos</h3>

                    </div>

                    <div class="box-body">


                        <!-- Sindicato Field -->
                        <div class="form-group">
                            {!! Form::label('labelbasico', 'Sueldo Basico:') !!}
                            {!! Form::input('text','valor',null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label class="control-label" style="margin-top: 5px">
                                <input type="radio" name="imppor" value="Importe"  checked class="minimal">
                                Importe
                            </label>
                            <label class="control-label" style="margin-top: 5px">
                                <input type="radio" name="imppor" value="Porcentaje" class="minimal">
                                Porcentaje
                            </label>
                        </div>



                    </div>

            </div>
            <div class="col-md-2">
            <div class="box-header">

            <i class="fa fa-file"></i>

            <h3 class="box-title">Actualizar</h3>


            </div>

            <div class="box-body">
            <div class="form-inline text-center">


                {!! Form::button('Aplicar', ['class' => 'btn btn-primary btn-block', 'id'=>'Guardar']) !!}

            </div>
            </div>

            </div>


                <!-- Submit Field -->


            </div>
            </div>
            <div class="box box-primary">



            <div class="box-header">
            <div class="pull-right box-tools">



            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


            <a href="#" onClick="table.fnReloadAjax()" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>
            </div>
            <i class="fa fa-user"></i>
            <h3 class="box-title">Listado de sueldos Basicos </h3>





            </div>
            <div class="box-body">
            @if($employees->isEmpty())
            <div  class="well text-center">No se encontraron empleados </div>
            @else
                @include('employees.actualizar.basicos.table')

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
                $('#TableBasicos tfoot th').each( function () {
                    var title = $(this).text();
                    if ((title!= "Legajo") && (title!= "Nombre"))
                    {
                        $(this).html( '' );
                    }
                    else
                    {
                        $(this).html( '<input type="search" id="search'+title+'" class="form-control" placeholder="Buscar X '+title+'" />' );
                    }
                } );
                var r = $('#TableBasicos tfoot tr');
                r.find('th').each(function(){
                    $(this).css('padding', 5);
                });
                $('#TableBasicos thead').prepend(r);

                $('#search_0').css('text-align', 'center');
                $('#TableBasicos').DataTable({
                    "scrollX": true,
                    "processing": true,
                    "serverSide": true,
                    "dom": 'lrtip<"clear"B>',
                    "ajax": {
                        "url": '{{ URL::to('employees/databasicos') }}'
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
                            title: 'Tabla Basicos'
                        }, {
                            extend: 'pdfHtml5',
                            text: 'A PDF',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            title: 'Tabla Basicos'
                        }
                        ]},
                    "columns": [
                        { "targets" : [0],"data": "actions", orderable: false, searchable: false },
                        { "targets" : [1],"data": "id" },
                        { "targets" : [2],"data": "nombre" },
                        { "targets" : [3],"data": "basico",searchable: false },
                        { "targets" : [4],"data": "categoria",searchable: false  },
                        { "targets" : [5],"data": "subcategoria",searchable: false  }
                    ]
                });

                var table = $('#TableBasicos').DataTable();
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


            });

    </script>
    <script type="text/javascript">

        $(document).ready(function() {
            // select2 style
            $('#legajo').select2({
                allowClear: true,
                placeholder: "Seleccione"
            });
                var $subcategoria = $("#subcategoria");
            var $categoria = $("#categoria");

            $categoria.select2({
                placeholder: "Seleccione"
            }).on('change', function() {
                $.ajax({
                    url:"{{ URL::to('categories/specialities/') }}/" + $categoria.val(), // if you say $(this) here it will refer to the ajax call not $('.company2')
                    type:'GET',
                    success:function(data) {
                        $subcategoria.empty();
                        $.each(data, function(value, key) {
                            $subcategoria.append($("<option></option>").attr("value", value).text(key)); // name refers to the objects value when you do you ->lists('name', 'id') in laravel
                        });
                        $subcategoria.select2(); //reload the list and select the first option
                    }
                });
            }).trigger('change');

            $('#subcategoria').select2({
                placeholder: "Seleccione"
            }).on("change", function(e) {
                // mostly used event, fired to the original element when the value changes
            });
            $('#legajo').val(null).trigger("change");
            // dataTables bootstrap style

            $('.dataTables_filter input').addClass('form-control')
            $('input[type="checkbox"].minimal').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                increaseArea: '20%' // optional
            });
            $('input[type="radio"].minimal').iCheck({
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });

            $('#todos').on('ifChecked', function () {
                $("#legajo > option").removeAttr("selected");// Select All Options
                $("#legajo").trigger("change");// Trigger change to select 2
                $("#legajo").prop("disabled", true);


            });
            $('#todos').on('ifUnchecked', function () {
                $("#legajo").prop("disabled", false);
                $("#legajo > option").removeAttr("selected");
                $("#legajo").trigger("change");// Trigger change to select 2

            });

            $('#todasC').on('ifChecked', function () {
                $("#categoria > option").removeAttr("selected");// Select All Options
                $("#categoria").trigger("change");// Trigger change to select 2
                $("#categoria").prop("disabled", true);



            });
            $('#todasC').on('ifUnchecked', function () {
                $("#categoria").prop("disabled", false);
                $("#categoria > option").removeAttr("selected");
                $("#categoria").trigger("change");// Trigger change to select 2

            });
            $('#todasS').on('ifChecked', function () {
                $("#subcategoria > option").removeAttr("selected");// Select All Options
                $("#subcategoria").trigger("change");// Trigger change to select 2
                $("#subcategoria").prop("disabled", true);


            });
            $('#todasS').on('ifUnchecked', function () {
                $("#subcategoria").prop("disabled", false);
                $("#subcategoria > option").removeAttr("selected");
                $("#subcategoria").trigger("change");// Trigger change to select 2

            });





            // add blue bg on header
            $('.dataTable thead th').addClass('bg-blue');


            $('#Guardar').on('click', function(){


               $valor= $('input:text[name=valor]').val();


                if ($.isNumeric($valor)) {

                    if ($("input:radio[name=imppor]:checked").val() == 'Importe') {
                        var $mensaje = 'Se va a actualizar a $' + $valor + ' el Sueldo Basico de los legajos incluidos.';
                    }
                    else {
                        var $mensaje = 'Se va a aumentar en un ' + $valor + '% el Sueldo Basico de los legajos incluidos.';
                    }
                    swal({
                                title: "Esta seguro?",
                                text: $mensaje, type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Si, actualizalo!",
                                cancelButtonText: "Cancelar",
                                closeOnConfirm: false
                            },
                            function () {
                                $("#actualizar_basicos").submit();
                            });
                }
                else{
                    swal({
                        title: "Campo Erroneo",
                        text: "El valor del campo Sueldo Basico debe ser un numero", type: "error",
                        closeOnConfirm: true
                    });

                }
            });


        });
    </script>
    <script>

        // CONFIRMATION edit MODAL
        $('#confirmUpdateBasico').on('show.bs.modal', function (e) {
            var message = $(e.relatedTarget).attr('data-message');
            var title = $(e.relatedTarget).attr('data-title');
            var action= $(e.relatedTarget).attr('data-id');
            var nombre = $(e.relatedTarget).attr('data-nombre');
            var basico =$(e.relatedTarget).attr('data-basico');
            var employees_id =$(e.relatedTarget).attr('data-employees_id');
            $(this).find('.modal-body p').text(message);
            $(this).find('.modal-title').text(title);
            $('#nombre').val(nombre);
            $('#basico_up').val(basico);
            $('#legajo_up').val(employees_id);
            $('#update_basico').attr('action',action);


        });
        $('#confirmUpdateBasico').find('.modal-footer #confirm').on('click', function(){
            $(this).data('form').submit();
        });


    </script>
    @include('admin.structure.dashboard-scripts')
    @include('scripts.address-lookup-g-api')
    @include('scripts.modals')

    @include('admin.modals.flash_message')

@endsection

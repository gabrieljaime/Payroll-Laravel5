@extends('admin.layouts.dashboard')

@section('template_title')
    Editar Empleados
@endsection


@section('template_fastload_css')


    .kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
    }
    .kv-avatar .file-input {
    display: table-cell;
    max-width: 220px;
    }

@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">

            <h1>
                Editar Empleado Legajo {{ $employees->id}}
            </h1>

            {!! Breadcrumbs::render('create_employees') !!}

        </section>

        <section class="content">

            {!! Form::model($employees, ['route' => ['employees.update', $employees->id], 'method' => 'patch','files' => 'true', 'class'=>''] ) !!}

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos Personales</h3>
                    <div class="box-tools pull-right">
                        {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' => 'tooltip')) !!}
                    </div>
                </div>
                <div class="box-body" >

                    {{--<div class="form-group col-sm-2 left">--}}

                            {{--@if (is_null($employees["photo"]) or $employees["photo"]=="")--}}


                            {{--{!! HTML::image('storage/legajos/icon-user-default.png' ,'Imagen', array('class' => 'img-circle','width' => '100%')) !!}--}}
                            {{--</br></br></br>--}}
                        {{--@else--}}
                            {{--{!! HTML::image('storage/legajos/' .$employees["photo"] ,'Imagen', array('class' => 'img-circle','width' => '100%', 'style'=>'border: 3px solid; border-color: transparent;border-color: rgba(60, 141, 188, 0.2);')) !!}--}}
                        {{--@endif--}}


                    {{--</div>--}}

                    @include('employees.personal', ['edit' => 'true'])
                 </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos de Contacto</h3>
                    <div class="box-tools pull-right">
                        {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' => 'tooltip')) !!}
                     </div>
                </div>
                <div class="box-body">
                    @include('employees.contact', ['edit' => 'true'])
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos Familiares</h3>
                    <div class="box-tools pull-right">
                        {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' => 'tooltip')) !!}
                      </div>
                </div>
                <div class="box-body">
                    @include('employees.family', ['edit' => 'true'])
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">

                    <h3 class="box-title">Datos Laborales</h3>
                    <div class="box-tools pull-right">
                        {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' => 'tooltip')) !!}
                     </div>
                </div>
                <div class="box-body">
                    @include('employees.jobs', ['edit' => 'true'])
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos Complementarios</h3>
                    <div class="box-tools pull-right">
                        {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' => 'tooltip')) !!}
                     </div>
                </div>
                <div class="box-body">
                    @include('employees.fields', ['edit' => 'true'])
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Estado</h3>
                    <div class="box-tools pull-right">
                        {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' => 'tooltip')) !!}
                    </div>
                </div>
                <div class="box-body">
                    @include('employees.status', ['edit' => 'true'])
                </div>


            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                {!! link_to('/employees', 'Cancelar', ['class' => 'btn btn-warning']) !!}
            </div>
            <!-- /.box -->

            {!! Form::close() !!}
                </div>

        </section>

        @include('employees.update_revista')
        <br>
        <br>
        <br>
    </div>



@endsection
@section('template_scripts')
    {!! Html::script('assets/plugins/bootstrap-fileinput/fileinput.js') !!}
    {!! Html::script('assets/plugins/bootstrap-fileinput/fileinput_locale_es.js') !!}
    {!! Html::script('assets/plugins/datepicker/bootstrap-datepicker.js') !!}
    {!! Html::script('assets/plugins/datepicker/locales/bootstrap-datepicker.es.js') !!}
    <script type="text/javascript">
        $(document).ready(function(){
                // select2 style
                $('select').select2();

            $("[data-mask]").inputmask();

            //Date picker
            $('#fecha_nacimiento').datepicker({
                autoclose: true,
                language:'es',
                format:'dd/mm/yyyy'
            });
            $('#fecha_ingreso').datepicker({
                autoclose: true,
                language:'es',
                todayBtn: 'linked',
                todayHighlight:true,
                format:'dd/mm/yyyy'
            });


// with plugin options

            var $categoria = $('#categoria');
            var $subcategoria = $("#subcategoria");

            $categoria.select2().on('change', function() {
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
            });


            $('#confirmCambiarRevista').on('show.bs.modal', function (e) {
                var title = $(e.relatedTarget).attr('data-title');
                var action= $(e.relatedTarget).attr('data-id');
                $(this).find('.modal-title').text(title);
                $('#store').attr('action',action);


            });
            $('#confirmCambiarRevista').find('.modal-footer #confirm').on('click', function(){
                $(this).data('form').submit();
            });

        });

        $('#Guardar').on('click', function(){
            if($('#sitrevista').val()=="99"){
            swal({
                        title: "Esta seguro?",
                        text: "Usted esta seguro que quiere dar la baja definitiva al legajo",         type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Si, dalo de baja!",
                        cancelButtonText: "Cancelar",
                        closeOnConfirm: false
                    },
                    function(){
                        $("#cambiar_revista").submit();
                    });
            }
            else
            {
                $("#cambiar_revista").submit();
            }


        });


        $('#conyugue').select2().on('change', function() {
            if ($('#conyugue').val()=="1")
            {
                $('#conyuguefields').prop('hidden', false)
            }
            else
            {
                $('#conyuguefields').prop('hidden', true)
            }

        });

        $('#cant_hijos').on('change', function() {
            for (i = 1; i < 10; i++) {
                if ( i<= $('#cant_hijos').val()) {
                    $('#hijo' + i + 'fields').prop('hidden', false)
                }
                else
                {
                    $('#hijo'+i+'fields').prop('hidden', true)
                }
            };

        });
        $(document).on('ready', function() {

           var $foto =  $("#photo").val();
            if ($foto=="") {
                $foto = "icon-user-default.png";
            }

            $("#photoup").fileinput({
                overwriteInitial: true,
                language: "es",
                maxFileSize: 1500,
                showClose: false,
                showCaption: false,
                browseLabel: '',
                removeLabel: '',
                browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
                removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
                removeTitle: 'Cancel or reset changes',
                elErrorContainer: '#kv-avatar-errors',
                msgErrorClass: 'alert alert-block alert-danger',
                defaultPreviewContent: '<img src="/storage/legajos/'+$foto+'" style="width:160px">',
                layoutTemplates: {main2: '{preview}  {browse}'},
                allowedFileExtensions: ["jpg", "png", "gif"]
            });
        });
    </script>

    @include('admin.structure.dashboard-scripts')
    @include('scripts.address-lookup-g-api')
    @include('scripts.modals')
    @include('admin.modals.flash_message')
@endsection

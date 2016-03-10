@extends('admin.layouts.dashboard')

@section('template_title')
   Crear empleados
@endsection

@section('template_fastload_css')


@endsection


@section('content')
    <div class="content-wrapper">
        <section class="content-header">

            <h1>
               Create Employees
            </h1>

            {!! Breadcrumbs::render('create_employees') !!}

        </section>

        <section class="content">
            {!! Form::open(['route' => 'employees.store','enctype' => 'multipart/form-data','files' => true]  ) !!}
      <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos Personales</h3>
                    <div class="box-tools pull-right">
                        {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' => 'tooltip')) !!}
                    </div>
                </div>
                <div class="box-body">
                    @include('employees.personal')
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos de Contacto</h3>
                    <div class="box-tools pull-right">
                        {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' => 'tooltip')) !!}
                        {!! Form::button('<i class="fa fa-times"></i>', array('class' => 'btn btn-box-tool','title' => 'close', 'data-widget' => 'remove', 'data-toggle' => 'tooltip')) !!}
                    </div>
                </div>
                <div class="box-body">
                    @include('employees.contact')
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos Familiares</h3>
                    <div class="box-tools pull-right">
                        {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' => 'tooltip')) !!}
                        {!! Form::button('<i class="fa fa-times"></i>', array('class' => 'btn btn-box-tool','title' => 'close', 'data-widget' => 'remove', 'data-toggle' => 'tooltip')) !!}
                    </div>
                </div>
                <div class="box-body">
                    @include('employees.family')
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">

                    <h3 class="box-title">Datos Laborales</h3>
                    <div class="box-tools pull-right">
                        {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' => 'tooltip')) !!}
                        {!! Form::button('<i class="fa fa-times"></i>', array('class' => 'btn btn-box-tool','title' => 'close', 'data-widget' => 'remove', 'data-toggle' => 'tooltip')) !!}
                    </div>
                </div>
                <div class="box-body">
                    @include('employees.jobs')
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos Complementarios</h3>
                    <div class="box-tools pull-right">
                        {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' => 'tooltip')) !!}
                        {!! Form::button('<i class="fa fa-times"></i>', array('class' => 'btn btn-box-tool','title' => 'close', 'data-widget' => 'remove', 'data-toggle' => 'tooltip')) !!}
                    </div>
                </div>
                <div class="box-body">
                    @include('employees.fields')
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Estado</h3>
                    <div class="box-tools pull-right">
                        {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' => 'tooltip')) !!}
                        {!! Form::button('<i class="fa fa-times"></i>', array('class' => 'btn btn-box-tool','title' => 'close', 'data-widget' => 'remove', 'data-toggle' => 'tooltip')) !!}
                    </div>
                </div>
                <div class="box-body">
                    @include('employees.status')
                </div>
            </div>

            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                {!! link_to('/employees', 'Cancelar', ['class' => 'btn btn-warning']) !!}
            </div>
        <!-- /.box -->
            {!! Form::close() !!}
        </section>
        <br>
        <br>
        <br>
    </div>



@endsection

@section('template_scripts')
        <script type="text/javascript">
        $(document).ready(function(){
            $('select').select2();

            $('select').addClass('form-control');
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
            }).trigger('change');

        });
    </script>
    @include('admin.structure.dashboard-scripts')
    @include('scripts.address-lookup-g-api')
    @include('scripts.modals')

@endsection

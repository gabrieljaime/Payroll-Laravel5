@extends('admin.layouts.dashboard')

@section('template_title')
    Editar Empleados
@endsection

@section('template_fastload_css')


@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">

            <h1>
                Edit Employees
            </h1>

            {!! Breadcrumbs::render('create_employees') !!}

        </section>

        <section class="content">

            {!! Form::model($employees, ['route' => ['employees.update', $employees->id], 'method' => 'patch','files' => 'true'] ) !!}

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos Personales</h3>
                    <div class="box-tools pull-right">
                        {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' => 'tooltip')) !!}
                    </div>
                </div>
                <div class="box-body" >

                    <div class="form-group col-sm-2 col-lg-2 clear">
                        {!! HTML::image(Gravatar::get(Auth::user()->email), Auth::user()->name, array('class' => 'img-circle', 'draggable' => 'false')) !!}

                    </div>

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
                    <h3 class="box-title">dos Example</h3>
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


    @include('admin.structure.dashboard-scripts')
    @include('scripts.address-lookup-g-api')
    @include('scripts.modals')

@endsection

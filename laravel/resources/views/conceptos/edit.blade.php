    @extends('admin.layouts.dashboard')

@section('template_title')
    Editar Conceptos
@endsection

@section('template_fastload_css')


@endsection

@section('content')

 <div class="content-wrapper">
        <section class="content-header">

            <h1>
                Editar un concepto
            </h1>

            {{--{!! Breadcrumbs::render('create_conceptos') !!}--}}


        </section>

        <section class="content">
            @include('commons.errors')
            {!! Form::model($concepto, ['route' => ['conceptos.update', $concepto->id], 'method' => 'patch']) !!}

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos de Conceptos</h3>
                    <div class="box-tools pull-right">
                        {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' => 'tooltip')) !!}
                    </div>
                </div>
                <div class="box-body">
                    @include('conceptos.general',  ['edit' => 'true'])
                </div>
                <!-- Submit Field -->

            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Propiedades</h3>
                    <div class="box-tools pull-right">
                        {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' => 'tooltip')) !!}
                    </div>
                </div>
                <div class="box-body">
                    @include('conceptos.propiedades')
                </div>
                <!-- Submit Field -->

            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Detalles</h3>
                    <div class="box-tools pull-right">
                        {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' => 'tooltip')) !!}
                    </div>
                </div>
                <div class="box-body">
                    @include('conceptos.fields')
                </div>
                <!-- Submit Field -->

            </div>
            <div class="form-group col-sm-12">
                {!! Form::submit('Guardar', ['class' => 'btn btn-s btn-primary']) !!}
                {!! link_to('/conceptos', 'Cancelar', ['class' => 'btn btn-s btn-warning']) !!}
            </div>


          {!! Form::close() !!}
        </section>
        <br>
        <br>
        <br>
 </div>
@endsection
@section('template_scripts')

    <script type="text/javascript">
        $(document).ready(function()
        {
            $('select').select2({
                placeholder: "Seleccione"
            });
            $('select').addClass('form-control');

        });
    </script>
    @include('admin.structure.dashboard-scripts')
    @include('scripts.address-lookup-g-api')
    @include('scripts.modals')

@endsection

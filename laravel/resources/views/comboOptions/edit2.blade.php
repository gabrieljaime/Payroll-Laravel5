@extends('admin.layouts.dashboard')

@section('template_title')
    Edit ComboOption
@endsection

@section('template_fastload_css')


@endsection

@section('content')

 <div class="content-wrapper">
        <section class="content-header">

            <h1>
                Edit Employees
            </h1>

            {{--{!! Breadcrumbs::render('create_comboOptions') !!}--}}


        </section>

        <section class="content">
            {!! Form::model($comboOption, ['route' => ['comboOptions.update', $comboOption->id], 'method' => 'patch']) !!}

          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Datos</h3>
                <div class="box-tools pull-right">
                    {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' => 'tooltip')) !!}
                </div>
            </div>
            <div class="box-body" >

                    @include('comboOptions.fields', ['edit' => 'true'])

            </div>
          </div>


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

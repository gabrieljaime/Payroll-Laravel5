@extends('admin.layouts.dashboard')

@section('template_title')
   Generación de Liquidación Mensual de conceptos especiales
@endsection

@section('template_fastload_css')



@endsection


@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Liquidación de Conceptos Especiales
                <small> </small>
            </h1>

            {{-- {!! Breadcrumbs::render('conceptos') !!}--}}


        </section>


        <section class="content">


         {{--   @include('flash::message')--}}

            <div class="box box-primary container-fluid">
                    {!! Form::open(['action' => 'LiquidacionController@liquidarantexp','enctype' => 'multipart/form-data'] ) !!}
                    {!! csrf_field() !!}
                    @include('liquidacion.form')

                    <!-- Submit Field -->

                    {!! Form::close() !!}
            </div>


            <!-- /.box -->



        </section>

    </div>

@endsection

@section('template_scripts')

    @include('liquidacion.scripts')


    @include('admin.structure.dashboard-scripts')
    @include('scripts.address-lookup-g-api')
    @include('scripts.modals')
    @include('admin.modals.flash_process')
@endsection

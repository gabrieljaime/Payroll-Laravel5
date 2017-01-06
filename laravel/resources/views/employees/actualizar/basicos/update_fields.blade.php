
<div class="box box-primary">


    <!-- Concepto Field -->
    <div class="box-header">

        <i class="fa fa-user"></i>

        <h3 class="box-title">Empleado</h3>

    </div>
    <div class="box-body">
        <div class="row form-group form-inline">
            <div class="col-md-12">

                {!! Form::label('legajo', 'Legajos:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
                {!! Form::input('text','legajo_up','', ['class' => 'form-control' ,'style'=>'width: 86%', 'readonly','required', 'id'=>'legajo_up']) !!}

            </div>
            </div>
            <div class="row form-group form-inline">
            <div class="col-md-12">

            {!! Form::label('nombre', 'Nombre:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
            {!! Form::input('nombre', 'nombre','',  ['class' => 'form-control' ,'style'=>'width: 86%', 'readonly','required']) !!}
            </div>

        </div>
    </div>

    <div class="box-header">

        <i class="fa fa-edit"></i>

        <h3 class="box-title">Datos Actuales</h3>

    </div>

    <div class="box-body">
        <!-- Cantidad Field -->
        <!-- Importe Field -->
        <div class="form-group col-md-6">
            {!! Form::label('importe', 'Sueldo Basico:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
            {!! Form::input('text','basico','0', ['class' => 'form-control','required', 'id'=>'basico_up']) !!}
        </div>

    </div>
</div>





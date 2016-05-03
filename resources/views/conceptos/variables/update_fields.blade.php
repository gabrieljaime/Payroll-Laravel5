
<div class="box box-primary">

    <div class="box-header">

        <i class="fa fa-calendar"></i>

        <h3 class="box-title">Periodo</h3>

    </div>
    <div class="box-body">

        <!-- Categoria Field -->
        <div class="form-group col-md-6">
            <input type="hidden" name="mes" id="mes_up_h" >
            {!! Form::label('mes', 'Mes:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
            {!! Form::SelectMonth('mes_up', $mes, ['class' => 'form-control','disabled', 'id'=>'mes_up' ]) !!}
        </div>

        <div class="form-group col-md-6">
            <input type="hidden" name="anio" id="año_up_h">
            {!! Form::label('año', 'Año:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
            {!! Form::text('anio_up', $año, ['class' => 'form-control','disabled','id'=>'año_up']) !!}
        </div>

    </div>

    <!-- Concepto Field -->
    <div class="box-header">

        <i class="fa fa-user"></i>

        <h3 class="box-title">Relación</h3>

    </div>
    <div class="box-body">
        <div class="row form-group form-inline">
        <div class="col-md-12">

            {!! Form::label('legajo', 'Legajos:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
            <input type="hidden" name="employees_id" id="employees_id_up_h" >
            {!! Form::select('employees_id_up', $Legajos,null, ['class' => 'form-control' ,'style'=>'width: 86%', 'disabled','id'=>'employees_id_up','required']) !!}


        </div>

        </div>
        <div class="form-group form-inline">
            <input type="hidden" name="concepto_id" id="concepto_id_up_h" >
            {!! Form::label('concepto', 'Concepto:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
            {!! Form::select('concepto_id_up', $conceptosvariables,null,  ['class' => 'form-control','style'=>'width: 86%', 'disabled', 'id'=>'concepto_id_up','required']) !!}

        </div>
    </div>

    <div class="box-header">

        <i class="fa fa-edit"></i>

        <h3 class="box-title">Valores</h3>

    </div>

    <div class="box-body">
        <!-- Cantidad Field -->
        <div class="form-group col-md-6">
            {!! Form::label('cantidad', 'Cantidad:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
            {!! Form::input('number','cantidad', 'cantidad', ['class' => 'form-control','required', 'id'=>'cantidad_up']) !!}
        </div>
        <!-- Importe Field -->
        <div class="form-group col-md-6">
            {!! Form::label('importe', 'Importe:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
            {!! Form::input('number','importe','importe', ['class' => 'form-control','required', 'id'=>'importe_up']) !!}
        </div>

    </div>
</div>





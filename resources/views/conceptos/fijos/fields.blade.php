<!-- Importe Field -->
<div class="row">

    <div class="form-group col-md-4">
        {!! Form::label('concepto_id', 'Codigo:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
        {!! Form::text('concepto_id','concepto_id', ['class' => 'form-control', 'disabled'=>true]) !!}
    </div>
    <div class="form-group col-md-8">
        {!! Form::label('detalle', 'Concepto:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
        {!! Form::text('datalle','concepto', ['class' => 'form-control','disabled'=>true]) !!}
    </div>

</div>


<div class="row">
    <!-- Importe Field -->
    <div class="form-group col-md-4">
        {!! Form::label('employees_id', 'Legajo:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
        {!! Form::input('number','employees_id', 'employees_id', ['class' => 'form-control','disabled'=>true]) !!}
    </div>

    <div class="form-group col-md-8">
        {!! Form::label('nombre', 'Nombre:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
        {!! Form::text('nombre','nombre', ['class' => 'form-control','disabled'=>true]) !!}
    </div>

</div>

<div class="row">
    <!-- Cantidad Field -->
    <div class="form-group col-md-6">
        {!! Form::label('cantidad', 'Cantidad:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
        {!! Form::input('number','cantidad', 'cantidad', ['class' => 'form-control']) !!}
    </div>
    <!-- Importe Field -->
    <div class="form-group col-md-6">
        {!! Form::label('importe', 'Importe:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
        {!! Form::input('number','importe','importe', ['class' => 'form-control']) !!}
    </div>
</div>




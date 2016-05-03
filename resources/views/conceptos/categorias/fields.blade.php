


<div class="row">
        <!-- Categoria Field -->
    <div class="form-group col-md-4">
        {!! Form::label('category_id', 'Categoria:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
        {!! Form::text('categoria_update', 'categoria_update', ['class' => 'form-control','disabled'=>true, 'id'=>'categoria_update']) !!}
    </div>

    <div class="form-group col-md-8">
        {!! Form::label('categoria', 'Detalle:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
        {!! Form::text('categoria','categoria', ['class' => 'form-control','disabled'=>true]) !!}
    </div>

</div>
<!-- Concepto Field -->
<div class="row">

    <div class="form-group col-md-4">
        {!! Form::label('concepto_id', 'Codigo:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
        {!! Form::text('concepto_id','concepto_id', ['class' => 'form-control', 'disabled'=>true]) !!}
    </div>
    <div class="form-group col-md-8">
        {!! Form::label('detalle_update', 'Concepto:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
        {!! Form::text('detalle_update','detalle_update', ['class' => 'form-control','disabled'=>true]) !!}
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




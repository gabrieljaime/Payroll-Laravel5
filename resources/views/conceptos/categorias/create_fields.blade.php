
<div class="row">
        <!-- Categoria Field -->
    <div class="form-group col-md-4">
        {!! Form::label('category_id', 'Categoria:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
        {!! Form::text('categoria_id', 'categoria_id', ['class' => 'form-control','readonly'=>'readonly' , 'id'=>'categoria_id']) !!}
    </div>

    <div class="form-group col-md-8">
        {!! Form::label('categoria', 'Detalle:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
        {!! Form::text('categoria','categoria', ['class' => 'form-control','disabled'=>true,'id'=>'categoria_create']) !!}
    </div>

</div>
<!-- Concepto Field -->
<div class="row">

    <div class="form-group col-md-12">
        {!! Form::label('concepto_id', 'Concepto:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
        {!! Form::select('concepto_id',$conceptosfijos,null, ['class' => 'form-control select2','style'=>'width: 100%']) !!}
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




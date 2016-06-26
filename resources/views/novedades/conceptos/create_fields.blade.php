<div class="row">

    <div class="form-group col-md-12">
        {!! Form::label('tiponovedad_id', 'Tipo de Novedad:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
        {!! Form::select('tiponovedad_id',$tiposnovedades,null, ['class' => 'form-control select2','style'=>'width: 100%']) !!}
    </div>

</div>
<!-- Concepto Field -->
<div class="row">

    <div class="form-group col-md-12">
        {!! Form::label('concepto_id', 'Concepto:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
        {!! Form::select('concepto_id',$conceptosvariables,null, ['class' => 'form-control select2','style'=>'width: 100%']) !!}
    </div>

</div>
<!-- Codigo Field -->
<div class="form-group col-lg-2">
    {!! Form::label('codigo', 'Codigo:') !!}
    {!! Form::text('codigo', null, ['class' => 'form-control']) !!}
</div>

<!-- Detalle Field -->
<div class="form-group col-lg-10">
    {!! Form::label('detalle', 'Detalle:') !!}
    {!! Form::text('detalle', null, ['class' => 'form-control']) !!}
</div>
<!-- Esfijo Field -->
<div class="form-group col-lg-2">
    {!! Form::label('esfijo', 'Es fijo:') !!}
    {!! Form::select('esfijo',[''=>'','SI','NO'], null, ['class' => 'form-control']) !!}
</div>
<!-- Basico Field -->
<div class="form-group col-lg-2">
    {!! Form::label('basico', 'Basico:') !!}
    {!! Form::select('basico',[''=>'','SI','NO'], null, ['class' => 'form-control']) !!}
</div>

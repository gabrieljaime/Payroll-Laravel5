<!-- Activo Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('activo', 'Activo:') !!}
    {!! Form::select('activo',['Activo','Inactivo'] ,'Activo', ['class' => 'form-control']) !!}

</div>

<!-- Estado Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('estado', 'Estado de Revista:') !!}
    {!! Form::select('estado', ['estados_revista'],null, ['class' => 'form-control']) !!}
</div>

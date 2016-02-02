<!-- Id Field -->
<!-- Photo Field -->
    <div class="form-group col-sm-6 col-lg-4 ">
        {!! Form::label('photo', 'Foto:') !!}
        {!! Form::file('photoup', null, ['class' => 'form-control']) !!}
       <div style="visibility:hidden;position: fixed">
           {!! Form::text('photo', null , ['class' => 'form-control'])!!}
       </div>
    </div>
<!-- Nombre Field -->
<div class="form-group col-sm-6 col-lg-8">
    {!! Form::label('nombre', 'Nombre y Apellido:') !!}
	{!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>
<!-- Fecha Nacimiento Field -->
<div class="form-group col-sm-6 col-lg-2">
    {!! Form::label('fecha_nacimiento', 'Fecha Nacimiento:') !!}
    {!! Form::text('fecha_nacimiento', null, ['class' => 'form-control']) !!}
</div>
<!-- Tipo Documento Field -->
<div class="form-group col-sm-6 col-lg-2">
    {!! Form::label('tipo_documento', 'Tipo Documento:') !!}
    {!! Form::select('tipo_documento',['TipoDoc','2'], null , ['class' => 'form-control']) !!}
</div>
<!-- Numero Documento Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('numero_documento', 'Numero Documento:') !!}
    {!! Form::text('numero_documento', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('cuil', 'Cuil:') !!}
    {!! Form::text('cuil', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6 col-lg-2">
    {!! Form::label('sexo', 'Sexo:') !!}

    {!! Form::select('sexo', ['Masculino','Femenino'] , null , ['class' => 'form-control']) !!}

</div>
<!-- Estado Civil Field -->
<div class="form-group col-sm-6 col-lg-2    ">
    {!! Form::label('estado_civil', 'Estado Civil:') !!}
    {!! Form::select('estado_civil', ['estadocivil'] , null , ['class' => 'form-control']) !!}
</div>

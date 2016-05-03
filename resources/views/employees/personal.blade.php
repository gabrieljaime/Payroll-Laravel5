<!-- Id Field -->
<!-- Photo Field -->
<div id="kv-avatar-errors" class="center-block" style="width:800px;display:none"></div>
<div class="form-group col-sm-2">
        {!! Form::label('photo', 'Foto:') !!}
        <div class="kv-avatar center-block" style="width:200px">
            <input id="photoup" name="photoup" type="file" class="file-loading">
        </div>

       <div style="visibility:hidden;position: fixed">
           {!! Form::text('photo', null , ['class' => 'form-control'])!!}
       </div>


    </div>



    <div class="form-group col-sm-2">

        {!! Form::label('legajo', 'Legajo:') !!}
        {!! Form::text('id', null, ['class' => 'form-control', 'readonly'=>'readonly']) !!}

    </div>


<!-- Nombre Field -->


    <div class="form-group col-sm-8">
    {!! Form::label('nombre', 'Nombre y Apellido:') !!}
	{!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Documento Field -->
<div class="form-group col-sm-2">
    {!! Form::label('tipo_documento', 'Tipo Documento:') !!}
    {!! Form::select('tipo_documento',$TipoDoc, null , ['class' => 'form-control','data-role'=>'select', 'data-placeholder'=>'Seleccione un Tipo de documento']) !!}
</div>
<!-- Numero Documento Field -->


                <div class="form-group col-sm-4">

    {!! Form::label('numero_documento', 'Numero Documento:') !!}
    {!! Form::text('numero_documento', null, ['class' => 'form-control', 'data-inputmask'=>'"mask": "99.999.999"', 'data-mask' ]) !!}
</div>


                            <div class="form-group col-sm-4">

    {!! Form::label('cuil', 'Cuil:') !!}
    {!! Form::text('cuil', null, ['class' => 'form-control','data-inputmask'=>'"mask": "99-99.999.999-9"', 'data-mask']) !!}
</div>

                                                            <!-- Fecha Nacimiento Field -->
                                        <div class="form-group col-sm-2">
                                            {!! Form::label('fecha_nacimiento', 'Fecha Nacimiento:') !!}
                                            {!! Form::input('date','fecha_nacimiento', null, ['class' => 'form-control']) !!}
                                        </div>
<div class="form-group col-sm-6 col-lg-2">
    {!! Form::label('sexo', 'Sexo:') !!}

    {!! Form::select('sexo', $Sexo , null , ['class' => 'form-control','data-role'=>'select', 'data-placeholder'=>'Seleccione...']) !!}

</div>
<!-- Estado Civil Field -->
<div class="form-group col-sm-6 col-lg-2    ">
    {!! Form::label('estado_civil', 'Estado Civil:') !!}
    {!! Form::select('estado_civil',$EstadoCivil , null , ['class' => 'form-control', 'data-role'=>'select', 'data-placeholder'=>'Seleccione...']) !!}
</div>

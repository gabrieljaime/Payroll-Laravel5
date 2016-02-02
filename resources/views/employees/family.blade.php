<!-- Conyugue Field -->
<div class="form-group col-sm-6 col-lg-2">
    {!! Form::label('conyugue', 'Conyugue:') !!}
    {!! Form::select('conyugue',['N','S'], null, ['class' => 'form-control']) !!}
</div>
<!-- Cant Hijos Field -->
<div class="form-group col-sm-6 col-lg-2">
    {!! Form::label('cant_hijos', 'Cantidad de Hijos:') !!}
    {!! Form::text('cant_hijos', null, ['class' => 'form-control']) !!}
</div>

<!-- Cant Hijos Disc Field -->
<div class="form-group col-sm-6 col-lg-2">
    {!! Form::label('cant_hijos_disc', 'Hijos con Discapacidad:') !!}
    {!! Form::text('cant_hijos_disc', null, ['class' => 'form-control']) !!}
</div>

<!-- Hijos Escpres Field -->
<div class="form-group col-sm-6 col-lg-2">
    {!! Form::label('hijos_escpres', 'Hijos en Prescolar:') !!}
    {!! Form::text('hijos_escpres', null, ['class' => 'form-control']) !!}
</div>

<!-- Hijos Escprim Field -->
<div class="form-group col-sm-6 col-lg-2">
    {!! Form::label('hijos_escprim', 'Hijos en Primaria:') !!}
    {!! Form::text('hijos_escprim', null, ['class' => 'form-control']) !!}
</div>

<!-- Hijos Escsec Field -->
<div class="form-group col-sm-6 col-lg-2">
    {!! Form::label('hijos_escsec', 'Hijos en Secundaria:') !!}
    {!! Form::text('hijos_escsec', null, ['class' => 'form-control']) !!}
</div>

<!-- Hijos Univer Field -->
<div class="form-group col-sm-6 col-lg-2" hidden="hidden">
    {!! Form::label('hijos_univer', 'Hijos Universitarios:') !!}
    {!! Form::text('hijos_univer', null, ['class' => 'form-control']) !!}
</div>


<!-- Tiene A Cargo Field -->
<div class="form-group col-sm-6 col-lg-2">
    {!! Form::label('tiene_a_cargo', 'Tiene personas a Cargo:') !!}
    {!! Form::select('tiene_a_cargo', ['N','S'], null, ['class' => 'form-control']) !!}
</div>

<!-- Cant A Cargo Field -->
<div class="form-group col-sm-6 col-lg-2">
    {!! Form::label('cant_a_cargo', 'Cantidad A Cargo:') !!}
    {!! Form::text('cant_a_cargo', null, ['class' => 'form-control']) !!}
</div>

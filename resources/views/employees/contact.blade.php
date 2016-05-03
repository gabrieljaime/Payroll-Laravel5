<!-- Telefono Field -->
<div class="form-group col-sm-4 col-lg-3">
    {!! Form::label('telefono', 'Telefono:') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control','data-inputmask'=>'"mask": "(999) 9999-9999"', 'data-mask']) !!}
</div>
<!-- Celular Field -->
<div class="form-group col-sm-4 col-lg-3">
    {!! Form::label('celular', 'Celular:') !!}
    {!! Form::text('celular', null, ['class' => 'form-control','data-inputmask'=>'"mask": "(999) 15-9999-9999"', 'data-mask']) !!}
</div>
<!-- Email Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Localidad Field -->
<div class="form-group  col-lg-3">
    {!! Form::label('localidad', 'Localidad:') !!}
    {!! Form::select('localidad',$Localidades, null, ['class' => 'form-control','data-role'=>'select', 'data-placeholder'=>'Seleccione una Localidad']) !!}
</div>

<div class="form-group  col-lg-9">
    {!! Form::label('direccion', 'Direccion:') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
</div>

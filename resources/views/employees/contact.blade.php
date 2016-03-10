<!-- Telefono Field -->
<div class="form-group col-sm-4 col-lg-3">
    {!! Form::label('telefono', 'Telefono:') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
</div>
<!-- Celular Field -->
<div class="form-group col-sm-4 col-lg-3">
    {!! Form::label('celular', 'Celular:') !!}
    {!! Form::text('celular', null, ['class' => 'form-control']) !!}
</div>
<!-- Email Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Localidad Field -->
<div class="form-group  col-lg-3">
    {!! Form::label('localidad', 'Localidad:') !!}
    {!! Form::select('localidad',['Lanus','Avellaneda','CABA','Merlo'], null, ['class' => 'form-control']) !!}
</div>

<div class="form-group  col-lg-9">
    {!! Form::label('direccion', 'Direccion:') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
</div>

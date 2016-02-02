<!-- Telefono Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('telefono', 'Telefono:') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
</div>
<!-- Email Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Localidad Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('localidad', 'Localidad:') !!}
    {!! Form::select('localidad',['Lanus','Avellaneda','CABA','Merlo'], null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6 col-lg-12">
    {!! Form::label('direccion', 'Direccion:') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
</div>

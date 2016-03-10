<!-- Obra Social Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('obra_social', 'Obra Social:') !!}
    {!! Form::select('obra_social', $ObraSocial, null, ['class' => 'form-control']) !!}
</div>

<!-- Matricula Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('matricula', 'Matricula:') !!}
	{!! Form::text('matricula', null, ['class' => 'form-control']) !!}
</div>
<!-- Sindicato Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('sindicato', 'Sindicato:') !!}
	{!! Form::select('sindicato', ['SI','NO'],null, ['class' => 'form-control']) !!}
</div>

<!-- Nro Cuenta Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('nro_cuenta', 'Nro Cuenta:') !!}
	{!! Form::text('nro_cuenta', null, ['class' => 'form-control']) !!}
</div>

<!-- Fatsa Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('fatsa', 'Fatsa:') !!}
	{!! Form::select('fatsa',  ['SI','NO'],null, ['class' => 'form-control']) !!}
</div>

<!-- Nro Afiliado Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('nro_afiliado', 'Nro Afiliado:') !!}
	{!! Form::text('nro_afiliado', null, ['class' => 'form-control']) !!}
</div>



<!-- Jubilacion Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('jubilacion', 'Jubilacion:') !!}
	{!! Form::select('jubilacion',  ['REPARTO','AFJP'],null, ['class' => 'form-control']) !!}
</div>

<!-- Afjp Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('afjp', 'Afjp:') !!}
	{!! Form::text('afjp', null, ['class' => 'form-control']) !!}
</div>







<!-- Caja Cirujia Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('caja_cirujia', 'Caja Cirujia:') !!}
	{!! Form::text('caja_cirujia', null, ['class' => 'form-control']) !!}
</div>

<!-- Caja Partos Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('caja_partos', 'Caja Partos:') !!}
	{!! Form::text('caja_partos', null, ['class' => 'form-control']) !!}
</div>





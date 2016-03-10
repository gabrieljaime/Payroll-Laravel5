

<!-- Retencion Field -->
<div class="form-group col-lg-2">
    {!! Form::label('retencion', 'Sujeto a Retenciones:') !!}
    {!! Form::select('retencion', [''=>'','SI','NO'],null, ['class' => 'form-control'])  !!}
</div>

<!-- Familia Field -->
<div class="form-group col-lg-2">
    {!! Form::label('familia', 'Sujeto a reten familiares:') !!}
    {!! Form::select('familia',  [''=>'','SI','NO'],null,  ['class' => 'form-control']) !!}
</div>
<!-- Retencion1 Field -->
<div class="form-group col-lg-2">
    {!! Form::label('reintegro', 'Es Reintegro:') !!}
    {!! Form::select('reintegro',[''=>'','SI','NO'], null, ['class' => 'form-control']) !!}
</div>

<!-- Haberdebe Field -->
<div class="form-group col-lg-2">
    {!! Form::label('haberdebe', 'Debe o Haber:') !!}
    {!! Form::select ('haberdebe',[''=>'','D'=>'DEBE','H'=>'HABER'],null, ['class' => 'form-control']) !!}
</div>

<!-- Sumaresta Field -->
<div class="form-group col-lg-2">
    {!! Form::label('sumaresta', 'Suma o Resta:') !!}
    {!! Form::select('sumaresta', [''=>'','S'=>'SUMA','R'=>'RESTA'],null, ['class' => 'form-control']) !!}
</div>


<!-- Imp Por Field -->
<div class="form-group col-lg-2">
    {!! Form::label('imp_por', 'Importe o Porcentaje:') !!}
    {!! Form::select('imp_por',[''=>'','C'=>'IMPORTE','P'=>'PORCENTAJE'], null, ['class' => 'form-control']) !!}
</div>



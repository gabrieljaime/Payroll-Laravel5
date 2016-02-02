<!-- Fecha Ingreso Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('fecha_ingreso', 'Fecha Ingreso:') !!}
    {!! Form::text('fecha_ingreso', null, ['class' => 'form-control']) !!}
</div>

<!-- Categoria Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('categoria', 'Categoria:') !!}
    {!! Form::select('categoria', ['categoria'],null, ['class' => 'form-control']) !!}
</div>

<!-- Subcategoria Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('subcategoria', 'Subcategoria:') !!}
    {!! Form::select('subcategoria',['especialidad'], null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Contrato Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('tipo_contrato', 'Tipo Contrato:') !!}
    {!! Form::text('tipo_contrato', null, ['class' => 'form-control']) !!}
</div>
<!-- Ubicacion Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('ubicacion', 'Ubicación:') !!}
    {!! Form::select('ubicacion', ['ubicaciones'],null,['class' => 'form-control']) !!}
</div>
<!-- Turno Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('turno', 'Turno:') !!}
    {!! Form::select('turno',['Mañana','Tarde','Noche'], null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('es_jerarquico', 'Es Jerarquico:') !!}
    {!! Form::select('es_jerarquico',['SI','NO'], null, ['class' => 'form-control']) !!}
</div>
<!-- Basico Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('basico', 'Basico:') !!}
    {!! Form::text('basico', null, ['class' => 'form-control']) !!}
</div>

<!-- Horas Field -->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('horas', 'Horas:') !!}
    {!! Form::text('horas', null, ['class' => 'form-control']) !!}
</div>
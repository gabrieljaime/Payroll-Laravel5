
<!-- Conyugue Field -->
<div class="form-group col-sm-3">
    {!! Form::label('conyugue', 'Conyugue:') !!}
    {!! Form::select('conyugue',['N','S'], null, ['class' => 'form-control']) !!}
</div>
<!-- Cant Hijos Field -->
<div class="form-group col-sm-3">
    {!! Form::label('cant_hijos', 'Cantidad de Hijos:') !!}
    {!! Form::text('cant_hijos', null, ['class' => 'form-control','data-inputmask'=>'"mask": "9"', 'data-mask']) !!}
</div>


<!-- Tiene A Cargo Field -->
<div class="form-group col-sm-3">
    {!! Form::label('tiene_a_cargo', 'Tiene personas a Cargo:', ['class' => 'form-label']) !!}
    {!! Form::select('tiene_a_cargo', ['N','S'], null, ['class' => 'form-control']) !!}
</div>

<!-- Cant A Cargo Field -->
<div class="form-group col-sm-3">
    {!! Form::label('cant_a_cargo', 'Cantidad A Cargo:') !!}
    {!! Form::text('cant_a_cargo', null, ['class' => 'form-control','data-inputmask'=>'"mask": "9"', 'data-mask']) !!}
</div>
<div id="conyuguefields" style="clear:both" @if ($employees->conyugue=='0') hidden="true" @endif >
<div class="box-header with-border">
    <h3 class="box-title">Conyugue</h3>
</div>
<div class="col-sm-10">
    <div class="form-group col-sm-8">
        {!! Form::label('lblconyugye', 'Nombre y Apellido:') !!}
        @if ($employees->conyugue=='0' or !isset($conyugue))
            {!! Form::text('nombreconyu', null , ['class' => 'form-control']) !!}
        @else
            {!! Form::text('nombreconyu', $conyugue->nombre , ['class' => 'form-control']) !!}
        @endif

    </div>

    <div class="form-group col-sm-4  ">
         {!! Form::label('lblfechan', 'Fecha Nacimiento:') !!}
        @if ($employees->conyugue=='0' or !isset($conyugue))
        {!! Form::input('date', 'fechnacconyu', null, ['class' => 'form-control']) !!}
        @else
            {!! Form::input('date', 'fechnacconyu',  $conyugue->fecha_nacimiento->format('Y-m-d') , ['class' => 'form-control']) !!}
        @endif

    </div>
    <!-- Tipo Documento Field -->
    <div class="form-group col-sm-2 ">

        {!! Form::label('tipo_documento', 'Tipo Documento:') !!}
        @if ($employees->conyugue=='0' or !isset($conyugue))
        {!! Form::select('tipdoccony',$TipoDoc, null , ['class' => 'form-control','data-role'=>'select', 'data-placeholder'=>'Seleccione...']) !!}
        @else
            {!! Form::select('tipdoccony',$TipoDoc,  $conyugue->tipo_documento , ['class' => 'form-control','data-role'=>'select', 'data-placeholder'=>'Seleccione...']) !!}
        @endif
    </div>
    <!-- Numero Documento Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('numero_documento', 'Numero Documento:') !!}
        @if ($employees->conyugue=='0' or !isset($conyugue))
        {!! Form::text('nrodoccony', null, ['class' => 'form-control','data-inputmask'=>'"mask": "99.999.999"', 'data-mask' ]) !!}
        @else
            {!! Form::text('nrodoccony', $conyugue->documento, ['class' => 'form-control','data-inputmask'=>'"mask": "99.999.999"', 'data-mask' ]) !!}
              @endif
    </div>

    <div class="form-group col-sm-3">
        {!! Form::label('cuil', 'Cuil:') !!}

        @if ($employees->conyugue=='0' or !isset($conyugue))
            {!! Form::text('cuilcony', null, ['class' => 'form-control','data-inputmask'=>'"mask": "99-99.999.999-9"', 'data-mask']) !!}
        @else
            {!! Form::text('cuilcony', $conyugue->cuil, ['class' => 'form-control','data-inputmask'=>'"mask": "99-99.999.999-9"', 'data-mask']) !!}
        @endif
    </div>
    <div class="form-group col-sm-2">
        {!! Form::label('disca', 'Discapacidad:') !!}
        @if ($employees->conyugue=='0' or !isset($conyugue))
            {!! Form::select('disccony', ['N','S'], null, ['class' => 'form-control']) !!}
        @else
            {!! Form::select('disccony', ['N','S'], $conyugue->discapacitado, ['class' => 'form-control']) !!}

        @endif
    </div>
    <div class="form-group col-sm-2">
        {!! Form::label('ocupacionlbl', 'Ocupacion:') !!}
        @if ($employees->conyugue=='0' or !isset($conyugue))
            {!! Form::text('ocupacony', null, ['class' => 'form-control']) !!}
        @else
            {!! Form::text('ocupacony', $conyugue->ocupacion, ['class' => 'form-control']) !!}
        @endif
    </div>
</div>
</div>
@for ($i = 1; $i < 10; $i++)


    <div id="hijo{{ $i }}fields" style="clear:both"  @if ($employees->cant_hijos<$i)  hidden="true" @endif >

        <div class="box-header with-border">
            <h3 class="box-title">Hijo {{ $i }}</h3>
        </div>
        <div class="col-sm-10">
            <div class="form-group col-sm-8">
                {!! Form::label('lblhijo1', 'Nombre y Apellido:') !!}
                @if ($employees->cant_hijos<$i or !isset($hijos) or count($hijos)==0 )
                    {!! Form::text('nombrehijo'.$i, null, ['class' => 'form-control']) !!}
                @else
                    {!! Form::text('nombrehijo'.$i, $hijos[ $i -1]->nombre, ['class' => 'form-control']) !!}
                @endif
            </div>

            <div class="form-group col-sm-4  ">
                {!! Form::label('lblfechan', 'Fecha Nacimiento:') !!}
                @if ($employees->cant_hijos<$i or !isset($hijos) or count($hijos)==0)
                    {!! Form::input('date', 'fechnahijo'.$i, null, ['class' => 'form-control']) !!}
                @else
                    {!! Form::input('date', 'fechnahijo'.$i, $hijos[ $i -1]->fecha_nacimiento->format('Y-m-d'), ['class' => 'form-control']) !!}
                @endif
            </div>

            <!-- Tipo Documento Field -->
            <div class="form-group col-sm-2 ">
                {!! Form::label('tipo_documento', 'Tipo Documento:') !!}
                @if ($employees->cant_hijos<$i or !isset($hijos) or count($hijos)==0)
                {!! Form::select('tipdohijo'.$i,$TipoDoc, null , ['class' => 'form-control','data-role'=>'select', 'data-placeholder'=>'Seleccione...']) !!}
                @else
                    {!! Form::select('tipdohijo'.$i,$TipoDoc,  $hijos[ $i -1]->tipo_documento , ['class' => 'form-control','data-role'=>'select', 'data-placeholder'=>'Seleccione...']) !!}
                @endif
            </div>
            <!-- Numero Documento Field -->
            <div class="form-group col-sm-3">
                {!! Form::label('numero_documento', 'Numero Documento:') !!}
                @if ($employees->cant_hijos<$i or !isset($hijos) or count($hijos)==0)
                {!! Form::text('nrodochijo'.$i, null, ['class' => 'form-control','data-inputmask'=>'"mask": "99.999.999"', 'data-mask' ]) !!}
                @else
                    {!! Form::text('nrodochijo'.$i,  $hijos[ $i -1]->documento, ['class' => 'form-control','data-inputmask'=>'"mask": "99.999.999"', 'data-mask' ]) !!}
                @endif
            </div>

            <div class="form-group col-sm-3">
                {!! Form::label('cuil', 'Cuil:') !!}
                @if ($employees->cant_hijos<$i or !isset($hijos) or count($hijos)==0)
                {!! Form::text('cuilhijo'.$i, null, ['class' => 'form-control','data-inputmask'=>'"mask": "99-99.999.999-9"', 'data-mask']) !!}
                @else
                    {!! Form::text('cuilhijo'.$i,  $hijos[ $i -1]->cuil, ['class' => 'form-control','data-inputmask'=>'"mask": "99-99.999.999-9"', 'data-mask']) !!}
                @endif
            </div>
            <div class="form-group col-sm-2">
                {!! Form::label('disca', 'Discapacidad:') !!}
                @if ($employees->cant_hijos<$i or !isset($hijos) or count($hijos)==0)
                {!! Form::select('dischijo'.$i, ['N','S'], null, ['class' => 'form-control']) !!}
                @else
                    {!! Form::select('dischijo'.$i, ['N','S'],  $hijos[ $i -1]->discapacitado, ['class' => 'form-control']) !!}
                @endif
            </div>
            <div class="form-group col-sm-2">
                {!! Form::label('educa', 'Educacion:') !!}
                @if ($employees->cant_hijos<$i or !isset($hijos) or count($hijos)==0)
                {!! Form::select('educahijo'.$i, ['Prescolar','Primaria', 'Secundario', 'Universitario'],null, ['class' => 'form-control','data-role'=>'select', 'data-placeholder'=>'Seleccione...']) !!}
                @else
                    {!! Form::select('educahijo'.$i, ['Prescolar','Primaria', 'Secundario', 'Universitario'], $hijos[ $i -1]->ocupacion, ['class' => 'form-control','data-role'=>'select', 'data-placeholder'=>'Seleccione...']) !!}

                @endif
            </div>


        </div>
    </div>
@endfor




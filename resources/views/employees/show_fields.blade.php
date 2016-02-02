<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Datos Personales</h3>
        <div class="box-tools pull-right">
            {!! Form::button('<i class="fa fa-minus"></i>', array('class' => 'btn btn-box-tool','title' => 'Collapse', 'data-widget' => 'collapse', 'data-toggle' => 'tooltip')) !!}
        </div>
    </div>
    <div class="box-body">


        <!-- Id Field -->
        <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('id', 'Id:') !!}
            <p class ="form-control" >{!! $employees->id !!}</p>
        </div>

        <!-- Nombre Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('nombre', 'Nombre:') !!}
           <p class ="form-control" >{!! $employees->nombre !!}</p>
        </div>

        <!-- Photo Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('photo', 'Photo:') !!}
           <p class ="form-control" >{!! $employees->photo !!}</p>
        </div>

        <!-- Cuil Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('cuil', 'Cuil:') !!}
           <p class ="form-control" >{!! $employees->cuil !!}</p>
        </div>

        <!-- Fecha Ingreso Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('fecha_ingreso', 'Fecha Ingreso:') !!}
           <p class ="form-control" >{!! $employees->fecha_ingreso !!}</p>
        </div>

        <!-- Categoria Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('categoria', 'Categoria:') !!}
           <p class ="form-control" >{!! $employees->categoria !!}</p>
        </div>

        <!-- Subcategoria Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('subcategoria', 'Subcategoria:') !!}
           <p class ="form-control" >{!! $employees->subcategoria !!}</p>
        </div>

        <!-- Sexo Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('sexo', 'Sexo:') !!}
           <p class ="form-control" >{!! $employees->sexo !!}</p>
        </div>

        <!-- Tipo Documento Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('tipo_documento', 'Tipo Documento:') !!}
           <p class ="form-control" >{!! $employees->tipo_documento !!}</p>
        </div>

        <!-- Numero Documento Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('numero_documento', 'Numero Documento:') !!}
           <p class ="form-control" >{!! $employees->numero_documento !!}</p>
        </div>

        <!-- Fecha Nacimiento Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('fecha_nacimiento', 'Fecha Nacimiento:') !!}
           <p class ="form-control" >{!! $employees->fecha_nacimiento !!}</p>
        </div>

        <!-- Matricula Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('matricula', 'Matricula:') !!}
           <p class ="form-control" >{!! $employees->matricula !!}</p>
        </div>

        <!-- Direccion Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('direccion', 'Direccion:') !!}
           <p class ="form-control" >{!! $employees->direccion !!}</p>
        </div>

        <!-- Localidad Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('localidad', 'Localidad:') !!}
           <p class ="form-control" >{!! $employees->localidad !!}</p>
        </div>

        <!-- Telefono Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('telefono', 'Telefono:') !!}
           <p class ="form-control" >{!! $employees->telefono !!}</p>
        </div>

        <!-- Email Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('email', 'Email:') !!}
           <p class ="form-control" >{!! $employees->email !!}</p>
        </div>

        <!-- Estado Civil Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('estado_civil', 'Estado Civil:') !!}
           <p class ="form-control" >{!! $employees->estado_civil !!}</p>
        </div>

        <!-- Cant Hijos Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('cant_hijos', 'Cant Hijos:') !!}
           <p class ="form-control" >{!! $employees->cant_hijos !!}</p>
        </div>

        <!-- Cant Hijos Disc Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('cant_hijos_disc', 'Cant Hijos Disc:') !!}
           <p class ="form-control" >{!! $employees->cant_hijos_disc !!}</p>
        </div>

        <!-- Hijos Escpres Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('hijos_escpres', 'Hijos Escpres:') !!}
           <p class ="form-control" >{!! $employees->hijos_escpres !!}</p>
        </div>

        <!-- Hijos Escprim Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('hijos_escprim', 'Hijos Escprim:') !!}
           <p class ="form-control" >{!! $employees->hijos_escprim !!}</p>
        </div>

        <!-- Hijos Escsec Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('hijos_escsec', 'Hijos Escsec:') !!}
           <p class ="form-control" >{!! $employees->hijos_escsec !!}</p>
        </div>

        <!-- Hijos Univer Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('hijos_univer', 'Hijos Univer:') !!}
           <p class ="form-control" >{!! $employees->hijos_univer !!}</p>
        </div>

        <!-- Sindicato Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('sindicato', 'Sindicato:') !!}
           <p class ="form-control" >{!! $employees->sindicato !!}</p>
        </div>

        <!-- Nro Cuenta Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('nro_cuenta', 'Nro Cuenta:') !!}
           <p class ="form-control" >{!! $employees->nro_cuenta !!}</p>
        </div>

        <!-- Fatsa Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('fatsa', 'Fatsa:') !!}
           <p class ="form-control" >{!! $employees->fatsa !!}</p>
        </div>

        <!-- Nro Afiliado Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('nro_afiliado', 'Nro Afiliado:') !!}
           <p class ="form-control" >{!! $employees->nro_afiliado !!}</p>
        </div>

        <!-- Conyugue Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('conyugue', 'Conyugue:') !!}
           <p class ="form-control" >{!! $employees->conyugue !!}</p>
        </div>

        <!-- Tiene A Cargo Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('tiene_a_cargo', 'Tiene A Cargo:') !!}
           <p class ="form-control" >{!! $employees->tiene_a_cargo !!}</p>
        </div>

        <!-- Cant A Cargo Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('cant_a_cargo', 'Cant A Cargo:') !!}
           <p class ="form-control" >{!! $employees->cant_a_cargo !!}</p>
        </div>

        <!-- Tipo Contrato Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('tipo_contrato', 'Tipo Contrato:') !!}
           <p class ="form-control" >{!! $employees->tipo_contrato !!}</p>
        </div>

        <!-- Turno Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('turno', 'Turno:') !!}
           <p class ="form-control" >{!! $employees->turno !!}</p>
        </div>

        <!-- Jubilacion Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('jubilacion', 'Jubilacion:') !!}
           <p class ="form-control" >{!! $employees->jubilacion !!}</p>
        </div>

        <!-- Afjp Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('afjp', 'Afjp:') !!}
           <p class ="form-control" >{!! $employees->afjp !!}</p>
        </div>

        <!-- Basico Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('basico', 'Basico:') !!}
           <p class ="form-control" >{!! $employees->basico !!}</p>
        </div>

        <!-- Ubicacion Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('ubicacion', 'Ubicacion:') !!}
           <p class ="form-control" >{!! $employees->ubicacion !!}</p>
        </div>

        <!-- Obra Social Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('obra_social', 'Obra Social:') !!}
           <p class ="form-control" >{!! $employees->obra_social !!}</p>
        </div>

        <!-- Horas Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('horas', 'Horas:') !!}
           <p class ="form-control" >{!! $employees->horas !!}</p>
        </div>

        <!-- Caja Cirujia Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('caja_cirujia', 'Caja Cirujia:') !!}
           <p class ="form-control" >{!! $employees->caja_cirujia !!}</p>
        </div>

        <!-- Caja Partos Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('caja_partos', 'Caja Partos:') !!}
           <p class ="form-control" >{!! $employees->caja_partos !!}</p>
        </div>

        <!-- Activo Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('activo', 'Activo:') !!}
           <p class ="form-control" >{!! $employees->activo !!}</p>
        </div>

        <!-- Estado Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('estado', 'Estado:') !!}
           <p class ="form-control" >{!! $employees->estado !!}</p>
        </div>

        <!-- Created At Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('created_at', 'Created At:') !!}
           <p class ="form-control" >{!! $employees->created_at !!}</p>
        </div>

        <!-- Updated At Field -->
         <div class="form-group col-sm-4 col-lg-2">
            {!! Form::label('updated_at', 'Updated At:') !!}
           <p class ="form-control" >{!! $employees->updated_at !!}</p>
        </div>
        <div class="form-group col-sm-12">
            {!! link_to('/employees', 'Volver', ['class' => 'btn btn-warning']) !!}
        </div>
    </div>
</div>


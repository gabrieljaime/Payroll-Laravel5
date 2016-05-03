@if ($edit)
    <div class="form-group col-sm-3">
        {!! Form::label('activo', 'Estado:') !!}
        </br>
        @if ($employees->activo==true)
            <span class="btn btn-success" style="cursor:default !important;" >
                <i class="fa fa-check-square-o" aria-hidden="true"></i> {!! $estado_revista->descripcion !!}
            </span>
         @else
            <span class="btn btn-danger" style="cursor:default !important;" >
                <i class="fa fa-ban" aria-hidden="true"></i> {!! $estado_revista->descripcion !!}
            </span>


        @endif
    </div>
<!-- Estado Field -->
    <div class="form-group col-sm-6 ">
    {!! Form::label('a', 'Accion:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
        </br>
        @if ($employees->activo==true)
            <a class="btn btn-primary btn-md iframe " type="button" data-toggle="modal"
               id="btnCambiarRevista" data-target="#confirmCambiarRevista"
              data-title="Cambiar Estado de Revista"
             data-id="{!! URL::to('employees/cambiar_revista/' . $employees->id ) !!}">
                <i class="fa fa-pencil" aria-hidden="true"></i>Cambiar Estado de Revista
            </a>
        @else
            <a class="btn btn-primary btn-md iframe " type="button" disabled data-toggle="modal">
                <i class="fa fa-pencil" aria-hidden="true"></i>Cambiar Estado de Revista
            </a>
        @endif
    </div>


@else
        <!-- Activo Field -->
<div class="form-group col-sm-6 col-lg-4">
  <span class="btn btn-success" style="cursor:default !important;" >
                <i class="fa fa-check-square-o" aria-hidden="true"></i> Activo
         {!! Form::hidden('activo' ,1, ['class' => 'form-control']) !!}

            </span>

</div>

<div class="form-group col-sm-6 col-lg-4">
    {!! Form::hidden('estado', 1, ['class' => 'form-control']) !!}
</div>
@endif
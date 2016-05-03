<div class="modal fade modal-primary" id="confirmCambiarRevista" role="dialog" aria-labelledby="confirmCambiarRevista" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar</h4>
            </div>
            {!! Form::open(['url' => URL::to('employees/cambiar_revista/' . $employees->id ), 'method' => 'patch' , 'id'=>'cambiar_revista']) !!}
            <div class="modal-body" style="background-color: white !important;">

                    @include('employees.update_revista_fields')

            </div>
            <div class="modal-footer">
                {!! Form::button('<i class="fa fa-fw fa-close" aria-hidden="true"></i> Cancel', array('class' => 'btn btn-outline pull-left btn-flat', 'type' => 'button', 'data-dismiss' => 'modal' )) !!}
                {!! Form::button('Guardar', array('class' => 'btn btn-outline pull-right btn-flat',  'id'=>'Guardar'))!!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
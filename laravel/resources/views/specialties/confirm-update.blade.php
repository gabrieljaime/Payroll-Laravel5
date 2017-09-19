<div class="modal fade modal-primary" id="confirmEditE" role="dialog" aria-labelledby="confirmEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar</h4>
            </div>
            {!! Form::open( ['route' => ['specialties.update', 'id'], 'method' => 'patch' , 'id'=>'updateE']) !!}
            <div class="modal-body" style="background-color: white !important;">
                <div class="box-body">
                    @include('specialties.fields', ['edit' => 'true'])
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::button('<i class="fa fa-fw fa-close" aria-hidden="true"></i> Cancelar', array('class' => 'btn btn-outline pull-left btn-flat', 'type' => 'button', 'data-dismiss' => 'modal' )) !!}
                {!! Form::submit('Guardar', array('class' => 'btn btn-outline pull-right btn-flat', 'type' => 'submit' ))!!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
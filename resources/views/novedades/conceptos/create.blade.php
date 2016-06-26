<div class="modal fade modal-primary" id="confirmAsociarConceptoNovedad" role="dialog" aria-labelledby="confirmAsociarConceptoNovedadlabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit</h4>
            </div>
            {!! Form::open(['route' => 'novedades.conceptos.store','enctype' => 'multipart/form-data']  ) !!}
            <div class="modal-body" style="background-color: white !important;">
                <div class="box-body">
                    @include('novedades.conceptos.create_fields')
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::button('<i class="fa fa-fw fa-close" aria-hidden="true"></i> Cancel', array('class' => 'btn btn-outline pull-left btn-flat', 'type' => 'button', 'data-dismiss' => 'modal' )) !!}
                {!! Form::submit('Asociar', array('class' => 'btn btn-outline pull-right btn-flat', 'type' => 'submit' ))!!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
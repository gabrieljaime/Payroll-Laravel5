
<div class="box box-primary">

    <!-- Concepto Field -->
    <div class="box-header">

        <i class="fa fa-user"></i>

        <h3 class="box-title">Relación</h3>

    </div>
    <div class="box-body">
        <div class="row form-group form-inline">
        <div class="col-md-9">

            {!! Form::label('legajo', 'Legajos:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
            <input type="hidden" name="employees_id" value="TODOS">
            {!! Form::select('employees_id[]', $Legajos, null, ['class' => 'form-control' ,'style'=>'width: 84%', 'disabled','id'=>'employees_id_cf','required']) !!}


        </div>
        <div class="col-md-3">
            <div class="form-control pull-right">
                <label class="control-label">
                    <input type="checkbox" name="todos" id="todos_cf" checked="true" class="minimal" disabled>
                    Todos
                </label>
            </div>
        </div>
        </div>
        <div class="form-group form-inline">
            {!! Form::label('concepto', 'Concepto:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
            {!! Form::select('concepto_id', $conceptosfijos, null, ['class' => 'form-control','style'=>'width: 86%','id'=>'concepto_id_cf','required']) !!}

        </div>
    </div>

    <div class="box-header">

        <i class="fa fa-edit"></i>

        <h3 class="box-title">Valores</h3>

    </div>

    <div class="box-body">
        <!-- Cantidad Field -->
        <div class="form-group col-md-6">
            {!! Form::label('cantidad', 'Cantidad:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
            {!! Form::input('number','cantidad', 'cantidad', ['class' => 'form-control','required']) !!}
        </div>
        <!-- Importe Field -->
        <div class="form-group col-md-6">
            {!! Form::label('importe', 'Importe:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
            {!! Form::input('number','importe','importe', ['class' => 'form-control','required']) !!}
        </div>

    </div>
</div>





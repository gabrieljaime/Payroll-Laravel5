
<div class="box box-primary">



    <!-- Concepto Field -->
    <div class="box-header">

        <i class="fa fa-user"></i>

        <h3 class="box-title">Concepto</h3>

    </div>
    <div class="box-body">
        <div class="row form-group form-inline">
            <div class="col-md-12">

                {!! Form::label('codigo', 'Codigo:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
                {!! Form::text('codigo','codigo',  ['class' => 'form-control', 'readonly']) !!}


            </div>

        </div>
        <div class="form-group form-inline">
            {!! Form::label('detalle', 'Detalle:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
            {!! Form::text('detalle', 'detalle',  ['class' => 'form-control', 'readonly']) !!}

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
            {!! Form::text('importe','importe', ['class' => 'form-control','required']) !!}
        </div>

    </div>
</div>





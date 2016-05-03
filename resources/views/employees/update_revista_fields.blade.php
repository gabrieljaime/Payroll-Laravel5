
<div class="box box-primary">

    <div class="box-header">

        <i class="fa fa-user"></i>

        <h3 class="box-title">Empleado</h3>

    </div>
    <div class="box-body">

        <!-- Categoria Field -->

        <div class="form-group col-md-3">
            {!! Form::label('legajo', 'Legajo:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
            {!! Form::text('legajo', $employees->id, ['class' => 'form-control','disabled']) !!}
            </div>
            <div class="form-group col-md-9">
            {!! Form::label('Nombre', 'Nombre:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
            {!! Form::text('empleado', $employees->nombre, ['class' => 'form-control','disabled']) !!}
        </div>

    </div>

    <!-- Concepto Field -->
    <div class="box-header">

        <i class="fa fa-info"></i>

        <h3 class="box-title">Situacion Actual</h3>

    </div>
    <div class="box-body">
        <div class="form-group col-md-6">
            {!! Form::label('Estado', 'Estado Actual:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
            {!! Form::text('empleado', $situacion_revista->Situacion['descripcion'], ['class' => 'form-control','disabled']) !!}
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('lbsdesde', 'Desde:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}


            <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar" ></i>
                    </div>

                    {!! Form::text('desde', $situacion_revista->fecha_inicio->format('d/m/Y'), ['class' => 'form-control pull-right','disabled', 'id'=>'pikdesde']) !!}

            </div>
                <!-- /.input group -->
        </div>
    </div>

    <div class="box-header">

        <i class="fa fa-edit"></i>

        <h3 class="box-title">Nueva Situación</h3>

    </div>

    <div class="box-body">
        <div class="form-group col-md-6" >

            {!! Form::label('situacion', 'Nuevo Estado:', ['class'=>'control-label', 'style'=>'color:black !important']) !!}

            {!! Form::select('sitrevista', $conceptos_revista, null, ['class' => 'form-control','required','style'=>' width: 100%', 'id'=>'sitrevista','data-role'=>'select', 'data-placeholder'=>'Seleccione un nuevo estado']) !!}
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('lbsdesde', 'Desde:', ['class'=>'control-label', 'style'=>'color:black !important']) !!}


            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>

                {!! Form::input('date','inicio', null, ['class' => 'form-control pull-right',  'required']) !!}

            </div>
            <!-- /.input group -->
        </div>



        <!-- Importe Field -->
        <div class="form-group col-md-12">
            {!! Form::label('importe', 'Motivo:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
            {!! Form::text('motivo',null, ['class' => 'form-control','required']) !!}
        </div>

    </div>
</div>





<div >


             {!! Form::open([ '','enctype' => 'multipart/form-data', 'id'=>'asoci_crl'] ) !!}

                <div class="form-inline">
                    <div class="col-md-2">
                        {!! Form::label('mes', 'Mes:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
                        {!! Form::select('mes',['1'=>'Enero','2'=>'Febrero','3'=>'Marzo','4'=>'Abril','5'=>'Mayo','6'=>'Junio','13'=>'Sac 1','7'=>'Julio','8'=>'Agosto','9'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre','14'=>'Sac 2'], $mes,['class' => 'form-control' ,'placeholder'=>'Mes', 'id'=>'mes_crl'])!!}
                    </div>

                    <div class="col-md-2 col-lg-1">
                        {!! Form::label('año', 'Año:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
                            {!! Form::selectYear('anio',$año-5 , $año+5, $año, ['class' => 'form-control','id'=>'anio_crl']) !!}
                    </div>
                    <div class="col-md-4 col-lg-2 ">
                        {!! Form::label('legajo', 'Legajos:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
                        {!! Form::select('employees_id', $Legajos, null, ['class' => 'form-control' ,'id'=>'employees_id_crl','required']) !!}
                    </div>
                    <div class="col-md-4 col-lg-2">
                        {!! Form::label('concepto', 'Concepto:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
                        {!! Form::select('concepto_id', $conceptosvariables, null, ['class' => 'form-control','id'=>'concepto_id_crl','required']) !!}
                    </div>
                    <div class="col-md-2">

                        {!! Form::label('cantidad', 'Cantidad:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
                        {!! Form::input('number','cantidad', 'cantidad', ['class' => 'form-control','required','id'=>'cantidad_crl']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::label('importe', 'Importe:', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
                        {!! Form::input('number','importe',null, ['class' => 'form-control','required','id'=>'importe_crl']) !!}
                    </div>
                    <div class="col-md-2 col-lg-1" >
                        {!! Form::label('', '', ['class'=>'control-label ', 'style'=>'color:black !important']) !!}
                        {!! Form::button('Guardar', ['class' => 'form-control btn btn-primary btn-block','id'=>'guardar_crl']) !!}

                    </div>
                </div>


          {!! Form::close() !!}


</div>
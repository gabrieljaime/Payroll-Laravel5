
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>   Crear empleados
        |  LaraAdmin | Dashboard</title>
    <meta name="description" content="">


    <link type="text/css" rel="stylesheet" media="all" href="http://payrool/assets/css/admin/admin.css">
    <style>
        label {
            display: inline-block;
            max-width: 100%;
            margin-bottom: 1px;
            font-weight: bold;
        }
        .content {
            min-height: 250px;
            margin-right: auto;
            margin-left: auto;
            padding-left: 15px;
            padding-right: 15px;
            padding-top: 20px;
            padding-bottom: 0px;
            background: white;
        }
        .form-group {
            margin-bottom: 4px;
        }
        .form-control {
            border-radius: 4px;
            box-shadow: none;
            border-color: #8f88de;
        }
        .box-header {
            color: #444;
            display: block;
            padding: 8px;
            position: relative;
        }

    </style>

</head>

<body class="hold-transition skin-blue sidebar-mini fixed ">


<header class="main-header">
    {{-- UPPER LEFT LOGO --}}
    <a href="/home" class="logo">
        <span style="float: left;">Los Cedros</span>
        <span style="float: right;">Planilla de Alta de Empleados</span>
    </a>

    {{-- LOAD TEMPLATE NAVIGATION --}}


</header>
</br>
<div class="content">



    <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos Personales</h3>
                    <div class="box-tools pull-right">
                       
                    </div>
                </div>
                <div class="box-body">
                    <!-- Id Field -->
                    <!-- Photo Field -->
                    <!-- Nombre Field -->

                    <div class="form-group col-sm-6 col-lg-8">
                        <label for="nombre">Nombre y Apellido:</label>
                        <input class="form-control input-sm" name="nombre" type="text" id="nombre">
                    </div>
                    <!-- Fecha Nacimiento Field -->
                    <div class="form-group col-xs-4">
                        <label for="fecha_nacimiento">Fecha Nacimiento:</label>
                        <input class="form-control input-sm" name="fecha_nacimiento" type="text" id="fecha_nacimiento">
                    </div>
                    <!-- Tipo Documento Field -->
                    <div class="form-group col-xs-2">
                        <label for="tipo_documento">Tipo Doc:</label>
                        <input class="form-control input-sm" name="tipo_documento" type="text" id="tipo_documento">
                    </div>
                    <!-- Numero Documento Field -->
                    <div class="form-group col-xs-3">
                        <label for="numero_documento">Numero Doc:</label>
                        <input class="form-control input-sm" name="numero_documento" type="text" id="numero_documento">
                    </div>

                    <div class="form-group col-xs-3">
                        <label for="cuil">Cuil:</label>
                        <input class="form-control input-sm" name="cuil" type="text" id="cuil">
                    </div>

                    <div class="form-group col-xs-4">
                        <label for="sexo">Sexo:</label>

                        <input class="form-control input-sm" name="" type="text" id="">

                    </div>
                    <!-- Estado Civil Field -->
                    <div class="form-group col-xs-4    ">
                        <label for="estado_civil">Estado Civil:</label>
                        <input class="form-control input-sm" name="" type="text" id="">
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos de Contacto</h3>
                    <div class="box-tools pull-right">


                    </div>
                </div>
                <div class="box-body">
                    <!-- Telefono Field -->
                    <div class="form-group col-xs-3">
                        <label for="telefono">Tel Fijo:</label>
                        <input class="form-control input-sm" name="telefono" type="text" id="telefono">
                    </div>
                    <!-- Telefono Field -->
                    <div class="form-group col-xs-3">
                        <label for="celular">Celular:</label>
                        <input class="form-control input-sm" name="celular" type="text" id="celular">
                    </div>
                    <!-- Email Field -->
                    <div class="form-group col-xs-6">
                        <label for="email">Email:</label>
                        <input class="form-control input-sm" name="email" type="email" id="email">
                    </div>

                    <!-- Localidad Field -->
                    <div class="form-group col-xs-3">
                        <label for="localidad">Localidad:</label>
                        <input class="form-control input-sm" name="" type="text" id="">
                    </div>

                    <div class="form-group col-xs-9">
                        <label for="direccion">Direccion:</label>
                        <input class="form-control input-sm" name="direccion" type="text" id="direccion">
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos Familiares</h3>
                    <div class="box-tools pull-right">


                    </div>
                </div>
                <div class="box-body">
                    <!-- Conyugue Field -->
                    <div class="form-group col-xs-2">
                        <label for="conyugue">Conyugue:</label>
                        <input class="form-control input-sm" name="" type="text" id="">
                    </div>
                    <!-- Cant Hijos Field -->
                    <div class="form-group col-xs-2">
                        <label for="cant_hijos">Hijos:</label>
                        <input class="form-control input-sm" name="" type="text" id="">
                    </div>

                    <!-- Cant Hijos Disc Field -->
                    <div class="form-group col-xs-2">
                        <label for="cant_hijos_disc">Discapacitado:</label>
                        <input class="form-control input-sm" name="cant_hijos_disc" type="text" id="cant_hijos_disc">
                    </div>

                    <!-- Hijos Escpres Field -->
                    <div class="form-group col-xs-2">
                        <label for="hijos_escpres">Prescolar:</label>
                        <input class="form-control input-sm" name="hijos_escpres" type="text" id="hijos_escpres">
                    </div>

                    <!-- Hijos Escprim Field -->
                    <div class="form-group col-xs-2">
                        <label for="hijos_escprim">Primaria:</label>
                        <input class="form-control input-sm" name="hijos_escprim" type="text" id="hijos_escprim">
                    </div>

                    <!-- Hijos Escsec Field -->
                    <div class="form-group col-xs-2">
                        <label for="hijos_escsec">Secundaria:</label>
                        <input class="form-control input-sm" name="hijos_escsec" type="text" id="hijos_escsec">
                    </div>

                    <!-- Hijos Univer Field -->
                    <div class="form-group col-xs-4" hidden="hidden">
                        <label for="hijos_univer">Hijos Universitarios:</label>
                        <input class="form-control input-sm" name="hijos_univer" type="text" id="hijos_univer">
                    </div>


                    <!-- Tiene A Cargo Field -->
                    <div class="form-group col-xs-4">
                        <label for="tiene_a_cargo">Tiene personas a Cargo:</label>
                        <input class="form-control input-sm" name="" type="text" id="">
                    </div>

                    <!-- Cant A Cargo Field -->
                    <div class="form-group col-xs-4">
                        <label for="cant_a_cargo">Cantidad A Cargo:</label>
                        <input class="form-control input-sm" name="cant_a_cargo" type="text" id="cant_a_cargo">
                    </div>
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">

                    <h3 class="box-title">Datos Laborales</h3>
                    <div class="box-tools pull-right">


                    </div>
                </div>
                <div class="box-body">
                    <!-- Fecha Ingreso Field -->
                    <div class="form-group col-xs-4">
                        <label for="fecha_ingreso">Fecha Ingreso:</label>
                        <input class="form-control input-sm" name="fecha_ingreso" type="text" id="fecha_ingreso">
                    </div>

                    <!-- Categoria Field -->
                    <div class="form-group col-xs-4"  >
                        <label for="categoria">Categoria:</label>
                        <input class="form-control input-sm" name="" type="text" id="">
                    </div>

                    <!-- Subcategoria Field -->
                    <div class="form-group col-xs-4">
                        <label for="subcategoria">Subcategoria:</label>
                        <input class="form-control input-sm" name="" type="text" id="">
                    </div>

                    <!-- Tipo Contrato Field -->
                    <div class="form-group col-xs-4">
                        <label for="tipo_contrato">Tipo Contrato:</label>
                        <input class="form-control input-sm" name="" type="text" id="">
                    </div>
                    <!-- Ubicacion Field -->
                    <div class="form-group col-xs-4">
                        <label for="ubicacion">Ubicaci&oacute;n:</label>
                        <input class="form-control input-sm" name="" type="text" id="">
                    </div>
                    <!-- Turno Field -->
                    <div class="form-group col-xs-4">
                        <label for="turno">Turno:</label>
                        <input class="form-control input-sm" name="" type="text" id="">
                    </div>
                    <div class="form-group col-xs-4">
                        <label for="es_jerarquico">Es Jerarquico:</label>
                        <input class="form-control input-sm" name="" type="text" id="">        </div>
                    <!-- Basico Field -->
                    <div class="form-group col-xs-4">
                        <label for="basico">Basico:</label>
                        <input class="form-control input-sm" name="basico" type="text" id="basico">
                    </div>

                    <!-- Horas Field -->
                    <div class="form-group col-xs-4">
                        <label for="horas">Horas:</label>
                        <input class="form-control input-sm" name="horas" type="text" id="horas">
                    </div>                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos Complementarios</h3>
                    <div class="box-tools pull-right">


                    </div>
                </div>
                <div class="box-body">
                    <!-- Obra Social Field -->
                    <div class="form-group col-xs-4">
                        <label for="obra_social">Obra Social:</label>
                        <input class="form-control input-sm" name="" type="text" id="">
                    </div>

                    <!-- Matricula Field -->
                    <div class="form-group col-xs-4">
                        <label for="matricula">Matricula:</label>
                        <input class="form-control input-sm" name="matricula" type="text" id="matricula">
                    </div>
                    <!-- Sindicato Field -->
                    <div class="form-group col-xs-4">
                        <label for="sindicato">Sindicato:</label>
                        <input class="form-control input-sm" name="" type="text" id="">   </div>

                    <!-- Nro Cuenta Field -->
                    <div class="form-group col-xs-4">
                        <label for="nro_cuenta">Nro Cuenta:</label>
                        <input class="form-control input-sm" name="" type="text" id="">
                    </div>

                    <!-- Fatsa Field -->
                    <div class="form-group col-xs-4">
                        <label for="fatsa">Fatsa:</label>
                        <input class="form-control input-sm" name="" type="text" id="">
                    </div>

                    <!-- Nro Afiliado Field -->
                    <div class="form-group col-xs-4">
                        <label for="nro_afiliado">Nro Afiliado:</label>
                        <input class="form-control input-sm" name="nro_afiliado" type="text" id="nro_afiliado">
                    </div>



                    <!-- Jubilacion Field -->
                    <div class="form-group col-xs-4">
                        <label for="jubilacion">Jubilacion:</label>
                        <input class="form-control input-sm" name="" type="text" id="">
                    </div>

                    <!-- Afjp Field -->
                    <div class="form-group col-xs-4">
                        <label for="afjp">Afjp:</label>
                        <input class="form-control input-sm" name="afjp" type="text" id="afjp">
                    </div>







                    <!-- Caja Cirujia Field -->
                    <div class="form-group col-xs-4">
                        <label for="caja_cirujia">Caja Cirujia:</label>
                        <input class="form-control input-sm" name="" type="text" id=""> </div>

                    <!-- Caja Partos Field -->
                    <div class="form-group col-xs-4">
                        <label for="caja_partos">Caja de Partos:</label>
                        <input class="form-control input-sm" name="" type="text" id="">
                    </div>




                </div>
            </div>
        </br></br>
            <div class="col-xs-6">

                <label >Firma Empleado:        ................................</label>

            </div>
        <div class="col-xs-6">
            <label>Aclaración:        ................................</label>
        </div>

    </section>

</div>

</body>
</html>
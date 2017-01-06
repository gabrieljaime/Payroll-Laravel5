# Crear un nuevo Empleado

- [Introducción](#introduction)
- [Campos](#campos)
	- [Datos Personales](#personales)
	- [Datos de Contacto](#contacto)
	- [Datos Familiares](#familiares)
	- [Datos Laborales](#laborales)
	- [Datos Complementarios](#complementarios)
- [Guardar Empleado](#guardar)
	
<a name="introduction"></a>
## Introducción

Desde esta pantalla se podra dar de alta un nuevo empleado, se deberan cargar todos los campos obligatarios y al finalizar el sistema le mostrara el nuevo legajo asignado al empleado creado.

<a name="campos"></a>
## Campos a Completar para el alta de un empleado nuevo.

<a name="personales"></a>
### Datos Personales

![Application Image](http://payrool/assets/img/empleados/datos_pesonales.png)

#### Campos:
- `Foto`: Se deberá ingresar una foto del nuevo empleado, podra utilizarse la misma que se carga en el sistema de fichadas.
- `Legajo`: Este campo se completará automaticamente cuando se de de alta al empleado, no se puede modificar.
- `Nombre y Apellido`: Nombre completo del empleado. 
- `Tipo Documento`: Se eligira un tipo de documento entre DNI, Pasaporte, LE o LC.
- `Numero Documento`: Numero de documento del tipo seleccionado.
- `Cuil`: Cuil del Empleado ingresado. Se validara que el Cuil corresponda con el `Numero Documento` ingresado y que el digito verificador sea valido.
- `Fecha Nacimiento`: Se debera elegir la fecha corredondiente al dia del nacimiento del empleado.
- `Sexo`: Se indicara el Sexo del empleado.
- `Estado Civil`: Se indicara el Estado Civil del empleado.

<a name="contacto"></a>
### Datos de Contacto

![Application Image](http://payrool/assets/img/empleados/datos_contacto.png)

#### Campos:
- `Telefono`: Debera ingresar el telefono con el codigo de area correspondiente
- `Celular`: Debera ingresar un celular con el codigo de area y el 15
- `Email`: Debara ingrear un Email valido. Tener en cuenta que si no se ingresa un Email luego no se podra crear un [Usuario](#) al empleado.
- `Localidad`: Debera elegir una localidad.
- `Direccion`: Debera ingresar la direccion completa. Se puede usar la asistencia de Google Maps.

<a name="familiares"></a>
### Datos Familiares

![Application Image](http://payrool/assets/img/empleados/datos_familiares.png)

#### Campos:
- `Conyugue`: Indica si tiene `S` o no `N` conyugye declarado. En caso de ingresar `S`, se desplegara para completar la informacion del Conyugue
- `Cantidad de Hijos`: Debera ingresar la cantidad de hijos. En caso de ingresar más de 1, se desplegara para completar la informacion de cada uno de los hijos.
- `Tiene personas a Cargo`: Debera indicar si tiene `S` o no `N` personas a cargo
- `Cantidad de Personas`: En caso de indicar `S` en la opcion anterior debera indicar la cantidad de personas a cargo.

<a name="laborales"></a>
### Datos Laborales

![Application Image](http://payrool/assets/img/empleados/datos_laborales.png)

#### Campos:
- `Fecha de Ingreso`: Se debera elegir la fecha corredondiente al dia de ingreso del empleado.
- `Categoria`: Debera elegir la categoria del empleado.
- `Subcategoria`: Debera elegir la subcategoria o especialidad. La misma dependerera de lo elegido en la opcion `Categoria`
- `Tipo de Contrato`: Debera elegir el Tipo de contrato del empleado
- `Ubicacion`: Debera elegir la Ubicacion donde trabajara el empleado
- `Turno`: Debera elegir el turno laboral del empleado
- `Es Jerarquico`: Indica si el empleado es `S` o no es `N` jerarquico
- `Basico`: Se informara el sueldo basico.
- `Horas`: Se indicaran la cantidad de horas a trabajar.

<a name="complementarios"></a>
### Datos Complementarios

![Application Image](http://payrool/assets/img/empleados/datos_complementarios.png)

#### Campos:
- `Obra Social`: Se debera elegir la obra social del empleado.
- `Matricula`: Se debera ingresar el numero de matricula profesional del empleado.
- `Sindicato`: Indica si el empleado esta `S` o no esta `N`  asociado al sindicato.
- `Nro de Cuenta`: Nro de cuenta del empleado
- `Fatsa`: Indica si el empleado esta `S` o no esta `N`  asociado a FATSA.
- `Nro Afiliado`: Nro de Afiliado del empleado.
- `Jubilacion`: Tipo de Jubilacion del Empleado.
- `Caja Cirujia`: Indica si corresponde pagar una caja de Cirujia.
- `Caja Partos`: Indica si corresponde pagar una caja de Partos.

<a name="guardar"></a>
## Guardar empleado

Cuando se completen todos los campos anteriores y se quiera crear el empleado nuevo, se debera presionar el boto `Guardar` al final de la pagina.

Si no existe ningun error en los datos o ningun dato faltante, el sistema procedera al alta del empleado y emitira el siguente mensaje de corroboracion, donde se informara el `Legajo` asignado al empleado y los [Conceptos](/docs/{{version}}/verconceptos) que se asginaran de forma automatica al mismo por la `Categoria` asignada..

![Application Image](http://payrool/assets/img/empleados/mensaje_alta.png)

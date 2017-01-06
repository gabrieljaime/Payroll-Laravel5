# Consulta de Recibos de Sueldos

- [Introducción](#introduction)
- [Busqueda](#filtos)
- [Recibo Buscado](#opciones)
- [Acciones](#botones)
	- [Imprimir](#imprimir)
	- [Descargar](#descargar)
	- [Editar](#editar)
	
<a name="introduction"></a>
## Introducción

La consulta de recibos permite ver, imprimir y editar el recibo de sueldo de un empleado. Se pueden ver los 3 tipos del liquidacion habilitados `Normal`, `Especial` y `Independiente`. 

<a name="filtos"></a>
## Busqueda

![Application Image](http://payrool/assets/img/empleados/consultarecibos.png)

-`Legajos`: Esta opción permite seleccionar el empleado del que queremos ver el recibo de sueldo. 

-`Periodo`: Se debera seleccionar el mes y el año correspondiente al recibo que se quiera consultar.

-`Tipo de  Recibo`: Se debera seleccionar el tipo de recibo que se desea ver
	- `Normal`: Liquidacion de sueldos normal.
    - `Especial`: Liquidacion especial de conceptos que **no** se incluyen el [Libro de Sueldo](/docs/{{version}}/librosueldo) del periodo .
    - `Independiente`: La liquidación independiente de conceptos que conforman el [Libro de Sueldo](/docs/{{version}}/librosueldo) del periodo .


<a name="opciones"></a>
## Recibo buscado

Se veran todos los datos del recibo de sueldo tal cual se imprimiran.

![Application Image](http://payrool/assets/img/empleados/recibo.png)


<a name="botones"></a>
##Acciones sobre el recibo

![Application Image](http://payrool/assets/img/empleados/botonessueldo.png)

Esta opción permite seleccionar los empleados que se quieren liquidar. Se podria elegir entre todos los empleados `Seleccionar Todos` o un empleado en particular `Legajos`. Para que se pueda seleccionar un legajo se debera deseleccionar la opción `Seleccionar Todos`

<a name="imprimir"></a>
### <i class="fa fa-print fa-xs"> </i> Imprimir 

Se podra imprimir el recibo directamente.

<a name="descargar"></a>
###  <i class="fa fa-download fa-xs"> </i> Descargar 

Se podra descargar el recibo para poder imprimirlo en otro momento.

<a name="editar"></a>
### <i class="fa fa-edit fa-xs"> </i> Editar

Desde esta pantalla se ve el detalle de los conceptos de cada recibo. Se podran modificar los datos libremente. Esta actualizacion solo afectará el valor del registro, si desea afectar a mas de un valor, lo debera hacer para cada registro. Solo se recalcura de forma automatica el valor de los totales y la liquidacion total.


![Application Image](http://payrool/assets/img/empleados/editarrecibo.png)

> **Nota**: Tenga en cuenta solo se modificaran los datos ingresados, no se reactualizan los demas conceptos..

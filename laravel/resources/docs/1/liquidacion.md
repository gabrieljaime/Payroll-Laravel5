# Generar Liquidación de Sueldos

- [Introducción](#introduction)
- [Pantalla](#pantalla)
- [Opciones](#opciones)
	- [Empleados a Liquidar](#legajos)
	- [Periodo](#periodo)
	- [Tipo de Liquidación](#tipo)
	- [Generar](#generar)
	
<a name="introduction"></a>
## Introducción

La generación de las liquidación es el proceso principal del sistema. Con este proceso además de generar los sueldos mensuales y los aguinaldos, se pueden generar recibos puntual. 
Actualmente existen tres 3 tipos de liquidación:
	- `Normal:` Se toman todos los [Conceptos](/docs/{{version}}/verconceptos) del mismo y se generán los sueldos. Es el tipo que se debera utilizar en la liquidación de todos los meses.
	- `Especial:` Se toman los [Conceptos](/docs/{{version}}/verconceptos) Especiales y se genera una liquidación solo con estos conceptos. La liquidación `Especial` no se integra con otra liquidación y los saldos no conforman el [Libro de Sueldo](/docs/{{version}}/librosueldo). del periodo .
	- `Independiente:` Se toman los [Conceptos](/docs/{{version}}/verconceptos) Independientes y se genera un recibo independiente con estos conceptos. La liquidación `Independiente`  se integra con la `Normal` y los saldos conforman el [Libro de Sueldo](/docs/{{version}}/librosueldo). del periodo .

Se pueden realizar liquidaciones para todos los empleados o para un empleado en particular. Cada vez que se genere una liquidación nueva, se eliminara la existente para el mismo periodo y tipo de liquidación.
Una vez ralizada la liquidación se continua automaticamente con la generarción de los recibos de sueldos que se podran descargar luego desde [Imprimir Recibos](/docs/{{version}}/imprimirrecibos). 

<a name="pantalla"></a>
## Pantalla

![Application Image](http://payrool/assets/img/liquidacion/pantalla.png)


<a name="opciones"></a>
## Opciones de la Pantalla

<a name="legajos"></a>
### Empleados a liquidar

Esta opción permite seleccionar los empleados que se quieren liquidar. Se podria elegir entre todos los empleados `Seleccionar Todos` o un empleado en particular `Legajos`. Para que se pueda seleccionar un legajo se debera deseleccionar la opción `Seleccionar Todos`

<a name="periodo"></a>
### Periodo

Esta opción permite elegir el periodo a liquidar. Se deberá seleccionar un `Mes`, que podra ser tambien Sac 1 o Sac 2, y un `Año`. Tambien se deberá seleccionar una `Fecha de Pago`, la misma sera que que luego se incluya en los recibos de sueldo.

<a name="tipo"></a>
### Tipo de liquidación

Actualmente existen tres 3 tipos de liquidación:
	- `Normal:` Se toman todos los [Conceptos](/docs/{{version}}/verconceptos) Normales y se generán los sueldos. Es el tipo que se debera utilizar en la liquidación de todos los meses.
	- `Especial:` Se toman los [Conceptos](/docs/{{version}}/verconceptos) Especiales y se genera una liquidación solo con estos conceptos. La liquidación `Especial` no se integra con otra liquidación y los saldos no conforman el [Libro de Sueldo](/docs/{{version}}/librosueldo). del periodo .
	- `Independiente:` Se toman los [Conceptos](/docs/{{version}}/verconceptos) Independientes y se genera un recibo independiente con estos conceptos. La liquidación `Independiente`  se integra con la `Normal` y los saldos conforman el [Libro de Sueldo](/docs/{{version}}/librosueldo). del periodo .

<a name="generar"></a>
### Generar

Una vez seleccionado los empleados, el periodo y el tipo de liquidación se debera presionar el boton `Generar` para que comience el proceso. Cuando termine la liquidación se comenzarán a generar los recibos, se podran imprimir desde  [Imprimir Recibos](/docs/{{version}}/imprimirrecibos). 


> **Nota**: Cada vez que se genere una liquidación nueva, si exisistiera, se eliminará la liquidación existente para el mismo periodo y tipo, y se generarán los recibos.

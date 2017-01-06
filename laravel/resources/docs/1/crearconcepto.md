# Crear un nuevo Concepto

- [Introducción](#introduction)
- [Campos](#campos)
	- [Datos del Concepto](#datos)
	- [Propiedades](#propiedades)
	- [Detalle](#detalle)
- [Guardar Concepto](#guardar)
	
<a name="introduction"></a>
## Introducción

Desde esta pantalla se podra dar de alta un nuevo concepto, se deberan cargar todos los campos obligatarios.

<a name="campos"></a>
## Campos a Completar para el alta de un concepto nuevo.

<a name="datos"></a>
### Datos del Concepto

![Application Image](http://payrool/assets/img/concepto/datos.png)

#### Campos:
- `Codigo`: Este campo indica el codigo del nuevo concepto, debera ser un valor numerico y no se podra repetir.
- `Detalle`: Descpricion del concepto. Este dato sera la leyenda que salga en los recibos de sueldo.
- `Es Fijo`: Indica `SI` el concepto es fijo o `No` 
- `Es Basico`: Indica `SI` el concepto forma parte del basico o `No` 

<a name="propiedades"></a>
### Propiedades

![Application Image](http://payrool/assets/img/concepto/propiedades.png)

#### Campos:
- `Sujeto a Retenciones`: Indica `SI` el concepto esta sujeto a retenciones o `No` 
- `Sujeto a reten familiares`: Indica `SI` el concepto esta sujeto a retenciones familiares o `No` 
- `Es Reintegro`: Indica `SI` el concepto es un reintegro o `No` 
- `Debe o Haber`: Indica si el concepto es `Debe` o `Haber` 
- `Suma o Resta`: Indica si el concepto es `Suma` o `Resta`
- `Importe o Porcentaje`: Indica si el concepto representa un `Importe` o `Porcentaje`


<a name="detalle"></a>
### Detalle

![Application Image](http://payrool/assets/img/concepto/detalle.png)

#### Campos:
- `Con Formula`: Indica `SI` el concepto tiene formula o `No` 
- `Importe`: Importe correspondiente al concepto. 
- `Porcentaje`: Porcentaje correspondiente al concepto. 
- `Porcentaje Sobre`: Indica sobre que se aplica el porcentaje `Basico`, `Haber`, `Debe`, `Sujeto Retencion` o `Fijo`. 
- `Tipo Carga`: Indica si el concepto se carga de forma `Unica` o `Periodica`. 
- `Es Formula`: Indica `SI` el concepto es formula o `No` 
- `Tipo de Liquidación`: El tipo de liquidación donde se incluye el concepto:
		- `Normal`.
    	- `Especial`: La liquidación `Especial` no se integra con otra liquidación y los saldos no conforman el [Libro de Sueldo](/docs/{{version}}/librosueldo). del periodo .
    	- `Independiente`: La liquidación `Independiente`  se integra con la `Normal` y los saldos conforman el [Libro de Sueldo](/docs/{{version}}/librosueldo). del periodo. Los conceptos salen en un recibo de sueldo independiente.
- `Orden`: Indica el orden de prioridad del concepto:


<a name="guardar"></a>
## Guardar concepto

Cuando se completen todos los campos anteriores y se quiera crear el concepto nuevo, se debera presionar el boton `Guardar` al final de la pagina.

Si no existe ningun error en los datos o ningun dato faltante, el sistema procedera al alta del concepto 
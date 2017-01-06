# Actualizacion de Sueldos Basicos

- [Introducción](#introduction)
- [Filtros](#campos)
- [Cambios de Sueldo](#cambios)
- [Actualizar](#actualizar)
- [Listado de Sueldos](#listado)
	- [Editar](#editar)
	
<a name="introduction"></a>
## Introducción

Desde esta pantalla se podra realizar la actualizacion de los Sueldos Basicos de los empleados. Se podra actualizar un empleado en particular, una categoria o todos los empleados, tanto por un importe fijo o por un porcentaje.
<a name="campos"></a>
## Filtros.

Desde aqui se seleciconara el empleado o grupo de empleados a los que se les quiere modificar el Sueldo Basico.

![Application Image](http://payrool/assets/img/empleados/filtrosactializarbasicos.png)

-`Legajos`: Esta opción permite seleccionar el empleado al que se le quiere cambiar el Sueldo Basico. Se podria elegir entre todos los empleados `Seleccionar Todos` o un empleado en particular `Legajos`. Para que se pueda seleccionar un legajo se debera deseleccionar la opción `Seleccionar Todos`

-`Categorias`: Esta opción permite seleccionar una `Categoria` dentro de la cual se le quiere cambiar el Sueldo Basico a los empleados que la tengan asignada. Se podria elegir entre todas las categorias `Seleccionar Todas` o una  `Categoria` en particular. Para que se pueda seleccionar una categoria se debera deseleccionar la opción `Seleccionar Todas`

-`Subcategoria`: Esta opción permite seleccionar una `SubCategoria` dentro de la cual se le quiere cambiar el Sueldo Basico a los empleados que la tengan asignada. Se podria elegir entre todas las subcategorias `Seleccionar Todas` o una  `SubCategoria` en particular. Para que se pueda seleccionar una Subcategoria se debera deseleccionar la opción `Seleccionar Todas` y seleccionar previamente una `Categoria`

<a name="sueldo"></a>
## Cambios de Sueldo.

Aqui debemos ingresar el importe o porcenjaje que se desea aplicar como nuevo Sueldo basico.

![Application Image](http://payrool/assets/img/empleados/cambioactializarbasicos.png)

-`Sueldo Basico`: Se debera ingresar el importe o el porcentaje que se desea aplicar como nuevo sueldo. Encaso de ingresar un `Importe` esa saldo sera el nuevo basico del empleado selecionado. En caso de ingrsar un `Porcentaje`, sobre el sueldo actual del empleado se le aplicara un aumento igual al porcentaje indicado
-`Importe o Porcentaje`: Indica si el campo anterior es un `Importe` nuevo o un `Porcentaje` a aplicar.

<a name="actualizar"></a>
## Actualizar

Cuando se presione el boton `Aplicar`, el sistema emitira un mensaje de confirmacion indicando la accion que se realizara. Usted debera confirmar esta accion la cual no tiene vuelta atras.

![Application Image](http://payrool/assets/img/empleados/alertaactializarbasicos.png)


> **Nota**: Tenga en cuenta que de confirmar la operacion no se podra volver a los sueldos basicos anteriores.

<a name="listado"></a>
## Listado de Sueldos Basicos

Se mostrara un listado con el sueldo actual de todos los empleados activos. Desde la opcion `Editar` podra cambiar el valor del sueldo de un empleado.

![Application Image](http://payrool/assets/img/empleados/listadoactializarbasicos.png)

<a name="editar"></a>
### Editar:

Desde esta pantalla se ingresara el nuevo sueldo del empleado. Tambien se podra relizar el cambio ingresando a [Editar el legajo](docs/{{version}}/editarempleado) del empleado

![Application Image](http://payrool/assets/img/empleados/editaractializarbasicos.png)

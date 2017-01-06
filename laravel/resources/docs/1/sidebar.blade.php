<ul class="sidebar-menu">

    <li class="header">
       DOCUMENTACION
    </li>

    <li>
        <a href="/docs/{{version}}/dashboard" title="Tablero"><i class="fa fa-dashboard" aria-hidden="true"></i><span>Tablero</span></a>
    </li>


    <li class="treeview   ">
        <a href="/docs/{{version}}/emplados" title="Conceptos"><i class="fa fa-child" aria-hidden="true"></i><span>Empleados</span><i
                    class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li>
                <a href="/docs/{{version}}/empleados" title="Ver Empleados"><i class="fa fa-eye" aria-hidden="true"></i>Ver
                    Empleados</a>
            </li>
            <li>
                <a href="/docs/{{version}}/crearempleado" title="Crear Empleados"><i class="fa fa-plus"
                                                                                     aria-hidden="true"></i>Crear
                    Empleados</a>
            </li>
            <li>
                <a href="/docs/{{version}}/actualizarbasicos" title="Actualizar Basicos"><i class="fa fa-pencil"
                                                                                          aria-hidden="true"></i>Actualizar
                    Basicos</a>
            </li>
            <li>
                <a href="/docs/{{version}}/consultarecibos" title="Ver Recibos"><i class="fa fa-file-text"
                                                                                aria-hidden="true"></i>Ver Recibos</a>
            </li>
            <li>
                <a href="/docs/{{version}}/asignacion" title="Asignar Concepto"><i class="fa fa-plug"
                                                                                          aria-hidden="true"></i>Asignar
                    Concepto</a>
            </li>


        </ul>
    </li>
    <li class="treeview {{  (Request::is('/docs/{{version}}/liquidacion' )   ? ' active' : '' ) }}">
        <a href="/docs/{{version}}/liquidacion" title="Liquidación">
            <i class="fa fa-filter" aria-hidden="true"></i><span>Liquidación</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li>
                <a href="/docs/{{version}}/liquidacion" title="Generar Liquidación">
                    <i class="fa fa-filter" aria-hidden="true"></i>Generar Liquidación
                </a>
            </li>
            <li>
                <a href="/docs/{{version}}/impresionrecibo" title="Imprir Recibos"><i class="fa fa-print"
                                                                                   aria-hidden="true"></i>Imprir Recibos</a>
            </li>


        </ul>
    </li>
    <li class="treeview   ">
        <a href="/docs/{{version}}/conceptos" title="Conceptos"><i class="fa fa-legal" aria-hidden="true"></i><span>Conceptos</span><i
                    class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li>
                <a href="/docs/{{version}}/conceptos" title="Ver Conceptos"><i class="fa fa-eye" aria-hidden="true"></i>Ver
                    Conceptos</a>
            </li>
            <li>
                <a href="/docs/{{version}}/crearconcepto" title="Crear Concepto"><i class="fa fa-plus"
                                                                                    aria-hidden="true"></i>Crear
                    Concepto</a>
            </li>
            <li>
                <a href="/docs/{{version}}/conceptoscategorias" title="Concepto por Categorias"><i class="fa fa-share-alt"
                                                                                                 aria-hidden="true"></i>Concepto
                    por Categorias</a>
            </li>
            <li>
                <a href="/docs/{{version}}/asignacion" title="Asignar Concepto"><i class="fa fa-plug"
                                                                                          aria-hidden="true"></i>Asignar
                    Concepto</a>
            </li>


        </ul>
    </li>
    <li class="treeview  ">
        <a href="/docs/{{version}}/reports" title="Reportes"><i class="fa fa-newspaper-o" aria-hidden="true"></i><span>Reportes</span><i
                    class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li class="active">
                <a href="/docs/{{version}}/reports/librosueldos" title="Libro de sueldos"><i class="fa fa-book"
                                                                                          aria-hidden="true"></i>Libro
                    de sueldos</a>
            </li>


        </ul>
    </li>
    <li class=" treeview   ">
        <a href="/docs/{{version}}/configurar" title="Parametria"><i class="fa fa-cog" aria-hidden="true"></i><span>Parametria</span><i
                    class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li class="treeview   ">
                <a href="/docs/{{version}}/obrasSociales" title="Obras Sociales"><i class="fa fa-medkit"
                                                                                 aria-hidden="true"></i><span>Obras Sociales</span><i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li>
                        <a href="/docs/{{version}}/obrasSociales" title="Ver Obras Sociales"><i class="fa fa-eye"
                                                                                             aria-hidden="true"></i>Ver
                            Obras Sociales</a>
                    </li>
                    <li>
                        <a href="/docs/{{version}}/obrasSociales/create" title="Crear Obra Social"><i class="fa fa-plus"
                                                                                                   aria-hidden="true"></i>Crear
                            Obra Social</a>
                    </li>


                </ul>
            </li>
            <li class="treeview   ">
                <a href="/docs/{{version}}/categories" title="Categorias"><i class="fa fa-sitemap"
                                                                          aria-hidden="true"></i><span>Categorias</span><i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li>
                        <a href="/docs/{{version}}/categories" title="Ver Categorias"><i class="fa fa-eye"
                                                                                      aria-hidden="true"></i>Ver
                            Categorias</a>
                    </li>
                    <li>
                        <a href="/docs/{{version}}/conceptos/categorias" title="Concepto por Categorias"><i
                                    class="fa fa-share-alt" aria-hidden="true"></i>Concepto por Categorias</a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="/docs/{{version}}/comboTypes" title="Opciones"><i class="fa fa-filter" aria-hidden="true"></i>Opciones</a>
            </li>


        </ul>
    </li>


    <li class="treeview   ">
        <a href="/docs/{{version}}/users" title="Usuarios"><i class="fa fa-users"
                                                           aria-hidden="true"></i><span>Usuarios</span><i
                    class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
            <li>
                <a href="/docs/{{version}}/users" title="Ver Usuarios"><i class="fa fa-users" aria-hidden="true"></i>Ver
                    Usuarios</a>
            </li>
            <li>
                <a href="/docs/{{version}}/edit-users" title="Editar Usuarios"><i class="fa fa-cog" aria-hidden="true"></i>Editar
                    Usuarios</a>
            </li>
            <li>
                <a href="/docs/{{version}}/users/create" title="Crear Usuario"><i class="fa fa-user-plus"
                                                                               aria-hidden="true"></i>Crear Usuario</a>
            </li>


        </ul>
    </li>

    <li class="header"></li>

    <li>
        <a href="/docs/{{version}}/logout" title="Salir"><i class="fa fa-sign-out text-red" aria-hidden="true"></i><span>Salir</span></a>
    </li>

</ul>
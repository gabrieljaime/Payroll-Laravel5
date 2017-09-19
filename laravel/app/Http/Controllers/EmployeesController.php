<?php namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeesRequest;
use App\Http\Requests\UpdateEmployeesRequest;
use App\Libraries\Repositories\EmployeesRepository;
use App\Models\Category;
use App\Models\ComboOption;
use App\Models\ComboType;
use App\Models\concepto_revista;
use App\Models\ConceptoCategory;
use App\Models\ConceptoFijo;
use App\Models\Employees;
use App\Models\Familiar;
use App\Models\ObraSocial;
use App\Models\Specialty;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\EstadosRevista;
use Flash;
use Gabo\Controller\AppBaseController as AppBaseController;
use Illuminate\Support\Facades\DB;
use Image;
use PhpParser\Node\Expr\Array_;
use Response;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class employeesController extends AppBaseController {

    /** @var  employeesRepository */
    private $employeesRepository;

    function __construct(employeesRepository $employeesRepo)
    {
        $this->employeesRepository = $employeesRepo;
    }

    /**
     * Display a listing of the employees.
     *
     * @return Response
     */
    public function index()
    {
        $employees = $this->employeesRepository->all();

            return view('employees.index')
                ->with('employees', $employees);
    }
    public function index2()

    {
        $id ="111169";
        $conceptos=ConceptoFijo::with("Concepto")->DelLegajo($id)->get();

        $mensaje="<h4>Se dio de alta el usuario y se le asignaron los siguentes conceptos: </h4>";
        $mensaje.="<table  class='table table-striped table-bordered table-condensed' ><thead><th>Codigo</th><th>Detalle</th><th>Cantidad</th><th>Importe</th></thead><tbody>";
        $tabla="";
        foreach($conceptos as $concepto)
        {

            $tabla.="<tr >";
            $tabla.="<td>" . $concepto->concepto_id . "</td>";
            $tabla.="<td align='left' ><h5>" . $concepto->concepto["detalle"] . "</h5></td>";
            $tabla.="<td >". $concepto->cantidad . "</td>";
            $tabla.="<td>". $concepto->importe . "</td>";
            $tabla.="</tr>";

        };


        $mensaje.= $tabla."</tbody></table>";


        Flash::message($mensaje,'success', 0, 'Alta Exitosa del legajo:</br><strong>'.$id.'</strong>' );


        $employees = $this->employeesRepository->all();

        return view('employees.index')
            ->with('employees', $employees);
    }

    public function buscar($legajo)
    {

        return    $Employees = Employees::DelLegajo($legajo)->get();
    }


    public function basicos()
    {
        $employees = $this->employeesRepository->all();
        $Category = Category::lists('category', 'id')->forget('0')->prepend('', '');
        $Specialty = Specialty::lists('specialty', 'id')->prepend('', '');
        $Legajos = Employees::Activos()->selectRaw('CONCAT(id, "-", nombre) as empleado, id')->lists('empleado', 'id');



        return view('employees.actualizar.basicos.index', compact('employees','Category', 'Specialty', 'Legajos'));
    }
    public function databasicos()
    {

            $Employees = Employees::Activos()->get(array('id', 'nombre',  'categoria', 'subcategoria', 'basico'));


        return Datatables::of($Employees)
            ->edit_column('categoria', '{{ App\Models\Category::find($categoria)->category }}')
            ->edit_column('subcategoria', '{{ App\Models\Specialty::find($subcategoria)->specialty  }}')
            ->edit_column('basico', '$ {{ number_format($basico,2)  }}')
            ->add_column('actions', '
            				<div class="btn-group" align="center">
                                 <a class="btn btn-primary btn-xs" type="button" data-toggle="modal"
                                   id="btnUpdateBasico" data-target="#confirmUpdateBasico"
                                  data-employees_id="{{$id}}"  data-basico="{{$basico}}"
                                  data-nombre="{{$nombre}}"
                                   data-id="{{{ URL::to(\'employees/updatebasico/\' . $id   ) }}}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>Editar
                                </a>
                            </div>
                        	')
            ->make(true);
    }

public function data($todos)
    {
       if ($todos=='ACTIVOS')
       {
           $Employees = Employees::Activos()->get(array('id', 'nombre', 'cuil', 'fecha_ingreso','fecha_nacimiento', 'categoria', '.subcategoria', 'tipo_documento', 'numero_documento', 'basico', 'activo', 'estado'));
       }
        else
        {
            if ($todos=='TODOS')
            {
                $Employees = Employees::get(array('id', 'nombre', 'cuil', 'fecha_ingreso', 'fecha_nacimiento','categoria', 'subcategoria', 'tipo_documento', 'numero_documento', 'basico', 'activo', 'estado'));

            }
            else
            {
                $Employees = Employees::DelLegajo($todos)->get(array('id', 'nombre', 'cuil', 'fecha_ingreso','fecha_nacimiento', 'categoria', 'subcategoria', 'tipo_documento', 'numero_documento', 'basico', 'activo', 'estado'));
            }
        }




        return Datatables::of($Employees)
            ->edit_column('categoria', '{{ App\Models\Category::find($categoria)->category }}')
            ->edit_column('subcategoria', '{{ App\Models\Specialty::find($subcategoria)->specialty  }}')
            ->edit_column('tipo_documento', '{{ App\Models\ComboOption::find($tipo_documento)->description  }}')
            ->edit_column('fecha_ingreso', '{{ $fecha_ingreso->format("d/m/Y")  }}')
            ->edit_column('fecha_nacimiento', '{{ $fecha_nacimiento->format("d/m/Y")  }}')
            ->edit_column('basico', '$ {{ number_format($basico,2)  }}')
            ->edit_column('activo',  function ($Employee) { if ($Employee->activo==true) return "<span class='label label-success'>ACTIVO</span>" ;
                                                            else return "<span class='label label-danger'>BAJA</span>"  ;
            })
            ->add_column('actions', '
				<div class="btn-group" align="center">
				<a href="{{{ URL::to(\'employees/\' . $id . \'/edit\' ) }}}" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i>Editar </a>
				</div>
            	')
            ->make(true);
    }

    /**
     * Show the form for creating a new employees.
     *
     * @return Response
     */
    public function create()
    {

        $TipoDoc =  ComboOption::where('type_id',1)->lists('description','id')->prepend('', '');
        $Sexo =  ComboOption::where('type_id',3)->lists('description','id')->prepend('', '');
        $EstadoCivil = ComboOption::where('type_id',4)->lists('description','id')->prepend('', '');
        $turno = ComboOption::where('type_id',9)->lists('description','id')->prepend('', '');
        $cajas = ComboOption::where('type_id',11)->lists('description','id')->prepend('', '');
        $TipoContrato = ComboOption::where('type_id',5)->lists('description','id')->prepend('', '');
        $Ubicacion = ComboOption::where('type_id',6)->lists('description','id')->prepend('', '');
        $Localidades = ComboOption::where('type_id',8)->lists('description','id')->prepend('', '');
        $ObraSocial  = ObraSocial::selectRaw('CONCAT(codigo, "-", nombre) as nombre, id')->lists('nombre', 'id')->prepend('', '');

        $Category = Category::lists('category', 'id')->prepend('', '');
        $Specialty = Specialty::lists('specialty', 'id')->prepend('', '');
        $conceptos_revista = concepto_revista::lists('descripcion','id')->prepend('', '');
        $employees = New Employees();
        $employees->conyugue=0;
         $employees->cant_hijos=0;
        $edit=false;

        /*
         $estadocivil  = \App\Models\OpcionesCombos::where('combo','=','1')->lists('descripcion','descripcion');
        $categoria  = \App\Models\Categorias::lists('categoria','id');
        $especialidad  = \App\Models\Especialidades::lists('especialidad','id');
        $obrasocial  = \App\Models\ObrasSociales::lists('nombre','codigo');*/

        return view('employees/create', compact('TipoDoc','cajas', 'Sexo','turno', 'EstadoCivil', 'Ubicacion', 'TipoContrato', 'ObraSocial', 'Category', 'Specialty','conceptos_revista','employees','edit', 'Localidades'));
        /*		->with('ubicaciones', $ubicaciones)
                ->with('estados_revista', $estados_revista)
                ->with('categoria', $categoria)
                ->with('especialidad', $especialidad)
                ->with('estadocivil', $estadocivil)
                ->with('obrasocial', $obrasocial)
                ->with('TipoDoc', $TipoDoc);*/
    }


    public function validarCuit( $cuit, $dni ){





        $cuit = preg_replace( '/[^\d]/', '', (string) $cuit );
        $dni = preg_replace( '/[^\d]/', '', (string) $dni );


        $val = substr($cuit,2,8)==$dni;



        if ($val)
        {
            if( strlen( $cuit ) != 11 ){
                return false;
            }
            $acumulado = 0;
            $digitos = str_split( $cuit );
            $digito = array_pop( $digitos );


            for( $i = 0; $i < count( $digitos ); $i++ ){
                $acumulado += $digitos[ 9 - $i ] * ( 2 + ( $i % 6 ) );
            }
            $verif = 11 - ( $acumulado % 11 );
            $verif = $verif == 11? 0 : $verif;

            $val = $digito == $verif;

        }

        return $val;
    }

    /**
     * Store a newly created employees in storage.
     *
     * @param CreateEmployeesRequest $request
     *
     * @return Response
     */
    public function store(CreateEmployeesRequest $request)
    {
        DB::transaction(function () use($request) {


            $input = $request->all();

        $doc= $input['numero_documento'];
        $cuil=$input['cuil'];


        $errors=[];

        if (!$this->validarCuit($cuil,$doc)) {

            $errors= array_prepend( $errors,'El Cuil ingresado no es valido');
            return redirect('employees/create')
                ->withErrors($errors)
                ->withInput($input);
        }


        if ($request->hasFile('photoup'))
        {

            $input["photo"]  = $this->guardar_foto( $request->file('photoup'));
        }

        $input["fecha_nacimiento"]=Carbon::createFromFormat('d/m/Y',$input["fecha_nacimiento"]);
        $input["fecha_ingreso"]=Carbon::createFromFormat('d/m/Y',$input["fecha_ingreso"]);


        $employees = $this->employeesRepository->create($input);

        $this->guardar_familiares($input, $employees->id);

        $this->nueva_revista($employees->id,$input["fecha_ingreso"], 1,'Ingreso' );


        $this->asignar_conceptosfijos( $input["categoria"], $employees);

        $conceptos=ConceptoFijo::with("Concepto")->DelLegajo( $employees->id)->get();

        $mensaje="<h4>Se dio de alta el usuario y se le asignaron los siguentes conceptos: </h4>";
        $mensaje.="<table  class='table table-striped table-bordered table-condensed' ><thead><th>Codigo</th><th>Detalle</th><th>Cantidad</th><th>Importe</th></thead><tbody>";
            $tabla="";
            foreach($conceptos as $concepto)
            {

                $tabla.="<tr>";
                $tabla.="<td>" . $concepto->concepto_id . "</td>";
                $tabla.="<td align='left' ><h5>" . $concepto->concepto["detalle"] . "</h5></td>";
                $tabla.="<td>". $concepto->cantidad . "</td>";
                $tabla.="<td>". $concepto->importe . "</td>";
                $tabla.="</tr>";

            };


        $mensaje.= $tabla."</tbody></table>";


        Flash::message($mensaje,'success', 0, 'Alta Exitosa del legajo:</br><strong>'.$employees->id.'</strong>' );

        });

        return redirect(route('employees.index'));
    }

    /**
     * Display the specified employees.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $employees = $this->employeesRepository->find($id);

        if (empty($employees))
        {
            Flash::error('employees not found');

            return redirect(route('employees.index'));
        }

        return view('employees.show')->with('employees', $employees);
    }

    /**
     * Show the form for editing the specified employees.
     *
     * @    param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $employees = $this->employeesRepository->find($id);
        $TipoDoc =  ComboOption::where('type_id',1)->lists('description','id')->prepend('', '');
        $Sexo =  ComboOption::where('type_id',3)->lists('description','id')->prepend('', '');
        $EstadoCivil = ComboOption::where('type_id',4)->lists('description','id')->prepend('', '');
        $turno = ComboOption::where('type_id',9)->lists('description','id')->prepend('', '');
        $cajas = ComboOption::where('type_id',11)->lists('description','id')->prepend('', '');
        $TipoContrato = ComboOption::where('type_id',5)->lists('description','id')->prepend('', '');
        $Ubicacion = ComboOption::where('type_id',6)->lists('description','id')->prepend('', '');
        $Localidades = ComboOption::where('type_id',8)->lists('description','id')->prepend('', '');
        $ObraSocial =ObraSocial::selectRaw('CONCAT(codigo, "-", nombre) as nombre, id')->lists('nombre', 'id')->prepend('', '');
        $Category = Category::lists('category', 'id')->prepend('', '');
        $Specialty =Specialty::where('category', '=', $employees->categoria)->get()->lists('specialty', 'id')->prepend('', '');
        $conceptos_revista = concepto_revista::where('id','!=',$employees->estado)->lists('descripcion','id')->prepend('', '');
        $estado_revista = concepto_revista::find($employees->estado);
        $situacion_revista= EstadosRevista::with('Situacion')->DelLegajoVigente($id)->first();
        $conyugue=Familiar::ConyugueDe($id)->first();
        $hijos=Familiar::HijosDe($id)->get();

        //$estados_revista  = \App\Models\estado_revista::lists('descripcion','id');
        //$categoria  = \App\Models\Categorias::lists('categoria','id');
        //$especialidad  = \App\Models\Especialidades::lists('especialidad','id');
        if (empty($employees))
        {
            Flash::error('No se encontro el empleado buscado!');

                return redirect(route('employees.index'));
        }

        return view('employees.edit', compact('employees','cajas', 'TipoDoc','turno', 'Sexo', 'EstadoCivil', 'Ubicacion', 'TipoContrato', 'ObraSocial', 'Category', 'Specialty','conceptos_revista','estado_revista','situacion_revista', 'conyugue', 'hijos', 'Localidades'));
        //->with('estados_revista', $estados_revista)
        //->with('categoria', $categoria)
        //->with('especialidad', $especialidad)


    }

    /**
     * Update the specified employees in storage.
     *
     * @param  int $id
     * @param UpdateemployeesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateemployeesRequest $request)
    {
        $employees = $this->employeesRepository->find($id);

            if (empty($employees))
            {
                Flash::error('employees not found');

                return redirect(route('employees.index'));
            }

        $input = $request->all();



        if ($request->hasFile('photoup'))
        {

            $input["photo"]  = $this->guardar_foto( $request->file('photoup'));
        }
        $input["fecha_nacimiento"]=Carbon::createFromFormat('d/m/Y',$input["fecha_nacimiento"]);
        $input["fecha_ingreso"]=Carbon::createFromFormat('d/m/Y',$input["fecha_ingreso"]);






        $this->employeesRepository->updateRich($input, $id);


        if (($employees->categoria <>  $input["categoria"]) or ($employees->sindicato <>  $input["sindicato"]) or ($employees->es_jerarquico <>  $input["es_jerarquico"]))
        {
            $this->eliminar_conceptosfijos( $employees);
            $this->asignar_conceptosfijos( $input["categoria"], $this->employeesRepository->find($id));
        }


        $this->guardar_familiares($input, $id);



        Flash::success('Empleado actualizado Exitosamente');

        return redirect(route('employees.index'));
    }


    public function updatebasico($id, Request $request)
    {
        $input = $request->all();

        $basico = $input["basico"];

        $this->actualizarbasico($id, $basico,"Importe");

        Flash::success('Sueldo basico actualizado Exitosamente');


        return redirect(route('actualizar.basicos'));
    }
    public function updatebasicos( Request $request)
    {




        $input = $request->all();



        if (isset($input["todos"]))
        {

            if (isset($input["todasC"]))
            {
                if (isset($input["todasS"]))
                {
                    $empleados = Employees::Activos()->lists('id');
                }
                else
                {
                    $empleados = Employees::Activos()->where('subcategoria',$input["subcategoria"])->lists('id');
                }
            }
            else
            {
                if (isset($input["todasS"]))
                {
                    $empleados = Employees::Activos()->where('categoria',$input["categoria"])->lists('id');
                }
                else
                {
                    $empleados = Employees::Activos()->where('categoria',$input["categoria"])->where('subcategoria',$input["subcategoria"])->lists('id');
                }
            }
        }
       else
       {
           $empleados= Employees::Activos()->DelLegajo($input["legajo"])->lists('id');


       }


        $cant=$empleados->count();
        $basico = $input["valor"];


        foreach ($empleados as $empleado)
        {

        $this->actualizarbasico($empleado, $basico,$input["imppor"]);
        }

        if ( $cant==1)
        {
            Flash::message('Se actualizó el Sueldo Basico solicitado','success', 0, '<strong>Sueldos Basicos Actualizados</strong>');

        }
        else
        {
            Flash::message('Se actualizarón los '.$cant.' Sueldos Basicos solicitados','success', 0, '<strong>Sueldos Basicos Actualizados</strong>');

        }


        return redirect(route('actualizar.basicos'));
    }

    /**
     * Remove the specified employees from storage.

     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $employees = $this->employeesRepository->find($id);

        if (empty($employees))
        {
            Flash::error('employees not found');

            return redirect(route('employees.index'));
        }

        $this->employeesRepository->delete($id);

        Flash::success('employees deleted successfully.');

        return redirect(route('employees.index'));
    }
    public function cambiar_revista($id, Request $request)
    {


        DB::transaction(function () use($id, $request) {

        $employees = $this->employeesRepository->find($id);

        $estado_revista= EstadosRevista::DelLegajoVigente($id)->first();

            if (empty($employees))
        {
                Flash::message('No existe el empleado solicitado','alert', 15, 'Error de Busqueda');

                return redirect(route('employees.index'));
         }


       $employees->estado=$request["sitrevista"];

        if ($request["sitrevista"]==99)
        {
            $employees->activo = false;
        }

        $employees->save();

        $estado_revista->fecha_fin=$request["inicio"];
        $estado_revista->estado="N";
        $estado_revista->save();



        $this->nueva_revista($id,$request["inicio"],$request["sitrevista"],$request["motivo"] );


        Flash::message('Se realizó correctamente el cambio de Situación del empleado','success', 0, 'Cambio Situación Revista');
        });
        return redirect(route('employees.index'));
    }


    public function nueva_revista($id, $fecha_inicio, $situacion, $motivo)
    {
        $nueva_revista = new EstadosRevista();
        $nueva_revista->legajo = $id;
        $nueva_revista->fecha_inicio =$fecha_inicio;
        $nueva_revista->situacion = $situacion;
        $nueva_revista->motivo = $motivo;
        $nueva_revista->usuario_cambio = Auth::user()->id;
        $nueva_revista->estado = "V";
        $nueva_revista->save();


    }


    public function guardar_familiares($input, $id)
    {


        if ($input["conyugue"]== 1)
        {
            $familiar=Familiar::ConyugueDe($id)->first();
            if (empty($familiar))
            {
                $familiar=new Familiar();
                $familiar->legajo=$id;
                $familiar->relacion="Conyugue";
            }
            $familiar->nombre=$input["nombreconyu"];
            $familiar->fecha_nacimiento=$input["fechnacconyu"];
            $familiar->tipo_documento=$input["tipdoccony"];
            $familiar->documento=$input["nrodoccony"];
            $familiar->cuil=$input["cuilcony"];
            $familiar->discapacitado=$input["disccony"];
            $familiar->ocupacion=$input["ocupacony"];

            $familiar->save();
        }
        else
        {
            $familiar=Familiar::ConyugueDe($id)->first();
            if (!empty($familiar))
            {
                $familiar->delete();
            }
        }


        for ($i = 1; $i <10; $i++)
        {
            if ( $input["cant_hijos"]>=$i)
            {
                $familiar= Familiar::HijoDe($id, "Hijo".$i)->first();

                if (empty($familiar))
                {
                    $familiar = new Familiar();
                    $familiar->legajo = $id;
                    $familiar->relacion = "Hijo" . $i;
                }
                $familiar->nombre=$input["nombrehijo".$i];
                $familiar->fecha_nacimiento=$input["fechnahijo".$i];
                $familiar->tipo_documento=$input["tipdohijo".$i];
                $familiar->documento=$input["nrodochijo".$i];
                $familiar->cuil=$input["cuilhijo".$i];
                $familiar->discapacitado=$input["dischijo".$i];
                $familiar->ocupacion=$input["educahijo".$i];

                $familiar->save();
            }
            else
            {
                $familiar=Familiar::HijoDe($id, "Hijo".$i)->first();
                if (!empty($familiar))
                {
                    $familiar->delete();
                }
            }
        };
    }


    public function asignar_conceptosfijos($categoria,$empleado)
    {

        $categorias[]="0";
        $categorias=array_prepend($categorias,$categoria);


        $conceptosTodos = ConceptoCategory::DelaCategoria($categorias)->get();


        

        $conceptosFijos = new ConceptoFijo();



              $conceptosFijos->guardar_porCategoria($conceptosTodos, $empleado);
    }
    public function eliminar_conceptosfijos($empleado)
    {


       $conceptosFijos =  ConceptoFijo::DelLegajo($empleado->id)->get();


        foreach ($conceptosFijos as $concepto)
        {
            $concepto->delete();

        }







    }

    public function guardar_foto($photo)
    {
        $image =$photo;
        $image_name = time() . "-" . $image->getClientOriginalName();
        $image->move('storage/legajos', $image_name);
        Image::make('storage/legajos/' . $image_name)
            ->fit(200)
            ->save('storage/legajos/' . $image_name);

        return $image_name;
    }

    /**
     * @param $id
     * @param UpdateEmployeesRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function actualizarbasico($id, $basico,$impor)
    {
        $empleado = Employees::find($id);


        if (empty($empleado)) {
            Flash::error('Empleado no encontrado');

            return redirect(route('actualizar.basicos'));
        }


        if ($impor=="Porcentaje")
        {
        $empleado->basico = $empleado->basico * (1 + ($basico/100));
        }
        else
        {
            $empleado->basico = $basico;
        }
        $empleado->save();

        return;

    }
}

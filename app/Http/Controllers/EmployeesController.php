<?php namespace App\Http\Controllers;

use App\Http\Requests\CreateemployeesRequest;
use App\Http\Requests\UpdateEmployeesRequest;
use App\Libraries\Repositories\EmployeesRepository;
use App\Models\ConceptoCategory;
use App\Models\ConceptoFijo;
use App\Models\Employees;
use App\Models\Familiar;
use App\Models\Specialty;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\EstadosRevista;
use Flash;
use Gabo\Controller\AppBaseController as AppBaseController;
use Image;
use Response;
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

public function data($todos)
    {
       if ($todos=='ACTIVOS')
       {
           $Employees = Employees::Activos()->get(array('id', 'nombre', 'cuil', 'fecha_ingreso', 'categoria', 'subcategoria', 'tipo_documento', 'numero_documento', 'basico', 'activo', 'estado'));
       }
        else
        {
            if ($todos=='TODOS')
            {
                $Employees = Employees::get(array('id', 'nombre', 'cuil', 'fecha_ingreso', 'categoria', 'subcategoria', 'tipo_documento', 'numero_documento', 'basico', 'activo', 'estado'));

            }
            else
            {
                $Employees = Employees::DelLegajo($todos)->get(array('id', 'nombre', 'cuil', 'fecha_ingreso', 'categoria', 'subcategoria', 'tipo_documento', 'numero_documento', 'basico', 'activo', 'estado'));
            }
        }


        return Datatables::of($Employees)
            ->edit_column('categoria', '{{ \App\Models\Category::find($categoria)->category }}')
                ->edit_column('subcategoria', '{{\App\Models\Specialty::find($subcategoria)->specialty  }}')
            ->edit_column('tipo_documento', '{{ \App\Models\comboOption::find($tipo_documento)->description  }}')
            ->edit_column('activo',  function ($Employee) { if ($Employee->activo==true) return "<span class='label label-success'>ACTIVO</span>" ;
                                                            else return "<span class='label label-danger'>BAJA</span>"  ;
            })
            ->add_column('actions', '
				<div class="btn-group" align="center">
				<a href="{{{ URL::to(\'employees/\' . $id . \'/edit\' ) }}}" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i>Edit </a>
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

        $TipoDoc =  \App\Models\comboType::join('comboOptions', 'comboTypes.id', '=', 'comboOptions.type_id')
                                        ->where('comboTypes.type','Tipo Documento')
                                        ->lists('comboOptions.description','comboOptions.id')->prepend('', '');
        $Sexo =  \App\Models\comboType::join('comboOptions', 'comboTypes.id', '=', 'comboOptions.type_id')
            ->where('comboTypes.type','Sexo')
            ->lists('comboOptions.description','comboOptions.id')->prepend('', '');
        $EstadoCivil =  \App\Models\comboType::join('comboOptions', 'comboTypes.id', '=', 'comboOptions.type_id')
            ->where('comboTypes.type','Estado Civil')
            ->lists('comboOptions.description','comboOptions.id')->prepend('', '');
        $turno =  \App\Models\comboType::join('comboOptions', 'comboTypes.id', '=', 'comboOptions.type_id')
            ->where('comboTypes.type','Turno')
            ->lists('comboOptions.description','comboOptions.id')->prepend('', '');
        $TipoContrato =  \App\Models\comboType::join('comboOptions', 'comboTypes.id', '=', 'comboOptions.type_id')
            ->where('comboTypes.type','Tipo Contrato')
            ->lists('comboOptions.description','comboOptions.id')->prepend('', '');
        $Ubicacion =  \App\Models\comboType::join('comboOptions', 'comboTypes.id', '=', 'comboOptions.type_id')
            ->where('comboTypes.type','Ubicacion')
            ->lists('comboOptions.description','comboOptions.id')->prepend('', '');
        $Localidades =  \App\Models\comboType::join('comboOptions', 'comboTypes.id', '=', 'comboOptions.type_id')
            ->where('comboTypes.type','Localidades')
            ->lists('comboOptions.description','comboOptions.id')->prepend('', '');
        $ObraSocial = \App\Models\obraSocial::selectRaw('CONCAT(codigo, "-", nombre) as nombre, id')->lists('nombre', 'id')->prepend('', '');

        $Category = \App\Models\Category::lists('category', 'id')->prepend('', '');
        $Specialty = \App\Models\Specialty::lists('specialty', 'id')->prepend('', '');
        $conceptos_revista = \App\Models\concepto_revista::lists('descripcion','id')->prepend('', '');
        $employees = New Employees();
        $employees->conyugue=0;
         $employees->cant_hijos=0;
        $edit=false;

        /*
         $estadocivil  = \App\Models\OpcionesCombos::where('combo','=','1')->lists('descripcion','descripcion');
        $categoria  = \App\Models\Categorias::lists('categoria','id');
        $especialidad  = \App\Models\Especialidades::lists('especialidad','id');
        $obrasocial  = \App\Models\ObrasSociales::lists('nombre','codigo');*/

        return view('employees/create', compact('TipoDoc', 'Sexo','turno', 'EstadoCivil', 'Ubicacion', 'TipoContrato', 'ObraSocial', 'Category', 'Specialty','conceptos_revista','employees','edit', 'Localidades'));
        /*		->with('ubicaciones', $ubicaciones)
                ->with('estados_revista', $estados_revista)
                ->with('categoria', $categoria)
                ->with('especialidad', $especialidad)
                ->with('estadocivil', $estadocivil)
                ->with('obrasocial', $obrasocial)
                ->with('TipoDoc', $TipoDoc);*/
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

            $input = $request->all();
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
        $TipoDoc = \App\Models\comboType::find(1)->Options->lists('description', 'id');
        $Sexo = \App\Models\comboType::find(3)->Options->lists('description', 'id');
        $EstadoCivil = \App\Models\comboType::find(4)->Options->lists('description', 'id');
        $TipoContrato = \App\Models\comboType::find(5)->Options->lists('description', 'id');
        $Ubicacion = \App\Models\comboType::find(6)->Options->lists('description', 'id');
        $Localidades =  \App\Models\comboType::join('comboOptions', 'comboTypes.id', '=', 'comboOptions.type_id')
            ->where('comboTypes.type','Localidades')
            ->lists('comboOptions.description','comboOptions.id')->prepend('', '');
        $turno =  \App\Models\comboType::join('comboOptions', 'comboTypes.id', '=', 'comboOptions.type_id')
            ->where('comboTypes.type','Turno')
            ->lists('comboOptions.description','comboOptions.id')->prepend('', '');
        $ObraSocial = \App\Models\obraSocial::selectRaw('CONCAT(codigo, "-", nombre) as nombre, id')->lists('nombre', 'id')->prepend('', '');
        $Category = \App\Models\Category::lists('category', 'id')->prepend('', '');
        $Specialty = \App\Models\Specialty::where('category', '=', $employees->categoria)->get()->lists('specialty', 'id')->prepend('', '');
        $conceptos_revista = \App\Models\concepto_revista::where('id','!=',$employees->estado)->lists('descripcion','id')->prepend('', '');
        $estado_revista = \App\Models\concepto_revista::find($employees->estado);
        $situacion_revista= \App\Models\EstadosRevista::with('Situacion')->DelLegajoVigente($id)->first();
        $conyugue=\App\Models\Familiar::ConyugueDe($id)->first();
        $hijos=\App\Models\Familiar::HijosDe($id)->get();

        //$estados_revista  = \App\Models\estado_revista::lists('descripcion','id');
        //$categoria  = \App\Models\Categorias::lists('categoria','id');
        //$especialidad  = \App\Models\Especialidades::lists('especialidad','id');
        if (empty($employees))
        {
            Flash::error('employees not found');

            return redirect(route('employees.index'));
        }

        return view('employees.edit', compact('employees', 'TipoDoc','turno', 'Sexo', 'EstadoCivil', 'Ubicacion', 'TipoContrato', 'ObraSocial', 'Category', 'Specialty','conceptos_revista','estado_revista','situacion_revista', 'conyugue', 'hijos', 'Localidades'));
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

        $this->guardar_familiares($input, $id);

        Flash::success('Empleado actualizado Exitosamente');

        return redirect(route('employees.index'));
    }

    /**
     * Remove the specified employees from storage.
     *
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
    public function cambiar_revista($id, UpdateemployeesRequest $request)
    {
        $employees = $this->employeesRepository->find($id);
        $estado_revista= EstadosRevista::DelLegajoVigente($id)->first();


        if (empty($employees))
            if (empty($employees))
            {
                Flash::message('Relación modificada correctamente','success', 0, 'Modificación Exitosa');

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

        Flash::success('Empleado actualizado Exitosamente');

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
        $categorias = collect(0,$categoria);

        $conceptosTodos = ConceptoCategory::DelaCategoria($categorias)->get();

        $conceptosFijos = new ConceptoFijo();

              $conceptosFijos->guardar_porCategoria($conceptosTodos, $empleado);
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
}

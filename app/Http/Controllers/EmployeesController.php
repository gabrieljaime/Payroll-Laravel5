<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateemployeesRequest;
use App\Http\Requests\UpdateemployeesRequest;
use App\Libraries\Repositories\EmployeesRepository;
use App\Models\employees;
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

    public function data()
    {
        $Employees = Employees::select(array('employees.id', 'employees.nombre', 'employees.cuil', 'employees.fecha_ingreso', 'employees.categoria', 'employees.subcategoria', 'employees.tipo_documento', 'employees.numero_documento', 'employees.basico', 'employees.activo', 'employees.estado',));

        return Datatables::of($Employees)
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
        /*$ubicaciones  = \App\Models\Ubicaciones::lists('descripcion','id');
        $estados_revista  = \App\Models\estado_revista::lists('descripcion','id');
        */
        $TipoDoc = \App\Models\comboType::find(1)->Options->lists('description', 'id');
        $Sexo = \App\Models\comboType::find(3)->Options->lists('description', 'id');
        $EstadoCivil = \App\Models\comboType::find(4)->Options->lists('description', 'id');
        $TipoContrato = \App\Models\comboType::find(5)->Options->lists('description', 'id');
        $Ubicacion = \App\Models\comboType::find(6)->Options->lists('description', 'id');
        $ObraSocial = \App\Models\obraSocial::lists('nombre', 'codigo');
        $Category = \App\Models\Category::lists('category', 'id')->prepend('', '');
        $Specialty = \App\Models\Specialty::lists('specialty', 'id')->prepend('', '');

        /*
         $estadocivil  = \App\Models\OpcionesCombos::where('combo','=','1')->lists('descripcion','descripcion');
        $categoria  = \App\Models\Categorias::lists('categoria','id');
        $especialidad  = \App\Models\Especialidades::lists('especialidad','id');
        $obrasocial  = \App\Models\ObrasSociales::lists('nombre','codigo');*/

        return view('employees/create', compact('TipoDoc', 'Sexo', 'EstadoCivil', 'Ubicacion', 'TipoContrato', 'ObraSocial', 'Category', 'Specialty'));
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
     * @param CreateemployeesRequest $request
     *
     * @return Response
     */
    public function store(CreateemployeesRequest $request)
    {

        $input = $request->all();

        if ($request->hasFile('photoup'))
        {
            $image = $request->file('photoup');
            $image_name = time() . "-" . $image->getClientOriginalName();

            \Storage::disk('local')->put($image_name, \File::get($image));

            $input["photo"] = $image_name;
        }


        $employees = $this->employeesRepository->create($input);

        Flash::success('Empleado creado correctamente con el Legajo: ' . $employees->id);

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
        $ObraSocial = \App\Models\obraSocial::lists('nombre', 'codigo');
        $Category = \App\Models\Category::lists('category', 'id')->prepend('', '');
        $Specialty = \App\Models\Specialty::where('category', '=', $employees->categoria)->get()->lists('specialty', 'id')->prepend('', '');


        //$estados_revista  = \App\Models\estado_revista::lists('descripcion','id');
        //$categoria  = \App\Models\Categorias::lists('categoria','id');
        //$especialidad  = \App\Models\Especialidades::lists('especialidad','id');
        if (empty($employees))
        {
            Flash::error('employees not found');

            return redirect(route('employees.index'));
        }

        return view('employees.edit', compact('employees', 'TipoDoc', 'Sexo', 'EstadoCivil', 'Ubicacion', 'TipoContrato', 'ObraSocial', 'Category', 'Specialty'));
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
            if (empty($employees))
            {
                Flash::error('employees not found');

                return redirect(route('employees.index'));
            }

        $input = $request->all();
        if ($request->hasFile('photoup'))
        {
            $image = $request->file('photoup');
            $image_name = time() . "-" . $image->getClientOriginalName();

            \Storage::disk('local')->put($image_name, \File::get($image));

            $input["photo"] = $image_name;
        }
        $this->employeesRepository->updateRich($input, $id);


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

}

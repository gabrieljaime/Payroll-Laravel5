<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateemployeesRequest;
use App\Http\Requests\UpdateemployeesRequest;
use App\Libraries\Repositories\EmployeesRepository;
use Flash;
use App\Models\employees;
use Mitul\Controller\AppBaseController as AppBaseController;
use Yajra\Datatables\Datatables;
use Response;
use Image;
class employeesController extends AppBaseController
{

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
		$Employees = Employees::select(array('employees.id','employees.nombre','employees.cuil','employees.fecha_ingreso','employees.categoria','employees.subcategoria','employees.tipo_documento','employees.numero_documento','employees.basico','employees.activo','employees.estado',));

		return Datatables::of($Employees)->make(true);
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
		$TipoDoc  = \App\Models\OpcionesCombos::where('combo','=','DNI')->lists('descripcion','descripcion');
		$estadocivil  = \App\Models\OpcionesCombos::where('combo','=','1')->lists('descripcion','descripcion');
		$categoria  = \App\Models\Categorias::lists('categoria','id');
		$especialidad  = \App\Models\Especialidades::lists('especialidad','id');
		$obrasocial  = \App\Models\ObrasSociales::lists('nombre','codigo');*/

		return view('employees/create');
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
			$image =$request->file('photoup');
			$image_name = time()."-".$image->getClientOriginalName();

			\Storage::disk('local')->put($image_name,  \File::get($image));

			$input["photo"]= $image_name;
		}


		$employees = $this->employeesRepository->create($input);

		Flash::success('employees saved successfully.');

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

		if(empty($employees))
		{
			Flash::error('employees not found');

			return redirect(route('employees.index'));
		}

		return view('employees.show')->with('employees', $employees);
	}

	/**
	 * Show the form for editing the specified employees.
	 *
	 * @	param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$employees = $this->employeesRepository->find($id);
		//$ubicaciones  = \App\Models\Ubicaciones::lists('descripcion','id');
		//$estados_revista  = \App\Models\estado_revista::lists('descripcion','id');
		//$TipoDoc  = \App\Models\OpcionesCombos::where('combo','=','DNI')->lists('descripcion','descripcion');
		//$estadocivil  = \App\Models\OpcionesCombos::where('combo','=','1')->lists('descripcion','descripcion');
		//$categoria  = \App\Models\Categorias::lists('categoria','id');
		//$especialidad  = \App\Models\Especialidades::lists('especialidad','id');
		//$obrasocial  = \App\Models\ObrasSociales::lists('nombre','codigo');
		if(empty($employees))
		{
			Flash::error('employees not found');

			return redirect(route('employees.index'));
		}

		return view('employees.edit')
			->with('employees', $employees);
			//->with('ubicaciones', $ubicaciones)
			//->with('estados_revista', $estados_revista)
			//->with('categoria', $categoria)
			//->with('especialidad', $especialidad)
			//->with('estadocivil', $estadocivil)
			//->with('obrasocial', $obrasocial)
			//->with('TipoDoc', $TipoDoc);

	}

	/**
	 * Update the specified employees in storage.
	 *
	 * @param  int              $id
	 * @param UpdateemployeesRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateemployeesRequest $request)
	{
		$employees = $this->employeesRepository->find($id);

		if(empty($employees))
		if(empty($employees))
		{
			Flash::error('employees not found');

			return redirect(route('employees.index'));
		}

		$input=$request->all();
		if ($request->hasFile('photoup'))
		{
			$image =$request->file('photoup');
			$image_name = time()."-".$image->getClientOriginalName();

			\Storage::disk('local')->put($image_name,  \File::get($image));

			$input["photo"]= $image_name;
		}
		$this->employeesRepository->updateRich($input	, $id);







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

		if(empty($employees))
		{
			Flash::error('employees not found');

			return redirect(route('employees.index'));
		}

		$this->employeesRepository->delete($id);

		Flash::success('employees deleted successfully.');

		return redirect(route('employees.index'));
	}

}

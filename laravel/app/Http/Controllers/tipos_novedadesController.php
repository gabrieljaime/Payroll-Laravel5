<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Createtipos_novedadesRequest;
use App\Http\Requests\Updatetipos_novedadesRequest;
use App\Libraries\Repositories\tipos_novedadesRepository;
use App\Models\TiposNovedades;
use Flash;
use Yajra\Datatables\Datatables;
use Gabo\Controller\AppBaseController as AppBaseController;
use Response;
use Image;

class tipos_novedadesController extends AppBaseController
{

	/** @var  tipos_novedadesRepository */
	private $tiposNovedadesRepository;

	function __construct(tipos_novedadesRepository $tiposNovedadesRepo)
	{
		$this->tiposNovedadesRepository = $tiposNovedadesRepo;
	}

	/**
	 * Display a listing of the TiposNovedades.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tiposNovedades = $this->tiposNovedadesRepository->paginate(10);

		return view('novedades.tipos.index')
			->with('tiposNovedades', $tiposNovedades);
	}

	/**
	 * Show the form for creating a new TiposNovedades.
	 *
	 * @return Response
	 */
	public function create()
	{
		

		return view('novedades.tipos.create');
	}

	/**
    	 * Generate the Data File for de DataTables of TiposNovedades.
    	 *
    	 * @return Datatable
    	 */
	public function data()
    	{
    		$tiposNovedades = TiposNovedades::get(array('descripcion','resumen','id'));

    		return Datatables::of($tiposNovedades)
    						->add_column('actions', '
            				<div class="btn-group">
            				<a href="{{{ URL::to(\'novedades/tipos/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-xs btn-primary"><i class="fa fa-pencil"></i>Edit </a>
            				</div>
                        	')
            				->remove_column('id')
            				->make(true);
    	}

	/**
	 * Store a newly created TiposNovedades in storage.
	 *
	 * @param Createtipos_novedadesRequest $request
	 *
	 * @return Response
	 */
	public function store(Createtipos_novedadesRequest $request)
	{
		$input = $request->all();

		$tiposNovedades = $this->tiposNovedadesRepository->create($input);



		Flash::success('TiposNovedades saved successfully.');

		return redirect(route('novedades.tipos.index'));
	}

	/**
	 * Display the specified TiposNovedades.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$tiposNovedades = $this->tiposNovedadesRepository->find($id);

		if(empty($tiposNovedades))
		{
			Flash::error('TiposNovedades not found');

			return redirect(route('novedades.tipos.index'));
		}

		return view('novedades.tipos.show')->with('tiposNovedades', $tiposNovedades);
	}

	/**
	 * Show the form for editing the specified TiposNovedades.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$tiposNovedades = $this->tiposNovedadesRepository->find($id);

		

		if(empty($tiposNovedades))
		{
			Flash::error('TiposNovedades not found');

			return redirect(route('novedades.tipos.index'));
		}

		return view('novedades.tipos.edit')->with('tiposNovedades', $tiposNovedades);
	}

	/**
	 * Update the specified TiposNovedades in storage.
	 *
	 * @param  int              $id
	 * @param Updatetipos_novedadesRequest $request
	 *
	 * @return Response
	 */
	public function update($id, Updatetipos_novedadesRequest $request)
	{
		$tiposNovedades = $this->tiposNovedadesRepository->find($id);


		if(empty($tiposNovedades))
		{
			Flash::error('TiposNovedades not found');

			return redirect(route('novedades.tipos.index'));
		}

		$this->tiposNovedadesRepository->updateRich($request->all(), $id);

		Flash::success('TiposNovedades updated successfully.');

		return redirect(route('novedades.tipos.index'));
	}

	/**
	 * Remove the specified TiposNovedades from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$tiposNovedades = $this->tiposNovedadesRepository->find($id);

		if(empty($tiposNovedades))
		{
			Flash::error('TiposNovedades not found');

			return redirect(route('novedades.tipos.index'));
		}

		$this->tiposNovedadesRepository->delete($id);

		Flash::success('TiposNovedades deleted successfully.');

		return redirect(route('novedades.tipos.index'));
	}
}

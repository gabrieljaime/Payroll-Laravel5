<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Createconceptos_novedadesRequest;
use App\Http\Requests\Updateconceptos_novedadesRequest;
use App\Libraries\Repositories\conceptos_novedadesRepository;
use App\Models\ComboOption;
use App\Models\Concepto;
use App\Models\ConceptosNovedades;
use App\Models\TiposNovedades;
use Flash;
use Yajra\Datatables\Datatables;
use Gabo\Controller\AppBaseController as AppBaseController;
use Response;
use Image;

class conceptos_novedadesController extends AppBaseController
{

	/** @var  conceptos_novedadesRepository */
	private $conceptosNovedadesRepository;

	function __construct(conceptos_novedadesRepository $conceptosNovedadesRepo)
	{
		$this->conceptosNovedadesRepository = $conceptosNovedadesRepo;
	}

	/**
	 * Display a listing of the ConceptosNovedades.
	 *
	 * @return Response
	 */
	public function index()
	{
		$conceptosNovedades = $this->conceptosNovedadesRepository->paginate(10);
		$tiposnovedades = TiposNovedades::select(array('descripcion', 'id'))->lists('descripcion', 'id');
		$conceptosvariables = Concepto::where('esfijo', '!=', 'S')->selectRaw('CONCAT(codigo, "-", detalle) as concepto, id')->lists('concepto', 'id');

		return view('novedades.conceptos.index', compact('conceptosNovedades','tiposnovedades','conceptosvariables'));
	}

	/**
	 * Show the form for creating a new ConceptosNovedades.
	 *
	 * @return Response
	 */
	public function create()
	{
		

		return view('novedades.conceptos.create');
	}

	public function datatipos()
	{
		$tipos = TiposNovedades::select(array('descripcion', 'id'));

		return Datatables::of($tipos)
			->add_column('actions', '
            				<div class="btn-group">
            				<a target="_blank" class="btn btn-xs btn-primary"  data-categoria={{{ $descripcion }}}  data-categoria_id={{{ $id }}}
            				<i class="fa fa-pencil"></i>Ver Conceptos</a>
            				</div>
                        	')
			->remove_column('id')
			->make(true);


	}

	public function data($tipos)
    	{
			if ($tipos == 'TODOS')
			{
				$conceptosvariables = ConceptosNovedades::with('Concepto')->with('TipoNovedad')->get(array("id","concepto_id", "tiponovedad_id"));

			}
			else
			{
				$conceptosvariables = ConceptosNovedades::with('Concepto')->with('TipoNovedad')->DelTipo($tipos)->get(array("id","concepto_id", "tiponovedad_id"));

			}


    		return Datatables::of($conceptosvariables)
    						->add_column('actions', '
            				<div class="btn-group" align="center">
								<a class="btn btn-xs btn-primary" type="button" data-toggle="modal" data-target="#confirmEditConceptoNovedad"  data-title="Update Type" data-concepto_id="{{{$concepto["codigo"]}}}" data-concepto="{{{$concepto["detalle"]}}}" data-categoria_id="{{{ $tiponovedad_id }}}" data-categoria="{{{ $tipo_novedad["descripcion"] }}}" data-id="{{{ URL::to(\'novedades/conceptos/\' .$id   ) }}}">
									<i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
								<a class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDeletegr" data-id="{{{ URL::to(\'novedades/conceptos/\' . $id . \'/delete\' ) }}}" data-title="Delete Type" data-message="Are you sure to delete this Option ?">
									<i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
							</div>
                        	')
            				->make(true);
    	}

	/**
	 * Store a newly created ConceptosNovedades in storage.
	 *
	 * @param Createconceptos_novedadesRequest $request
	 *
	 * @return Response
	 */
	public function store(Createconceptos_novedadesRequest $request)
	{
		$input = $request->all();

		$conceptosNovedades = $this->conceptosNovedadesRepository->create($input);



		Flash::success('ConceptosNovedades saved successfully.');

		return redirect(route('novedades.conceptos.index'));
	}

	/**
	 * Display the specified ConceptosNovedades.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$conceptosNovedades = $this->conceptosNovedadesRepository->find($id);

		if(empty($conceptosNovedades))
		{
			Flash::error('ConceptosNovedades not found');

			return redirect(route('novedades.conceptos.index'));
		}

		return view('novedades.conceptos.show')->with('conceptosNovedades', $conceptosNovedades);
	}

	/**
	 * Show the form for editing the specified ConceptosNovedades.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$conceptosNovedades = $this->conceptosNovedadesRepository->find($id);

		

		if(empty($conceptosNovedades))
		{
			Flash::error('ConceptosNovedades not found');

			return redirect(route('novedades.conceptos.index'));
		}

		return view('novedades.conceptos.edit')->with('conceptosNovedades', $conceptosNovedades);
	}

	/**
	 * Update the specified ConceptosNovedades in storage.
	 *
	 * @param  int              $id
	 * @param Updateconceptos_novedadesRequest $request
	 *
	 * @return Response
	 */
	public function update($id, Updateconceptos_novedadesRequest $request)
	{
		$conceptosNovedades = $this->conceptosNovedadesRepository->find($id);


		if(empty($conceptosNovedades))
		{
			Flash::error('ConceptosNovedades not found');

			return redirect(route('novedades.conceptos.index'));
		}

		$this->conceptosNovedadesRepository->updateRich($request->all(), $id);

		Flash::success('ConceptosNovedades updated successfully.');

		return redirect(route('novedades.conceptos.index'));
	}

	/**
	 * Remove the specified ConceptosNovedades from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$conceptosNovedades = $this->conceptosNovedadesRepository->find($id);

		if(empty($conceptosNovedades))
		{
			Flash::error('ConceptosNovedades not found');

			return redirect(route('novedades.conceptos.index'));
		}

		$this->conceptosNovedadesRepository->delete($id);

		Flash::success('ConceptosNovedades deleted successfully.');

		return redirect(route('novedades.conceptos.index'));
	}
}

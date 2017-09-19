<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateInput_RelojRequest;
use App\Http\Requests\UpdateInput_RelojRequest;
use App\Jobs\ResumirReloj;
use App\Libraries\Repositories\Input_RelojRepository;
use App\Models\Input_Reloj;
use App\Models\ResumenReloj;
use App\Models\Employees;
use Carbon\Carbon;
use Flash;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Gabo\Controller\AppBaseController as AppBaseController;
use Response;
use Maatwebsite\Excel\Facades\Excel;
use Image;

class Input_RelojController extends AppBaseController
{

	/** @var  Input_RelojRepository */

	function __construct(Input_RelojRepository $inputRelojRepo)
	{
		$this->inputRelojRepository = $inputRelojRepo;
	}

	/**
	 * Display a listing of the Input_Reloj.
	 *
	 * @return Response
	 */
	public function index()
	{
		$today = Carbon::today();
		$año = $today->year;
		$mes = $today->month;
		$inputRelojs = $this->inputRelojRepository->paginate(10);

		return view('reloj.input.index', compact('inputRelojs', 'año', 'mes'));
	}
	public function detalle($mes,$año,$legajo)
	{
		$año = $año;
		$mes = $mes;
		$inputRelojs = $this->inputRelojRepository->paginate(10);
		$Legajos = Employees
			::Activos()->selectRaw('CONCAT(id, "-", nombre) as empleado, id')->lists('empleado', 'id')->prepend('', '');



		return view('reloj.input.detalle', compact('inputRelojs', 'año', 'mes', 'legajo','Legajos'));
	}
	/**
	 * Show the form for creating a new Input_Reloj.
	 *
	 * @return Response
	 */
	public function create()
	{


		return view('reloj.input.create');
	}

	/**
    	 * Generate the Data File for de DataTables of Input_Reloj.
    	 *
    	 * @return Datatable
    	 */
	public function datal($mes, $año,$legajo)
	{

		$resumen = Input_Reloj::DelPeriodo($mes, $año)->DelLegajo($legajo)->get(array('id','apynom','fecha','fichadas','fechadate','hpausa','hpausaexceso','vpausaexceso','vpausafuerahora','hnormales','htarde','vtarde','hanticipado','vanticipado','hausente','vausente','dtrabajados','hextras3','hextras4','hextras5','hferiado','hnocturnas','hnocnormales','hnocextras3','hnocextras4','hnocextras5','hnocferiado','observaciones','cpremio','legajo','hdescuento','hreales'));
			
		return Datatables::of($resumen)
			->edit_column('hpausa','{{{ round($hpausa/60,2)  }}}'	)
			->edit_column('hnormales','{{{ round($hnormales/60 ,2) }}}'	)
			->edit_column('htarde','{{{ round($htarde/60 ,2) }}}'	)
			->edit_column('hanticipado','{{{ round($hanticipado/60 ,2) }}}'	)
			->edit_column('hausente','{{{ round($hausente/60,2) }}}'	)
			->edit_column('hferiado','{{{ round($hferiado/60,2)  }}}'	)
			->edit_column('hdescuento','{{{round( $hdescuento/60,2)  }}}'	)
			->edit_column('hreales','{{{ round($hreales/60,2)  }}}'	)
			->add_column('actions', '
            				<div class="btn-group">
            				<a href="{{{ URL::to(\'reloj\resumen/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-xs btn-primary"><i class="fa fa-pencil"></i>Editar</a>
            				<a class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDeletegr"  data-id="{{{ URL::to(\'reloj\resumen/\' . $id . \'/delete\' ) }}}" data-title="Delete Input_Reloj" data-message="Are you sure to delete this Input_Reloj ?" >
                            <i class="fa fa-trash-o" aria-hidden="true"></i>Borrar</a>
            				</div>
                        	')
			->remove_column('id')
			->make(true);
	}
		public function data($mes, $año)
{


	$resumen = Input_Reloj::DelPeriodo($mes, $año)->get(array('id','apynom','fecha','fichadas','fechadate','hpausa','hpausaexceso','vpausaexceso','vpausafuerahora','hnormales','htarde','vtarde','hanticipado','vanticipado','hausente','vausente','dtrabajados','hextras3','hextras4','hextras5','hferiado','hnocturnas','hnocnormales','hnocextras3','hnocextras4','hnocextras5','hnocferiado','observaciones','cpremio','legajo','hdescuento','hreales'));

	return Datatables::of($resumen)
		->edit_column('hpausa','{{{ round($hpausa/60,2)  }}}'	)
		->edit_column('hnormales','{{{ round($hnormales/60 ,2) }}}'	)
		->edit_column('htarde','{{{ round($htarde/60 ,2) }}}'	)
		->edit_column('hanticipado','{{{ round($hanticipado/60 ,2) }}}'	)
		->edit_column('hausente','{{{ round($hausente/60,2) }}}'	)
		->edit_column('hferiado','{{{ round($hferiado/60,2)  }}}'	)
		->edit_column('hdescuento','{{{round( $hdescuento/60,2)  }}}'	)
		->edit_column('hreales','{{{ round($hreales/60,2)  }}}'	)
		->add_column('actions', '
            				<div class="btn-group">
            				<a href="{{{ URL::to(\'reloj\input/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-xs btn-primary"><i class="fa fa-pencil"></i>Editar</a>
            				<a class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDeletegr"  data-id="{{{ URL::to(\'reloj\resumen/\' . $id . \'/delete\' ) }}}" data-title="Delete Input_Reloj" data-message="Are you sure to delete this Input_Reloj ?" >
                            <i class="fa fa-trash-o" aria-hidden="true"></i>Borrar</a>
            				</div>
                        	')
		->remove_column('id')
		->make(true);
}

	/**
	 * Store a newly created Input_Reloj in storage.
	 *
	 * @param CreateInput_RelojRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateInput_RelojRequest $request)
	{
		$input = $request->all();

		//$año= $input['año'];
		$año=2016;
		//$mes= $input['mes'];
		$mes =5;
		//$nombre=$this->guardar_input( $request->file('archivo'));
		$nombre="1469750300-Horas Reloj Prueba.xls";
		//$nombre="1469750427-Horas Reloj Prueba.xls";


		$results= Excel::filter('chunk')->load(public_path().'\storage\reloj/'.$nombre)->chunk(250, function($reader) {
		//	$results= Excel::load(public_path().'\storage\reloj/'.$nombre, function($reader) {




			foreach($reader as $key => $value)
			{


				$registro = Input_Reloj::create([
					'idPersona'=>$value['idpersona'],
					'Apynom'=>$value['apynom'],
					'Agrupacion1'=>$value['agrupacion1'],
					'Agrupacion2'=>$value['agrupacion2'],
					'Agrupacion3'=>$value['agrupacion3'],
					'Categoria'=>$value['categoria'],
					'Fecha'=>$value['fecha'],
					'Fichadas'=>$value['fichadas'],
					'FechaDate'=> Carbon::create(1900,1,1)->addDays(-2)->addDays($value['fechadate'])->format('Y-m-d'),
					'hPausa'=>$value['hpausa'],
					'hPausaExceso'=>$value['hpausaexceso'],
					'vPausaExceso'=>$value['vpausaexceso'],
					'vPausaFueraHora'=>$value['vpausafuerahora'],
					'hNormales'=>$value['hnormales'],
					'hTarde'=>$value['htarde'],
					'vTarde'=>$value['vtarde'],
					'hAnticipado'=>$value['hanticipado'],
					'vAnticipado'=>$value['vanticipado'],
					'hAusente'=>$value['hausente'],
					'vAusente'=>$value['vausente'],
					'dTrabajados'=>$value['dtrabajados'],
					'hExtras3'=>$value['hextras3'],
					'hExtras4'=>$value['hextras4'],
					'hExtras5'=>$value['hextras5'],
					'hFeriado'=>$value['hferiado'],
					'hNocturnas'=>$value['hnocturnas'],
					'hNocNormales'=>$value['hnocnormales'],
					'hNocExtras3'=>$value['hnocextras3'],
					'hNocExtras4'=>$value['hnocextras4'],
					'hNocExtras5'=>$value['hnocextras5'],
					'hNocFeriado'=>$value['hnocferiado'],
					'Observaciones'=>$value['observaciones'],
					'cPremio'=>$value['cpremio'],
					'Legajo'=>$value['legajo'],
					'hDescuento'=>$value['hdescuento'],
					'hReales'=>$value['hreales']
				]);

			}

		});


		$this->dispatch(new ResumirReloj( $año, $mes));


		Flash::success('Input_Reloj saved successfully.');

		return redirect(route('reloj.input.index'));
	}


	public function guardar_input($archivo)
	{
		$archivo_name = time() . "-" . $archivo->getClientOriginalName();
		$archivo->move('storage/reloj', $archivo_name);

		return $archivo_name;
	}

	/**
	 * Display the specified Input_Reloj.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$inputReloj = $this->inputRelojRepository->find($id);

		if(empty($inputReloj))
		{
			Flash::error('Input_Reloj not found');

			return redirect(route('reloj.input.index'));
		}

		return view('reloj.input.show')->with('inputReloj', $inputReloj);
	}

	/**
	 * Show the form for editing the specified Input_Reloj.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{

		$inputReloj = $this->inputRelojRepository->find($id);


		

		if(empty($inputReloj))
		{
			Flash::error('Input_Reloj not found');

			return redirect(route('reloj.input.index'));
		}

		return view('reloj.input.edit')->with('inputReloj', $inputReloj);
	}

	/**
	 * Update the specified Input_Reloj in storage.
	 *
	 * @param  int              $id
	 * @param UpdateInput_RelojRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateInput_RelojRequest $request)
	{
		$inputReloj = $this->inputRelojRepository->find($id);


		if(empty($inputReloj))
		{
			Flash::error('Input_Reloj not found');

			return redirect(route('reloj.input.index'));
	}


		DB::transaction(function() use ($request, $inputReloj,  $id)
		{
			$this->inputRelojRepository->updateRich($request->all(), $id);

			$periodo=Carbon::createFromFormat('Y-m-d', $inputReloj->FechaDate);
			$mes=$periodo->month;
			$año=$periodo->year;

			$resumir =  new ResumenReloj();

			$resumir->ResumirRelojDe( $año,$mes, $inputReloj->Legajo);

		});

		Flash::success('Input_Reloj updated successfully.');

		return redirect(route('reloj.input.index'));
	}

	/**
	 * Remove the specified Input_Reloj from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$inputReloj = $this->inputRelojRepository->find($id);

		if(empty($inputReloj))
		{
			Flash::error('Input_Reloj not found');

			return redirect(route('reloj.input.index'));
		}

		$this->inputRelojRepository->delete($id);

		Flash::success('Input_Reloj deleted successfully.');

		return redirect(route('reloj.input.index'));
	}
}

<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateInput_RelojRequest;
use App\Http\Requests\UpdateInput_RelojRequest;
use App\Jobs\ResumirReloj;
use App\Libraries\Repositories\Input_RelojRepository;
use App\Models\Input_Reloj;
use App\Models\ResumenReloj;
use Carbon\Carbon;
use Flash;
use Yajra\Datatables\Datatables;
use Gabo\Controller\AppBaseController as AppBaseController;
use Response;
use Maatwebsite\Excel\Facades\Excel;
use Image;

class Resumen_RelojController extends AppBaseController
{

	/** @var  Input_RelojRepository */
	private $inputRelojRepository;

	function __construct()
	{

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
		$resumen = ResumenReloj::first();
		return view('reloj.resumen.index',compact('resumen', 'mes','año'));
	}

	/**
	 * Show the form for creating a new Input_Reloj.
	 *
	 * @return Response
	 */
	public function create()
	{


		return view('reloj.resumen.create');
	}

	/**
    	 * Generate the Data File for de DataTables of Input_Reloj.
    	 *
    	 * @return Datatable
    	 */
	public function data($mes,$año)
    	{




			$resumen = ResumenReloj::DelPeriodo($mes,$año)->get(array('id', 'legajo', 'dias_trabajados', 'dias_descuentos', 'horas_descuentos', 'horas_extras', 'feriados_trabajados','mes','año'));


			return Datatables::of($resumen)
				->add_column('nombre','{{{ App\Models\Employees::DelLegajo((string)$legajo)->first()->nombre}}}')
				->add_column('actions', '
            				<div class="btn-group">
            				<a href="{{{ URL::to(\'reloj\input\detalle/\'.$mes.\'/\'.$año.\'/\'.$legajo  ) }}}" class="iframe btn btn-xs btn-primary"><i class="fa fa-info-circle"></i> Detalle</a>
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

		return redirect(route('reloj.resumen.index'));
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

			return redirect(route('reloj.resumen.index'));
		}

		return view('reloj.resumen.show')->with('inputReloj', $inputReloj);
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

			return redirect(route('reloj.resumen.index'));
		}

		return view('reloj.resumen.edit')->with('inputReloj', $inputReloj);
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

			return redirect(route('reloj.resumen.index'));
		}

		$this->inputRelojRepository->updateRich($request->all(), $id);

		Flash::success('Input_Reloj updated successfully.');

		return redirect(route('reloj.resumen.index'));
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

			return redirect(route('reloj.resumen.index'));
		}

		$this->inputRelojRepository->delete($id);

		Flash::success('Input_Reloj deleted successfully.');

		return redirect(route('reloj.resumen.index'));
	}
}

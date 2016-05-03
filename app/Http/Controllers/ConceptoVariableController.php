<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\UpdateConceptoVariableRequest;
use App\Http\Requests\CreateConceptoVariableRequest;
use App\Libraries\Repositories\ConceptoVariableRepository;
use App\Models\ConceptoVariable;
use App\Models\Employees;
use Flash;
use Gabo\Controller\AppBaseController as AppBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class ConceptoVariableController extends AppBaseController {

    private $conceptovariableRepository;

    function __construct(ConceptoVariableRepository $conceptovariableRepo)
    {

        $this->conceptovariableRepository = $conceptovariableRepo;
    }

    public function data($mes, $anio, $legajos, $conceptos )
    {

        if ($legajos=='todos')
        {
            if ($conceptos=='todos')
            {
                $conceptosVariables = ConceptoVariable::with('Concepto')->with('Empleado')->DelPeriodo($mes, $anio)->get(array("id","concepto_id", "employees_id", "importe", "cantidad", "mes", "anio"));
            }
            else
            {
                $conceptosVariables = ConceptoVariable::with('Concepto')->with('Empleado')->DelPeriodo($mes, $anio)->DelConcepto($conceptos)->get(array("id","concepto_id", "employees_id", "importe", "cantidad", "mes", "anio"));
            }

        }
        else
        {
            if ($conceptos=='todos')
            {
                $conceptosVariables = ConceptoVariable::with('Concepto')->with('Empleado')->DelPeriodo($mes, $anio)->DelLegajo($legajos)->get(array("id","concepto_id", "employees_id", "importe", "cantidad", "mes", "anio"));
            }
            else
            {
                $conceptosVariables = ConceptoVariable::with('Concepto')->with('Empleado')->DelPeriodo($mes, $anio)->DelLegajo($legajos)->DelConcepto($conceptos)->get(array("id","concepto_id", "employees_id", "importe", "cantidad", "mes", "anio"));
            }
        }
        //return $conceptos = Concepto::with('EsVariableDe')->where('esfijo', '!=', 'S')
        //    ->where('anio',$year)->get();


        return Datatables::of($conceptosVariables)
            ->add_column('actions', '
            				<div class="btn-group" align="center">
                                 <a class="btn btn-primary btn-xs" type="button" data-toggle="modal"
                                   id="btnUpdateVariable" data-target="#confirmUpdateConceptoVariable"
                                   data-mes="{{$mes}}" data-anio="{{$anio}}" data-concepto_id="{{$concepto_id}}"
                                  data-employees_id="{{$employees_id}}"  data-importe="{{$importe}}" data-cantidad="{{$cantidad}}"
                                   data-id="{{{ URL::to(\'conceptovariable/\' . $id   ) }}}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>Editar
                                </a>
                            <a class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDeletegr"  data-id="{{{ URL::to(\'conceptovariable/\' .$id . \'/delete\' ) }}}" data-title="Delete Type" data-message="Are you sure to delete this Option ?" >
                            <i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                            </div>
                        	')
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( )
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * @param CreateConceptoVariableRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateConceptoVariableRequest $request)
    {


        $input = $request->all();

        $empleados= $request->input('employees_id');
        if ($empleados=='TODOS')
        {
            $empleados == Employees::Activos()->lists('id');
        }
        DB::transaction(function ()use ($empleados, $input)
        {
            foreach ($empleados as $empleado)
            {

                $input = array_set($input, 'employees_id', $empleado);
                $concetovariable = $this->conceptovariableRepository->create($input);

            }
        });



        Flash::message('Concepto asociado correctamente','success', 0, 'Asociación Exitosa');

        return redirect(route('conceptos.asignacion.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateConceptoVariableRequest $request)
    {
        $conceptovariable = $this->conceptovariableRepository->find($id);

        $input = $request->all();

        if (empty($conceptovariable))
        {
            Flash::error('No se encontro el Concepto Fijo');

            return redirect(route('conceptos.asignacion.index'));
        }

        $this->conceptovariableRepository->updateRich($input, $id);

        Flash::message('Concepto modificado correctamente','success', 0, 'Modificación Exitosa');

        return redirect(route('conceptos.asignacion.index'));


    }


    public function destroy($id)
    {
        $convariable = $this->conceptovariableRepository->find($id);

        if (empty($convariable))
        {
            Flash::error('Category not found');

            return redirect(route('conceptos.asignacion.index'));
        }

        $this->conceptovariableRepository->delete($id);


        Flash::message('Relación eliminada correctamente','success', 0, 'Eliminación Exitosa');

        return redirect(route('conceptos.asignacion.index'));
    }
}

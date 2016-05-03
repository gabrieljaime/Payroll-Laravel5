<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\ConceptoCategory;
use App\Models\ConceptoFijo;
use App\Models\Concepto;
use App\Models\Employees;
use App\Http\Requests\UpdateConceptoFijoRequest;
use App\Http\Requests\CreateConceptoFijoRequest;
use App\Libraries\Repositories\ConceptoFijoRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class ConceptoFijoController extends Controller {

    private $conceptofijoRepository;

    function __construct(ConceptoFijoRepository $conceptofijoRepo)
    {
        $this->conceptofijoRepository = $conceptofijoRepo;
    }
    public function data($legajos, $conceptos)
    {
        if ($legajos=='todos')
        {
           if ($conceptos=='todos')
           {
              $conceptosfijos = ConceptoFijo::with('Concepto')->with('Empleado')->get(array("id","concepto_id", "employees_id", "importe", "cantidad"));
           }
            else
            {
                $conceptosfijos = ConceptoFijo::with('Concepto')->with('Empleado')->DelConcepto($conceptos)->get(array("id","concepto_id", "employees_id", "importe", "cantidad"));
            }
        }
        else
        {

            if ($conceptos=='todos')
            {
                $conceptosfijos =ConceptoFijo::with('Concepto')->with('Empleado')->DelLegajo($legajos)->get(array("id","concepto_id","employees_id","importe","cantidad"));
            }
            else
            {
                $conceptosfijos = ConceptoFijo::with('Concepto')->with('Empleado')->DelLegajo($legajos)->DelConcepto($conceptos)->get(array("id","concepto_id", "employees_id", "importe", "cantidad"));
            }


        }


        return Datatables::of($conceptosfijos)
            ->add_column('actions', '
               <div class="btn-group" align="center">
                    <a class="btn btn-xs btn-primary" type="button" data-toggle="modal" data-target="#confirmEditConceptoFijo"
                       data-title="Update Type" data-concepto_id="{{{$concepto["codigo"]}}}" data-concepto="{{{$concepto["detalle"]}}}"
                       data-employees_id="{{{ $employees_id }}}" data-nombre="{{{ \App\Models\Employees::find($employees_id)->nombre }}}"
                       data-importe="{{{ $importe }}}" data-cantidad="{{{$cantidad}}}"
                       data-id="{{{ URL::to(\'conceptofijo/\' . $concepto_id . \'/\' . $employees_id   ) }}}">
                        <i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                    <a class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDeletegr"
                       data-id="{{{ URL::to(\'conceptofijo/\' . $id . \'/delete\' ) }}}" data-title="Delete Type"
                       data-message="Are you sure to delete this Option ?">
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateConceptoFijoRequest $request)
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

                $concetofijo = $this->conceptofijoRepository->create($input);

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
     * @param UpdateConceptoFijoRequest $request
     * @param $concepto
     * @param $legajo
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update( $concepto, $legajo,UpdateConceptoFijoRequest $request)
    {


        $conceptofijo = ConceptoFijo::with('Concepto')->DelLegajo($legajo)->DelConcepto($concepto)->first();

        $input = $request->all();

        if (empty($conceptofijo))
        {
            Flash::error('No se encontro el Concepto Fijo');

            return redirect(route('conceptos.asignacion.index'));
        }

        $input = ['importe'=>$input['importe'],  'cantidad'=>$input['cantidad']];

        $this->conceptofijoRepository->updateFijo($input, $concepto,$legajo);

        Flash::message('Relación modificada correctamente','success', 0, 'Modificación Exitosa');
        return redirect(route('conceptos.asignacion.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $confijo = $this->conceptofijoRepository->find($id);

        if (empty($confijo))
        {
            Flash::error('Category not found');

            return redirect(route('conceptos.asignacion.index'));
        }

        $this->conceptofijoRepository->delete($id);


        Flash::message('Relación eliminada correctamente','success', 0, 'Eliminación Exitosa');

        return redirect(route('conceptos.asignacion.index'));
    }


}

<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateConceptoenReciboRequest;
use App\Http\Requests\UpdateConceptoenReciboRequest;
use App\Libraries\Repositories\ConceptoenReciboRepository;
use App\Models\ConceptosenRecibos;
use Flash;
use Gabo\Controller\AppBaseController as AppBaseController;
use Image;
use Response;
use Yajra\Datatables\Datatables;

class ConceptoenReciboController extends AppBaseController {

    /** @var  ConceptoRepository */
    private $conceptoenreciboRepository;

    function __construct(ConceptoenReciboRepository $conceptoenreciboRepository)
    {
        $this->conceptoenreciboRepository = $conceptoenreciboRepository;
    }

    /**
     * Display a listing of the Concepto.
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new Concepto.
     *
     * @return Response
     */
    public function create()
    {


    }



    /**
     * Store a newly created Concepto in storage.
     *
     * @param CreateConceptoRequest $request
     *
     * @return Response
     */
    public function store(CreateConceptoenReciboRequest $request)
    {
        $input = $request->all();

        $concepto = $this->conceptoenreciboRepository->create($input);


        Flash::success('Concepto saved successfully.');

        return redirect(route('conceptos.index'));
    }

    /**
     * Display the specified Concepto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $concepto = $this->conceptoenreciboRepository->find($id);

        if (empty($concepto))
        {
            Flash::error('Concepto not found');

            return redirect(route('conceptos.index'));
        }

        return view('conceptos.show')->with('concepto', $concepto);
    }

    /**
     * Show the form for editing the specified Concepto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $concepto = $this->conceptoenreciboRepository->find($id);


        if (empty($concepto))
        {
            Flash::error('Concepto not found');

            return redirect(route('conceptos.index'));
        }

        return view('conceptos.edit')->with('concepto', $concepto);
    }

    /**
     * Update the specified Concepto in storage.
     *
     * @param  int $id
     * @param UpdateConceptoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConceptoenReciboRequest $request)
    {
        $concepto = $this->conceptoenreciboRepository->find($id);


        if (empty($concepto))
        {
            Flash::error('Concepto not found');

            return redirect(route('conceptos.index'));
        }

        $this->conceptoenreciboRepository->updateRich($request->all(), $id);

        Flash::success('Concepto updated successfully.');

        return redirect(route('conceptos.index'));
    }

    /**
     * Remove the specified Concepto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $concepto = $this->conceptoenreciboRepository->find($id);

        if (empty($concepto))
        {
            Flash::error('Concepto not found');

            return redirect(route('conceptos.index'));
        }

        $this->conceptoenreciboRepository->delete($id);

        Flash::success('Concepto deleted successfully.');

        return redirect(route('conceptos.index'));
    }
}

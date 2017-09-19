<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateConceptoCategoryRequest;
use App\Http\Requests\UpdateConceptoCategoryRequest;
use App\Libraries\Repositories\ConceptoCategoryRepository;
use App\Models\Category;
use App\Models\Concepto;
use App\Models\ConceptoCategory;
use Flash;
use Gabo\Controller\AppBaseController as AppBaseController;
use Image;
use Response;
use Yajra\Datatables\Datatables;

class ConceptoCategoryController extends AppBaseController {

    /** @var  CategoryRepository */
    private $conceptocategoryRepository;

    function __construct(ConceptoCategoryRepository $categoryRepo)
    {
        $this->conceptocategoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Category.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->conceptocategoryRepository->paginate(10);
                                     // int(2012)
        $conceptosfijos = Concepto::where('esfijo', 'S')->lists('detalle','id');


        return view('conceptos.categorias.index', compact('categories', 'conceptosfijos'));

    }

    /**
     * Show the form for creating a new Category.
     *
     * @return Response
     */
    public function create()
    {


        return view('conceptos.categorias.create');
    }

    /**
     * Generate the Data File for de DataTables of Category.
     *
     * @return Datatable
     */
    public function data()
    {
        $categories = Category::select(array('categories.Category', 'categories.id'));

        return Datatables::of($categories)
            ->add_column('actions', '
            				<div class="btn-group">
            				<a target="_blank" class="btn btn-xs btn-primary"  data-categoria={{{ $Category }}}  data-categoria_id={{{ $id }}}
            				<i class="fa fa-pencil"></i>Ver Conceptos</a>
            				</div>
                        	')
            ->remove_column('id')
            ->make(true);


    }
    public function dataFijo($categoria)
    {
        if ($categoria == 'todos')
        {
            $conceptosfijos = ConceptoCategory::with('Concepto')->with('Categoria')->get(array("id","concepto_id", "categoria_id", "cantidad","importe"));

        }
        else
        {
           $conceptosfijos = ConceptoCategory::with('Concepto')->with('Categoria')->DelaCategoria($categoria)->get(array("id","concepto_id", "categoria_id", "cantidad","importe"));

        }



        //var action= $(e.relatedTarget).attr('data-id');
        //var concepto_id = $(e.relatedTarget).attr('data-concepto_id');
        //var concepto = $(e.relatedTarget).attr('data-concepto');
        //var employee_id = $(e.relatedTarget).attr('data-employee_id');
        //var nombre = $(e.relatedTarget).attr('data-nombre');
        //var importe =$(e.relatedTarget).attr('data-importe');
//        //var cantidad =$(e.relatedTarget).attr('data-cantidad');
        //        "concepto.codigo"},
        //{"targets": [2], "data": "concepto.detalle"

        return Datatables::of($conceptosfijos)
            ->add_column('actions', '
               <div class="btn-group" align="center">
                    <a class="btn btn-xs btn-primary" type="button" data-toggle="modal" data-target="#confirmEditConceptoFijo" data-title="Update Type" data-concepto_id="{{{$concepto["codigo"]}}}" data-concepto="{{{$concepto["detalle"]}}}" data-categoria_id="{{{ $categoria_id }}}" data-categoria="{{{ $categoria["category"] }}}" data-importe="{{{ $importe }}}" data-cantidad="{{{ $cantidad }}}" data-id="{{{ URL::to(\'conceptos/categorias/\' .$id   ) }}}">
                        <i class="fa fa-pencil" aria-hidden="true"></i>Editar</a>
                    <a class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDeletegr" data-id="{{{ URL::to(\'conceptos/categories/\' . $id . \'/delete\' ) }}}" data-title="Desasociar Concepto" data-message="Esta seguro de des-asociar este concepto?">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>Desasociar</a>
                </div>
                        	')
            ->make(true);
    }


    /**
     * @param CreateConceptoCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
        public function store(CreateConceptoCategoryRequest $request)
    {
        $input = $request->all();
        $category = $this->conceptocategoryRepository->create($input);

        Flash::message('Concepto asociado correctamente','success', 0, 'Asociación Exitosa');

        return redirect(route('conceptos.categorias.index'));
    }

    /**
     * Display the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $category = $this->conceptocategoryRepository->find($id);

        if (empty($category))
        {
            Flash::error('Category not found');

            return redirect(route('conceptos.categorias.index'));
        }

        return view('conceptos.categorias.show')->with('category', $category);
    }


    /**
     * Show the form for editing the specified Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->conceptocategoryRepository->find($id);


        if (empty($category))
        {
            Flash::error('Category not found');

            return redirect(route('conceptos.categorias.index'));
        }

        return view('conceptos.categorias.edit')->with('category', $category);
    }

    /**
     * Update the specified Category in storage.
     *
     * @param  int $id
     * @param UpdateCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConceptoCategoryRequest $request)
    {
        $category = $this->conceptocategoryRepository->find($id);


        if (empty($category))
        {
            Flash::error('Category not found');

            return redirect(route('conceptos.categorias.index'));
        }

        $this->conceptocategoryRepository->updateRich($request->all(), $id);

        Flash::message('Concepto modificado correctamente','success', 0, 'Modificacion Exitosa');

        return redirect(route('conceptos.categorias.index'));
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $category = $this->conceptocategoryRepository->find($id);

        if (empty($category))
        {
            Flash::error('Category not found');

            return redirect(route('conceptos.categorias.index'));
        }

        $this->conceptocategoryRepository->delete($id);

        Flash::success('Concepto desasociado correctamente.');

        return redirect(route('conceptos.categorias.index'));
    }
}

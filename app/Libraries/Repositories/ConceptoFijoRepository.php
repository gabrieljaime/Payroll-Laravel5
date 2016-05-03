<?php namespace App\Libraries\Repositories;

use App\Models\ConceptoFijo;
use Bosnadev\Repositories\Eloquent\Repository;
use Schema;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ConceptoFijoRepository extends Repository {

    /**
     * Configure the Model
     *
     **/
    public function model()
    {
        return 'App\Models\ConceptoFijo';
    }

    public function search($input)
    {
        $query = ConceptoFijo::query();

        $columns = Schema::getColumnListing('conceptos');
        $attributes = array();

        foreach ($columns as $attribute)
        {
            if (isset($input[$attribute]) and !empty($input[$attribute]))
            {
                $query->where($attribute, $input[$attribute]);
                $attributes[$attribute] = $input[$attribute];
            } else
            {
                $attributes[$attribute] = null;
            }
        }

        return [$query->get(), $attributes];
    }

    public function apiFindOrFail($id)
    {
        $model = $this->find($id);

        if (empty($model))
        {
            throw new HttpException(1001, "Concepto Fijo not found");
        }

        return $model;
    }

    public function apiDeleteOrFail($id)
    {
        $model = $this->find($id);

        if (empty($model))
        {
            throw new HttpException(1001, "Concepto Fijo not found");
        }

        return $model->delete();
    }
    public function updateFijo(array $data, $concepto, $legajo) {
        return $this->model->where('concepto_id', '=', $concepto)->where('employees_id', '=', $legajo)->update($data);
    }

}

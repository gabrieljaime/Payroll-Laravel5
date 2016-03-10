<?php namespace App\Libraries\Repositories;

use App\Models\employees;
use Bosnadev\Repositories\Eloquent\Repository;
use Schema;
use Symfony\Component\HttpKernel\Exception\HttpException;

class employeesRepository extends Repository {

    /**
     * Configure the Model
     *
     **/
    public function model()
    {
        return 'App\Models\Employees';
    }

    public function search($input)
    {
        $query = employees::query();

        $columns = Schema::getColumnListing('employees');
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
            throw new HttpException(1001, "Employees not found");
        }

        return $model;
    }

    public function apiDeleteOrFail($id)
    {
        $model = $this->find($id);

        if (empty($model))
        {
            throw new HttpException(1001, "Employees not found");
        }

        return $model->delete();
    }
}

<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
	/**
	* @var Application
	*/
    protected $app;

	/**
	* @var Model
	*/
    protected $model;

    function __construct(Application $app)
    {
    	$this->app = $app;
    	$this->makeModel();
    }

	/**
	* @return Model
	* @throws RepositoryException
	*/
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            dd('mal');
        }

        return $this->model = $model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    abstract public function model();

    public function update($inputs, $model)
    {
        return $model->update($inputs) ? $model : false;
    }

    public function all()
    {
        return $this->model::all();
    }

    public function pluck($key, $value)
    {
        return $this->model::pluck($key, $value);
    }

    public function create($inputs)
    {
        return $this->model::create($inputs);
    }

    public function withRelations($value)
    {
        return $this->model::with(
            is_string($value) ? func_get_args() : $value
        );
    }

    public function paginate($value)
    {
        return $this->model::paginate($value);
    }

    public function get()
    {
        return $this->model::get();
    }

    public function where($field, $operator, $value)
    {
        return $this->model::where($field, $operator, $value);
    }

    public function whereIn($field, $value)
    {
        return $this->model::whereIn($field, $value);
    }

    public function whereNotIn($field, $value)
    {
        return $this->model::whereNotIn($field, $value);
    }

    public function orderBy($field, $order)
    {
        return $this->model::orderBy($field, $order);
    }

    public function count()
    {
        return $this->model::count();
    }
}
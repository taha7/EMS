<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\AppRepoContract;
use Exception;
use ReflectionClass;

abstract class EloquentRepoAbstract implements AppRepoContract
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    public function resolveModel()
    {
        if (!method_exists($this, 'model')) {
            $classNamespace = (new ReflectionClass($this))->getNamespaceName();
            throw new Exception("No model defined for repository {$classNamespace}");
        }

        return app()->make($this->model());
    }

    protected abstract function model();
}

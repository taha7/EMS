<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\AppRepoContract;
use App\Repositories\Eloquent\Appends\AppendsContract;

abstract class EloquentRepoAbstract implements AppRepoContract
{
    protected $model, $request;

    public function __construct()
    {
        $this->model = $this->resolveModel();
        $this->request = request();
    }

    /**
     * Will use same naming convention of model
     */
    public function __call($name, $arguments)
    {
        // TODO: Should take approval for that
        return call_user_func(array($this->model, $name), ...$arguments);
    }

    public function resolveModel()
    {
        return app()->make($this->model());
    }

    /**
     * add appends to query
     *
     * @param AppendsContract[] $appends
     * @return void
     */
    public function appends(array $appends = [])
    {
        foreach ($appends as $index => $append) {
            $this->model = $append->apply($this->model);
        }

        return $this;
    }

    /**
     * Specifying which model will be the base for the repo
     * @return void
     */
    protected abstract function model(): string;
}

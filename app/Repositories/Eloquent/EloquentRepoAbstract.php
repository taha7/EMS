<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\AppRepoContract;
use App\Repositories\Eloquent\Appends\AppendsContract;

abstract class EloquentRepoAbstract implements AppRepoContract
{
    protected $model, $request, $allowFilters, $filters;

    const SELECT_FROM_BASIC_QUERY = true;

    public function __construct()
    {
        $this->model = $this->resolveModel();
        $this->request = request();
        $this->allowFilters = false;
        $this->filters = [];
    }

    /**
     * Will use methods from model direct
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
     * Select from the initial query appends or
     * update with the given append
     *
     * @param array<string,bool|AppendsContract> $selections
     * @return AppendsContract[]
     */
    public function appendsSelections($selections)
    {
        $selectedAppends = [];
        $initialAppends = $this->basicQueryAppends();

        foreach ($selections as $selectionName => $selectedAppend) {
            if ($selectedAppend === self::SELECT_FROM_BASIC_QUERY) {
                // You will select the basic and initial append
                $selectedAppends[] = $initialAppends[$selectionName];
            } else {
                // Then the user of this method specified another append
                $selectedAppends[] = $selectedAppend;
            }
        }

        return $selectedAppends;
    }

    /**
     * add appends to query
     *
     * @param AppendsContract[] $appends
     * @return this
     */
    public function appends(array $appends = [])
    {
        foreach ($appends as $index => $append) {
            $this->model = $append->apply($this->model);
        }

        return $this;
    }

    public function appendFilters()
    {
        $filtersAppends = $this->filtersAppends();
        foreach ($this->filters as $filter) {
            if (request()->has($filter) && array_key_exists($filter, $filtersAppends)) {
                $filtersAppends[$filter](request()->get($filter));
            }
        }
    }

    public function allowFilters()
    {
        $this->allowFilters = true;
    }

    public function filterWith(array $filters)
    {
        $this->filters = $filters;
    }

    /**
     * Specifying which model will be the base for the repo
     * @return void
     */
    protected abstract function model(): string;

    public abstract function basicQueryAppends();

    protected function filtersAppends() {
        return [];
    }
}

<?php

namespace App\Livewire\Admin\Common;

use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Table extends Component
{
    use WithPagination;

    public string $model;
    public array $columns = [];
    public array $with = [];
    public array $filters = [];

    public array $relationFilters = [];
    public string $search = '', $searchField = 'name';

    public string $orderBy = 'created_at';
    public string $title = 'Table';
    public string $detailsRouteName;


    public string $listener;

    public bool $allowSearch = true;


    public function getListeners()
    {
        return [
            'set-filters' => 'setFilters',
            'set-relation-filters' => 'setRelationFilters',
        ];
    }

    public function setFilters(?array $data)
    {

        $this->filters = $data;
        $this->resetPage();
    }

    public function setRelationFilters(?array $data)
    {

        $this->relationFilters = $data;


        $this->resetPage();
    }

    public function getRowsProperty()
    {

        $query = ($this->model)::query();

        if ($this->with) {
            $query->with($this->with);
        }


        foreach ($this->filters as $field => $value) {
            if (filled($value)) {

                $query->where($field, '=', $value);
            }
        }

        foreach ($this->relationFilters as $relation => $withFilter) {
            if (filled($withFilter['value'])) {

                $query->whereHas($relation, function (Builder $query) use ($withFilter) {
                    $query->where($withFilter['field'], 'like',  '%' . $withFilter['value'] . '%');
                });
            }
        }

        $query->orderByDesc($this->orderBy);

        if ($this->search) {
            $query->where($this->searchField, 'like', '%' . $this->search . '%');
        }

        return $query->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.common.table', [
            'rows' => $this->rows,
            'columns' => $this->columns,
            'title' => $this->title,
        ]);
    }
}

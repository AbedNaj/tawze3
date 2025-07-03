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
    // Only supports simple search on the 'name' column within the same table.
    // Advanced search with relationships requires custom implementation.
    public bool $allowSearch = true;


    public function getListeners()
    {
        return [
            $this->listener => '$refresh',
        ];
    }
    public function getRowsProperty()
    {

        $query = ($this->model)::query();

        if ($this->with) {
            $query->with($this->with);
        }



        foreach ($this->filters as $filter) {
            if (!empty($filter['value'])) {
                $query->where($filter['field'], $filter['operator'], $filter['value']);
            }
        }

        foreach ($this->relationFilters as $relation => $withFilter) {
            if (!empty($withFilter['value'])) {
                $query->whereHas($relation, function (Builder $query) use ($withFilter) {
                    $query->where($withFilter['field'], $withFilter['operator'], $withFilter['value']);
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

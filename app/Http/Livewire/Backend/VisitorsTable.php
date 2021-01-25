<?php

namespace App\Http\Livewire\Backend;

use App\Models\Visitor;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Http\Request;

/**
 * Class VisitorsTable.
 */
class VisitorsTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'time_in';
    public $sortDirection = 'desc';

    /**
     * @var string
     */
    public $samevisitor;
    public $filter;

    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table table-striped',
    ];

    /**
     * @param  string  $status
     */
    public function mount(Request $request): void
    {
        $this->filter = request()->query('filter');
        $this->samevisitor = request()->query('samevisitor');
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = Visitor::with('unit');
        if ($this->samevisitor) {
          $visitor_info = Visitor::where('id', $this->samevisitor)->first();
          if ($visitor_info) {
            $query = $query->where('contact',$visitor_info->contact)->where('nric',$visitor_info->nric);
          }
        }else if($this->filter == 'pending_checkout') {
          $query = $query->whereNull('time_out');
        }
        return $query;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('IN'), 'time_in')->searchable()->sortable(),
            Column::make(__('OUT'), 'time_out')->searchable()->sortable()->format(function (Visitor $model) {
                if ($model->time_out) {
                  return $model->time_out;
                }else{
                  return '-';
                }
            }),
            Column::make(__('Name'), 'name')->searchable()->sortable(),
            Column::make(__('NRIC'), 'nric')->searchable(),
            Column::make(__('Contact'), 'contact')->searchable()->sortable(),
            Column::make(__('Block'), 'unit.unit_block')->searchable()->sortable(),
            Column::make(__('Unit'), 'unit.unit_number')->searchable()->sortable(),
            Column::make(__('Actions'))
                ->format(function (Visitor $model) {
                    return view('backend.visitor.includes.actions', ['unit' => $model]);
            }),
        ];
    }
}

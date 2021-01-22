<?php

namespace App\Http\Livewire\Backend;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Http\Request;

class UnitsTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'unit_block';

    /**
     * @var string
     */

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
      
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = Unit::query();

        return $query;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Block'), 'unit_block')->searchable()->sortable(),
            Column::make(__('Unit'), 'unit_number')->searchable()->sortable(),
            Column::make(__('Type'), 'is_residential')->sortable()->format(function (Unit $model) {
                if ($model->is_residential === 1) {
                  return __('Residential');
                }else{
                  return __('Non-residential');
                }
            }),
            Column::make(__('Occupant'), 'occupant_name')->searchable()->sortable()->format(function (Unit $model) {
                if ($model->occupant_name) {
                  return $model->occupant_name;
                }else{
                  return '-';
                }
            }),
            Column::make(__('Contact'), 'occupant_contact')->searchable(),
            Column::make(__('Actions'))
                ->format(function (Unit $model) {
                    return view('backend.unit.includes.actions', ['unit' => $model]);
            }),
        ];
    }
}

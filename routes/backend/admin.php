<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UnitController;
use App\Http\Controllers\Backend\VisitorController;
use Tabuna\Breadcrumbs\Trail;
use App\Models\Unit;
use App\Models\Visitor;
// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });
    
Route::group([
  'prefix' => 'unit',
  'as' => 'unit.'
], function(){
  Route::get('/', [UnitController::class, 'index'])
  ->name('index')
  ->breadcrumbs(function (Trail $trail) {
      $trail->parent('admin.dashboard')
          ->push(__('Unit List'), route('admin.unit.index'));
  });
  
  Route::get('create', [UnitController::class, 'create'])
      ->name('create')
      ->breadcrumbs(function (Trail $trail) {
          $trail->parent('admin.unit.index')
              ->push(__('Create Unit'), route('admin.unit.create'));
      });

  Route::post('/', [UnitController::class, 'store'])->name('store');
  
  Route::group(['prefix' => '{unit}'], function () {
      Route::get('edit', [UnitController::class, 'edit'])
          ->name('edit')
          ->breadcrumbs(function (Trail $trail, Unit $unit) {
              $trail->parent('admin.unit.index')
                  ->push(__('Unit ID :unit', ['unit' => $unit->id]), route('admin.unit.edit', $unit));
          });

      Route::patch('/', [UnitController::class, 'update'])->name('update');
      Route::delete('/', [UnitController::class, 'destroy'])->name('destroy');
  });
});

Route::group([
  'prefix' => 'visitor',
  'as' => 'visitor.'
], function(){
  Route::get('/', [VisitorController::class, 'index'])
  ->name('index')
  ->breadcrumbs(function (Trail $trail) {
      $trail->parent('admin.dashboard')
          ->push(__('Visitor List'), route('admin.visitor.index'));
  });

  Route::get('create', [VisitorController::class, 'create'])
      ->name('create')
      ->breadcrumbs(function (Trail $trail) {
          $trail->parent('admin.visitor.index')
              ->push(__('Log New Visit'), route('admin.visitor.create'));
      });

  Route::post('/', [VisitorController::class, 'store'])->name('store');
  
  Route::group(['prefix' => '{visitor}'], function () {
      Route::get('edit', [VisitorController::class, 'edit'])
          ->name('edit')
          ->breadcrumbs(function (Trail $trail, Visitor $visitor) {
              $trail->parent('admin.visitor.index')
                  ->push(__('Unit ID :visitor', ['unit' => $visitor->id]), route('admin.visitor.edit', $visitor));
          });

      Route::patch('/', [VisitorController::class, 'update'])->name('update');
      Route::delete('/', [VisitorController::class, 'destroy'])->name('destroy');
  });
});

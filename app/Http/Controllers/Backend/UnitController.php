<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Unit;

/**
 * Class DashboardController.
 */
class UnitController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.unit.index');
    }
    
    public function create()
    {
        return view('backend.unit.create');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'unit_block' => 'required',
            'unit_number' => 'required',
            'occupant_name' => 'nullable',
            'occupant_contact' => 'nullable|numeric',
        ]);
        
        if ($validator->fails()) {
          return redirect()->back()->withInput()->withFlashDanger($validator->errors()->first());
        }
        
        $duplicateUnit = Unit::where('unit_block',$request->unit_block)->where('unit_number',$request->unit_number)->first();
        if ($duplicateUnit) {
          return redirect()->back()->withInput()->withFlashDanger('Duplicated unit number');
        }
        
        $is_residential = $request->is_residential? 1: 0;

        $unit = new Unit();
        $unit->unit_block = $request->unit_block;
        $unit->unit_number = $request->unit_number;
        $unit->is_residential = $is_residential;
        $unit->occupant_name = $is_residential? $request->occupant_name: NULL;
        $unit->occupant_contact = $is_residential? $request->occupant_contact: NULL;
        $unit->save();
        
        return redirect()->route('admin.unit.index')->withFlashSuccess(__('The unit was successfully created.'));
    }
    
    public function edit(Request $request, Unit $unit)
    {
        return view('backend.unit.edit')->with(compact('unit'));
    }
    
    public function update(Request $request, Unit $unit)
    {
        
        $validator = Validator::make($request->all(), [
            'unit_block' => 'required',
            'unit_number' => 'required',
            'occupant_name' => 'nullable',
            'occupant_contact' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
          return redirect()->back()->withInput()->withFlashDanger($validator->errors()->first());
        }
        
        $duplicateUnit = Unit::where('id','<>',$unit->id)->where('unit_block',$request->unit_block)->where('unit_number',$request->unit_number)->first();
        if ($duplicateUnit) {
          return redirect()->back()->withInput()->withFlashDanger('Duplicated unit number');
        }

        $is_residential = $request->is_residential? 1: 0;
        
        $unit->unit_block = $request->unit_block;
        $unit->unit_number = $request->unit_number;
        $unit->is_residential = $is_residential;
        $unit->occupant_name = $is_residential? $request->occupant_name: NULL;
        $unit->occupant_contact = $is_residential? $request->occupant_contact: NULL;
        $unit->save();
        
        return redirect()->route('admin.unit.index')->withFlashSuccess(__('Successfully updated.'));
    }
    
    public function destroy(Request $request, Unit $unit)
    {
        $unit->delete();
        return redirect()->route('admin.unit.index')->withFlashSuccess(__('The unit was successfully deleted.'));
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Unit;
use App\Models\Visitor;
use App\Http\Controllers\VisitorHelper;

/**
 * Class DashboardController.
 */
class VisitorController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    
    public function index()
    {
        return view('backend.visitor.index');
    }
    
    public function create()
    {
        return view('backend.visitor.create');
    }
    
    public function edit(Request $request, Visitor $visitor)
    {
        $visit = Visitor::where('contact',$visitor->contact)->where('nric',$visitor->nric)->where('id','<>', $visitor->id)->get();
        $visitcount = $visit->count();
        return view('backend.visitor.edit')->with(compact('visitor','visitcount'));
    }
    
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'pass_id' => 'nullable',
            'name' => 'required',
            'nric' => 'required|string|size:3',
            'contact' => 'required|string|size:8',
            'unit_block' => 'required',
            'unit_number' => 'required',
            'time_in' => 'required|date_format:Y-m-d H:i:s',
            'time_out' => 'nullable|date_format:Y-m-d H:i:s'
        ]);
        
        if ($validator->fails()) {
          return redirect()->back()->withInput()->withFlashDanger($validator->errors()->first());
        }
        
        $unit = Unit::where('unit_block',$request->unit_block)->where('unit_number',$request->unit_number)->first();
        if (!$unit) {
          return redirect()->back()->withInput()->withFlashDanger('Unit not found!');
        } else if (!$unit->occupant_name && $unit->is_residential) {
          return redirect()->back()->withInput()->withFlashDanger('The Residential Unit is vacant!');
        }
        
        if ($request->time_out && $request->time_in > $request->time_out) {
          return redirect()->back()->withInput()->withFlashDanger('Invalid Time In/Out');
        }

        $helper = new VisitorHelper;
        if ($helper->duplicateEntry($request->pass_id, $request->contact, $request->nric)) {
          return redirect()->back()->withInput()->withFlashDanger('Duplicated visitor entry!');
        }

        if ($helper->capacityMaxed($request->unit_block, $request->unit_number)) {
          return redirect()->back()->withInput()->withFlashDanger('Room capacity maxed!');
        }

        $is_residential = $request->is_residential? 1: 0;
        
        $visitor = new Visitor();
        $visitor->pass_id = $request->pass_id? $request->pass_id: null;
        $visitor->name = $request->name;
        $visitor->nric = strtoupper($request->nric);
        $visitor->contact = $request->contact;
        $visitor->unit_block = $request->unit_block;
        $visitor->unit_number = $request->unit_number;
        $visitor->time_in = $request->time_in;
        $visitor->time_out = $request->time_out;
        $visitor->save();
        
        return redirect()->route('admin.visitor.index')->withFlashSuccess(__('Entry Logged Successfully.'));
    }
    
    public function update(Request $request, Visitor $visitor)
    {
        
        $validator = Validator::make($request->all(), [
            'pass_id' => 'nullable',
            'name' => 'required',
            'nric' => 'required|string|size:3',
            'contact' => 'required|string|size:8',
            'unit_block' => 'required',
            'unit_number' => 'required',
            'time_in' => 'required|date_format:Y-m-d H:i:s',
            'time_out' => 'nullable|date_format:Y-m-d H:i:s'
        ]);
        
        if ($validator->fails()) {
          return redirect()->back()->withInput()->withFlashDanger($validator->errors()->first());
        }
        
        $unit = Unit::where('unit_block',$request->unit_block)->where('unit_number',$request->unit_number)->first();
        if (!$unit) {
          return redirect()->back()->withInput()->withFlashDanger('Unit not found!');
        } else if (!$unit->occupant_name && $unit->is_residential) {
          return redirect()->back()->withInput()->withFlashDanger('The Residential Unit is vacant!');
        }
        
        if ($request->time_out &&  $request->time_in > $request->time_out) {
          return redirect()->back()->withInput()->withFlashDanger('Invalid Time In/Out');
        }

        $is_residential = $request->is_residential? 1: 0;
        
        $visitor->pass_id = $request->pass_id? $request->pass_id: null;
        $visitor->name = $request->name;
        $visitor->nric = strtoupper($request->nric);
        $visitor->contact = $request->contact;
        $visitor->time_in = $request->time_in;
        $visitor->time_out = $request->time_out;
        $visitor->save();
        
        return redirect()->route('admin.visitor.index')->withFlashSuccess(__('Successfully updated.'));
    }
    
    public function destroy(Request $request, Visitor $visitor)
    {
        $visitor->delete();
        return redirect()->route('admin.visitor.index')->withFlashSuccess(__('The entry was successfully deleted.'));
    }
}

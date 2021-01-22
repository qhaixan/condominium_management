<?php

namespace App\Http\Controllers\Frontend;

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
    
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'pass_id' => 'nullable',
            'name' => 'required',
            'nric' => 'required|string|size:3',
            'contact' => 'required|string|size:8',
            'unit_block' => 'required',
            'unit_number' => 'required'
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
        $visitor->time_in = now();
        $visitor->time_out = null;
        $visitor->save();
        
        return redirect()->route('frontend.index')->withFlashSuccess(__('Checked In Successfully.'));
    }
    
    public function update(Request $request) {
      if ($request->pass_id) {
        $visitor = Visitor::where('pass_id', $request->pass_id)->whereNull('time_out')->first();
        if (!$visitor) {
          return redirect()->back()->withInput()->withFlashDanger('Pass ID not found');
        }
      } else {
        $visitor = Visitor::where('contact', $request->contact)->where('nric', $request->nric)->whereNull('time_out')->first();
        if (!$visitor) {
          return redirect()->back()->withInput()->withFlashDanger('Contact or NRIC not found');
        }
      }
      
      $visitor->time_out = now();
      $visitor->save();
      return redirect()->route('frontend.index', ['action'=>'exit'])->withFlashSuccess(__('Checked Out Successfully.'));
    }
}

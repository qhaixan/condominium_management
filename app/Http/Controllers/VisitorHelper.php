<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\Visitor;

class VisitorHelper extends Controller
{
    
    public function capacityMaxed($unit_block, $unit_number) {
      $residentialCapacity = 8;
      $nonResidentialCapacity = 8;
      $visitors = Visitor::where('unit_block',$unit_block)->where('unit_number',$unit_number)->whereNull('time_out')->get();
      $visitorstcount = $visitors->count();
      $unit = Unit::where('unit_block', $unit_block)->where('unit_number', $unit_number)->first();
      if ($unit->is_residential) {
        return $visitorstcount >= $residentialCapacity;
      }else{
        return $visitorstcount >= $nonResidentialCapacity;
      }
    }
    
    public function duplicateEntry($contact, $nric){
      $visitor = Visitor::where('contact',$contact)->where('nric',$nric)->whereNull('time_out')->first();
      return $visitor? true: false;
    }
}

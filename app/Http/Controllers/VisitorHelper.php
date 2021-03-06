<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\Visitor;

class VisitorHelper extends Controller
{
    
    public function capacityMaxed($unit_id) {
      $residentialCapacity = 8;
      $nonResidentialCapacity = 8;
      $visitors = Visitor::where('unit_id', $unit_id)->whereNull('time_out')->get();
      $visitorstcount = $visitors->count();
      $unit = Unit::where('id', $unit_id)->first();
      if ($unit->is_residential) {
        return $visitorstcount >= $residentialCapacity;
      }else{
        return $visitorstcount >= $nonResidentialCapacity;
      }
    }
    
    public function duplicateEntry($pass_id, $contact, $nric){
      if ($pass_id) {
        $visitor = Visitor::where('pass_id',$pass_id)->whereNull('time_out')->first();
      }else{
        $visitor = Visitor::where('contact',$contact)->where('nric',$nric)->whereNull('time_out')->first();
      }
      return $visitor? true: false;
    }
}

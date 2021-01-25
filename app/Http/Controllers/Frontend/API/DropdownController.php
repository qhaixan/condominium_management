<?php

namespace App\Http\Controllers\FrontEnd\API;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class DropdownController extends Controller
{
    public function block()
    {
      $blocks = Unit::distinct('unit_block')->select('unit_block')->pluck('unit_block')->toArray();
      return response()->json($blocks);
    }
    
    public function number(Request $req)
    {
      $units = Unit::distinct('unit_number')->where('unit_block', $req->block)->select('unit_number')->pluck('unit_number')->toArray();
      return response()->json($units);
    }
}

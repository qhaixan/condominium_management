<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Unit;

class Visitor extends Model
{    
    public $timestamps = true;
    protected $table = 'visitor';
    
    protected $fillable = [
        'id',
        'pass_id',
        'name',
        'contact',
        'unit_id',
        'nric',
        'time_in',
        'time_out'
    ];
    
    protected $hidden = [
      'updated_at',
      'created_at'
    ];
    
    public function unit() {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}

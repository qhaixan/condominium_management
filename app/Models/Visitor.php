<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{    
    public $timestamps = true;
    protected $table = 'visitor';
    
    protected $fillable = [
        'id',
        'pass_id',
        'name',
        'contact',
        'unit_block',
        'nric',
        'time_in',
        'time_out'
    ];
    
    protected $hidden = [
      'updated_at',
      'created_at'
    ];
}

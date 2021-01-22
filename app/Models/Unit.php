<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{    
    public $timestamps = true;
    protected $table = 'unit';
    
    protected $fillable = [
        'id',
        'unit_block',
        'unit_number',
        'is_residential',
        'occupant_name',
        'occupant_contact'
    ];
    
    protected $hidden = [
      'updated_at',
      'created_at'
    ];
}

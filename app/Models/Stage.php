<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = [
        'stage_name',
        'stage_notes',
        'stage_case_id',
        'stage_type_stage_id',
        
    ];

    public function stage_type_stage(){
        return $this->belongsTo(TypeStage::class);
    }
    
    public function stage_case(){
        return $this->belongsTo(Caso::class);
    }

    public function files(){
        return $this->hasMany(File::class);
    }

    public function personStage()
    {
        return $this->hasMany(PersonStage::class);
    }
}

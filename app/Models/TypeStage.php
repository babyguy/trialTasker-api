<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeStage extends Model
{
    
    use HasFactory;

    protected $table ='type_stages';

    protected $fillable = [
        'type_stage_name',
    ];

    public function stages(){
        return $this->hasMany(Stage::class);
    }
}

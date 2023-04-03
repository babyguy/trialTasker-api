<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'file_name',
        'file_url',
        'file_stage_id',
    ];

    public function file_stage(){
        return $this->belongsTo(Stage::class);
    }
}

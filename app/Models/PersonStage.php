<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonStage extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_stage_person_id',
        'person_stage_stage_id',
    ];

    public function person_stage_stage()
    {
        return $this->belongsTo(Stage::class);
    }
    public function person_stage_person()
    {
        return $this->belongsTo(Person::class);
    }
}

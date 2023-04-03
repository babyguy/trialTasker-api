<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'persons';

    protected $fillable = [
        'per_name',
        'per_lastname',
        'per_email',
        'per_phone',
        'per_address',
        'per_nit',
        'per_issue_nit',
        'per_num_ministry',
        'per_num_dispaych',
        'per_radicated',
        'per_authority',
        'per_number',
        'per_type_person_id',
    ];

    public function per_type_person(){
        return $this->belongsTo(TypePerson::class);
    }


    public function cases(){
        return $this->hasMany(Caso::class);
    }

    public function personStage()
    {
        return $this->hasMany(PersonStage::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePerson extends Model
{
    use HasFactory;

    protected $table ='type_persons';

    protected $fillable = [
        'type_person_name',
    ];

    public function persons()
    {
        return $this->hasMany(Person::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutexessisler extends Model
{
    use HasFactory;

    protected $table='mutexessisler';
    protected $guarded=[];
    protected $primaryKey='id';
}

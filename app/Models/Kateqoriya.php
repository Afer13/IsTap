<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kateqoriya extends Model
{
    use HasFactory;

    protected $table='kateqoriya';
    protected $guarded=[];
    protected $primaryKey='id';
}

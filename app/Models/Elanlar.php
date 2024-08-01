<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Elanlar extends Model
{
    use HasFactory;
    protected $table='elanlar';
    protected $guarded=[];
    protected $primaryKey='id';
    public function getKateqoriya(){
        return $this->hasOne('App\Models\Kateqoriya','id','kateqoriya_id')->select('ad','img');
    }
    public function getSeher(){
        return $this->hasOne('App\Models\Seher','id','seher_id')->select('ad');
    }
}

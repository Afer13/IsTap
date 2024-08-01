<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Elaqe extends Model
{
    use HasFactory;

    // public function boot(){
    //     parent::boot();
    //     static::created(function($item){
    //         $amin_email='aferrehimov@gmail.com';
    //         Mail::to($amin_email)->send(new ContactMail($item));
    //     });
    // }
}

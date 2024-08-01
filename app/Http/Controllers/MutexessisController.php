<?php

namespace App\Http\Controllers;

use App\Models\Kateqoriya;
use App\Models\Mutexessisler;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class MutexessisController extends Controller
{
    public function index(Request $request){
        $mutexessisler=Mutexessisler::select('id','ad','sahe','img');
        
        $kateqoriyalar=Kateqoriya::orderBy('id','ASC')->get();
        if(isset($request->kateqoriya_id)){
            $mutexessisler=$mutexessisler->where('kateqoriya_id',$request->kateqoriya_id);
        }
        $mutexessisler=$mutexessisler->paginate(9);
        
        $kateqoriyaSay=Mutexessisler::select('kateqoriya_id',DB::raw('count(*) as total'))->groupBy('kateqoriya_id')->get();

        $kateqoriyalar_say=[];
        $kateqoriyalar_img=[];
        $kateqoriya_id=0;
        $total=0;
        foreach($kateqoriyaSay as $kSay){
            $kateqoriya_id=$kSay->kateqoriya_id;
            $kateqoriya=Kateqoriya::select('ad')->find($kateqoriya_id);
            $total=$kSay->total;
            $kateqoriyalar_say=Arr::add($kateqoriyalar_say,$kateqoriya->ad,$total);
        }

        return view('mutexessisler',compact(['mutexessisler','kateqoriyalar','kateqoriyalar_say']));
    }

    public function mutexessis_detal($mutexessis_id){
        $mutexessis=Mutexessisler::where('id',$mutexessis_id)->get();
        $baxis_sayi=$mutexessis[0]->baxis_sayi;
        $mutexessis[0]->baxis_sayi=$baxis_sayi+1;
        $mutexessis[0]->save();
        return view('mutexessis_detal',compact('mutexessis'));
    }
}

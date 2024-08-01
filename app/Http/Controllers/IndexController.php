<?php

namespace App\Http\Controllers;

use App\Models\Elanlar;
use App\Models\Kateqoriya;
use App\Models\Seher;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(Request $request){
        $premiumElanlar=Elanlar::where('bitme_tarixi','>',date('Y-m-d H:i:s'))->where('premium',1)->get();
        $ireliElanlar=Elanlar::where('bitme_tarixi','>',date('Y-m-d H:i:s'))->where('ireli_cek','>',0)->get();
        $sonElanlar=Elanlar::where('bitme_tarixi','>',date('Y-m-d H:i:s'))->orderBy('created_at','DESC')->limit(5)->get();
        $kateqoriyalar=Kateqoriya::orderBy('ad','ASC')->get();
        $seherler=Seher::orderBy('ad','ASC')->get();
        //$user=Auth::user();

        $kateqoriyaSay=Elanlar::select('kateqoriya_id',DB::raw('count(*) as total'))->groupBy('kateqoriya_id')->get();

        $kateqoriyalar_say=[];
        $kateqoriyalar_img=[];
        $kateqoriya_id=0;
        $total=0;
        foreach($kateqoriyaSay as $kSay){
            $kateqoriya_id=$kSay->kateqoriya_id;
            $kateqoriya=Kateqoriya::select('ad','img')->find($kateqoriya_id);
            $total=$kSay->total;
            $kateqoriyalar_img=Arr::add($kateqoriyalar_img,$kateqoriya->ad,$kateqoriya->img);
            $kateqoriyalar_say=Arr::add($kateqoriyalar_say,$kateqoriya->ad,$total);
        }
       

        return view('index',compact(['premiumElanlar','ireliElanlar','sonElanlar','kateqoriyalar','kateqoriyalar_say','kateqoriyalar_img','seherler']));
    }
}

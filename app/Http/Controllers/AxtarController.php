<?php

namespace App\Http\Controllers;

use App\Models\Elanlar;
use App\Models\Kateqoriya;
use App\Models\Seher;
use Illuminate\Http\Request;

class AxtarController extends Controller
{
    public function index_page(Request $request){
        $kateqoriyalar=Kateqoriya::orderBy('ad','ASC')->get();
        $seherler=Seher::orderBy('ad','ASC')->get();
        $sonElanlar=Elanlar::where('bitme_tarixi','>',date('Y-m-d H:i:s'))->orderBy('created_at','DESC');

        if($request->sahe!=''){
            $sonElanlar=$sonElanlar->where('ad','LIKE','%'.$request->sahe.'%');
        }
        if($request->kateqoriya!='Kateqoriya'){
            $sonElanlar=$sonElanlar->where('kateqoriya_id',$request->kateqoriya);
        }
        if($request->seher!='Şəhər/Rayon'){
            $sonElanlar=$sonElanlar->where('seher_id',$request->seher);
        }
        $sonElanlar=$sonElanlar->paginate(5);
        
        return view('vakansiyalar',compact(['sonElanlar','kateqoriyalar','seherler']));
    }
    public function index_page_kateqoriya($kateqoriya_id){
        $kateqoriyalar=Kateqoriya::orderBy('ad','ASC')->get();
        $seherler=Seher::orderBy('ad','ASC')->get();
        $sonElanlar=Elanlar::where('bitme_tarixi','>',date('Y-m-d H:i:s'))->where('kateqoriya_id',$kateqoriya_id)->orderBy('created_at','DESC')->paginate(5);
        return view('vakansiyalar',compact(['sonElanlar','seherler','kateqoriyalar']));
    }

    public function index_page_kateqoriya2($kateqoriya_ad){
        $kateqoriyalar=Kateqoriya::orderBy('ad','ASC')->get();
        $seherler=Seher::orderBy('ad','ASC')->get();
        $kateqoriya_id=Kateqoriya::where('ad',$kateqoriya_ad)->take(1)->get();
        $sonElanlar=Elanlar::where('bitme_tarixi','>',date('Y-m-d H:i:s'))->where('kateqoriya_id',$kateqoriya_id->id)->orderBy('created_at','DESC')->paginate(5);

        return view('vakansiyalar',compact(['sonElanlar','kateqoriyalar','seherler']));
    }
    
}

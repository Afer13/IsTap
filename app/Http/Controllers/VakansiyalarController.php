<?php

namespace App\Http\Controllers;

use App\Models\Elanlar;
use App\Models\Kateqoriya;
use App\Models\Seher;
use Illuminate\Http\Request;

class VakansiyalarController extends Controller
{
    public function index(Request $request){
        $premiumElanlar=Elanlar::where('bitme_tarixi','>',date('Y-m-d H:i:s'))->where('premium',1)->get();
        $ireliElanlar=Elanlar::where('bitme_tarixi','>',date('Y-m-d H:i:s'))->where('ireli_cek','>',0)->get();
        $sonElanlar=Elanlar::where('bitme_tarixi','>',date('Y-m-d H:i:s'))->orderBy('created_at','DESC')->paginate(5);
        $kateqoriyalar=Kateqoriya::select('id','ad')->orderBy('id','DESC')->get();
        $seherler=Seher::orderBy('ad','ASC')->get();
        //dd($request->all());
        if($request->sahe || $request->kateqoriya || $request->seher){
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

        return view('vakansiyalar',compact(['premiumElanlar','ireliElanlar','sonElanlar','kateqoriyalar','seherler']));
    }

    public function vakansiya_detal($vakansiya_id){
        $ireliElanlar=Elanlar::where('bitme_tarixi','>',date('Y-m-d H:i:s'))->where('ireli_cek','>',0)->get();
        $elan=Elanlar::where('id',$vakansiya_id)->get();
        $baxis_sayi=$elan[0]->baxis_sayi;
        $elan[0]->baxis_sayi=$baxis_sayi+1;
        $elan[0]->save();
        return view('vakansiya_detal',compact(['elan','ireliElanlar']));
    }
}

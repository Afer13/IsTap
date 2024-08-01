<?php

namespace App\Http\Controllers;

use App\Models\Elanlar;
use App\Models\Kateqoriya;
use App\Models\Mutexessisler;
use App\Models\Seher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class UserElanController extends Controller
{
    public function user_elanlar_index(){
        $user=Auth::user();
        $elanlar=Elanlar::where('bitme_tarixi','>',date('Y-m-d H:i:s'))->where('user_id',$user->id)->get();
        
        return view('user_elan',compact('elanlar'));
    }

    public function user_elan_detal($elan_id){
        $user_id=Auth::user()->id;
        $elan_uygun=Elanlar::where('user_id',$user_id)->where('id',$elan_id)->get();
        if(count($elan_uygun)==0){
            return redirect()->route('elan.user.index');
        }
        $elan=Elanlar::where('id',$elan_id)->get();
        //dd($elan->getKateqoriya->img);
        return view('user_elan_detal',compact('elan'));
    }

    public function elan_add_index(){
        $user_id=Auth::user()->id;
        $elanlar=Elanlar::where('user_id',$user_id)->get();
        $say=count($elanlar);
        if($say>=3){
            return back()->with('elan_count_max','Hal-hazırda 1 elanınız mövcuddur. <br> Qeyd: 1 istifadəçi yalnız 2 elan yerləşdirə bilər !');
        }
        $kateqoriyalar=Kateqoriya::all();
        $seherler=Seher::all();

        return view('elan_yarat',compact(['kateqoriyalar','seherler']));
    }

    public function elan_add_post(Request $request){
       // dd($request->all());
        $rules = [
            'ad' => 'required|max:100|string',
            'sirket' => 'required|max:500',
            'yas_min' => 'required|not_in:none',
            'yas_max' => 'required|not_in:none',
            'tehsil' =>'required|not_in:none',
            'seher_id'=>'required|not_in:none',
            'is_tecrubesi'=>'required|not_in:none',
            'kateqoriya_id'=>'required|not_in:none',
            'elaqedar_sexs' => 'required|max:100|string',
            'eh_min'=>'max:10000|numeric',
            'eh_max'=>'max:10000|numeric',
            'is_melumat'=>'required',
            'is_teleb'=>'required',
            'bitme_tarixi'=>'required|date|after:tomorrow',
            'telefon'=>'required|numeric',
            'email'=>'required|email',
        ];
        $messages=[
            'ad.required'=>'Ad sahəsi boş buraxıla bilməz !',
            'ad.max'=>'Ad sahəsi max 100 elementdən ibarət ola bilər !',
            'ad.string'=>'Ad sahəsi yalnız hərflərdən ibarət ola bilər !',

            'sirket.required'=>'Şirkət sahəsi boş buraxıla bilməz !',
            'sirket.max'=>'Şirkət sahəsi max 500 elementdən ibarət ola bilər !',
            'sirket.string'=>'Şirkət sahəsi yalnız hərflərdən ibarət ola bilər !',

            'yas_min.required'=>'Yaş sahəsi boş buraxıla bilməz !',
            'yas_min.not_in' => 'Yaş sahəsi boş buraxıla bilməz !',

            'yas_max.required'=>'Yaş sahəəsi boş buraxıla bilməz !',
            'yas_max.not_in' => 'Yaş sahəsi boş buraxıla bilməz !',

            'tehsil.required'=>'Təhsil sahəsi boş buraxıla bilməz !',
            'tehsil.not_in' => 'Təhsil sahəsi boş buraxıla bilməz !',

            'seher_id.required'=>'Şəhər sahəsi boş buraxıla bilməz !',
            'seher_id.not_in' => 'Şəhər sahəsi boş buraxıla bilməz !',

            'is_tecrubesi.required'=>'İş təcrübəsi sahəsi boş buraxıla bilməz !',
            'is_tecrubesi.not_in' => 'İş təcrübəsi sahəsi boş buraxıla bilməz !',

            'kateqoriya.required'=>'Kateqoriya sahəsi boş buraxıla bilməz !',
            'kateqoriya.not_in' => 'Kateqoriya sahəsi boş buraxıla bilməz !',

            'elaqedar_sexs.required'=>'Əlaqədar şəxs sahəsi boş buraxıla bilməz !',
            'elaqedar_sexs.max'=>'Əlaqədar şəxs sahəsi max 100 elementdən ibarət ola bilər !',
            'elaqedar_sexs.string'=>'Əlaqədar şəxs sahəsi yalnız hərflərdən ibarət ola bilər !',

            'eh_min'=>'Minimum əməkhaqqı sahəsi max 5 elementdən ibarət ola bilər!',
            'eh_min.numeric'=>'Minimum əməkhaqqı sahəsi yalnız ədədlərdən ibarət olmalıdır !',

            'eh_max'=>'Maksimum əməkhaqqı sahəsi max 5 elementdən ibarət ola bilər!',
            'eh_max.numeric'=>'Maksimum əməkhaqqı sahəsi yalnız ədədlərdən ibarət olmalıdır !',

            'is_melumat.required'=>'Məlumat sahəsi boş buraxıla bilməz !',

            'is_teleb.required'=>'Namizəddən tələblər sahəsi boş buraxıla bilməz !',

            'bitme_tarixi.required'=>'Bitmə tarixi sahəsi boş buraxıla bilməz!',
            'bitme_tarixi.date'=>'Bitmə tarixi formatı düzgün deyil !',
            'bitme_tarixi.after'=>'Bitmə tarixi indiki andan sonrakı zaman olmalıdır !',


            'telefon.requred'=>'Telefon sahəsi boş buraxıla bilməz !',
            'telefon.max'=>'Telefon sahəsi max 20 elementdən ibarət ola bilər !',
            'telefon.numeric'=>'Telefon sahəsi yalnız ədədlərdən ibarət olmalıdır !',

            'email.email'=>'Email formatı düzgün deyil !',
            'email.required'=>'Email sahəhəsi boş buraxıla bilməz !',
        ];
        foreach($request->all() as $key=>$value){
                 session([$key=>$value]);
        }
       
        
        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            $errors=$validator->errors();
            return back()->withErrors($errors);
        }

        foreach($request->all() as $key=>$value){
                session()->forget($key);
        }
       
        $user=Auth::user();
        $ad=$request->ad;
        $sirket=$request->sirket;
        $yas=$request->yas_min.'-'.$request->yas_max;
        $tehsil=$request->tehsil;
        $is_tecrubesi=$request->is_tecrubesi;
        $kateqoriya_id=$request->kateqoriya_id;
        $elaqedar_sexs=$request->elaqedar_sexs;
        $seher_id=$request->seher_id;

        if($request->eh_r!="on"){
            if($request->eh_min=="" || $request->eh_max==""){
                return back()->with('eh_min','Əməkhaqqı sahəsi boş buraxıla bilməz!');
            }
            else{
                $eh=$request->eh_min.'-'.$request->eh_max;
            }
        }
        else{
            $eh="Ə/H razılaşma ilə";
        }
        
        $is_melumat=$request->is_melumat;
        $is_teleb=$request->is_teleb;
        if($request->elave!=""){
            $elave_melumat=$request->elave;
        }
        else{
            $elave_melumat="Təyin edilməyib";
        }
        $bitme_tarixi=$request->bitme_tarixi;
        $telefon=$request->telefon;
        $email=$request->email;
        

        $elan=new Elanlar();
        $elan->user_id=$user->id;
        $elan->ad=$ad;
        $elan->sirket=$sirket;
        $elan->yas=$yas;
        $elan->tehsil=$tehsil;
        $elan->is_tecrubesi=$is_tecrubesi;
        $elan->kateqoriya_id=$kateqoriya_id;
        $elan->elaqedar_sexs=$elaqedar_sexs;
        $elan->seher_id=$seher_id;
        $elan->emekhaqqi=$eh;
        $elan->is_melumat=$is_melumat;
        $elan->is_teleb=$is_teleb;
        $elan->elave=$elave_melumat;
        $elan->bitme_tarixi=$bitme_tarixi;
        $elan->telefon=$telefon;
        $elan->email=$email;

        $elan->save();

        return redirect()->route('elan.user.index');
    }

    public function elan_update_index($elan_id){
        $user_id=Auth::user()->id;
        $data=Elanlar::where('user_id',$user_id)->where('id',$elan_id)->get();
        if(count($data)==0){
            return redirect()->route('elan.user.index');
        }
        $kateqoriyalar=Kateqoriya::all();
        $seherler=Seher::all();

        $elan=Elanlar::where('id',$elan_id)->first();
        return view('user_elan_update',compact(['kateqoriyalar','seherler','elan']));
    }

    public function elan_user_update(Request $request){
        $rules = [
            'ad' => 'required|max:100|string',
            'sirket' => 'required|max:500',
            'yas_min' => 'required|not_in:none',
            'yas_max' => 'required|not_in:none',
            'tehsil' =>'required|not_in:none',
            'seher_id'=>'required|not_in:none',
            'is_tecrubesi'=>'required|not_in:none',
            'kateqoriya_id'=>'required|not_in:none',
            'elaqedar_sexs' => 'required|max:100|string',
            'eh_min'=>'max:10000|numeric',
            'eh_max'=>'max:10000|numeric',
            'is_melumat'=>'required',
            'is_teleb'=>'required',
            'bitme_tarixi'=>'required|date|after:tomorrow',
            'telefon'=>'required|numeric',
            'email'=>'required|email',
        ];
        $messages=[
            'ad.required'=>'Ad sahəsi boş buraxıla bilməz !',
            'ad.max'=>'Ad sahəsi max 100 elementdən ibarət ola bilər !',
            'ad.string'=>'Ad sahəsi yalnız hərflərdən ibarət ola bilər !',

            'sirket.required'=>'Şirkət sahəsi boş buraxıla bilməz !',
            'sirket.max'=>'Şirkət sahəsi max 500 elementdən ibarət ola bilər !',
            'sirket.string'=>'Şirkət sahəsi yalnız hərflərdən ibarət ola bilər !',

            'yas_min.required'=>'Yaş sahəsi boş buraxıla bilməz !',
            'yas_min.not_in' => 'Yaş sahəsi boş buraxıla bilməz !',

            'yas_max.required'=>'Yaş sahəəsi boş buraxıla bilməz !',
            'yas_max.not_in' => 'Yaş sahəsi boş buraxıla bilməz !',

            'tehsil.required'=>'Təhsil sahəsi boş buraxıla bilməz !',
            'tehsil.not_in' => 'Təhsil sahəsi boş buraxıla bilməz !',

            'seher_id.required'=>'Şəhər sahəsi boş buraxıla bilməz !',
            'seher_id.not_in' => 'Şəhər sahəsi boş buraxıla bilməz !',

            'is_tecrubesi.required'=>'İş təcrübəsi sahəsi boş buraxıla bilməz !',
            'is_tecrubesi.not_in' => 'İş təcrübəsi sahəsi boş buraxıla bilməz !',

            'kateqoriya.required'=>'Kateqoriya sahəsi boş buraxıla bilməz !',
            'kateqoriya.not_in' => 'Kateqoriya sahəsi boş buraxıla bilməz !',

            'elaqedar_sexs.required'=>'Əlaqədar şəxs sahəsi boş buraxıla bilməz !',
            'elaqedar_sexs.max'=>'Əlaqədar şəxs sahəsi max 100 elementdən ibarət ola bilər !',
            'elaqedar_sexs.string'=>'Əlaqədar şəxs sahəsi yalnız hərflərdən ibarət ola bilər !',

            'eh_min'=>'Minimum əməkhaqqı sahəsi max 5 elementdən ibarət ola bilər!',
            'eh_min.numeric'=>'Minimum əməkhaqqı sahəsi yalnız ədədlərdən ibarət olmalıdır !',

            'eh_max'=>'Maksimum əməkhaqqı sahəsi max 5 elementdən ibarət ola bilər!',
            'eh_max.numeric'=>'Maksimum əməkhaqqı sahəsi yalnız ədədlərdən ibarət olmalıdır !',

            'is_melumat.required'=>'Məlumat sahəsi boş buraxıla bilməz !',

            'is_teleb.required'=>'Namizəddən tələblər sahəsi boş buraxıla bilməz !',

            'bitme_tarixi.required'=>'Bitmə tarixi sahəsi boş buraxıla bilməz!',
            'bitme_tarixi.date'=>'Bitmə tarixi formatı düzgün deyil !',
            'bitme_tarixi.after'=>'Bitmə tarixi indiki andan sonrakı zaman olmalıdır !',


            'telefon.requred'=>'Telefon sahəsi boş buraxıla bilməz !',
            'telefon.max'=>'Telefon sahəsi max 20 elementdən ibarət ola bilər !',
            'telefon.numeric'=>'Telefon sahəsi yalnız ədədlərdən ibarət olmalıdır !',

            'email.email'=>'Email formatı düzgün deyil !',
            'email.required'=>'Email sahəhəsi boş buraxıla bilməz !',
        ];
        foreach($request->all() as $key=>$value){
                 session([$key=>$value]);
        }
       
        
        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            $errors=$validator->errors();
            return back()->withErrors($errors);
        }

        foreach($request->all() as $key=>$value){
                session()->forget($key);
        }
       

        $id=$request->id;

        $user=Auth::user();
        $ad=$request->ad;
        $sirket=$request->sirket;
        $yas=$request->yas_min.'-'.$request->yas_max;
        $tehsil=$request->tehsil;
        $is_tecrubesi=$request->is_tecrubesi;
        $kateqoriya_id=$request->kateqoriya_id;
        $elaqedar_sexs=$request->elaqedar_sexs;
        $seher_id=$request->seher_id;

        if($request->eh_r!="on"){
            if($request->eh_min=="" || $request->eh_max==""){
                return back()->with('eh_min','Əməkhaqqı sahəsi boş buraxıla bilməz!');
            }
            else{
                $eh=$request->eh_min.'-'.$request->eh_max;
            }
        }
        else{
            $eh="Ə/H razılaşma ilə";
        }
        
        $is_melumat=$request->is_melumat;
        $is_teleb=$request->is_teleb;
        if($request->elave!=""){
            $elave_melumat=$request->elave;
        }
        else{
            $elave_melumat="Təyin edilməyib";
        }
        $bitme_tarixi=$request->bitme_tarixi;
        $telefon=$request->telefon;
        $email=$request->email;
        

        $elan=Elanlar::where('id',$id)->first();
        $elan->user_id=$user->id;
        $elan->ad=$ad;
        $elan->sirket=$sirket;
        $elan->yas=$yas;
        $elan->tehsil=$tehsil;
        $elan->is_tecrubesi=$is_tecrubesi;
        $elan->kateqoriya_id=$kateqoriya_id;
        $elan->elaqedar_sexs=$elaqedar_sexs;
        $elan->seher_id=$seher_id;
        $elan->emekhaqqi=$eh;
        $elan->is_melumat=$is_melumat;
        $elan->is_teleb=$is_teleb;
        $elan->elave=$elave_melumat;
        $elan->bitme_tarixi=$bitme_tarixi;
        $elan->telefon=$telefon;
        $elan->email=$email;

        $elan->save();

        return redirect()->route('elan.user.detal',['elan_id'=>$id]);
    }

    public function elan_user_delete($elan_id){
        $user_id=Auth::user()->id;
        $data=Elanlar::where('user_id',$user_id)->where('id',$elan_id)->get();
        if(count($data)==0){
            return redirect()->route('elan.user.index');
        }

        Elanlar::where('id',$elan_id)->delete();
        return redirect()->route('elan.user.index');
    }
}

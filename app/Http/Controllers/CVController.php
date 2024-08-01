<?php

namespace App\Http\Controllers;

use App\Models\Kateqoriya;
use App\Models\Mutexessisler;
use App\Models\Seher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\elementType;

class CVController extends Controller
{
    public function index()
    {
        $user_id=Auth::user()->id;
        $mutexessis=Mutexessisler::where('user_id',$user_id)->get();
        $say=count($mutexessis);
        if($say>=1){
            return back()->with('cv_count_max','Hal-hazırda 1 CV-niz mövcuddur. <br> Qeyd: 1 istifadəçi yalnız 1 CV yerləşdirə bilər !');
        }

        $kateqoriyalar=Kateqoriya::all();
        $seherler=Seher::all();

        return view('cv_yarat',compact(['kateqoriyalar','seherler']));
    }

    public function cv_yarat_post(Request $request)
    {

        $rules = [
            'ad' => 'required|max:100|string',
            'soyad' => 'required|max:100|string',
            'ata_adi' => 'required|max:100|string',
            'cins' => 'required|not_in:none',
            'yas' => 'required|not_in:none',
            'img' => 'mimes:jpeg,jpg,png,gif|required|max:5000',
            'tehsil' =>'required|not_in:none',
            'tehsil_etrafli'=>'max:1000',
            'is_tecrubesi'=>'required|not_in:none',
            'is_tecrubesi_etrafli'=>'max:1000',
            'kateqoriya_id'=>'required|not_in:none',
            'sahe'=>'required|max:1000',
            'min_eh'=>'max:10000|numeric',
            'bacariqlar'=>'required',
            'telefon'=>'required|numeric',
            'email'=>'email'
        ];
        $messages=[
            'ad.required'=>'Ad sahəhəsi boş buraxıla bilməz !',
            'ad.max'=>'Ad sahəhəsi max 100 elementdən ibarət ola bilər !',
            'ad.string'=>'Ad sahəhəsi yalnız hərflərdən ibarət ola bilər !',

            'soyad.required'=>'Soyad sahəhəsi boş buraxıla bilməz !',
            'soyad.max'=>'Soyad sahəhəsi max 100 elementdən ibarət ola bilər !',
            'soyad.string'=>'Soyad sahəhəsi yalnız hərflərdən ibarət ola bilər !',

            'ata_adi.required'=>'Ata adı sahəhəsi boş buraxıla bilməz !',
            'ata_adi.max'=>'Ata adı sahəhəsi max 100 elementdən ibarət ola bilər !',
            'ata_adi.string'=>'Ata adı sahəhəsi yalnız hərflərdən ibarət ola bilər !',

            'cins.required'=>'Cins sahəhəsi boş buraxıla bilməz !',
            'cins.not_in' => 'Cins sahəhəsi boş buraxıla bilməz !',

            'yas.required'=>'Yaş sahəhəsi boş buraxıla bilməz !',
            'yas.not_in' => 'Yaş sahəhəsi boş buraxıla bilməz !',

            'img.required'=>'Şəkil sahəhəsi boş buraxıla bilməz !',
            'img.mimes' => 'Şəkil jpeg,jpg,png formatında olmalıdır !',
            'img.max' => 'Şəkil ölçüsü max 5 MB ola bilər !',

            'tehsil.required'=>'Təhsil sahəhəsi boş buraxıla bilməz !',
            'tehsil.not_in' => 'Təhsil sahəhəsi boş buraxıla bilməz !',

            'tehsil_etrafli.max'=>'Təhsil-Ətraflı sahəsi max 1000 elemetdən ibarət ola bilər !',

            'is_tecrubesi.required'=>'İş təcrübəsi sahəhəsi boş buraxıla bilməz !',
            'is_tecrubesi.not_in' => 'İş təcrübəsi sahəhəsi boş buraxıla bilməz !',

            'is_tecrubesi_etrafli'=>'İş-Təcrübəsi-Ətraflı sahəsi max 1000 elemetdən ibarət ola bilər ! ',

            'kateqoriya.required'=>'Kateqoriya sahəhəsi boş buraxıla bilməz !',
            'kateqoriya.not_in' => 'Kateqoriya sahəhəsi boş buraxıla bilməz !',

            'sahe.required'=> 'Vəzifə sahəsi boş buraxıla bilməz!',
            'sahe.max'=>'Vəzifə sahəhəsi max 1000 elementdən ibarət ola bilər !',

            'min_eh'=>'Minimum əməkhaqqı sahəsi max 5 elementdən ibarət ola bilər!',
            'min_eh.numeric'=>'Minimum əməkhaqqı sahəhəsi yalnız ədədlərdən ibarət olmalıdır !',

            'bacariqlar.required'=>'Bacarıqlar sahəhəsi boş buraxıla bilməz !',

            'elave_melumat.required'=>'Əlavə məlumat sahəhəsi boş buraxıla bilməz !',

            'telefon.requred'=>'Telefon sahəhəsi boş buraxıla bilməz !',
            'telefon.max'=>'Telefon sahəhəsi max 20 elementdən ibarət ola bilər !',
            'telefon.numeric'=>'Telefon sahəhəsi yalnız ədədlərdən ibarət olmalıdır !'
        ];
        foreach($request->all() as $key=>$value){
            if($key!="img"){
                 session([$key=>$value]);
            }
        }
       
        
        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            $errors=$validator->errors();
            return back()->withErrors($errors);
        }
        foreach($request->all() as $key=>$value){
            if($key!="img"){
                session()->forget($key);
            }
        }
        //dd($request->all());
        $user=Auth::user();
        $ad=$request->ad;
        $soyad=$request->soyad;
        $ata_adi=$request->ata_adi;
        $cins=$request->cins;
        $yas=$request->yas;
        $tehsil=$request->tehsil;
        if($request->tehsil_etrafli!=""){
            $tehsil_etrafli=$request->tehsil_etrafli;
        }
        else{
            $tehsil_etrafli="Təyin edilməyib";
        }
        $is_tecrubesi=$request->is_tecrubesi;
        if($request->is_tecrubesi_etrafli!=""){
            $is_tecrubesi_etrafli=$request->is_tecrubesi_etrafli;
        }
        else{
            $is_tecrubesi_etrafli="Təyin edilməyib";
        }
        $kateqoriya_id=$request->kateqoriya_id;
        $sahe=$request->sahe;

        if($request->seher_id!="Şəhər"){
            $seher_id=$request->seher_id;
        }
        else{
            $seher_id="Təyin edilməyib";
        }

        if($request->min_eh!=""){
            $min_eh=$request->min_eh;
        }
        else{
            $min_eh="Təyin edilməyib";
        }
        
        $bacariqlar=$request->bacariqlar;
        if($request->elave_melumat!=""){
            $elave_melumat=$request->elave_melumat;
        }
        else{
            $elave_melumat="Təyin edilməyib";
        }
        
        $telefon=$request->telefon;
        if($request->email!=""){
            $email=$request->email;
        }
        else{
            $email="Təyin edilməyib";
        }
        
        $img_url='';
        if($file = $request->hasFile('img')) {
             
            $file = $request->file('img') ;
            $fileName = $file->getClientOriginalName() ;
            $user_name=$user->name;
            $ranNum=rand(10000,90000);
            $imgName=$user_name.$ranNum.$fileName;
            $destinationPath = public_path().'/ishtap/cv_img';
            $file->move($destinationPath,$imgName);
            $img_url="ishtap/cv_img/$imgName";
        }

        $mutexessis=new Mutexessisler();
        $mutexessis->user_id=$user->id;
        $mutexessis->ad=$ad;
        $mutexessis->soyad=$soyad;
        $mutexessis->ata_adi=$ata_adi;
        $mutexessis->cins=$cins;
        $mutexessis->yas=$yas;
        $mutexessis->tehsil=$tehsil;
        $mutexessis->tehsil_etrafli=$tehsil_etrafli;
        $mutexessis->is_tecrubesi=$is_tecrubesi;
        $mutexessis->is_tecrubesi_etrafli=$is_tecrubesi_etrafli;
        $mutexessis->kateqoriya_id=$kateqoriya_id;
        $mutexessis->sahe=$sahe;
        $mutexessis->seher_id=$seher_id;
        $mutexessis->min_eh=$min_eh;
        $mutexessis->bacariqlar=$bacariqlar;
        $mutexessis->elave_melumat=$elave_melumat;
        $mutexessis->telefon=$telefon;
        $mutexessis->email=$email;
        $mutexessis->img=$img_url;

        $mutexessis->save();

        return redirect()->route('cv.user_cv');
    }

    public function user_cv(){
        $user_id=Auth::user()->id;
        $mutexessis=Mutexessisler::where('user_id',$user_id)->where('status',1)->first();
        
        return view('user_cv',compact('mutexessis'));
    }

    public function cv_update_index(){
        $user_id=Auth::user()->id;
        $kateqoriyalar=Kateqoriya::all();
        $seherler=Seher::all();
        $mutexessis=Mutexessisler::where('user_id',$user_id)->where('status',1)->first();
        return view('user_cv_update',compact('mutexessis','kateqoriyalar','seherler'));
    }

    public function cv_update(Request $request){
        $rules = [
            'ad' => 'required|max:100|string',
            'soyad' => 'required|max:100|string',
            'ata_adi' => 'required|max:100|string',
            'cins' => 'required|not_in:none',
            'yas' => 'required|not_in:none',
            'img' => 'mimes:jpeg,jpg,png,gif|max:5000',
            'tehsil' =>'required|not_in:none',
            'tehsil_etrafli'=>'max:1000',
            'is_tecrubesi'=>'required|not_in:none',
            'is_tecrubesi_etrafli'=>'max:1000',
            'kateqoriya_id'=>'required|not_in:none',
            'sahe'=>'required|max:1000',
            'min_eh'=>'max:10000|numeric',
            'bacariqlar'=>'required',
            'telefon'=>'required|numeric',
            'email'=>'required|email'
        ];
        $messages=[
            'ad.required'=>'Ad sahəhəsi boş buraxıla bilməz !',
            'ad.max'=>'Ad sahəhəsi max 100 elementdən ibarət ola bilər !',
            'ad.string'=>'Ad sahəhəsi yalnız hərflərdən ibarət ola bilər !',

            'soyad.required'=>'Soyad sahəhəsi boş buraxıla bilməz !',
            'soyad.max'=>'Soyad sahəhəsi max 100 elementdən ibarət ola bilər !',
            'soyad.string'=>'Soyad sahəhəsi yalnız hərflərdən ibarət ola bilər !',

            'ata_adi.required'=>'Ata adı sahəhəsi boş buraxıla bilməz !',
            'ata_adi.max'=>'Ata adı sahəhəsi max 100 elementdən ibarət ola bilər !',
            'ata_adi.string'=>'Ata adı sahəhəsi yalnız hərflərdən ibarət ola bilər !',

            'cins.required'=>'Cins sahəhəsi boş buraxıla bilməz !',
            'cins.not_in' => 'Cins sahəhəsi boş buraxıla bilməz !',

            'yas.required'=>'Yaş sahəhəsi boş buraxıla bilməz !',
            'yas.not_in' => 'Yaş sahəhəsi boş buraxıla bilməz !',

            //'img.required'=>'Şəkil sahəhəsi boş buraxıla bilməz !',
            'img.mimes' => 'Şəkil jpeg,jpg,png formatında olmalıdır !',
            'img.max' => 'Şəkil ölçüsü max 5 MB ola bilər !',

            'tehsil.required'=>'Təhsil sahəhəsi boş buraxıla bilməz !',
            'tehsil.not_in' => 'Təhsil sahəhəsi boş buraxıla bilməz !',

            'tehsil_etrafli.max'=>'Təhsil-Ətraflı sahəsi max 1000 elemetdən ibarət ola bilər !',

            'is_tecrubesi.required'=>'İş təcrübəsi sahəhəsi boş buraxıla bilməz !',
            'is_tecrubesi.not_in' => 'İş təcrübəsi sahəhəsi boş buraxıla bilməz !',

            'is_tecrubesi_etrafli'=>'İş-Təcrübəsi-Ətraflı sahəsi max 1000 elemetdən ibarət ola bilər ! ',

            'kateqoriya.required'=>'Kateqoriya sahəhəsi boş buraxıla bilməz !',
            'kateqoriya.not_in' => 'Kateqoriya sahəhəsi boş buraxıla bilməz !',

            'sahe.required'=> 'Vəzifə sahəsi boş buraxıla bilməz!',
            'sahe.max'=>'Vəzifə sahəhəsi max 1000 elementdən ibarət ola bilər !',

            'min_eh'=>'Minimum əməkhaqqı sahəsi max 5 elementdən ibarət ola bilər!',
            'min_eh.numeric'=>'Minimum əməkhaqqı sahəhəsi yalnız ədədlərdən ibarət olmalıdır !',

            'bacariqlar.required'=>'Bacarıqlar sahəhəsi boş buraxıla bilməz !',

            'elave_melumat.required'=>'Əlavə məlumat sahəhəsi boş buraxıla bilməz !',

            'telefon.requred'=>'Telefon sahəhəsi boş buraxıla bilməz !',
            'telefon.max'=>'Telefon sahəhəsi max 20 elementdən ibarət ola bilər !',
            'telefon.numeric'=>'Telefon sahəhəsi yalnız ədədlərdən ibarət olmalıdır !',

            'email.email'=>'Email formatı düzgün deyil !',
            'email.required'=>'Email sahəhəsi boş buraxıla bilməz !',
        ];
        
        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            $errors=$validator->errors();
            return back()->withErrors($errors);
        }

        $user=Auth::user();
        $ad=$request->ad;
        $soyad=$request->soyad;
        $ata_adi=$request->ata_adi;
        $cins=$request->cins;
        $yas=$request->yas;
        $tehsil=$request->tehsil;
        if($request->tehsil_etrafli!=""){
            $tehsil_etrafli=$request->tehsil_etrafli;
        }
        else{
            $tehsil_etrafli="Təyin edilməyib";
        }
        $is_tecrubesi=$request->is_tecrubesi;
        if($request->is_tecrubesi_etrafli!=""){
            $is_tecrubesi_etrafli=$request->is_tecrubesi_etrafli;
        }
        else{
            $is_tecrubesi_etrafli="Təyin edilməyib";
        }
        $kateqoriya_id=$request->kateqoriya_id;
        $sahe=$request->sahe;

        if($request->seher_id!="Şəhər"){
            $seher_id=$request->seher_id;
        }
        else{
            $seher_id="Təyin edilməyib";
        }

        if($request->min_eh!=""){
            $min_eh=$request->min_eh;
        }
        else{
            $min_eh="Təyin edilməyib";
        }
        
        $bacariqlar=$request->bacariqlar;
        if($request->elave_melumat!=""){
            $elave_melumat=$request->elave_melumat;
        }
        else{
            $elave_melumat="Təyin edilməyib";
        }
        
        $telefon=$request->telefon;
        $email=$request->email;
        
        $img_url='';
        if($file = $request->hasFile('img')) {
             
            $file = $request->file('img') ;
            $fileName = $file->getClientOriginalName() ;
            $user_name=$user->name;
            $ranNum=rand(10000,90000);
            $imgName=$user_name.$ranNum.$fileName;
            $destinationPath = public_path().'/ishtap/cv_img';
            $file->move($destinationPath,$imgName);
            $img_url="ishtap/cv_img/$imgName";
        }

        $mutexessis=Mutexessisler::where('user_id',$user->id)->first();
        $mutexessis->user_id=$user->id;
        $mutexessis->ad=$ad;
        $mutexessis->soyad=$soyad;
        $mutexessis->ata_adi=$ata_adi;
        $mutexessis->cins=$cins;
        $mutexessis->yas=$yas;
        $mutexessis->tehsil=$tehsil;
        $mutexessis->tehsil_etrafli=$tehsil_etrafli;
        $mutexessis->is_tecrubesi=$is_tecrubesi;
        $mutexessis->is_tecrubesi_etrafli=$is_tecrubesi_etrafli;
        $mutexessis->kateqoriya_id=$kateqoriya_id;
        $mutexessis->sahe=$sahe;
        $mutexessis->seher_id=$seher_id;
        $mutexessis->min_eh=$min_eh;
        $mutexessis->bacariqlar=$bacariqlar;
        $mutexessis->elave_melumat=$elave_melumat;
        $mutexessis->telefon=$telefon;
        $mutexessis->email=$email;
        if($img_url!=''){
            $mutexessis->img=$img_url;
        }
            

        $mutexessis->save();

        return redirect()->route('cv.user_cv');
    }

    public function cv_user_delete(){
        $user=Auth::user();
        $mutexessis=Mutexessisler::where('user_id',$user->id)->delete();
        return redirect()->route('cv.user_cv');
    }
}

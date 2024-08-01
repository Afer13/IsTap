<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfilController extends Controller
{
    public function index(){
        $user=Auth::user();
        return view('profil',compact('user'));
    }

    public function profil_update_index(){
        $user=Auth::user();
        return view('profil_update',compact('user'));
    }

    public function profil_update(Request $request){
        $rules=[
            'name'=>'required|string|max:100',
            'email'=>'required|email|max:100',
        ];
        $messages=[
            'name.required'=>'İstifadəçi adı boş buraxıla bilməz!',
            'name.string'=>'İstifadəçi adı yalnız hərflərdən ibarət olmalıdır !',
            'name.max'=>'İstifadəçi adı max 100 simvoldan ibarət ola bilər',

            'email.required'=>'Email boş buraxıla bilməz!',
            'email.email'=>'Email formatı düzgün deyil !',
            'email.max'=>'Email max 100 simvoldan ibarət ola bilər!',
        ];
        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            $errors=$validator->errors();
            return redirect()->route('profil.update.index')->withErrors($errors);
        }
        $user_id=Auth::user()->id;

        $name=$request->name;
        $email=$request->email;
        
        $user=User::where('id',$user_id)->first();

        $user->name=$name;
        $user->email=$email;
        $user->save();
        
        return redirect()->route('profil.index')->with('updateOk','Məlumat uğurla yeniləndi !');
    }
}

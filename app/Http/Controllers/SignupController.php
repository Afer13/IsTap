<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    public function index(){
        return view('auth.signup');
    }

    public function signup(Request $request){
        //$id=auth()->user()->id;
        $rules=[
            'name'=>'required|max:100',
            'e_mail'=>"required|email|min:3|max:199|unique:users,email",
            'password' => 'required|min:8|max:100|confirmed',
            'password_confirmation'=>'required'
        ];
        $message=[
            'name.required'=>'Ad Soyad boş buraxıla bilməz !',
            'name.max'=>'Email max 100 elementədn ibarət ola bilər !',

            'e_mail.required'=>'Email boş buraxıla bilməz !',
            'e_mail.email'=>'Email formatı düzgün deyil !',
            'e_mail.min'=>'Email min 3 elementədn ibarət ola bilər !',
            'e_mail.max'=>'Email max 199 elementədn ibarət ola bilər !',
            'e_mail.unique'=>'Bu emailə uyğun istifadəçi artıq mövcuddur ! ',

            'password.required' => 'Şifrə hissəsi boş buraxıla bilməz!',
            'password.min' => 'Şifrə min 8 simvoldan ibarət olmalıdır!',
            'password.max' => 'Şifrə max 100 simvoldan ibarət olmalıdır!',
            'password.confirmed' => 'Təkrar şifrə şifrə ilə uyğun gəlmir !',

            'password_confirmation.required'=> 'Təkrar şifrə boş buraxıla bilməz !'
        ];

        $validator=Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            $errors=$validator->errors();
            return redirect()->route('signup.index')->withErrors($errors);
        }
        
        $name=$request->name;
        $email=$request->e_mail;
        $password=$request->password;

        $user=new User();
        $user->name=$name;
        $user->email=$email;
        $user->password=Hash::make($password);
        $user->save();
        Auth::login($user);
        return redirect()->route('index');
    }
}

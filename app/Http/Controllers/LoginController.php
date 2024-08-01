<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login(Request $request){
        $rules=[
            'e_mail'=>'required|email|min:3|max:199',
            'password' => 'required|min:8|max:100',
        ];
        $message=[
            'e_mail.required'=>'Email boş buraxıla bilməz !',
            'e_mail.email'=>'Email formatı düzgün deyil !',
            'e_mail.min'=>'Email min 3 elementədn ibarət ola bilər !',
            'e_mail.max'=>'Email max 199 elementədn ibarət ola bilər !',

            'password.required' => 'Şifrə hissəsi boş buraxıla bilməz!',
            'password.min' => 'Şifrə min 8 simvoldan ibarət olmalıdır!',
            'password.max' => 'Şifrə max 100 simvoldan ibarət olmalıdır!',
        ];
        $validator=Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            $errors=$validator->errors();
            return back()->withErrors($errors);
        }

        if (Auth::attempt(['email' => $request->e_mail, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('index');
        }

        return back()->with('loginNo','İstifadəçi email-i və ya şifrə səhvdir.');
    }
}

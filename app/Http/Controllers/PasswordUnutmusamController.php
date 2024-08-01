<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Stringable;

class PasswordUnutmusamController extends Controller
{

    public function index(){
        return view('auth.unutmusam_email');
    }

    public function linkGonder(Request $request){
        $rules=[
            'email'=>'required|email|min:3|max:199'
        ];
        $message=[
            'email.required'=>'Email boş buraxıla bilməz !',
            'email.email'=>'Email formatı düzgün deyil !',
            'email.min'=>'Email min 3 elementədn ibarət ola bilər !',
            'email.max'=>'Email max 199 elementədn ibarət ola bilər !'
        ];
        $validator=Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            $errors=$validator->errors();
            return redirect()->route('unutmusam.email')->withErrors($errors);
        }

        $data=User::where('email',$request->email)->first();
        if(!$data){
            return redirect()->route('unutmusam.email')->with('email_no','İstifadəçi mövcud deyil ! ');
        }

        $email=$request->email;
        $token=rand(1000,9999);

        DB::table('password_resets')->insert([
            'email'=>$email,
            'token'=>$token,
            'created_at'=>Carbon::now()
        ]);

        Mail::send('email.password_reset',['token'=>$token],function($message) use ($request){
            $message->to($request->email);
            $message->subject('Şifrə Sıfırlama');
        });

        return redirect()->route('unutmusam.email')->with('sendEmailOk','Şifrəni yeniləmək üçün Emailinizə link göndərildi.');
    }
    public function mailLinkOk($token){
        //$token=$request->token;
        $data=DB::table('password_resets')->where('token',$token)->first();
        if(!$data){
            return redirect()->route('login.index');
        }
        
        return view('auth.unutmusam_reset_password',['token'=>$token]);
    }

    public function resetPassword(Request $request){
        
        $rules=[
            'email'=>'required|email|min:3|max:199',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ];
        $message=[
            'email.required'=>'Email boş buraxıla bilməz !',
            'email.email'=>'Email formatı düzgün deyil !',
            'email.min'=>'Email min 3 elementədn ibarət ola bilər !',
            'email.max'=>'Email max 199 elementədn ibarət ola bilər !',

            'password.required' => 'Şifrə hissəsi boş buraxıla bilməz!',
            'password.min' => 'Şifrə min 8 simvoldan ibarət olmalıdır!',
            'password.confirmed' => 'Təkrar şifrə şifrə ilə uyğun gəlmir!',

            'password_confirmation.required'=>'Təkrar şifrə boş buraxıla bilməz!'
        ];
        //dd($request->all());
        $validator=Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            $errors=$validator->errors();
            return redirect()->route('unutmusam.resetPassword')->withErrors($errors);
        }
        $data=User::where('email',$request->email)->first();
        if(!$data){
           
            return redirect()->route('unutmusam.resetPassword')->with('email_no','İstifadəçi mövcud deyil ! ');
        }

        $data=User::where('email',$request->email)->first();
        $data->password=Hash::make($request->password);
        $data->save();
        DB::table('password_resets')->where('token',$request->token)->delete();
        
        return redirect()->route('login.index')->with('resetPasswordOk','Şifrə uğurla dəyişdirildi');
    }
}

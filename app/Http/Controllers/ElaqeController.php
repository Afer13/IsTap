<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ElaqeMail;
use App\Models\Elaqe;
use App\Models\Recipient;
use App\Notifications\ContactFormMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ElaqeController extends Controller
{
    public function index(){
        return view('elaqe');
    }

    public function mesajGonder(Request $request){
        $rules=[
            'ad'=>'required|max:200',
            'e_mail'=>'required|email|min:3|max:255',
            'basliq'=>'required|max:255',
            'mesaj'=>'required|max:1000'
        ];
        $messages=[
            'ad.required'=>'Ad boş buraxıla bilməz !',
            'ad.max'=>'Ad max 200 simvol ola bilər',

            'e_mail.required'=>'E-mail boş buraxıla bilməz !',
            'e_mail.min'=>'E-mail ən azı 3 elementdən ibarət ola bilər !',
            'e_mail.max'=>'E-mail ən çoxu 255 elementdən ibarət ola bilər !',
            'e_mail.email'=>'E-Mail formatı doğru deyil !',

            'basliq.required'=>'Başlıq boş buraxıla bilməz !',
            'basliq.max'=>'Başlıq max 255 simvol ola bilər',

            'mesaj.required'=>'Mesaj boş buraxıla bilməz !',
            'mesaj.max'=>'Mesaj max 1000 simvol ola bilər',
        ];

        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            $errors=$validator->errors();
            return redirect()->route('elaqe')->withErrors($errors);
        }
        

        Mail::send('email.mail', array(
            'ad' => $request->get('ad'),
            'email' => $request->get('e_mail'),
            'basliq' => $request->get('basliq'),
            'mesaj' => $request->get('mesaj'),
        ), function($message) use ($request){
            $message->from($request->e_mail);
            $message->to('aferrehimov@gmail.com', 'Afer Rehimov')->subject($request->get('basliq'));
        });

        return back()->with('ok_mail', 'Mesajınızı aldıq və bizə yazdığınız üçün sizə təşəkkür etmək istərdik');
        
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send_mail(){
        $to_name ="Nguyen Minh Vuong";//ten
        $to_email = "nmv20032000@gmail.com";//gui toi email
        $data = array("name"=>"Mail tu tai khoan khac hang", "body"=>"Mail gui ve van de hang hoa");
        Mail::send('pages.send_mail',$data, function($message) use ($to_name, $to_email){
            $message->to($to_email)->subject('Quen mat khau');
            $message->to($to_email,$to_name);
        });
        return redirect('home/index')->with('message','');
    }

}
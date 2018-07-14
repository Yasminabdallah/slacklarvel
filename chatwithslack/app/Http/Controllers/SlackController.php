<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Notifications\SlackNotification;
use App\Message;


class SlackController extends Controller
{
    public function index (){

        return view('chat');
    }
    public function send (Request $request){
        $filename=null;
        $typefile=null;
        
        if($request->hasFile('file')){
            $request->file('file')->store('public/images');
            $filename = $request->file('file')->hashName();
            $typefile=$request->file->getMimeType();
           
            
        }
        $msg=Message::create([
            'message' => $request->message,
            'user_id'=>Auth::user()->id,
            'file'=>$filename,
        ]);
        $user=Auth::user();
        
        $user->notify(new SlackNotification($user->name,$msg,$typefile));
        flashy()->error('Your message is sent ');
        
       
     
        return redirect('/home' );

    }


    public function attach (Request $request){
        if ($request){
            return redirect('/' );
        }
        else{
            return redirect('/' );
        }
     
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Notifications\SlackNotification;
use App\Message;
use App\User;

class SlackController extends Controller
{
    public function index (){
        $messages=User::find(Auth::user()->id)->messages;
        //dd($messages);

        return view('chat',['messages'=> $messages]);
    }
    public function send ( Request $request){
       
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
        
        return response()->json(['name'=>Auth::user()->name,'response' => 'success','message'=>$request->message]);
     
       

    }


    public function attach (Request $request){
        log()->error('we have reached the attach method');
        $msg=Message::create([
            'message' => $request,
            'user_id'=>Auth::user()->id,
            'file'=>$filename,
        ]);

    }
}

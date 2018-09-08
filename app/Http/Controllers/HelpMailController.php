<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use App\Mail\helpMail;

class HelpMailController extends Controller
{
    
    public function sendHelpMail(Request $request){
        $request->validate([
            'nombre' => 'required|string',
            'email' => 'required|string',
            'asunto' => 'required|string',
            'mensaje' => 'required|string',
        ]);
        $input = request()->all();
        Mail::to('sportzonesocialnetwork@gmail.com')->send(new helpMail($input));

        return response()->json([
            'mensaje' => 'email enviado correctamente'
        ], 200);
    }

    public function mostrar(){
        $user =Auth::user();
        return view('emails.mail',compact('user'));
    }







}

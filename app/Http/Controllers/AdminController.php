<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Quote;
use App\ContactMessage;

class AdminController extends Controller
{
    public function getIndex()
    {
        $quotes = Quote::orderBy('created_at', 'desc')->take(3)->get();
        $contact_messages = ContactMessage::orderBy('created_at', 'desc')->take(3)->get();
        
        return view('admin.index', ['quotes' => $quotes, 'contact_messages' => $contact_messages]);
    }
    
    public function getLogin()
    {
        return view('admin.login');   
    }
    
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email' ,
            'password' => 'required'
        ]);
        
        if(!Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
            return redirect()->back()->with(['fail' => "Connexion impossible"]);
        }
        
        return redirect()->route('admin.index');
    }
    
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('public.index');
    }
}

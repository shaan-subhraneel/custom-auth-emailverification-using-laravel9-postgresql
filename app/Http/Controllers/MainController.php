<?php

// code developed by Subhraneel Chowdhury

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\verifyUser;
use App\Mail\verifyMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function register(){
        return view('auth.register');
    }
    public function login(){
        return view('auth.login');
    }
    public function homepage(){
        return view ('homepage');
    }
    public function save(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|max:12'
        ]);

        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);

        $save=$user->save();

        if ($save){
            $verifyuser=new verifyUser;
            $verifyuser->id=$user->id;
            $verifyuser->token=Str::random(64);
            $verifyuser->save();

            Mail::to($user->email)->send(new verifyMail($user));
            return back()->with('success', 'user has been registered');
        }
        else{
            return back()->with('fail', 'user has not been registered! please try again');
        }
    }
    public function retrieve(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6|max:12'
        ]);

        $user=User::where('email', $request->email)->first();

        if (!$user){
            return back()->with('fail', 'Email not registered');
        }
        else{
            if (Hash::check($request->password, $user->password)){
                $request->session()->put('LoggedUser', $user->id);
                if ($user->email_verified=="V"){
                    return redirect()->route('homepage');
                }
                else{
                    $request->session()->pull('LoggedUser', $user->id);
                    return redirect()->route('auth.login')->with('error', 'email not verified');
                }
            }
            else{
                return back()->with('fail', 'password is incorrect');
            }
        }
    }

    public function emailverification($token){
        $verifieduser=verifyUser::where('token', $token)->first();
        if (isset($verifieduser)){
            $user=User::where('id',$verifieduser->id)->first();
            if (!$user->email_verified){
                $user->email_verified="V";
                $user->save();
                return redirect()->route('auth.login')->with('success', 'email has been verified');
            }
            else{
                return redirect()->route('auth.login')->with('fail', 'email has already been verified');
            }
        }
        else{
            return redirect()->route('auth.login')->with('fail', 'something went wrong!');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Login extends Controller
{
    //
    public function index(){
      if (!Session::get('login')){
        return redirect('login')->with('alert', 'Kamu harus login dulu');
      }else{
        return redirect('dashboard');
      }
    }

    public function login(){
      return view('login/login');
    }

    public function loginPost(Request $request){
      $email = $request->email;
      $password = $request->password;

      $data = ModelUser::where('email',$email)->first();

      if($data != null && $data->name != null ){
        if(Hash::check($password, $data->password)){
          Session::put('name', $data->name);
          Session::put('email', $data->email);
          Session::put('login', true);
          return redirect ('dashboard');
        }else{
          return redirect('login')->with('alert', 'Password atau Email salah coi !');
        }
      }else{
        return redirect('login')->with('alert','Email Belum Terdaftar ! Silahkan Register');
      }
    }

    public function logout(){
      Session::flush();
      return redirect('login')->with('alert', 'Bye, Anda berhasil Logout ..');
    }
}

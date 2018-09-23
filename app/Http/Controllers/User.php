<?php

namespace App\Http\Controllers;

use App\ModelUser;
use Illuminate\Http\Request;

class User extends Controller
{
    public function index(){
      $data = ModelUser::all ();
      return view ( 'user/index' )->withData ( $data );
    }

    public function register(Request $request){
      return view('user/register');
    }

    public function registerPost(Request $request){
      $this->validate($request, [
        'name'=> 'required|min:4',
        'email'=> 'required|min:4|email|unique:users',
        'password'=> 'required',
        'confirmation'=> 'required|same:password',
      ]);

      $data = new ModelUser();
      $data->name = $request->name;
      $data->email = $request->email;
      $data->password = bcrypt($request->password);
      $data->save();
      return redirect('login')->with('alert-success', 'Kamu berhasil login');

    }
}

<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12'
        ]);

        $users = Users::where('email','=', $request->email)->first();
        if($users){
            if(($request->password == $users->password)){

                $request->session()->put('LoggedUsers', $users->id);

                return redirect('/user/reports');
            }
            else{
                return back()->withErrors(['msg'=>"Senha inválida!"]);
            }
        }
        else{
            return back()->withErrors(['msg'=>"Email não cadastrado!"]);
        }
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/user/login');
    }

    public function forgotPassword()
    {
        return view('site.user.forgotPassword');
    }

    public function login()
    {
        return view('site.user.login');
    }

    public function passwordRecovery()
    {
        return view('site.user.passwordRecovery');
    }
    
    public function indexReports()
    {
        return view('site.user.reports');
    }

    public function indexCreateReports()
    {
        return view('site.user.createReport');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

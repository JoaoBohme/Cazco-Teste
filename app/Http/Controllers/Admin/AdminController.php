<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Users;
use App\Models\Report;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function authenticate(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12'
        ]);

        $admin = Admin::where('email','=', $request->email)->first();
        if($admin){
            if(($request->password == $admin->password)){

                $request->session()->put('LoggedAdmin', $admin->id);

                return redirect('/admin/users');
            }
            else{
                return back()->withErrors(['msg'=>"Senha inválida!"]);
            }
        }
        else{
            return back()->withErrors(['msg'=>"Email não cadastrado!"]);
        }
    }

    function profile(){
        if(session()->has('LoggedAdmin')){
            $admin = Admin::where('id', '=', session('LoggedAdmin'))->first();
            $data = [
                'LoggedUserInfo'=>$admin
            ];
        }
        return view("site.admin.users", $data);
    }

    public function logout(){
        if(session()->has('LoggedAdmin')){
            session()->pull('LoggedAdmin');
            return redirect('/admin/login');
        }
    }

    public function index()
    {
        //
    }

    public function login()
    {
        return view('site.admin.login');
    }

    public function forgotPassword()
    {
        return view('site.admin.forgotPassword');
    }

    public function passwordRecovery()
    {
        return view('site.admin.passwordRecovery');
    }

    public function users()
    {
        if(session()->has('LoggedAdmin')){
            $admin = Admin::where('id', '=', session('LoggedAdmin'))->first();
            $data = [
                'LoggedAdminInfo'=>$admin
            ];
        }

        $users = Users::all();

        return view('site.admin.users',['users' => $users], $data);
    }

    public function editUser($id)
    {
        $users = Users::findOrFail($id);

        return view("site.admin.edit", ['users' => $users]);
    }

    public function createUser()
    {
        return view('site.admin.create');
    }

    public function indexReports($id)
    {
        $reports = DB::table('reports')
                ->where('user_id', '=', $id)
                ->get();
        
        return view("site.admin.reports", ['reports' => $reports]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

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
     
    public function storeUser(Request $request)
    {

        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12'
        ]);

        $users = new Users;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = $request->password;

        $query = $users->save();

        if($query){
            return redirect('/admin/users')->with('success', 'Usuário criado com sucesso!'); 
        }
        else{
            return back()->with('fail', 'Não foi possível cadastrar usuário!');
        }
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

    public function updateUser(Request $request, $id)
    {
        Users::findOrFail($request->id)
            ->update($request->all());

        return redirect('/admin/users')->with('msg', 'Usuário editado com sucesso!');    
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

    public function destroyUser($id)
    {
        $reports = DB::table('reports')
                ->where('user_id', '=', $id)
                ->delete();

        Users::findOrFail($id)->delete();

        return redirect('/admin/users')->with('msg', 'Usuário excluído com sucesso!');
    }
}

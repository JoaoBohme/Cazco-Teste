<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Users;
use App\Models\Report;

class AdminController extends Controller
{
    public function authenticate(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $admin = Admin::where('email','=', $request->email)->first();
        if($admin){
            if(Hash::check($request->password, $admin->password)){

                $request->session()->put('LoggedAdmin', $admin->id);

                return redirect('/admin/users');
            }
            else{
                return back()->withErrors(['fail'=>"Senha inválida!"]);
            }
        }
        else{
            return back()->withErrors(['fail'=>"Email não cadastrado!"]);
        }
    }

    public function logout(){
        try{
            if(session()->has('LoggedAdmin')){
                session()->pull('LoggedAdmin');
                return redirect('/admin/login');
            }
        }
        catch(\Exception $e){
            return back()->withErrors(['fail'=>"Não foi possível fazer logout, tente novamente!"]);
        }
    }

    public function login()
    {
        return view('site.admin.login');
    }

    public function forgotPassword()
    {
        return view('site.admin.forgotPassword');
    }

    public function passwordRecovery($email)
    {
        return view('site.admin.passwordRecovery',['email' => $email]);
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
        try{

            $id = Crypt::decrypt($id);

            $users = Users::findOrFail($id);
        
            return view("site.admin.edit", ['users' => $users]);
        }
        catch(\Exception $e){
            return redirect('/admin/users')->withErrors(['fail'=>'Falha ao tentar editar, tente novamente.']);
        }
    }

    public function createUser()
    {
        return view('site.admin.create');
    }

    public function indexReports($id)
    {
        $id = Crypt::decrypt($id);

        $reports = DB::table('reports')
            ->where('user_id', '=', $id)
            ->get();
        
        return view("site.admin.reports", ['reports' => $reports]);

    }
     
    public function storeUser(Request $request)
    {   
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed'
        ]);

        $users = new Users;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = bcrypt($request->password);

        $query = $users->save();

        if($query){
            return redirect('/admin/users')->withErrors(['success', 'Usuário criado com sucesso!']); 
        }
        else{
            return back()->withErrors(['fail', 'Não foi possível cadastrar usuário!']);
        }
    }

    public function updatePasswordRecovery(Request $request, $email)
    {
        $request->validate([
            'password'=>'required|confirmed'
        ]);

        try{

            $email = Crypt::decrypt($email);
            
            $admin = Admin::where('email', $email)
                ->first();

            Admin::findOrFail($admin->id)
                ->update(['password' => bcrypt($request->password)]);

            return redirect('/admin/login')->withErrors(['success'=> 'Senha alterada com sucesso!']);
        }
        catch(\Exception $e){

            return back()->withErrors(['fail'=> 'Não foi possível alterar a senha, tente novamente!']);
        }
    }

    public function updateUser(Request $request, $id)
    {
        try{

            $id = Crypt::decrypt($id);

            Users::findOrFail($id)
            ->update($request->all());

            return redirect('/admin/users')->withErrors(['success'=> 'Usuário editado com sucesso!']);
        }
        catch(\Exception $e){
            return redirect('/admin/users')->withErrors(['fail'=> 'Não foi possível editar usuário, tente novamente!']);
        }
    }

    public function destroyUser($id)
    {
        try{
            $reports = DB::table('reports')
            ->where('user_id', '=', $id)
            ->delete();

            Users::findOrFail($id)->delete();

            return redirect('/admin/users')->withErrors(['success'=>'Usuário excluído com sucesso!']);
        }
        catch(\Exception $e)
        {
            return redirect('/admin/users')->withErrors(['fail'=>'Não foi possível excluir usuário!']);   
        }

    }

    function forgotPasswordSendEmail(Request $request){

        $request->validate([
            'email'=>'required|email'
        ]);

        try{

            $admin = Admin::where('email', $request->email)
                ->exists();
                if(!$admin){
                    return back()->withErrors(['fail'=>'Email não cadastrado!']);
                }


        $request->email = Crypt::encrypt($request->email);

            Mail::send('site.admin.email', ['request' => $request], function($m)use($request){
                $m->from('joao.bohmecastro@gmail.com');
                $m->subject('Recuperar senha');
                $m->to(Crypt::decrypt($request->email) );
            });
                
            return redirect('/admin/login')->withErrors(['success'=>'Sucesso! Verifique seu email.']);
        }
        catch(\Exception $e){
            return redirect('/admin/login')->withErrors(['fail'=>'Erro ao enviar email, contate o administrador!']);
            
        }
    }
}

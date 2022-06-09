<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Report;
use Carbon\Carbon;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $users = Users::where('email','=', $request->email)->first();
        if($users){
            if(Hash::check($request->password, $users->password)){

                $request->session()->put('LoggedUsers', $users->id);

                return redirect('/user/reports');
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
        if(session()->has('LoggedUsers')){
            session()->pull('LoggedUsers');
            return redirect('/user/login');
        }
    }
    catch(\Exception $e){
        return back()->withErrors(['fail'=>"Não foi possível fazer logout, tente novamente!"]);
    }
    }

    public function forgotPassword()
    {
        return view('site.user.forgotPassword');
    }

    public function login()
    {
        return view('site.user.login');
    }

    public function passwordRecovery($email)
    {
        return view('site.user.passwordRecovery',['email' => $email]);
    }
    
    public function indexReports()
    {
        return view('site.user.reports');
    }

    public function indexCreateReports()
    {
        if(session()->has('LoggedUsers')){
            $user = Users::where('id', '=', session('LoggedUsers'))->first();
            $data = [
                'LoggedUsersInfo'=>$user
            ];
        }

        $reports = DB::table('reports')
                ->where('user_id', '=', $user->id)
                ->get();

        return view('site.user.createReport',['reports' => $reports], $data);
    }

    public function storeReports(Request $request)
    {
        if(session()->has('LoggedUsers')){
            $user = Users::where('id', '=', session('LoggedUsers'))->first();
            $data = [
                'LoggedUsersInfo'=>$user
            ];
        }

        $reported = Report::whereDate('day', Carbon::today()->toDateString())
        ->where('user_id', $user->id)
        ->exists();

        if(!$reported){
            
            $request->validate([
                'description'=>'required',
            ]);
    
            $report = new Report;
            $report->day = Carbon::now();
            $report->description = $request->description;   
            $report->user_id = $user->id;
    
            $query = $report->save();
    
            if($query){
                return redirect('/user/reports')->withErrors(['success', 'relatório criado com sucesso!']); 
            }
            else{
                return redirect('/user/reports')->withErrors(['fail', 'Não foi possível cadastrar relatório!']);
            }

        }
        else{

            return redirect('/user/reports')->withErrors(['fail'=>"Só é possível cadastrar 1 relatório por dia!"]);
            
        }
    }

    function forgotPasswordSendEmail(Request $request){

        $request->validate([
            'email'=>'required|email'
        ]);

        try{

            $users = Users::where('email', $request->email)
                ->exists();

            if(!$users){
                return back()->withErrors(['fail'=>'Email não cadastrado!']);
            }

        $request->email = Crypt::encrypt($request->email);  

            Mail::send('site.user.email', ['request' => $request], function($m)use($request){
                $m->from('joao.bohmecastro@gmail.com');
                $m->subject('Recuperar senha');
                $m->to(Crypt::decrypt($request->email));
            });
                
            return redirect('/user/login')->withErrors(['success'=>'Sucesso! Verifique seu email.']);
        }
        catch(\Exception $e){
            return redirect('/user/login')->withErrors(['fail'=>'Erro ao enviar email, contate o administrador!']);

        }
    }

    public function updatePasswordRecovery(Request $request, $email)
    {
        $request->validate([
            'password'=>'required|confirmed'
        ]); 

        try{

            $email = Crypt::decrypt($email);

            $users = Users::where('email', $email)
                ->first();  

            Users::findOrFail($users->id)
                ->update(['password' => bcrypt($request->password)]);

            return redirect('/user/login')->withErrors(['success'=> 'Senha alterada com sucesso!']);
        }
        catch(\Exception $e){

            return back()->withErrors(['fail'=> 'Não foi possível alterar a senha, tente novamente!']);
        }
    }
}

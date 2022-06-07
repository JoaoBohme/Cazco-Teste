<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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

    public function logout(){
        if(session()->has('LoggedUsers')){
            session()->pull('LoggedUsers');
            return redirect('/user/login');
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
        ->exists();

        //dd($reported);

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
            Mail::to($request->email)
            ->subject('- Alterar senha')
            ->send('site.user.passwordRecovery', ['email'=>'bla bla']);
                
            return redirect('/user/login')->withErrors(['success'=>'Sucesso! Verifique seu email.']);
        }
        catch(\Exception $e){
            return redirect('/user/login')->withErrors(['error'=>'Erro ao enviar email, contate o administrador!']);

        }
        


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

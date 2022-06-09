<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Users;

class ReportController extends Controller
{
    public function indexUsers()
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

        return view('site.user.reports',['reports' => $reports]);
    }

    public function show($id)
    {
        try{
            $id = Crypt::decrypt($id);

            $reports = Report::findOrFail($id);
    
            return view('site.user.editReport', ['report' => $reports]);
        }
        catch(\Exception $e){
            return back()->withErrors(['fail'=>'Não foi possível editar o relatório, tente novamente.']);
        }
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'description'=>'required'
        ]);

        try{
            Report::findOrFail($request->id)
                ->update($request->all());
    
            return redirect('/user/reports')->withErrors(['success'=> 'Relatório editado com sucesso!']);    
        }
        catch(\Exception $e){
            return back()->withErrors(['fail'=>"Não foi possível editar relatório, tente novamente!"]);
        }
    }
}
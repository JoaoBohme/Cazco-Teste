<?php

namespace App\Http\Controllers\Admin;

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
        $users = Users::all();

        return view('site.admin.users',['users' => $users]);
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

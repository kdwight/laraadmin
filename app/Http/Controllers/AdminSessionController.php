<?php

namespace App\Http\Controllers;

class AdminSessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }

    public function create()
    {
        return view('admin.login');
    }

    public function store()
    {
        if (!auth()->attempt(['username' => request('username'), 'password' => request('password'), 'status' => 1])) {
            return back()->with('error', 'Please check your credentials');
        }
        return redirect('/pages');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/admin');
    }
}

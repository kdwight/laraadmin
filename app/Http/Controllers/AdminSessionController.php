<?php

namespace App\Http\Controllers;

class AdminSessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }

    public function index()
    {
        return view('admin.index');
    }

    public function store()
    {
        if (!auth()->attempt(['email' => request('email'), 'password' => request('password'), 'status' => true], request('remember'))) {
            return back()->with('login-error', 'These account doesn\'t exist');
        }

        return redirect('/admin/dashboard');

        /**
         * if there's no dashboard or dashboard is limited to users.
         * use this instead.
         * */
        // $firstPage = auth()->user()->role->modules[0]['name'];
        // return redirect('/admin/' . $firstPage);
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/admin');
    }
}

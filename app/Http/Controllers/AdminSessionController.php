<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;

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

        auth()->user()->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => request()->getClientIp(),
            'last_user_agent' => request()->header('User-Agent')
        ]);

        return redirect('/admin/pages');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/admin');
    }
}

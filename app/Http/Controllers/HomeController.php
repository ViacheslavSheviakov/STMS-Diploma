<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $redirect = '404';
        $user = Auth::user();

        if($user->hasRole('admin'))
        {
            $redirect = redirect()->route('home.admin');
        }
        else if($user->hasRole('student'))
        {
            $redirect = redirect()->route('home.student');
        }


        return $redirect;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
         $notifications = auth()->user()->unreadNotifications;
         // $notifications = all()->unreadNotifications;

        return view('home', compact('notifications'));

  //        {
  //   $user->notify(new StatusUpdate($order));
  // } 
      
    }


}

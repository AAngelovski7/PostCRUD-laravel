<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; //import here because we will use User Moel

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');  //block everything if we are nmot login
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id; // take user id of loged user
        $user = User::find($user_id); // return one users that is login with id that have
        //{"id":2,"name":"Toni","email":"antoniotoni15@live.com","email_verified_at":null,"created_at":"2020-09-02T23:18:28.000000Z","updated_at":"2020-09-02T23:18:28.000000Z"}
    
        return view('dashboard')->with('posts', $user->posts); //return all posts with same user id 
        
    }
}

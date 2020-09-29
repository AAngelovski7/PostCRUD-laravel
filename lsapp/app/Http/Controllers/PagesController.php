<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    
    // public function index(){
    //     return "Index";
    // } - this function retur "Index" where this controler and function is called

    public function index(){
        $title = 'Welcome to Laravel !!!';
        //return view('pages.index', compact('title')); //za da ja pratime title variable to indexx page
        return view('pages.index')->with('title',$title);  // passing tittle variable to pages.index page
        // this is like pages/index.blade.php page
    }
    public function about(){
        $title = "About us";
        return view('pages.about')->with('title',$title);  //when is called this function is loaded this view t.e about.blade.php page
    }
    public function services(){
        //creating data array and then pass information from that array to pages.services page with ->with($data);
         $data = array(
            'title' => 'Services',
            'services' => ['Web Design','Programming','SEO']
        );
        return view('pages.services')->with($data);
    }

}

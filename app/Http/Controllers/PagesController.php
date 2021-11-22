<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function home()
    {
        return view('front.index');
    }
    public function aboutUs()
    {
        return view('front.about-us');
    }
    public function contactUs()
    {
        return view('front.contact-us');
    }
    public function services()
    {
        return view('front.services');
    }
    public function business()
    {
        return view('front.business');
    }
}

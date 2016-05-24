<?php
namespace Link\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
}
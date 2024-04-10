<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('pages.admin.home');
    }

    public function publish()
    {
        return view('pages.admin.publish');
    }
}

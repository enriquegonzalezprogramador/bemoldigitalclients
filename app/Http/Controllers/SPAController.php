<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SPAController extends Controller
{
    /**
     * Index
     *
     * @return view
     */
    public function index()
    {
        return view('app');
    }
}

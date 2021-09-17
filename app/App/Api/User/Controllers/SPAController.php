<?php

namespace Desing\Api\User\Controllers;
use Desing\Core\Http\Controllers\Controller;

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

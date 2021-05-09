<?php

namespace App\Http\Controllers;

use App\Contracts\CompanyContract;
use App\Transformers\CompanyCollection;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }
}

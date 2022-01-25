<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use function view;

class ApplicationController extends Controller
{

    public function index(): View
    {
        return view('application');
    }

}

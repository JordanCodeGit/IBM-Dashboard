<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index() {
        return view('pages.driver', ['currentPage' => 'driver']);
    }
}

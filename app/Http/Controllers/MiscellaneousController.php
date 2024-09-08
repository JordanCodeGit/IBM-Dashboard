<?php

namespace App\Http\Controllers;

use App\Models\Salesman;
use App\Models\Settings;
use Illuminate\Http\Request;

class MiscellaneousController extends Controller
{
    public function help(Request $request) {
        return view('pages.help', ['currentPage' => 'help', 'firstID' => Salesman::first()->id_salesman, 'domain' => $request->getHost()]);
    }
}

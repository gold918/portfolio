<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function show ()
    {
        if(view()->exists('admin.index')) {
            return view('admin.index');
        }
        return abort(404);
    }
}

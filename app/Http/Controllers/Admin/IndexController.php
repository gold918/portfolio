<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function show ()
    {
//        $userRoles = Auth::user()->role->rules()->pluck('title')->all();
        if(view()->exists('admin.index')) {
            return view('admin.index');
        }
        return abort(404);
    }
}

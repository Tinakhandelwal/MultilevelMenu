<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menus::where('parent_id', 0)->get();
        return view('menus.index',compact('menus'));
    }
}

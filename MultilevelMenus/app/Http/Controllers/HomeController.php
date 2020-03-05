<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menus;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $menus = Menus::where('parent_id', 0)->get();
        // $cat = $this->getCategories($menus);
        // dd($cat);
        return view('home', compact('menus'));
    }

    public function create() {
        $menus = Menus::select('id', 'parent_id', 'title')->get();
        return view('menus.index', compact('menus'));
    }

    public function store(Request $request) {
        $post_relation = $request->post('menu_id');
        print_r($post_relation);die();
        if ($post_relation>0) {
            $Pid   = $request->input('sub_menu');
        } else {
            $Pid   = $request->input('relation');
        }
        $title = $request->input('title');
        $data  =  array('parent_id'=> $Pid,"title"=> $title);
        if (!empty($request->input())) {
            Menus::insert($data);
            return redirect('home');
        }
    }

    public function onSelectMenu(Request $request) {
        try {
            $menu_id    = $request->get('menu_id');
            $selectedMenuId = ($menu_id > 0) ? 1: 0;
            $menus = Menus::select('id', 'parent_id', 'title')->get();   
            $view = \View::make('menus/dropdownList', 
            array('menus' => $menus, 'menu_id' => $menu_id,'selectedMenuId' => $selectedMenuId))->render();          
            echo $view;
        } catch (Exception $e) { 
         echo $e->getMessage();
      }
    }

    static function createSelectdropdownRecursive($menu_id) {
        $menus = Menus::select('id', 'parent_id', 'title')->where('parent_id', $menu_id)->get();
        $select = "";
        $menu_count = $menus->count();
        if ($menu_count>0) {
            $select .= "<select name='sub_menu' id='subMenu' class='dropClass' style='display:block'>";
            foreach ($menus as $menu) {
                $select .= "<option value='$menu->id'>$menu->title</option>";
            }
            $select .= "</select>";
            return $select;
        }
        
    }


    
}

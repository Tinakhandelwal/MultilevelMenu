<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $fillable = ['parent_id','title'];
    protected $table = 'menus';

    public function sub_menu(){
        return $this->hasMany('App\Menus', 'parent_id');
    }
}

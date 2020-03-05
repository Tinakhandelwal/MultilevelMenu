<?php 
function createSelectdropdownRecursive(){
    $menus = Menus::select('id', 'parent_id', 'title')->get();
    foreach ($menus as $menu) {
        print_r($menu->title);
    }
    
}
?>


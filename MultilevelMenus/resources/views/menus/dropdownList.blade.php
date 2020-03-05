@if(empty($menu_id))
<select name="relation" id="MenuList" style="width: 50%" class="dropClass">
        <option value="0">Select</option>
        @foreach($menus as $key=>$menu)        
        @if(($menus->count()>0) && ($menu->parent_id == 0))
           <option value="{{ $menu->id }}" <?php echo ($selectedMenuId == 1) ? "selected" : ""?>>{{ $menu->title }}</option>
        @endif
        @endforeach
</select>
@endif
  
    {{-- @if($show == 1)
    <select name="sub_menu" id="subMenu" style="display:block" class="dropClass">
          @foreach($menus1 as $key => $menu)
          @if(($menus1->count() > 0) && ($menu->parent_id !=0))
          <option value="{{ $menu->id }}">{{ $menu->title }}</option>
          @endif
          @endforeach
    </select>
    @endif --}}
    @if($menu_id)
        @php echo Home::createSelectdropdownRecursive($menu_id); @endphp
    @endif

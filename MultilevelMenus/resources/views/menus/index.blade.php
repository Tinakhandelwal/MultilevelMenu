@extends('layouts.app')
@section('content')
<div class="container">
    <form action="/menu" method= "post">
        @csrf
            @if(count($errors) > 0)
                <div class="alert alert-danger  alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    @foreach($errors->all() as $error)
                            {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            @if ($message = Session::get('success'))
            <div class="alert alert-success  alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">×</button>   
                    <strong>{{ $message }}</strong>
            </div>
        @endif
      <h1>Add Menu</h1>
      <hr>
      <div class="row">
          <div class='col-md-2'>
            <label for="pid"><b>Select Menu</b></label>
          </div>
     <div id="dropdownlist0"></div>
            {{-- <select name="relation" id="MenuList" style="width: 50%">
                <option value="0">Select</option>
                @foreach($menus as $key=>$menu)
                @if(($menus->count()>0) && ($menu->parent_id == 0))
                   <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                @endif
                @endforeach
          </select> 
          <select name="sub_menu" id="subMenu" style="display:none">
              <option value="0">Select</option>
          </select> --}}
      </div>
      <div class="row">
        <div class='col-md-2'>
           <label for="title"><b>Title</b></label>
        </div>
      <input type="text" placeholder="Enter Title" name="title" required>
      </div>
      <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@push('styles')
    <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
@endpush
@endsection
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var BASE_URL = '{{ url('/')}}'; 
    $.ajax({
            url: BASE_URL + '/selected-menu',
            method: "POST",
            data: {},
            //dataType: 'json',
            beforeSend: function(request) {
              request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
            },
            success: function (data) {
                //console.log(data);
                console.log('Submission successful.');
                $('#dropdownlist0').html(data);
                
            },
            error: function (data) {
              console.log('An error occurred.');
              console.log(data);
            },
        });
        $(document).on('click', '.dropClass', function(){  
        var divId = $(this).parent('div').attr('id');
        alert(divId);
        // var  mm = $(this).find('option:selected').attr('selected',true);;
        // alert(mm);
        var menuId = this.value;
        var BASE_URL = '{{ url('/')}}'; 
        $.ajax({
            url: BASE_URL + '/selected-menu',
            method: "POST",
            data: {menu_id: menuId},
           // dataType: 'json',
            beforeSend: function(request) {
              request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
            },
            success: function (data) {
                var len = data.length;
                var indexs = divId.split('dropdownlist');
                var newIndex = Number(indexs[1])+1;
                $('#'+divId).append('<div id="dropdownlist'+newIndex+'"></div>')
                $('#dropdownlist'+newIndex).append(data);
            },
            error: function (data) {
              console.log('An error occurred.');
              console.log(data);
            },
        });
    });
   
});
</script>


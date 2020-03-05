@extends('layouts.app')
@section('content')
<div class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Hello Teena, You are logged in!
                </div>
            </div>
        </div>
    </div> --}}

    <div>
       
        {{-- <ul>
            @foreach($menus as $menu)
                <li>
                    {{ $menu->title }}
                    @if($menu->sub_menu->count()>0)
                        {!! view('home', ['menus' => $menu->sub_menu]) !!}
                    @endif
                </li>
            @endforeach
        </ul> --}}
    </div>
</div>
@endsection

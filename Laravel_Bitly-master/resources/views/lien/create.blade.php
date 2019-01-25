@extends('layouts.app')

@section('content')
@if(session('message'))
    {{ session('message') }}
@endif
    <form action="/lien/create/"  method="post" class="col-4">
        @csrf()
        <div class="form-group">
            <input type="text" name="title" placeholder="title" class="form-control">
        </div>

        <div class="form-group">
            <input type="text" name="url" placeholder="url" class="form-control">
        </div>

        @if(Auth::check() == true)
        <div class="form-group">
            <input type="text" name="code" placeholder="code" class="form-control">
        </div>
        @endif
        @if(Auth::check() == false)
        <div class="form-group">
            <input type="hidden" name="code" placeholder="code" class="form-control">
        </div>
        @endif

        <div class="form-group">
            <input type="submit" value="Create" class="form-control">
        </div>
    </form>
@endsection
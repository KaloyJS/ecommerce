@extends('admin.layout.base')
@section('title', 'Dashboard')

@section('content')
    <div class="dashboard">
        <div class="row expanded" >
            <h2>Dashboard</h2>
            <form action="/admin" method="post" enctype="multipart/form-data">
                <input type="text" name="product" value="testing">
                <input type="file" name="image">
                <input type="submit" name="submit" value="Go">
            </form>

            {{ \App\Classes\Request::all() }}
        </div>
    </div>
@endsection
@extends('admin.layout.base')
@section('title', 'Create Product')
@section('data-page-id', 'adminProduct')

@section('content')
    <div class="add-product">
        <div class="row expanded column" >
            <h2>Add Inventory Item</h2>           
        </div>

        @include('includes.message')
        <form method="post" action="/admin/product/create">
            <div class="small-12 medium-11">
                <div class="row expanded">
                    <div class="small-12 medium-6 column">
                        <label for="">Product Name</label>
                        <input type="text" name="name" placeholder="Product name" value={{ \App\Classes\Request::old('post', 'name')}}"">
                    </div>
                </div>
            </div>
        </form>        
    </div>   
    @include('includes.delete-modal')
@endsection
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
                        <label for="">Product Name:</label>
                        <input type="text" name="name" placeholder="Product name" value="{{ \App\Classes\Request::old('post', 'name')}}">
                    </div>

                    <div class="small-12 medium-6 column">
                        <label for="">Product Price:</label>
                        <input type="text" name="price" placeholder="Product price" value="{{ \App\Classes\Request::old('post', 'price')}}">
                    </div>

                    <div class="small-12 medium-6 column">
                        <label for="">Product Category:</label>
                        <select name="category" id="product-category">
                            <option value="{{ \App\Classes\Request::old('post', 'category') ?: ""}}">
                                {{ \App\Classes\Request::old('post', 'category') ?: "Select Category"}}
                            </option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        
                    </div>

                    <div class="small-12 medium-6 column">
                        <label for="">Product Subcategory:</label>
                        <select name="subcategory" id="product-subcategory">
                            <option value="{{ \App\Classes\Request::old('post', 'subcategory') ?: ""}}">
                                {{ \App\Classes\Request::old('post', 'subcategory') ?: "Select Subcategory"}}
                            </option>
                            
                        </select>
                    </div>
                </div>
            </div>
        </form>        
    </div>   
    @include('includes.delete-modal')
@endsection
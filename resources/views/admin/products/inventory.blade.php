@extends('admin.layout.base')
@section('title', 'Manage Inventory')
@section('data-page-id', 'adminProduct')

@section('content')
    <div class="products">
        <div class="row expanded column" >
            <h2>Manage Inventory Items</h2>           
        </div>

        @include('includes.message')

        <div class="row expanded"> 
            <div class="small-12 medium-1 column">
                <a href="/admin/product/create" class="button float-right">
                    <i class="fa fa-plus"></i>Add New Products
                </a>
            </div>
        </div>

        <div class="row expanded">
            <div class="small-12 medium-11 column">
                @if(count($products))
                    <table class="hover unstripe" data-form="deleteForm">
                        <tbody>
                            <thead>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>SubCategory</th>
                                <th>Date Created</th>
                                <th width="50">Actions</th>
                            </thead>
                            @foreach($products as $product)
                                <tr>
                                    <td><img src="/{{ $product['image_path'] }}" alt="{{ $product['name'] }}" height="40" width="40"></td>
                                    <td>{{ $product['name'] }}</td>
                                    <td>{{ $product['price'] }}</td>
                                    <td>{{ $product['quantity'] }}</td>
                                    <td>{{ $product['category_name'] }}</td>
                                    <td>{{ $product['sub_category_name'] }}</td>
                                    <td>{{ $product['added'] }}</td>
                                    <td width="50" class="text-right admin-categories-actions"> 
                                        <span data-tooltip tabindex="1" title="Edit Product" class="has-tip top">
                                            <a href="/admin/product/{{ $product['id'] }}/edit"><i class="fa fa-edit" ></i></a>
                                        </span>      

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {!!  $links !!}
                @else
                    <p>No Categories created</p>
                @endif
            </div>
        </div>
    </div>
    
@endsection
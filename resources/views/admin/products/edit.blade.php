@extends('admin.layout.base')
@section('title', 'Edit Product')
@section('data-page-id', 'adminProduct')

@section('content')
    <div class="add-product">
        <div class="row expanded column" >
            <h2>Edit {{ $product->name }}</h2>           
        </div>

        @include('includes.message')
        <form method="post" action="/admin/product/edit" enctype="multipart/form-data">
            <div class="small-12 medium-11">
                <div class="row expanded">
                    <div class="small-12 medium-6 column">
                        <label for="">Product Name:</label>
                        <input type="text" name="name" value="{{ $product->name }}">
                    </div>

                    <div class="small-12 medium-6 column">
                        <label for="">Product Price:</label>
                        <input type="text" name="price" placeholder="Product price" value="{{ $product->price }}">
                    </div>

                    <div class="small-12 medium-6 column">
                        <label for="">Product Category:</label>
                        <select name="category" id="product-category">
                            <option value="{{ $product->category->id }}">
                                {{ $product->category->name }}
                            </option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        
                    </div>

                    <div class="small-12 medium-6 column">
                        <label for="">Product Subcategory:</label>
                        <select name="subcategory" id="product-subCategory">
                            <option value="{{ $product->subCategory->id }}">
                                {{ $product->subCategory->name }}
                            </option>
                            
                        </select>
                    </div>

                    <div class="small-12 medium-6 column">
                        <label for="">Product Quantity:</label>
                        <select name="quantity">
                            <option value="{{ $product->quantity }}">
                                {{ $product->quantity }}
                            </option>
                            
                            @for ($i = 1; $i <= 50; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        
                    </div>

                    <div class="small-12 medium-6 column">
                        <br/>
                        <div class="input-group">
                            <span class="input-group-label">Product Image:</span>
                            <input type="file" name="productImage" class="input-group-field">
                        </div>                        
                    </div>

                    <div class="small-12 column">
                        <label>Description:
                            <textarea name="description" placeholder="Description">{{ $product->description }}</textarea>
                        </label>
                        <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::_token() }}">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <input class="button warning float-right" type="Submit" value="Update Product"/>
                    </div>
                </div>
            </div>
        </form> 

        <!-- Delete Button -->
        <div class="row expanded">
            <div class="small-12 medium-11">
                <table data-form="deleteForm">
                    <tr style="border: 1px solid #ffff !important;">
                        <td style="border: 1px solid #ffff !important;">
                            <form action="/admin/product/{{$product->id}}/delete" method="POST" class="delete-item" >
                                <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::_token() }}">
                                <button type="submit" class="button alert">Delete Product</button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </div>   
    @include('includes.delete-modal')
@endsection
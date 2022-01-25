@extends('admin.layout.base')
@section('title', 'Product Categories')
@section('data-page-id', 'adminCategories')

@section('content')
    <div class="category">
        <div class="row expanded column" >
            <h2>Product Categories</h2>           
        </div>

        @include('includes.message')

        <div class="row expanded">
            <div class="small-12 medium-6 column">
                <form action="" method="post">
                    <div class="input-group">
                        <input type="text" class="input-group-field" placeholder="Search by name">
                        <div class="input-group-button">
                            <input type="submit" class="button" value="Search">
                        </div>
                    </div>
                </form> 
            </div>

            <div class="small-12 medium-5 column end">
                <form action="/admin/product/categories" method="post" autocomplete="off">
                    <div class="input-group">
                        <input type="text" class="input-group-field" name="name" placeholder="Category name">
                        <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::_token() }}">
                        <div class="input-group-button">
                            <input type="submit" class="button" value="Create category">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row expanded">
            <div class="small-12 medium-11 column">
                @if(count($categories))
                    <table class="hover unstripe" data-form="deleteForm">
                        <tbody>
                            <thead>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Date Created</th>
                                <th width="50">Actions</th>
                            </thead>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category['name'] }}</td>
                                    <td>{{ $category['slug'] }}</td>
                                    <td>{{ $category['added'] }}</td>
                                    <td width="50" class="text-right admin-categories-actions"> 
                                        <span data-tooltip tabindex="1" title="Add Sub-category" class="has-tip top">
                                            <a data-open="add-subcategory-{{$category['id']}}"><i class="fa fa-plus" ></i></a>
                                        </span>       
                                        <span data-tooltip tabindex="1" title="Edit Category" class="has-tip top">
                                            <a data-open="item-{{$category['id']}}"><i class="fa fa-edit" ></i></a>
                                        </span>
                                        <span style="display: inline-block" data-tooltip tabindex="1" title="Delete Category" class="has-tip top">
                                           <form action="/admin/product/categories/{{$category['id']}}/delete" method="POST" class="delete-item" >
                                                <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::_token() }}">
                                                <button type="submit"><i class="fa fa-times delete"></i></button>
                                           </form>
                                        </span> 

                                        {{-- Edit Category Modal --}}
                                        <div class="reveal" id="item-{{$category['id']}}" 
                                            data-reveal data-close-on-click="false" data-close-on-esc="false"
                                            data-animation-in="scale-in-up" data-animation-out="scale-out-down">
                                            <div class="notification callout primary"></div>
                                            <h2>Edit Category</h2>
                                            <form autocomplete="off">
                                                <div class="input-group">
                                                    <input type="text"  name="name" value="{{ $category['name'] }}">
                                                    <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::_token() }}">
                                                    <div>
                                                        <input type="submit" class="button update-category" id="{{ $category['id'] }}" value="Update">
                                                    </div>
                                                </div>
                                            </form>
                                            <a href="/admin/product/categories" class="close-button" aria-label="Close modal" type="button">
                                                <span aria-hidden="true">&times;</span>
                                            </a>
                                        </div>

                                        {{-- Add Subcategory Modal --}}
                                        <div class="reveal" id="add-subcategory-{{$category['id']}}" 
                                            data-reveal data-close-on-click="false" data-close-on-esc="false"
                                            data-animation-in="scale-in-up" data-animation-out="scale-out-down">
                                            <div class="notification callout primary"></div>
                                            <h2>Add Subcategory</h2>
                                            <form autocomplete="off">
                                                <div class="input-group">
                                                    <input type="text"  name="name"> 
                                                    <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::_token() }}">

                                                    <div>
                                                        <input type="submit" class="button add-subcategory" id="{{ $category['id'] }}" value="Add Sub-category">
                                                    </div>
                                                </div>
                                            </form>
                                            <a href="/admin/product/categories" class="close-button" aria-label="Close modal" type="button">
                                                <span aria-hidden="true">&times;</span>
                                            </a>
                                        </div>
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

    <div class="subcategory">
        <div class="row expanded column" >
            <h2>Subcategories</h2>
        </div>    

        <div class="row expanded">
            <div class="small-12 medium-11 column">
                @if(count($subcategories))
                    <table class="hover unstripe" data-form="deleteForm">
                        <tbody>
                            <thead>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Date Created</th>
                                <th width="50">Actions</th>
                            </thead>
                            @foreach($subcategories as $subcategory)
                                <tr>
                                    <td>{{ $subcategory['name'] }}</td>
                                    <td>{{ $subcategory['slug'] }}</td>
                                    <td>{{ $subcategory['added'] }}</td>
                                    <td width="50" class="text-right admin-categories-actions"> 
                                             
                                        <span data-tooltip tabindex="1" title="Edit Subcategory" class="has-tip top">
                                            <a data-open="item-subcategory-{{$subcategory['id']}}"><i class="fa fa-edit" ></i></a>
                                        </span>
                                        <span style="display: inline-block" data-tooltip tabindex="1" title="Delete Subcategory" class="has-tip top">
                                           <form action="/admin/product/subcategories/{{$subcategory['id']}}/delete" method="POST" class="delete-item" >
                                                <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::_token() }}">
                                                <button type="submit"><i class="fa fa-times delete"></i></button>
                                           </form>
                                        </span> 

                                        {{-- Edit Subcategory Modal --}}
                                        <div class="reveal" id="item-subcategory-{{$subcategory['id']}}" 
                                            data-reveal data-close-on-click="false" data-close-on-esc="false"
                                            data-animation-in="scale-in-up" data-animation-out="scale-out-down">
                                            <div class="notification callout primary"></div>
                                            <h2>Edit Subcategory</h2>
                                            <form autocomplete="off">
                                                <div class="input-group">
                                                    <label for="name">Change Name</label>
                                                    <input type="text"  name="name" value="{{ $subcategory['name'] }}">
                                                    <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::_token() }}">

                                                    <label for="category_id">Change Category</label>
                                                        <select name="category_id">                                                            
                                                            @foreach(\App\Models\Category::all() as $category)
                                                                <option value="{{ $category['id'] }}" 
                                                                        {{ $category['id'] == $subcategory['category_id'] ? 'selected' : '' }}
                                                                >
                                                                    {{ $category['name'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    <div>
                                                        <input type="submit" class="button update-subcategory" id="{{ $subcategory['id'] }}" value="Update">
                                                    </div>
                                                </div>
                                            </form>
                                            <a href="/admin/product/categories" class="close-button" aria-label="Close modal" type="button">
                                                <span aria-hidden="true">&times;</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {!!  $subcategories_links !!}
                @else
                    <p>No Subcategories created</p>
                @endif
            </div>
        </div>
    </div>
    @include('includes.delete-modal')
@endsection
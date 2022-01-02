@extends('admin.layout.base')
@section('title', 'Product Category')

@section('content')
    <div class="dashboard">
        <div class="row expanded" >
            <h2>Product Categories</h2>  
        </div>

        @if($message)
            <p>{{ $message }}</p>
        @endif

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
                <form action="/admin/product/categories" method="post">
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
                    <table class="hover">
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->created_at->toFormattedDateString() }}</td>
                                    <td width="100" class="text-right">
                                        <a href="#"><i class="fa fa-edit"></i></a>
                                        <a href="#"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h3>No Categories created</h3>
                @endif
            </div>
        </div>
    </div>
@endsection
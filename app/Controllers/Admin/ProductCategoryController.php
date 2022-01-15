<?php

namespace App\Controllers\Admin;

use App\Classes\Request;
use App\Classes\Utility;
use App\Models\Category;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;

class ProductCategoryController
{
    public function show()
    {
        $categories = Category::all();
        $message = "Hi there";
        return view('admin/products/categories', compact('categories', 'message'));
    }

    public function store()
    {
        // check if post request exists
        if (Request::has('post')) {
            // gather all of $_POST values
            $request = Request::get('post');

            // check if request token is valid, process the form data            
            if (CSRFToken::verifyCSRFToken($request->token)) {
                $rules = [
                    'name' => ['required' => true, 'maxLength' => 5, 'string' => true, 'unique' => 'categories']
                ];

                $validate = new ValidateRequest();
                $validate->abide($_POST, $rules);

                // check if any validation errors occurred
                if ($validate->hasError()) {
                    Utility::printArr($validate->getErrorMessages());
                    exit();
                }

                Category::create([
                    'name' => $request->name,
                    'slug' => slug($request->name)
                ]);

                $categories = Category::all();
                $message = 'Category Created';
                return view('admin/products/categories', compact('categories', 'message'));
            }
            throw new \Exception('Token mismatch');
        }

        return null;
    }
}
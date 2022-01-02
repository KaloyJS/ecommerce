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

        return view('admin/products/categories', compact('categories'));
    }

    public function store()
    {
        // check if post request exists
        if (Request::has('post')) {
            // gather all of $_POST values
            $request = Request::get('post');
            // Form Validation
            $data = ValidateRequest::maxLength('name', $request->name, 6);

            if ($data) {
                echo "All Good";
            } else {
                echo "Field is below the minimum length required";
            }
            exit;

            // check if request token is valid, process the form data            
            if (CSRFToken::verifyCSRFToken($request->token)) {
                # code...
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
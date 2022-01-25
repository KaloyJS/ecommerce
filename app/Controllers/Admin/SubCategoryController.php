<?php

namespace App\Controllers\Admin;

use App\Classes\Request;
use App\Classes\Session;
use App\Classes\Utility;
use App\Models\Category;
use App\Classes\Redirect;
use App\Classes\CSRFToken;
use App\Models\SubCategory;
use App\Classes\ValidateRequest;
use App\Controllers\BaseController;

class SubCategoryController extends BaseController
{

    public function store()
    {
        // check if post request exists
        if (Request::has('post')) {
            // gather all of $_POST values
            $request = Request::get('post');
            $extra_errors = [];

            // check if request token is valid, process the form data            
            if (CSRFToken::verifyCSRFToken($request->token, false)) {
                $rules = [
                    'name' => ['required' => true, 'minLength' => 3, 'string' => true],
                    'category_id' => ['required' => true]
                ];

                $validate = new ValidateRequest();
                $validate->abide($_POST, $rules);

                $duplicate_subcategory = SubCategory::where('name', $request->name)
                    ->where('category_id', $request->category_id)->exists();
                if ($duplicate_subcategory) {
                    $extra_errors['name'] = array('Subcategory already exists');
                }

                $category = Category::where('id', $request->category_id)->exists();
                if (!$category) {
                    $extra_errors['name'] = array('Invalid product category.');
                }

                // check if any validation errors occurred
                if ($validate->hasError() || $duplicate_subcategory || !$category) {
                    $errors = $validate->getErrorMessages();
                    $response = count($extra_errors) ?  array_merge($errors, $extra_errors) : $errors;
                    header('HTTP/1.1 422 Unrpocessable Entity', true, 422);
                    echo json_encode($response);
                    exit();
                }

                SubCategory::create([
                    'name' => $request->name,
                    'category_id' => $request->category_id,
                    'slug' => slug($request->name)
                ]);

                echo json_encode(['success' => 'Subcategory created successfully']);
                exit();
            }
            throw new \Exception('Token mismatch');
        }

        return null;
    }

    public function edit($id)
    {
        // check if post request exists
        if (Request::has('post')) {
            // gather all of $_POST values
            $request = Request::get('post');
            $extra_errors = [];

            // check if request token is valid, process the form data            
            if (CSRFToken::verifyCSRFToken($request->token, false)) {
                $rules = [
                    'name' => ['required' => true, 'minLength' => 3, 'string' => true],
                    'category_id' => ['required' => true]
                ];

                $validate = new ValidateRequest();
                $validate->abide($_POST, $rules);

                $duplicate_subcategory = SubCategory::where('name', $request->name)
                    ->where('category_id', $request->category_id)->exists();
                if ($duplicate_subcategory) {
                    $extra_errors['name'] = array('You have not made any changes');
                }

                $category = Category::where('id', $request->category_id)->exists();
                if (!$category) {
                    $extra_errors['name'] = array('You have not made any changes');
                }

                // check if any validation errors occurred
                if ($validate->hasError() || $duplicate_subcategory || !$category) {
                    $errors = $validate->getErrorMessages();
                    $response = count($extra_errors) ?  array_merge($errors, $extra_errors) : $errors;
                    header('HTTP/1.1 422 Unrpocessable Entity', true, 422);
                    echo json_encode($response);
                    exit();
                }

                SubCategory::where('id', $id)->update([
                    'name' => $request->name,
                    'category_id' => $request->category_id
                ]);
                echo json_encode(['success' => 'Subcategory updated successfully']);
                exit();
            }
            throw new \Exception('Token mismatch');
        }

        return null;
    }

    public function delete($id)
    {
        // check if post request exists
        if (Request::has('post')) {
            // gather all of $_POST values
            $request = Request::get('post');

            // check if request token is valid, process the form data            
            if (CSRFToken::verifyCSRFToken($request->token)) {
                SubCategory::destroy($id);
                Session::add('success', 'SubCategory Deleted');
                Redirect::to('/admin/product/categories');
            }
            throw new \Exception('Token mismatch');
        }

        return null;
    }
}
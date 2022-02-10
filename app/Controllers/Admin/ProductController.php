<?php

namespace App\Controllers\Admin;

use App\Models\Product;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\Utility;
use App\Models\Category;
use App\Classes\Redirect;
use App\Classes\CSRFToken;
use App\Classes\UploadFile;
use App\Models\SubCategory;
use App\Classes\ValidateRequest;
use App\Controllers\BaseController;


class ProductController extends BaseController
{
    public $table_name = 'products';
    public $categories;
    public $links;
    public $subcategories;
    public $subcategories_links;

    public function __construct()
    {
        $this->categories = Category::all();

        // list($this->categories, $this->links) = paginate(6, $total, $this->table_name, $object);
        // list($this->subcategories, $this->subcategories_links) = paginate(6, $subcategoriesTotal, 'sub_categories', $subcategories_object);
    }

    public function showCreateProductForm()
    {
        $categories = $this->categories;
        return view('admin/products/create', compact('categories'));
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
                    'name' => ['required' => true, 'minLength' => 3, 'maxLength' => 70, 'mixed' => true, 'unique' => $this->table_name],
                    'price' => ['required' => true, 'minLength' => 2, 'number' => true],
                    'quantity' => ['required' => true],
                    'category' => ['required' => true],
                    'subcategory' => ['required' => true],
                    'description' => ['required' => true, 'mixed' => true, 'minLength' => 4, 'maxLength' => 500]
                ];

                $validate = new ValidateRequest();
                $validate->abide($_POST, $rules);


                $file = Request::get('file');
                isset($file->productImage->name) ? $filename = $file->productImage->name : $filename = "";

                $file_error = [];
                if (empty($filename)) {
                    $file_error['productImage'] = ['Image file is required'];
                } else if (!UploadFile::isImage($filename)) {
                    $file_error['productImage'] = ['Only image files allowed, please try again.'];
                }

                // check if any validation errors occurred
                if ($validate->hasError()) {
                    $response = $validate->getErrorMessages();
                    count($file_error) ? $errors = array_merge($response, $file_error) : $errors = $response;
                    return view('admin/products/create', [
                        'categories' => $this->categories,
                        'links' => $this->links,
                        'errors' => $errors
                    ]);
                }

                $ds = DIRECTORY_SEPARATOR;
                $temp_file = $file->productImage->tmp_name;
                $image_path = UploadFile::move($temp_file, "images{$ds}uploads{$ds}products", $filename)->path();

                Product::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'category_id' => $request->category,
                    'sub_category_id' => $request->subcategory,
                    'image_path' => $image_path,
                    'quantity' => $request->quantity
                ]);

                Request::refresh();
                return view('admin/products/create', [
                    'categories' => $this->categories,
                    'success' => 'Record Created',
                    'subcategories' => $this->subcategories,
                    'subcategories_links' => $this->subcategories_links
                ]);
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

            // check if request token is valid, process the form data            
            if (CSRFToken::verifyCSRFToken($request->token, false)) {
                $rules = [
                    'name' => ['required' => true, 'minLength' => 3, 'string' => true, 'unique' => 'categories']
                ];

                $validate = new ValidateRequest();
                $validate->abide($_POST, $rules);

                // check if any validation errors occurred
                if ($validate->hasError()) {
                    $errors = $validate->getErrorMessages();
                    header('HTTP/1.1 422 Unrpocessable Entity', true, 422);
                    echo json_encode($errors);
                    exit();
                }

                Category::where('id', $id)->update(['name' => $request->name]);
                echo json_encode(['success' => 'Record Update Successfully']);
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
                Category::destroy($id);
                // check if category has subcategories, 
                // if so delete also subcategories
                $subcategories = SubCategory::where('category_id', $id)->get();
                if (count($subcategories)) {
                    foreach ($subcategories as $key => $subcategory) {
                        $subcategory->delete();
                    }
                }
                // add success message to session
                Session::add('success', 'Category Deleted');
                Redirect::to('/admin/product/categories');
            }
            throw new \Exception('Token mismatch');
        }

        return null;
    }

    public function getSubcategories($id)
    {
        $subcategories = SubCategory::where('category_id', $id)->get();
        echo json_encode($subcategories);
        exit();
    }
}
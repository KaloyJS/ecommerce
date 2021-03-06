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
    public $products;
    public $categories;
    public $links;
    public $subcategories;
    public $subcategories_links;

    public function __construct()
    {
        $this->categories = Category::all();
        $total = count(Product::all());

        list($this->products, $this->links) = paginate(10, $total, $this->table_name, new Product);
    }

    public function show()
    {
        $products = $this->products;
        $links = $this->links;
        return view('admin/products/inventory', compact('products', 'links'));
    }

    public function showEditProductForm($id)
    {
        $categories = $this->categories;
        $product = Product::where('id', $id)->with(['category', 'subCategory'])->first();
        return view('admin/products/edit', compact('product', 'categories'));
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
            if (CSRFToken::verifyCSRFToken($request->token)) {
                $rules = [
                    'name' => ['required' => true, 'minLength' => 3, 'maxLength' => 70, 'mixed' => true],
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

                if (isset($file->productImage->name) && !UploadFile::isImage($filename)) {
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

                $product = Product::findOrFail($request->product_id);
                $product->name = $request->name;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->category_id = $request->category;
                $product->sub_category_id = $request->subcategory;

                if ($filename) {
                    $ds = DIRECTORY_SEPARATOR;
                    $old_image_path = BASE_PATH . "{$ds}public{$ds}$product->image_path";
                    $temp_file = $file->productImage->tmp_name;
                    $image_path = UploadFile::move($temp_file, "images{$ds}uploads{$ds}products", $filename)->path();
                    unlink($old_image_path);
                    $product->image_path = $image_path;
                }
                $product->save();
                Session::add('success', 'Record Updated');
                Redirect::to('/admin/products');
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
                Product::destroy($id);
                // add success message to session
                Session::add('success', 'Product Deleted');
                Redirect::to('/admin/products');
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
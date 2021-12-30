<?php

namespace App\Controllers\Admin;

use App\Classes\Utility;
use App\Models\Category;

class ProductCategoryController
{
    public function show()
    {
        $categories = Category::all();
        Utility::printArr($categories);
    }

    public function store()
    {
    }
}
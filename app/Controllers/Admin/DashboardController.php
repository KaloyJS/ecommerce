<?php

namespace App\Controllers\Admin;

use App\Classes\Request;
use App\Classes\Session;
use App\Classes\Utility;
use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function show()
    {
        Session::Add('admin', 'You are welcome, admin user');
        Session::remove('admin');

        if (Session::has('admin')) {
            $msg = Session::get('admin');
        } else {
            $msg = 'Not defined';
        }

        return view('admin/dashboard', ['admin' => $msg]);
    }

    public function get()
    {
        Request::refresh();
        $data = Request::old('post', 'product');
        Utility::printArr($data);

        // if (Request::has('post')) {
        //     $request = Request::get('post');
        //     Utility::printArr($request->product);
        // } else {
        //     return var_dump("posting does not exist");
        // }
    }
}
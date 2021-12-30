<?php

namespace App\Controllers;

use App\Classes\Mail;

class IndexController extends BaseController
{
    public function show()
    {

        echo "Inside homepage from controller class";
        // $mail = new Mail();
        // $data = [
        //     "to" => "kaloywebdev@gmail.com",
        //     "subject" => "Welcome to TindahanKo Online Store",
        //     "view" => "welcome",
        //     "name" => "John Doe",
        //     "body" => "Testing email template"
        // ];

        // if ($mail->send($data)) {
        //     echo "Email sent successfully";
        // } else {
        //     echo "Email sending failed";
        // }

    }
}
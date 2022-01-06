<?php

namespace App\Classes;

class ErrorHandler
{
    public function handleErrors($error_number, $error_message, $error_file, $error_line)
    {
        // echo $error_message;
        // exit();
        // create error message from arguments
        $error = "[{$error_number}] and error occurred in 
                    file {$error_file} on line {$error_line}: {$error_message}";

        $environment = $_ENV['APP_ENV'];
        // if environment is local use Custom Error handler whoops
        if ($environment === 'localhost') {
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();
        } else {
            // if production send email to administrator and display error message
            $data = [
                "to" => $_ENV['ADMIN_EMAIL'],
                "subject" => "System Error",
                "view" => "error",
                "name" => "Admin",
                "body" => $error
            ];

            ErrorHandler::emailAdmin($data)->outputFriendlyError();
        }
    }

    public function outputFriendlyError()
    {
        ob_end_clean();
        view('errors/generic');
        exit();
    }

    public static function emailAdmin($data)
    {
        $mail = new Mail();
        $mail->send($data);
        return new static;
    }
}
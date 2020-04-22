<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        return view('welcome');
    }

    public function widget_remote_ajax(string $page_uid)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        return view('widget_remote_ajax', ['page_uid' => $page_uid]);
    }
    public function widget_local_submit(string $page_uid)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        return view('widget_local_submit', ['page_uid' => $page_uid]);
    }
    public function widget_local_ajax(string $page_uid)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        return view('widget_local_ajax', ['page_uid' => $page_uid]);
    }
}

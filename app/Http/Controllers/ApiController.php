<?php

namespace App\Http\Controllers;

use App\Helpers\RemoteData;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function run(string $page_uid, Request $request)
    {
        $id = trim($request->input('id'));
        $method = trim($request->input('method'));
        $params = $request->input('params');
        $params['id'] = $id;

        $result = RemoteData::sSendData($page_uid, $method, $params, null, true);
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($result);
        exit();
    }
}

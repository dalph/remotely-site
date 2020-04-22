<?php

namespace App\Helpers;

class RemoteData
{
    protected static $id = 0;
    protected static function _getApiUrl()
    {
        return 'http://remotely-data.1test24.ru/api';
    }

    protected static function _sendData(string $pageUid, string $method, array $params = [], $callback = null)
    {
        $params['page_uid'] = $pageUid;
        $data = ["jsonrpc" => "2.0", "method" => $method, "params" => $params, "id" => ++static::$id];
        static::_sendPost(self::_getApiUrl(), $data, $callback);
    }

    protected static function _sendPost(string $queryUrl, array $data = [], $callback = null): void
    {
//        var_dump($queryUrl);
//        var_dump($data);
//        die();
        $curlHandler = curl_init();
        curl_setopt_array($curlHandler, [
            CURLOPT_URL => $queryUrl,
            CURLOPT_HTTPHEADER => [
                "charset=utf-8",
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data, '', '&'),
        ]);
        $response = curl_exec($curlHandler);
        curl_close($curlHandler);
        var_dump($response);
        if (!$response) return;
        $response = json_decode($response);
        var_dump($response);
        return;

        if ($response->error){
            throw new \Exception($response->error->message ?? 'Unknow error', $response->error->code ?? 500);
        }

        if ($callback){
            call_user_func($callback, $response->result);
        }
    }

    public static function sGetMessages(string $pageUid, $callback = null): void
    {
        self::_sendData($pageUid,'getMessages', [], $callback);
    }
    public static function sSendMessage(string $pageUid, array $params, $callback = null): void
    {
        self::_sendData($pageUid,'sendMessages', $params, $callback);
    }
}
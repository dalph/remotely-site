<?php

namespace App\Helpers;

class RemoteData
{
    protected static $id = 0;
    protected static function _getApiUrl()
    {
        return 'http://remotely-data.1test24.ru/api';
    }

    public static function sSendData(string $pageUid, string $method, array $params = [], $callback = null, bool $raw = false)
    {
        $params['page_uid'] = $pageUid;

        $id = $params['id'] ?? ++static::$id;
        $data = ["jsonrpc" => "2.0", "method" => $method, "params" => $params, "id" => $id];
        return static::_sendPost(self::_getApiUrl(), $data, $callback, $raw);
    }

    protected static function _sendPost(string $queryUrl, array $data = [], $callback = null, bool $raw = false)
    {
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
        if (!$response) return null;
        $response = json_decode($response);
        if ($raw) return $response;

        if ($response->error ?? false){
            throw new \Exception($response->error->message ?? 'Unknow error', $response->error->code ?? 500);
        }

        if ($callback){
            call_user_func($callback, $response->result);
        }
        return null;
    }

    public static function sGetMessages(string $pageUid, $callback = null): void
    {
        self::sSendData($pageUid,'getMessages', [], $callback);
    }
    public static function sSendMessage(string $pageUid, array $params, $callback = null): void
    {
        self::sSendData($pageUid,'sendMessage', $params, $callback);
    }
}
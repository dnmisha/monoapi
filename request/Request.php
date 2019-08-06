<?php
/**
 * Created by PhpStorm.
 * User: mihailvysocin
 * Date: 8/6/19
 * Time: 1:37 PM
 */

namespace dnmisha\monoapi\request;


class Request
{
    public $methodUrl = '';
    public $methodType = 'GET';

    private $baseUrl = '';
    private $token = null;
    private $params = [];

    public function __construct($baseUrl, $token, $params = [])
    {
        $this->baseUrl = $baseUrl;
        $this->token = $token;
        $this->params = $params;
    }

    public function sent()
    {
        $ch = curl_init($this->getRequestUrl());
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->methodType);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($this->params))
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "X-Token: {$this->token}"
        ));
        $data = curl_exec($ch);

        $result = json_decode($data);

        return $result;
    }

    public function getRequestUrl()
    {
        return $this->baseUrl . $this->methodUrl;
    }
}

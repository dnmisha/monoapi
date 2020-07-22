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
    public $token = null;
    private $params = [];

    public $headers = [];

    public function __construct($baseUrl, $token, $params = '')
    {
        $this->baseUrl = $baseUrl;
        $this->token = $token;
        $this->params = $params;

        if (is_string($token)){
            $this->headers = ["X-Token: {$this->token}"];
        }
    }

    /**
     * @return mixed
     */
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
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        $data = curl_exec($ch);

        return json_decode($data);
    }

    /**
     * @return string
     */
    public function getRequestUrl()
    {
        return $this->baseUrl . $this->methodUrl;
    }

    /**
     * @param $stringSign
     * @return string
     */
    public function getSign($stringSign)
    {
        $keyFile = openssl_get_privatekey(file_get_contents($this->token["pathToKeyFile"]), "");
        openssl_sign($stringSign, $newKeyString, $keyFile, OPENSSL_ALGO_SHA256);
        openssl_free_key($keyFile);

        return base64_encode($newKeyString);
    }
}

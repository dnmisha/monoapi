<?php
/**
 * Created by PhpStorm.
 * User: Amac
 * Date: 17.07.2020
 * Time: 16:05
 */

namespace dnmisha\monoapi\request;


class AccessInitialization extends Request
{
    public $methodUrl = "/personal/auth/request";
    public $methodType = 'POST';
    const PERMISSIONS = 'sp';

    public function __construct($baseUrl, $token, $params = '')
    {
        parent::__construct($baseUrl, $token, $params);

        if (is_array($token)) {
            $time = time();
            $stringSign = $time . $this::PERMISSIONS . $this->methodUrl;
            $sign = $this->getSign($stringSign);
            $callbackUrl = !empty($this->token['callbackUrl']) ? $this->token['callbackUrl'] : '';

            $this->headers = [
                "X-Key-Id: {$this->token['serviceId']}",
                "X-Time: {$time}",
                "X-Permissions: " . $this::PERMISSIONS,
                "X-Sign: {$sign}",
                "X-Callback: {$callbackUrl}",
            ];
        }
    }
}

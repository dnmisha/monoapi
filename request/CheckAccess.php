<?php
/**
 * Created by PhpStorm.
 * User: Amac
 * Date: 20.07.2020
 * Time: 20:33
 */

namespace dnmisha\monoapi\request;


use Exception;

class CheckAccess extends Request
{
    public $methodUrl = '/personal/auth/request';

    public function __construct($baseUrl, $token, $params = '')
    {
        parent::__construct($baseUrl, $token, $params);

        if (is_array($token)) {

            if (empty($this->token['tokenRequestId'])) {
                throw new Exception('Requires parameter [\'tokenRequestId\']', 400);
            }

            $time = time();
            $stringSign = $time . $this->token['tokenRequestId'] . $this->methodUrl;
            $sign = $this->getSign($stringSign);

            $this->headers = [
                "X-Key-Id: {$this->token['serviceId']}",
                "X-Time: {$time}",
                "X-Request-Id: {$this->token['tokenRequestId']}",
                "X-Sign: {$sign}",
            ];
        }
    }

}

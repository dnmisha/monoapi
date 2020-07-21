<?php

namespace dnmisha\monoapi\request;

class Statement extends Request
{
    private $account;
    private $from;
    private $to;

    public $methodUrl = "/personal/statement/{account}/{from}/{to}";

    public function __construct($baseUrl, $token, $params = '')
    {
        return parent::__construct($baseUrl, $token, $params);
    }

    public function setHeaders()
    {
        if (is_array($this->token)) {

            if (empty($this->token['tokenRequestId'])) {
                throw new Exception('Requires parameter [\'tokenRequestId\']', 400);
            }

            $time = time();
            $stringSign = $time . $this->token['tokenRequestId'] . $this->getUrl();
            $sign = $this->getSign($stringSign);

            $this->headers = [
                "X-Key-Id: {$this->token['serviceId']}",
                "X-Time: {$time}",
                "X-Request-Id: {$this->token['tokenRequestId']}",
                "X-Sign: {$sign}",
                "account: {$this->account}",
                "from: {$this->from}",
                "to: {$this->to}",
            ];
        }
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        $this->methodUrl = str_replace('{account}', $this->account, $this->methodUrl);
        $this->methodUrl = str_replace('{from}', $this->from, $this->methodUrl);
        $this->methodUrl = str_replace('{to}', $this->to, $this->methodUrl);

        return $this->methodUrl;
    }

    /**
     * @return string
     */
    public function getRequestUrl()
    {
        $this->methodUrl = str_replace('{account}', $this->account, $this->methodUrl);
        $this->methodUrl = str_replace('{from}', $this->from, $this->methodUrl);
        $this->methodUrl = str_replace('{to}', $this->to, $this->methodUrl);

        return parent::getRequestUrl();
    }

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param mixed $account
     */
    public function setAccount($account)
    {
        $this->account = $account;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }
}

<?php

namespace dnmisha\monoapi\request;

class Statement extends Request
{
    private $account;
    private $from;
    private $to;

    public $methodUrl = "/personal/statement/{account}/{from}/{to}";

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

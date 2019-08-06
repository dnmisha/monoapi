<?php

namespace dnmisha\monoapi;

use dnmisha\monoapi\request\RequestHandler;
use dnmisha\monoapi\request\Statement;
use dnmisha\monoapi\request\WebHook;

/**
 * Class MonobankApi
 * @package dnmisha\monoapi
 */
class MonobankApi
{
    private $request = null;

    /**
     * MonobankApi constructor.
     * @param $baseUrl
     * @param $token
     */
    public function __construct($baseUrl, $token)
    {
        $this->request = new RequestHandler($baseUrl, $token);
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->request->get('Currency')->sent();
    }

    /**
     * @param $account
     * @param $from
     * @param $to
     * @return mixed
     */
    public function getStatement($account, $from, $to)
    {
        /**
         * @var $request Statement
         */
        $request = $this->request->get('Statement');
        $request->setAccount($account);
        $request->setFrom($from);
        $request->setTo($to);

        return $request->sent();
    }

    public function setWebHook($url)
    {
        /**
         * @var $request WebHook
         */
        $request = $this->request->get('WebHook');
        $request->setHookUrl($url);

        return $request->sent();
    }

    /**
     * @return mixed
     */
    public function getClientInfo()
    {
        return $this->request->get('ClientInfo')->sent();
    }
}

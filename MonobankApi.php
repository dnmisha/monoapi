<?php

namespace dnmisha\monoapi;

use dnmisha\monoapi\request\RequestHandler;
use dnmisha\monoapi\request\Statement;
use dnmisha\monoapi\request\WebHook;
use Exception;
use ReflectionException;

/**
 * Class MonobankApi
 * @package dnmisha\monoapi
 */
class MonobankApi
{
    private $request = null;
    private $baseUrl = 'https://api.monobank.ua';

    /**
     * MonobankApi constructor.
     *
     * If corporate access is used then $token array otherwise string
     * use array keys
     * [required] $token['serviceId'] - corporate id,
     * [required] $token['pathToKeyFile'] - path to corporate key file
     * [optional] $token['tokenRequestId'] - token client
     * [optional] $token['callbackUrl'] - callback Url for initialization
     * @param $token array|string
     *
     * @throws Exception
     */
    public function __construct($token)
    {

        if (is_array($token)) {
            if (empty($token['serviceId'])) {
                throw new Exception('[\'serviceId\'] cannot be empty', 400);
            } elseif (empty($token['pathToKeyFile'])) {
                throw new Exception('[\'pathToKeyFile\'] cannot be empty', 400);
            } elseif (!file_exists($token['pathToKeyFile'])) {
                throw new Exception("file does not exist in the path " . $token['pathToKeyFile'], 400);
            }
        }

        $this->request = new RequestHandler($this->baseUrl, $token);
    }

    /**
     * @param $url
     */
    public function setBaseUrl($url)
    {
        $this->baseUrl = $url;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @return mixed
     * @throws ReflectionException
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
     * @throws ReflectionException
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
        $request->setHeaders();

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
     * @throws ReflectionException
     */
    public function getClientInfo()
    {
        return $this->request->get('ClientInfo')->sent();
    }

    /**
     * @return mixed
     * @throws ReflectionException
     */
    public function init()
    {
        return $this->request->get('AccessInitialization')->sent();
    }

    /**
     * @return mixed
     * @throws ReflectionException
     */
    public function checkAccess()
    {
        return $this->request->get('CheckAccess')->sent();
    }

}

<?php

namespace dnmisha\monoapi\request;

/**
 * Class RequestHandler
 * @package dnmisha\monoapi\request
 */
class RequestHandler
{
    private $baseUrl;
    private $token;

    /**
     * RequestHandler constructor.
     * @param $baseUrl
     * @param $token
     */
    public function __construct($baseUrl, $token)
    {
        $this->baseUrl = $baseUrl;
        $this->token = $token;
    }

    /**
     * @param $className
     * @param string $params
     * @return AbstractRequest
     * @throws \ReflectionException
     */
    public function get($className, $params = ''){
        $class = new \ReflectionClass($this);
        $className = $class->getNamespaceName().'\\'.$className;
        /**
         * @var $object AbstractRequest
         */
        $object = new $className($this->baseUrl, $this->token, $params);

        return $object;
    }
}

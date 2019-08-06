<?php
/**
 * Created by PhpStorm.
 * User: mihailvysocin
 * Date: 8/6/19
 * Time: 1:42 PM
 */

namespace dnmisha\monoapi\request;


class RequestHandler
{
    private $baseUrl;
    private $token;

    public function __construct($baseUrl, $token)
    {
        $this->baseUrl = $baseUrl;
        $this->token = $token;
    }

    /**
     * @param $className string
     */
    public function get($className, $params = []){
        $class = new \ReflectionClass($this);
        $className = $class->getNamespaceName().'\\'.$className;
        /**
         * @var $object AbstractRequest
         */
        $object = new $className($this->baseUrl, $this->token, $params);

        return $object;
    }
}

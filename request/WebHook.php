<?php

namespace dnmisha\monoapi\request;

class WebHook extends Request
{
    public $hookUrl = '';

    public $methodUrl = '/personal/webhook';

    /**
     * @return string
     */
    public function getHookUrl()
    {
        return $this->hookUrl;
    }

    /**
     * @param string $hookUrl
     */
    public function setHookUrl($hookUrl)
    {
        $this->hookUrl = $hookUrl;
    }

}

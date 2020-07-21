# monobank php api

>composer require dnmisha/monoapi

>$api = new \dnmisha\monoapi\MonobankApi($tokenMonobankClient);

> if you use corporate access

>[required] $tokenMonobankClient['serviceId'] - corporate id,
[required] $tokenMonobankClient['pathToKeyFile'] - path to corporate key file
[optional] $tokenMonobankClient['tokenRequestId'] - token client
[optional] $tokenMonobankClient['callbackUrl'] - callback Url for initialization

###methods
>getClientInfo

>getCurrency

>getStatement($account, $from, $to)

>setWebHook($url)

>init()

>checkAccess()

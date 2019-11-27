<?php

require_once('../vendor/autoload.php');

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

// 下面为申请app获得的clientId和clientSecret，必填项，否则无法生成token。
//$clientId = 'ATnuSLiYPPpNovryQJ4ZsiD1FfR2Jelv5GBkSGNjd59Ef8SW8XEH48fFwOf7L9wcyZARGx3LanesBuvb';
//$clientSecret = 'EAadzJ40KVcpBanjhdAR13N2mxPBi2O7uQYMs8h-wMga5scKmwHEyCIOLLgQk2FLEcEOc2xS5ORwyQSo';
$clientId='Aake-rp0ZyrygdZ2p9iCUNuC4Pxi3241TuIyCRmfjPcL4vpfG55ymslP61nD_paMGds4vR08RFfFX4Pj';
$clientSecret='ED8bEHItrvZmOiu91GxLqsBNoOegmWHRfon-eVQDJH6RXxQJjFh-3FENhHw119Elm3pfAuMcMGEiLonK';


$apiContext = new ApiContext(
    new OAuthTokenCredential(
        $clientId,
        $clientSecret
    )
);

$apiContext->setConfig(
    array(
        'mode' => 'sandbox',
        'log.LogEnabled' => true,
        'log.FileName' => '../PayPal.log',
        'log.LogLevel' => 'DEBUG',
        'cache.enabled' => true
    )
);
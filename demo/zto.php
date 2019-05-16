<?php

include __DIR__ . '/../vendor/autoload.php';


// 中通快递开放平台 https://zop.zto.com/apiDoc/

$trace = new \ruoge3s\express\zto\Traces([
    'companyId'     => '中通授权的公司ID',
    'key'           => '中通授权的秘钥key'
]);

$no = '快递编号';

$res = $trace->news([$no]);

print_r($res[$no]->toArray());
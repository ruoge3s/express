<?php

include __DIR__ . '/../vendor/autoload.php';


// 中通快递开放平台 https://zop.zto.com/apiDoc/

// 查询快递轨迹信息
$trace = new \ruoge3s\express\zto\Traces([
    'companyId'     => '中通授权的公司ID',
    'key'           => '中通授权的秘钥key'
]);

$res = $trace->news([ '快递编号1', '快递编号2', ]);
print_r($res['快递编号1']->toArray());

// 自定义查询(很多接口未封装成类，可以自定义创建)
$customize = new \ruoge3s\express\zto\Customize([
    'companyId' => '中通授权的公司ID',
    'key'       => '中通授权的秘钥key',
]);

$res = $customize->setApi('根据文档查询对应的api')->setFormParams([
    'data'      => json_encode(['73127sss904pp快递单号', '73127sss904pp快递单号', '73127sss904pp快递单号']),
    // 'content'   => json_encode([]),
    // ... 根据文档中要求的接口数据进行填写, 数组格式的都要json
])->request();

var_dump($res);

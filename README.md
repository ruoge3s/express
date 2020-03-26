# express
聚合各个快递开放平台的api接口服务


## 使用composer安装
```bash
composer require ruoge3s/express
```

## 中通快递

当前仅对中通快递的物流查询接口进行了封装，其他未封装的通过自定义的方式进行请求
### 查询物流轨迹

```php
// 查询快递轨迹信息
$trace = new \ruoge3s\express\zto\Traces([
    'companyId'     => '中通授权的公司ID',
    'key'           => '中通授权的秘钥key'
]);

$res = $trace->news([ '快递编号1', '快递编号2', ]);
print_r($res['快递编号1']->toArray());
```

### 自定义查询

```php
$customize = new \ruoge3s\express\zto\Customize([
    'companyId' => '中通授权的公司ID',
    'key'       => '中通授权的秘钥key',
]);

$res1 = $customize->setApi('根据文档查询对应的api1')->setFormParams([
    'data'      => json_encode(['73127sss904pp快递单号', '73127sss904pp快递单号', '73127sss904pp快递单号']),
    // 'content'   => json_encode([]),
    // ... 根据文档中要求的接口数据进行填写, 数组格式的都要json
])->request();

var_dump($res1);

$res2 = $customize->setApi('根据文档查询对应的api2')->setFormParams([
     'content'   => json_encode([]),
    // ... 根据文档中要求的接口数据进行填写, 数组格式的都要json
])->request();

var_dump($res2);
```

## 路线图

1. 对接中通快递开放接口
2. 对接百事快递开放接口

## 问题

如何根据快递单号识别是哪家快递?

<?php

namespace ruoge3s\express\zto;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use ruoge3s\express\Attribute;
use ruoge3s\express\Config;

/**
 * Class Common
 * @property string companyId 合作商编码
 * @property string dataDigest 数据签名
 * @property array headers 请求头
 * @package ruoge3s\express\zto
 */
abstract class Common
{
    use Config;
    use Attribute;

    public $timeout = 100;

    protected $host = 'http://japi.zto.cn';

    abstract public function api() : string ;

    /**
     * @return string 请求方式
     */
    public function method(): string
    {
        return 'POST';
    }

    /**
     * @var string
     */
    protected $key;

    /**
     * @var array 参考guzzlehttp/guzzle的文档
     */
    protected $option = [
        'headers' => [
            'ContentType'   => 'Content-type: application/x-www-form-urlencoded; charset=utf-8',
        ]
    ];

    /**
     * @var Response http请求响应的对象
     */
    protected $response;

    /**
     * @return array 获取请求头信息
     */
    public function getHeaders()
    {
        return $this->option['headers'];
    }

    /**
     * 设置请求头信息
     * @param string $key 请求头名称
     * @param string $value 请求头内容
     * @return $this
     */
    public function setHeader(string $key, string $value)
    {
        $this->option['headers'][$key] = $value;
        return $this;
    }

    /**
     * 设置post的参数
     * @param array $fp
     * @return $this
     */
    public function setFormParams(array $fp)
    {
        $this->option['form_params'] = $fp;
        return $this;
    }

    /**
     * 获取post的参数
     * @return array|null
     */
    public function getFormParams()
    {
        if (isset($this->option['form_params'])) {
            return $this->option['form_params'];
        } else {
            return null;
        }
    }

    /**
     * 设置公司ID
     * @param string $cid
     * @return $this
     */
    public function setCompanyId(string $cid)
    {
        $this->option['headers']['x-companyId'] = $cid;
        return $this;
    }

    /**
     * 获取公司ID
     * @return null
     */
    public function getCompanyId()
    {
        if (isset($this->option['headers']['x-companyId'])) {
            return $this->option['headers']['x-companyId'];
        } else {
            return null;
        }
    }

    /**
     * 设置数字签名信息
     * @param string $dd
     * @return $this
     */
    public function setDataDigest(string $dd)
    {
        $this->option['headers']['x-dataDigest'] = $dd;
        return $this;
    }

    /**
     * 获取数字签名信息
     * @return string|null
     */
    public function getDataDigest()
    {
        if (isset($this->option['headers']['x-dataDigest'])) {
            return $this->option['headers']['x-dataDigest'];
        } else {
            return null;
        }
    }

    /**
     * 发起请求
     * @return array|false|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request()
    {
        $httpClient = new Client([
            'base_uri'  => $this->host,
            'timeout'   => $this->timeout,
        ]);
        $this->setDataDigest($this->signature());
        $this->response = $httpClient->request($this->method(), $this->api(), $this->option);

        if ($this->response->getStatusCode() == 200) {
            return json_decode($this->response->getBody()->getContents(), true);
        } else {
            return null;
        }
    }

    /**
     * 签名
     * @return string
     */
    public function signature()
    {
        $sign = '';
        foreach ($this->getFormParams() as $k => $v) {
            $sign = $sign . $k . '=' . $v . '&';
        }
        $sign = substr($sign, 0, -1) . $this->key;
        return base64_encode(md5($sign, TRUE));
    }
}
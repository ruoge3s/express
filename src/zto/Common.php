<?php

namespace ruoge3s\express\zto;

use GuzzleHttp\Client;

/**
 * Class Common
 * @property string companyId 合作商编码
 * @property string dataDigest 数据签名
 * @property array headers 请求头
 * @package ruoge3s\express\zto
 */
abstract class Common
{
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

    protected $headers = [
        'ContentType'   => 'Content-type: application/x-www-form-urlencoded; charset=utf-8',
    ];

    public function __construct($config=[])
    {
        foreach ($config as $property => $value) {
            $this->$property = $value;
        }
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function setHeader($key, $value)
    {
        $this->headers[$key] = $value;
        return $this;
    }

    public function setCompanyId(string $cid)
    {
        $this->headers['x-companyId'] = $cid;
        return $this;
    }

    public function getCompanyId()
    {
        if (isset($this->headers['x-companyId'])) {
            return $this->headers['x-companyId'];
        } else {
            return null;
        }
    }

    public function setDataDigest(string $dd)
    {
        $this->headers['x-dataDigest'] = $dd;
        return $this;
    }

    public function getDataDigest()
    {
        if (isset($this->headers['x-dataDigest'])) {
            return $this->headers['x-dataDigest'];
        } else {
            return null;
        }
    }

    /**
     * @param $name
     * @param $value
     * @return mixed
     * @throws \Exception
     */
    public function __set($name, $value)
    {
        $methodName = 'set' . ucfirst($name);
        if (method_exists($this, $methodName)) {
            return $this->$methodName($value);
        } else {
            throw new \Exception("{$name} cannot be set!");
        }
    }

    /**
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function __get($name)
    {
        $methodName = 'get' . ucfirst($name);
        if (method_exists($this, $methodName)) {
            return $this->$methodName();
        } else {
            throw new \Exception("{$name} cannot be read!");
        }
    }

    protected function request($options=[])
    {
        $httpClient = new Client([
            'base_uri'  => $this->host,
        ]);

        $response = $httpClient->request($this->method(), $this->api(), $options);

//        var_dump($response->getStatusCode());
//        var_dump($response->getBody()->getContents());

        print_r(json_decode($response->getBody()->getContents(), true));

    }
}
<?php

namespace ruoge3s\express\zto;


class Customize extends Common
{
    public $api = '';

    /**
     * @return string
     * @throws \Exception
     */
    public function api(): string
    {
        if ($this->api) {
            return $this->api;
        } else {
            throw new \Exception('api 未初始化');
        }
    }

    public function setApi(string $api)
    {
        $this->api = $api;
        return $this;
    }

    public function setFormParams(array $fp)
    {
        $fp = array_merge([
            'company_id'    => $this->companyId,
            'msg_type'      => 'NEW_TRACES',
        ], $fp);
        return parent::setFormParams($fp); // TODO: Change the autogenerated stub
    }
}
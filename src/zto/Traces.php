<?php

namespace ruoge3s\express\zto;

use ruoge3s\express\Logistics;
use ruoge3s\express\Node;

/**
 * Class zto
 * 中通快递开放平台-快件轨迹
 * @package ruoge3s\express
 */
class Traces extends Common
{
    /**
     * @return string 定义接口
     */
    public function api(): string
    {
        return '/traceInterfaceNewTraces';
    }

    /**
     * 获取快件轨迹信息
     * @param array $NOs
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return Logistics[]
     */
    public function news(array $NOs)
    {
        $res = $this->setFormParams([
            'company_id'    => $this->companyId,
            'msg_type'      => 'NEW_TRACES',
            'data'          => json_encode($NOs),
        ])->request();

        // TODO 接口响应错误码进行处理

        $data = [];
        if (isset($res['data']) && is_array($res['data'])) {
            foreach ($res['data'] as $one) {
                $l = new Logistics(['no' => $one['billCode']]);
                foreach ($one['traces'] as $node) {
                    $l->addNode(new Node([
                        'content'   => $node['desc'],
                        'time'      => $node['scanDate'],
                        'site'      => "{$node['scanProv']}/{$node['scanCity']}/{$node['scanSite']}"
                    ]));
                }
                $data[$one['billCode']] = $l;
            }
        }
        return $data;
    }
}
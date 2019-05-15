<?php

namespace ruoge3s\express\zto;

/**
 * Class zto
 * 中通快递开放平台-快件轨迹
 * @package ruoge3s\express
 */
class Traces extends Common
{
    public function api(): string
    {
        return '/traceInterfaceNewTraces';
    }


    // 获取快件轨迹信息
    public function news()
    {
        $data = [
            'company_id'    => $this->companyId,
            'msg_type'      => 'NEW_TRACES',
            'data'          => json_encode([
                '75141846796460'
            ]),
        ];
        $digestStr = '';
        foreach ($data as $k => $v) {
            $digestStr = $digestStr . $k . '=' . $v . '&';
        }
        $digestStr = substr($digestStr, 0, -1) . $this->key;

        $data_digest = base64_encode(md5($digestStr, TRUE));
        $this->dataDigest = $data_digest;

        $this->request([
            'headers'       => $this->headers,
            'form_params'   => $data
        ]);
    }
}
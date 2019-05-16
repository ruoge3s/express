<?php

namespace ruoge3s\express;

/**
 * Class Logistical
 * 单个快递单号的物流节点信息(何时->何地->怎么样)
 * @package ruoge3s
 */
class Node
{
    use Config;

    /**
     * @var string 记录描述时间
     */
    protected $content  = '无记录内容';

    /**
     * @var string 记录时间(Y-m-d H:i:s)
     */
    protected $time     = '2000-01-01 00:00:01';

    /**
     * @var string 省/市/网点
     */
    protected $site     = '未知/未知/未知';


    public function toArray()
    {
        return [
            'content'   => $this->content,
            'site'      => $this->site,
            'time'      => $this->time,
        ];
    }
}
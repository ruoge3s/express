<?php

namespace ruoge3s\express;

/**
 * Class Logistical
 * 单个快递单号的物流信息(何时->何地->怎么样)
 * @describe 参考快递100的接口进行设计
 * @package ruoge3s
 */
class Logistics
{
    use Config;

    protected $no;
    /**
     * @var Node[]
     */
    protected $nodes = [];

    public function addNode(Node $node) {
        $this->nodes[] = $node;
    }

    public function toArray()
    {
        return array_map(function (Node $node) {
            return $node->toArray();
        }, $this->nodes);
    }
}
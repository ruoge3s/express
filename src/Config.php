<?php

namespace ruoge3s\express;

/**
 * Class Config
 * 配置
 * @package ruoge3s
 */
trait Config
{
    /**
     * Config constructor.
     * @notice 创建类的时候支持配置受保护的属性
     * @param array $config
     */
    public function __construct($config=[])
    {
        foreach ($config as $property => $value) {
            $this->$property = $value;
        }
    }
}
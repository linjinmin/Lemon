<?php

namespace Lemon\Container;

class Container
{

    // 注入的实例
    private static $instances;

    /**
     * 注入闭包或对象
     * @param string $abstract 名字
     * @param mixed $concrete  实例
     */
    public static function bind($abstract, $concrete)
    {

        Container::$instances[$abstract] = $concrete;

    }

    /**
     * @param string $abstract  实例名字
     * @param array $parameters 参数
     * @return mixed|null
     */
    public static function make($abstract)
    {
        if (Container::bound($abstract)) {
            return Container::$instances[$abstract];
        }

        return null;
    }

    /**
     * 判断是否绑定
     * @param string $abstract
     * @return bool
     */
    public static function bound($abstract)
    {
        return isset(Container::$instances[$abstract]);
    }

}

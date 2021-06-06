<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface;

use surface\exception\SurfaceException;

/**
 * Class Factory
 *
 * @method static form\Form     form()
 * @method static table\Table   table()
 *
 * Author: zsw zswemail@qq.com
 */
class Factory
{

    /**
     * @var Config
     */
    static private $config;

    /**
     * 注册全局配置
     *
     * @param        $config
     * @param string $def
     *
     * @return array|mixed|Config|null
     */
    public static function configure($config, $def = '')
    {
        if (is_null(static::$config)) {
            static::$config = new Config(is_array($config) ? $config : []);
        }
        if (is_array($config)) {
            static::$config->set($config);
        } elseif (is_string($config)){
            return static::$config->get($config, $def);
        }
        return static::$config;
    }

    /**
     * 构建
     *
     * @param       $name
     * @param array $param
     *
     * @return object
     * @throws SurfaceException
     * @throws \ReflectionException
     */
    public static function make($name, $param = [])
    {
        $component = strtolower($name);
        $class = "\\surface\\{$component}\\" . ucfirst($component);
        if (class_exists($class)) {
            if (count($param) === 0) $param = [null];
            return (new \ReflectionClass($class))->newInstanceArgs($param);
        }

        throw new SurfaceException("Component:{$name} is not founded!");
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return object
     * @throws SurfaceException
     * @throws \ReflectionException
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, $arguments);
    }


}

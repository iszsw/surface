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

    static private $config = [
        'table' => [],
        'form' => [],
    ];

    /**
     * 注册全局配置
     *
     * @param $config $config
     *
     * @return array|mixed|null
     */
    public static function configure($config)
    {
        if (is_array($config)) {
            static::$config = array_merge(static::$config, $config);
        } elseif (is_string($config)){
            return static::$config ? static::$config[$config] ?? null : null;
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
            if (count($param) === 1) array_push($param, static::configure($component));
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

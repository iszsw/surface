<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface;

use surface\exception\SurfaceException;

/**
 * Class Surface
 *
 * @method static \surface\form\Form   form()
 * @method static \surface\table\Table  table()
 *
 * Author: zsw zswemail@qq.com
 */
class Surface
{

    public static function make($name, $param = [])
    {
        $path = strtolower($name);
        $build = "\\Surface\\{$path}\\" . ucfirst($path);
        if (class_exists($build)) {
            return (new \ReflectionClass($build))->newInstanceArgs($param);
        }

        throw new SurfaceException("Method:{$name} is not found");
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return object
     * @throws SurfaceException
     * Author: zsw zswemail@qq.com
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, $arguments);
    }


}

<?php

namespace surface;

/**
 * @package surface\table
 * Author: zsw iszsw@qq.com
 */
class Globals extends Component
{

    public function __construct(string $name, array $config = [])
    {
        $this->componentType = $name;
        parent::__construct($config);
    }

}

<?php

namespace surface;

/**
 * @package surface\table
 * Author: zsw zswemail@qq.com
 */
class Globals extends Component
{

    public function __construct(array $config = [], string $name)
    {
        $this->componentType = $name;
        parent::__construct($config);
    }

}

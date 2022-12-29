<?php

namespace surface;

use surface\components\Render;
use surface\exception\SurfaceException;

trait ViewTrait
{

    /**
     * @param  Surface|null  $surface
     *
     * @return Surface
     */
    protected function buildSurface(?Surface $surface = null): Surface
    {
        if (!$surface) $surface = (new Surface());
        return $surface->append($this);
    }

    public function display(?Surface $surface = null): string
    {
        return $this->buildSurface($surface)->display();
    }

    public function view(?Surface $surface = null): string
    {
        return $this->buildSurface($surface)->view();
    }

}

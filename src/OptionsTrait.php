<?php

namespace surface;

/**
 * Trait OptionsTrait
 *
 * @package surface
 */
trait OptionsTrait
{

    public function options(array $options): self
    {
        if (!isset($options[0])) {
            $content = [];
            foreach ($options as $value => $label){
                $content[] = [
                    'label' => $label,
                    'value' => $value,
                ];
            }
            $options = $content;
        }
        $this->props = ['options' => $options];
        return $this;
    }

}


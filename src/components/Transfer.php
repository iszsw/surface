<?php

namespace surface\components;

class Transfer extends FormColumn
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
        $this->props = ['data' => $options, 'props' => ['key' => 'value', 'label' => 'label']];
        return $this;
    }

}


<?php

require_once __DIR__."/../../../autoload.php";

/**
 * 自定义组件
 */

//初始化surface容器
$surface = new \surface\Surface();

$surface->register(
    \surface\Functions::create(
        "
<script>
app.component('counter', {
      props: {
        modelValue: {
            type: [Number],
            default: 0
        }
      },
      emits: ['update:modelValue'],
      setup(props, {emit}) {
        const value = Vue.computed({
            get(){
                return props.modelValue
            },
            set(val) {
                emit('update:modelValue', val)
            }
        })
        return {
            value
        }
      },
    template: `<el-button @click='value++'>共 {{value}} <slot>Slot</slot></el-button>`,
})
</script>
", ["app"]
    )
);

$form = new \surface\documents\Form();

$form->binds(
    [
        "columns" => [
            (new \surface\components\FormColumn(['el' => 'counter', 'label' => "计数", 'name' => 'age']))->children("个"),
        ],
        'options' => [
            'submit'       => [
                'props'    => [
                    'type' => 'success',
                ],
                "children" => '确认',
            ],
        ]
    ]
)->attrs(
    [ // 本标签绑定
      ':columns' => 'columns',
      ':options' => 'options',
    ]
)->vModel(['age' => 15], 'data');

$surface->append($form);

// 生成页面
echo $surface->view();


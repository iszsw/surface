<?php

require_once "common.php";

use surface\Component;
use surface\Surface;
use surface\Functions;

/**
 * 自定义组件
 */

$surface = new Surface();

$surface->register(
    Functions::create(
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
    template: `<el-button @click='value++'>共 {{value}} <slot>Slot</slot></el-button><slot name='append'>slot append</slot>`,
})
</script>
", ["app"]
    )
);

$component = (new Component('counter'))->vModel(10, name: 'counterRef')
    ->children(
        [
            "个",
            (new Component('h1'))->slot('append')->children(
                Functions::create( "return {$surface->data()}.counterRef.value")
            ),
        ]
    );

// 动态渲染组件
//$surface->append(Functions::create("return {el: 'h2', children: '自定义动态渲染'}"));

echo $component->view($surface);



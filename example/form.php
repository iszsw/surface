<?php

require_once "common.php";

use surface\Surface;
use surface\components\Form;
use surface\Component;

$dataId = 0;
function createData($maxDeep, $maxChildren, $deep = 1, $key = 'node'): array
{
    global $dataId;
    $data = [];
    for ($i = 0; $i < $maxChildren; $i++)
    {
        $dataId++;
        $label = "{$key}-{$dataId}";
        $children = null;
        if ($deep <= $maxDeep)
        {
            $children = createData($maxDeep, $maxChildren, $deep + 1, $key);
        }
        $data[] = [
            'id'       => $label,
            'label'    => $label,
            'children' => $children,
        ];
    }

    return $data;
}

$form = (new Form())
    ->vModel(name: "formApi")
    ->vModel(
        [
            "name" => "lalala",
            "age"  => 18,
        ], 'data', 'formData'
    )
    ->props(
        [
            'columns' => [
                (new Component(['el' => "el-divider"]))->children("默认组件"),
                (new \surface\components\Input(['label' => "Input", 'name' => 'input']))
                    ->rules(['required' => true, 'message' => '请输入名字!']),
                (new \surface\components\Number(['label' => "number1", 'name' => 'number1', 'value' => 1]))
                    ->suffix("加到2有惊喜"),
                (new \surface\components\Number(['label' => "number2", 'name' => 'number2', 'value' => 1]))
                    ->suffix("['name'=>'number1', 'value'=>2]")
                    ->visible([['name' => 'number1', 'value' => 2]]),
                (new \surface\components\Number(['label' => "number3", 'name' => 'number3', 'value' => 1]))
                    ->suffix("['name'=>'number1', 'exec'=>'val === 2']")
                    ->visible([['name' => 'number1', 'exec' => 'val === 2']]),
                (new \surface\components\Number(['label' => "number4", 'name' => 'number4', 'value' => 1]))
                    ->suffix("['exec'=>'models.number1 === 2']")
                    ->visible([['exec' => 'models.number1 === 2']]),
                (new \surface\components\Number(['label' => "number5", 'name' => 'number5', 'value' => 1]))
                    ->suffix('\surface\Functions::create("return models.number1 === 2", ["models"])')
                    ->visible([\surface\Functions::create("return models.number1 === 2", ["models"])]),
                (new \surface\components\Hidden(['name' => 'Hidden', 'value' => "Hidden"])),
                (new \surface\components\Editable(['label' => "Editable", 'name' => 'editable', 'value' => "editable"])),
                (new \surface\components\Color(['label' => "Color", 'name' => 'Color', 'value' => "#293593"])),
                (new \surface\components\Date(['label' => "Date", 'name' => 'Date', 'col' => ['span' => 12], 'props' => ['type' => 'daterange', 'valueFormat' => 'YYYY-MM-DD']])),
                (new \surface\components\Time(['label' => "Time", 'name' => 'Time', 'col' => ['span' => 12], 'props' => ['is-range' => true, 'valueFormat' => 'HH:mm:ss']])),
                (new \surface\components\TimeSelect(['label' => "TimeSelect", 'name' => 'TimeSelect'])),
                (new \surface\components\Checkbox(['label' => "Checkbox", 'name' => 'Checkbox', 'value' => ['b']]))
                    ->options([['value' => 'a', 'label' => "吃饭"], ['value' => 'b', 'label' => "睡觉"], ['value' => 'c', 'label' => "打麻将"]]),
                (new \surface\components\Radio(['label' => "Radio", 'name' => 'Radio', 'value' => 'b']))
                    ->options(['a' => "吃饭", "b" => "睡觉", "c" => "打麻将"]),
                (new \surface\components\Rate(['label' => "Rate", 'name' => 'Rate', 'value' => 2, 'props' => ['count' => 5]])),
                (new \surface\components\Select(['label' => "Select", 'name' => 'Select', 'value' => ['b'], 'props' => ['multiple' => true]]))
                    ->options(['a' => "吃饭", "b" => "睡觉", "c" => "打麻将"]),
                (new \surface\components\Slider(['label' => "Slider", 'name' => 'Slider', 'value' => [10, 50], 'props' => ['range' => true]])),
                (new \surface\components\Switcher(['label' => "Switcher", 'name' => 'Switcher', 'value' => true, 'props' => ['active-text' => 'OK', 'inactive-text' => "NO", 'inline-prompt' => true]])),
                (new \surface\components\Cascader(['label' => "cascader", 'name' => 'cascader', 'value' => "a12"]))->props(
                    [
                        "options" => [
                            [
                                'value'    => "a1",
                                'label'    => "a1",
                                'children' => [
                                    [
                                        'value' => "a11",
                                        'label' => "a11",
                                    ],
                                    [
                                        'value' => "a12",
                                        'label' => "a12",
                                    ],
                                ],
                            ],
                            [
                                'value'    => "b1",
                                'label'    => "b1",
                                'children' => [
                                    [
                                        'value' => "b11",
                                        'label' => "b11",
                                    ],
                                    [
                                        'value' => "b12",
                                        'label' => "b12",
                                    ],
                                ],
                            ],
                        ],
                    ]
                ),
                (new \surface\components\Cascader(['label' => "async", 'name' => 'async']))->props(
                    [
                        'props' => [
                            'lazy'     => true,
                            'lazyLoad' => \surface\Functions::create(
                                <<<JS
const {level} = node;
const nodes = Array.from({length: level + 1}).map((item, k) => ({
    value: level * 10 + k,
    label: `Option - \${level} - \${k}`,
    leaf: level >= 2,
}));
resolve(nodes);
JS, ["node", "resolve"]
                            ),
                        ],
                    ]
                ),
                (new \surface\components\Upload(['label' => "Upload", 'name' => 'Upload', 'value' => 'https://zos.alipayobjects.com/rmsportal/jkjgkEfvpUPVyRjUImniVslZfWPnJuuZ.png']))->props(
                    [
                        'unique'   => true,
                        'limit'    => 2,
                        'action'   => '/api/upload.php',// 上传地址 根据options中config格式 data=['url' => '地址']
                        'multiple' => true,
                        //                    'manage'   => [ // 管理页面
                        //                        'url'     => '/api/manage.php',
                        //                        'method'  => 'get',
                        //                        'headers' => ['X-HEADER' => 'header'],
                        //                        'data'    => ["id" => 123],
                        //                    ],
                    ]
                ),
                (new \surface\components\Arrays(['label' => "Arrays", 'name' => 'Arrays', 'value' => [["key" => "key", 'Secret' => 'Secret']]]))->props(
                    [
                        'columns' => [
                            (new \surface\components\Input(['name' => "key", 'label' => "Key"])),
                            (new \surface\components\Input(['name' => "secret", 'label' => "Secret"])),
                        ],
                        'max' => 3
                    ]
                ),
                (new \surface\components\Objects(['label' => "Objects", 'name' => 'Objects', 'value' => ["key" => "key", 'Secret' => 'Secret']]))->props(
                    [
                        'columns' => [
                            (new \surface\components\Input(['name' => "key", 'label' => "Key"])),
                            (new \surface\components\Input(['name' => "secret", 'label' => "Secret"])),
                        ]
                    ]),
                (new \surface\components\Tree(['label' => "Tree", 'name' => 'Tree', 'value' => ['node-2', 'node-32']]))
                    ->props(
                        [
                            'style'        => ['width' => '100%'],
                            'emptyText'    => '暂无数据',
                            'showCheckbox' => true,
                            'data'         => createData(2, 5),
                            'props'        => [
                                'value'    => 'id',
                                'label'    => 'label',
                                'children' => 'children',
                            ],
                        ]
                    ),

                (new Component(['el' => "el-divider"]))->children("自定义组件样式"),
                (new Component(['el' => "el-card", 'label' => 'el-card', 'props' => ['body-style' => ["width" => '500px']]]))->children(
                    [
                        (new \surface\components\Input(['label' => "CardInput", 'name' => 'card-input', 'value' => "Hello"])),
                    ]
                ),
                (new \surface\components\Input(['label' => "CuInput", 'name' => 'cu-input', 'value' => "Hello"]))
                    ->children(
                        [
                            (new Component(['el' => "icon", 'slot' => 'prefix', 'props' => ['icon' => 'upload', 'color' => '#409EFC', 'size' => 15]])),
                            (new Component(['el' => "span", 'slot' => 'suffix']))->children("%"),
                        ]
                    ),
                (new Component(['el' => "el-tabs", 'name' => 'el-tabs', 'label' => 'el-tabs', 'value' => 'tab2', 'col' => ['span' => 24]]))->children(
                    [
                        (new Component(['el' => "el-tab-pane", 'props' => ['label' => 'tab1', "name" => "tab1"]]))->children(
                            [
                                (new \surface\components\Input(['label' => "TabInput1", 'name' => 'tab-input1', 'value' => "Hello"])),
                            ]
                        ),
                        (new Component(['el' => "el-tab-pane", 'props' => ['label' => 'tab2', "name" => "tab2"]]))->children(
                            [
                                (new \surface\components\Input(['label' => "TabInput2", 'name' => 'tab-input2', 'value' => "World"])),
                            ]
                        ),
                    ]
                ),
                // 自定义的 counter 组件
                (new \surface\components\FormColumn(['el' => 'counter','label' => '计数', "name" => "counter", 'value' => 20])),
            ],
            'options' => [
                'config'       => [
                    'responseKeys'        =>
                        [ // 异步请求响应 key 别名
                          'code' => 'code',
                          'data' => 'data',
                          'msg'  => 'msg',
                        ],
                    'responseSuccessCode' => 0,// 请求成功`code`的值 其他值都为失败
                ],
                'props'        => [
                    'label-width' => '100px',
                ],
                'row'          => [
                    'justify' => 'start',
                ],
                'col'          => [
                    'span' => 24,
                ],
                'submitBefore' => \surface\Functions::create("console.log('submitBefore', data)", ["data"]),  // 提交前返回 false 阻止提交
                'submitAfter'  => \surface\Functions::create("console.log('submitAfter');ElementPlus.ElMessage.success(res.msg || '提交成功')", ["data", "res"]),  // 提交成功后回调事件，自定义submit事件 不会触发
                'validate'     => \surface\Functions::create("console.log('validate', prop, isValid)", ["prop", "isValid"]),  // 字段校验失败回调
                'request'      => [
                    'url'     => '/api/change.php',
                    'method'  => 'post',
                    'headers' => [
                        'X-HEADER' => 'header',
                    ],
                    'data'    => [
                        'append' => '这是附加参数',
                    ],
                ],
                'submit'       => [
                    'props'    => [
                        'type' => 'success',
                    ],
                    "children" => '确认',
                ],
                //            'reset' => null, // 不需要reset可以设置为 null
            ],
        ]
    );

$form->listen(Form::EVENT_VIEW, function (Surface $surface)
{
    // 全局样式
    $surface->addStyle(
        <<<STYLE
<style>
#{$surface->id()} {
    width: 1200px;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    margin: auto;
    padding: 10px;
}
</style>
STYLE
    );

    // 注册自定义组件
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
    template: `<el-button @click='value++'>点击 {{value}} 次</el-button>`,
})
</script>
", ["app"]
        )
    );

});

echo $form->view();



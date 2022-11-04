## 说明

v3版本基于VUE3+ElementPlus完全重构，

## Surface构成

### 一、document 文档

> 通过 Surface/Document:class 直接生成html内容，内置引入了ElementPlus，所以ElementPlus的所有组件都支持生成

#### 初探document
```php

//初始化surface容器
$surface = new \surface\Surface();

// 创建一个div标签
$document = (new \surface\Document("div"))
    //添加属性 title="name"
    ->attrs(["title" => "name"])
    // div内部加入标签
    ->appendChild(
        [
            // 直接使用html标签
            "<h1>Hello world</h1>",

            // Document生成标签
            // <el-button title="按钮" :class="clb" @click="tab">按钮</el-button>
            (new \surface\Document('el-button'))
                ->attrs(
                    [
                        "title" => "按钮",
                        ":class" => "className", // 动态绑定
                        "@click" => "btnTab", // 绑定事件
                    ])
                ->binds(
                    [
                        "ref:className" => "hello", // 通过ref绑定动态参数 ref|reactive
                        "btnText" => "按钮",
                        "btnTab" => \surface\Functions::create('console.log("Hello World")') // 自定义函数
                    ])
                ->appendChild(":btnText")
        ]
    );

// 将文档加入到容器中
$surface->append($document);


$document->listen(\surface\Document::EVENT_VIEW, function (\surface\Surface $surface){
    // 调用 $surface->view() 时触发
});

// 显示生成的代码（不包含静态资源）不同页面可以混合使用
// echo $surface->display();

// 生成页面
echo $surface->view();

```

生成的代码如下
```html
<div id="QmiHfh">
    <div title="name">
        <h1>Hello world</h1>
        <el-button title="按钮" :class="clb" @click="tab">{{ btnText }}</el-button>
    </div>
</div>

<script>
    // ... surface 前端处理
</script>

```

#### s-table和s-form是内置的文档可以直接使用

##### Form \surface\documents\Form:class

```php
$form = new \surface\documents\Form();
$form->attrs( // 下列名字可以自定义
    [
        'formColumns' => [], // component 组件集合 看下面的第二点
        'formOptions' => [ // 表单配置
            'config'       => [ // 全局配置参数
                'responseKeys'  => [ // 异步请求响应 key 别名
                    'code' => 'code',
                    'data' => 'data',
                    'msg'  => 'msg',
                ],
                'responseSuccessCode' => 0,// 请求成功`code`的值 其他值都为失败
            ],
            // form属性配置 https://element-plus.org/zh-CN/component/form.html#form-%E5%B1%9E%E6%80%A7
            'props'        => [
                'label-width' => '100px',
            ],
            // 组件row配置 https://element-plus.org/zh-CN/component/layout.html#%E5%9F%BA%E7%A1%80%E5%B8%83%E5%B1%80
            'row'          => [
                'justify' => 'start',
            ],
            // 每个col配置
            'col'          => [
                'span' => 24,
            ],
            // 提交前返回 false 阻止提交
            'submitBefore' => \surface\Functions::create("console.log('submitBefore', data)", ["data"]),  
            // 提交成功后回调事件，自定义submit事件 不会触发
            'submitAfter' => \surface\Functions::create("console.log('submitAfter');ElMessage.success(res.msg || '提交成功')", ["data", "res"]),
            // 字段校验失败回调  
            'validate' => \surface\Functions::create("console.log('validate', prop, isValid)", ["prop", "isValid"]),  
            // 表单提交页面和参数配置
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
            // 提交按钮
            'submit'       => [
                'props' => [
                    'type' => 'success',
                ],
                "children"=> '确认'
            ],
            // 重置按钮 不需要重置按钮可以设置为 null
            // 'reset' => null, 
        ]
    ]
)->binds( // 下面的值为上面自定义的名字
    [
        ':columns' => 'formColumns',
        ':options' => 'formOptions',
    ]
)
```

##### Table \surface\documents\Table:class

```php
$table = (new \surface\documents\Table())->binds(
    [
        // table中列只能使用TableColumn组件内容可以无限级嵌套
        'columns' => [
            (new \surface\components\TableColumn())->props(['type' => 'selection']),
            (new \surface\components\TableColumn())->props(['label' => '年龄', 'prop' => 'age'])->children(
                [// 4种自定义绑定表格数据格式
                 // 绑定到children
                 (new Component(['el' => 'div', ':children' => ''])),
                 // 当前列字段age提交到{age}位置
                 (new Component(['el' => 'div', ':children' => '年龄：{age}'])),
                 // 自定义处理函数返回字符串显示
                 (new Component(['el' => 'div', ':children' => \surface\Functions::create("return '虚岁：' + row[field]", ["field", "row", "prop"])])),
                 // html渲染需要绑定到innerHTML
                 (new Component(['el' => 'span', 'props' => [':innerHTML' => "<b>{name}</b>"]])),
                ]
            ),
            (new \surface\components\TableColumn())->props(['label' => '状态', 'prop' => 'status'])->children(
                (new \surface\components\Switcher())->props(
                    [
                        // 预处理修改事件
                        \surface\components\TableColumn::EVENT_CHANGE => [
                            'before'  => \surface\Functions::create("console.log('before')", ['prop', 'data']),
                            'after'   => \surface\Functions::create("console.log('after')", ['prop', 'data', 'res']),
                            'request' => [
                                'url' => "/api/change.php",
                            ],
                        ],
                    ]
                )
            ),
            (new \surface\components\TableColumn())->props(['label' => '头像', 'prop' => 'avatar'])->children(
                (new Component(['el' => 'el-image']))->props([':src' => '', 'style' => ["width" => "50px"]])
            ),
           
            (new \surface\components\TableColumn())->props(['label' => '操作'])->children(
                [
                    (new \surface\components\Popconfirm())
                        ->onConfirm(["url" => "/api/change.php", 'method' => 'post', 'data' => ["status" => "OK", "id"]])
                        ->onCancel(["url" => "/api/change.php", 'method' => 'post', 'data' => ["status" => "NO", "id"]])
                        ->reference('删除')->props(['title' => '确认删除？']),
                    (new \surface\components\Button())->props(
                        [
                            'type'     => 'primary',
                            // 通过:注入当前列到方法
                            ':onClick' => \surface\Functions::create(
                                "return function(){
                                console.log('自定义点击事件', filed, row)
                            }",
                                ['filed', 'row']
                            ),
                        ]
                    )->children("编辑"),
                ]
            ),
        ],
        'options' => [
            'config'          => [
                'responseKeys'        => [
                    'code' => 'code',
                    'data' => 'data',
                    'msg'  => 'msg',
                ],
                'responseSuccessCode' => 0,
            ],
            // 数据获取地址
            'request'         => [
                'url'  => '/api/lists.php',
                'data' => [
                    'append' => '这是附加参数',
                ],
            ],
            // el-pagination分页props配置
            'paginationProps' => [
                'background'          => true,
                'hide-on-single-page' => true,
                'default-page-size'   => 2,
            ],
        ],
        // 自定义搜索 参考上面Form 表单中内容会提交到table数据接口
        'search'  => [
            'columns' => [
                (new \surface\components\Input(['label' => "Input", 'name' => 'input']))->col(['span' => 6]),
            ],
            'options' => [
                "row" => [
                    "gutter" => 10 // 偏移 10px
                ],
            ],
        ],
    ]
)->attrs(
    [
        // 将上面binds参数绑定到标签上
        ':columns' => 'columns',
        ':options' => 'options',
        ':search'  => 'search',
    ]
)->appendChild(
    [
        // table中有4个插槽挂载点可以自定义插入
        (new \surface\Document('template'))->attrs(['#top'])->appendChild("<b>我是top-slot</b>"),
        (new \surface\Document('template'))->attrs(['#header'])->appendChild("<b>我是header-slot</b>"),
        (new \surface\Document('template'))->attrs(['#append'])->appendChild("<b>我是append-slot</b>"),
        (new \surface\Document('template'))->attrs(['#footer'])->appendChild("<b>我是footer-slot</b>"),
    ]
);
```

##### 其他任何组件都可以参考form和table生成

### 二、component 组件

> 通过Json构建出组件内容，document和component本质都是一样，只是实现方式和场景不一样

```php
$form->attrs(
    [
        'formColumns' => [
            (new \surface\components\Input(['label' => "Input", 'name' => 'input']))
                ->rules(['required'=>true, 'message' => '请输入名字!']), // rules 验证
            (new \surface\components\Number(['label' => "number1", 'name' => 'number1', 'value' => 1]))
                ->suffix("加到2有惊喜"),// suffix后缀
            (new \surface\components\Number(['label' => "number2", 'name' => 'number2', 'value' => 1]))
                ->suffix("['name'=>'number1', 'value'=>2]")
                ->visible([ // 组件动态显示和隐藏条件4中校验方式
                    ['name' => 'number1', 'value' => 2],
                    ['name' => 'number1', 'exec' => 'val === 2'],
                    ['exec' => 'models.number1 === 2'],
                    \surface\Functions::create("return models.number1 === 2", ["models"])
                ]),
        ],
    ]
)
```


## 自定义组件

自定义组件参考vue官方文档

表单组件实现v-model就可以实现双向数据绑定


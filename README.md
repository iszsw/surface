# Surface

> PHP页面构建器，使用php代码生成表单表格页面，快速构建后台页面

## 介绍

> **邮件** zswemail@qqcom

> **主页**  [https://zsw.ink](https://zsw.ink) 留言

> **文档**  [https://doc.zsw.ink/surface/](https://doc.zsw.ink/surface/) 

> **github**  [https://github.com/iszsw/surface](https://github.com/iszsw/surface)

> **gitee**  [https://gitee.com/iszsw/surface](https://gitee.com/iszsw/surface)

## 效果

> Form 组件

![6jcp11.png](https://z3.ax1x.com/2021/03/26/6jcp11.png)

> Table组件

![6jcp11.png](https://z3.ax1x.com/2021/03/26/6jcSpR.png)
![6jcp11.png](https://z3.ax1x.com/2021/03/26/6jc96x.png)


## 安装

```shell
$ composer require iszsw/surface
```

## 使用

### Table 使用

```php
<?php
use surface\Component;
use surface\Factory;
use surface\table\components\Button;
use surface\table\components\Pagination;

// 注册全局配置
Factory::configure(['table' => [...]]);

// 获得Table
$table = Factory::table();

/**
 * 表配置 
 */
$table->options(
    'props', [
               'emptyText' => "求求你别看了，没有啦",
                // 'data' => [] // 如果不需要异步请求数据直接放置值到此变量
           ]
);

// 两种组件注册方式 1、new Component()，2、$table->component()

/**
 * 表格顶部样式
 */
$table->header(
    (new Component(['el' => 'div']))->children(
        [
            (new Button('el-icon-check', '提交'))->createSubmit(
                ['method' => 'post', 'data' => ['username' => 'hello'], 'url' => 'data.php'],
                '确认提交选择的数据',
                'id'
            ),
            $table->button('el-icon-plus', '编辑')->createPage('?form=1'),
            (new Button('el-icon-search', '搜索'))->createPage('?search=1')->props('doneRefresh', false),
        ]
    )
);

/**
 * 表格列配置
 */
$table->columns(
    [
        // 选择框（主键）
        $table->selection('id'),
        
        // 将address注入到<span>标签的内部显示
        $table->expand('address', '地址')->scopedSlots([$table->component(['el' => 'span', 'inject' => ['children']])]), 
        
        // 以图片显示
        $table->column('avatar', '头像')->scopedSlots(
            [
                $table->component(
                    [
                        'el'     => 'img',
                        'style'  => ['width' => '50px'],
                        'inject' => ['attrs' => ['src']],
                    ]
                ),
            ]
        ),

        // 可编辑的文本 异步修改
        $table->column('phone', '手机')->scopedSlots(
            [
                // 异步操作的data=[key=>val,value],只有value时将获取当前列的数据提交
                $table->writable()->props(['method' => 'post', 'async' => ['data' => ['id'], 'url' => 'data.php']]),
            ]
        )->props('width', '150px'),
        
        // 可编辑的开关样式 异步修改
        $table->column('status', '状态')->scopedSlots(
            [
                $table->switcher()->props(['method' => 'post', 'async' => ['data' => ['id'], 'url' => 'data.php',]]),
            ]
        ),
        
        // 可编辑的下拉框样式 异步修改
        $table->column('sex', '性别')->scopedSlots(
            [
                $table->select()->props(
                    [
                        'async'   => ['method' => 'post', 'data' => ['id', 'username' => 'hello'], 'url' => 'data.php'],
                        'options' => [1 => '男', '女', '未知',],
                    ]
                ),
            ]
        ),
    
        // 行按钮操作
        $table->column('options', '操作')->props('fixed', 'right')
            ->scopedSlots(
                [
                    // 打开一个页面 （可以配合Form组件进行交互）
                    $table->button('el-icon-edit', '编辑')
                         ->createPage('?form=1', ['id', 'username' => 'hello'])
                         ->props('doneRefresh', true), // 完成之后刷新页面,
        
                    // 确认框按钮 异步提交
                    $table->button('el-icon-delete', '删除')
                        ->createConfirm('你要删除我吗？', ['method' => 'post', 'data' => ['id', 'username' => 'hello'], 'url' => 'data.php',]),
                ]
            ),
    ]
);

/**
 * 分页配置 配置table的异步请求数据 如果无需异步请求 可以忽略
 */
$table->pagination(
    (new Pagination())->props(
        [
            'async' => [
                'url' => 'data.php', // 请求地址
                // 'data' => [], // 请求扩展参数
                // ... // axios 其他参数
            ],
        ]
    )
);

echo $table->view();

```


### Form 使用

```php
<?php
use surface\Factory;

// 注册全局配置
Factory::configure(['form' => [...]]);

$form = Factory::form();

/**
 * 表配置
 */
$form->options(
    [
        'submitBtn' => [
            'props' => [
                'prop' => [
                    'type' => 'primary',
                    'icon' => 'el-icon-search',
                ],
                'confirmMsg' => '确定搜索吗',
            ]
        ],
        // resetBtn 配置同 submitBtn
        'props'      => [
            'labelWidth' => '100px',
        ],
    ]
);


/**
 * 列配置
 */
$form->columns(
    [
        $form->input('username', '用户名'),
        $form->switcher('postage', '包邮', 0),
        $form->date('section_day', '日期')->props(
            [
                'type'        => "datetimerange",
                'format'      => "yyyy-MM-dd HH:mm:ss",
                'placeholder' => "请选择活动日期",
            ]
        ),
    ]
);

echo $form->view();

```

[更多代码演示](/test/index.php) 

[助手函数更多代码演示](/test/helper.php) 


## Test

```shell
进入verdor/iszsw/surface/test目录

$ php -S localhost:888
```

访问
[localhost:888](http://localhost:888) 

访问助手
[localhost:888/helper.php](http://localhost:888/helper.php) 


## 说明

前端基于 [iszsw/surface-src](https://gitee.com/iszsw/surface-src) 

如果需要自定义后端开发 可以自行引入前端逻辑

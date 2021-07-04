<p align="center"><img src="https://z3.ax1x.com/2021/06/29/Rdtqde.png" alt="surface" width="200px" style="border-radius: 50%" /></p>
<h1 align="center" style="margin: 30px 0 30px; font-weight: bold;">
    Surface</h1>
<h4 align="center">低代码PHP页面构建器，快速构建后台Table、Form页面</h4>
<p align="center">
    <img src="https://img.shields.io/badge/License-MIT-yellow.svg" alt="MIT" />
  <a href="https://github.com/iszsw">
    <img src="https://img.shields.io/badge/Author-iszsw-blue.svg" alt="iszsw" />
  </a>
  <a href="https://packagist.org/packages/iszsw/surface">
    <img src="https://img.shields.io/packagist/v/iszsw/surface.svg" alt="surface" />
  </a>
  <a href="https://packagist.org/packages/iszsw/surface">
    <img src="https://img.shields.io/packagist/php-v/iszsw/surface.svg" alt="php version" />
  </a>
</p>

## 特性

- 低代码
- 面向对象风格
- 自定义主题样式
- 动态生成Form页面
- 动态生成Table页面
- 丰富的表格表单样式
- 高扩展性，快速友好的扩展自定义的组件样式

## 内置功能
### table

>  - Button
>  - Editable
>  - Expand
>  - Select
>  - Selection
>  - Switcher
>  - Writable

### form

>  - Input
>  - Number
>  - Checkbox
>  - Radio
>  - Switch
>  - Select
>  - Cascader
>  - Color
>  - Date
>  - Time
>  - Rate
>  - Slider
>  - Upload
>  - Tree
>  - Take
>  - Arrays

## 演示

[http://curd.demo.zsw.ink/](http://curd.demo.zsw.ink/) 

账号密码 admin  123123


## 源码地址

gitee地址(主推)：[https://gitee.com/iszsw/surface](https://gitee.com/iszsw/surface)

github地址：[https://github.com/iszsw/surface](https://github.com/iszsw/surface)

## 生态

thinkPHP6 **0代码**生成CURD页面 [iszsw/curd](https://gitee.com/iszsw/curd)

Admin极速开发后台 [iszsw/surface-admin](https://gitee.com/iszsw/surface-admin)

## 文档

[https://www.kancloud.cn/zswok/surface/](https://www.kancloud.cn/zswok/surface/)


## 安装

```bash
# 运行环境要求PHP7.1+。
composer require iszsw/surface
```

 > 测试代码

```PHP

<?php

use surface\Component;
use surface\Factory;
use surface\table\components\Button;

// 构建搜索表单
$search = Factory::form();
$search->search(true); // 启用search 作为table子页面交互，将获取数据作为table拉取数据的参数
/**
 * 表配置
 */
$search->options(
    [
        'submitBtn' => [
            'props' => [
                'prop' => [
                    'type' => 'primary',
                    'icon' => 'el-icon-search',
                ],
                //  'confirmMsg' => '确定搜索吗',
            ],
        ],
        // resetBtn 配置同 submitBtn
        'props'     => [
            'labelWidth' => '100px',
        ],
    ]
);

/**
 * 列配置
 */
$search->columns(
    [
            $form->input('username', '用户名')->props('placeholder', "啦啦啦啦啦"),
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


// 构建表格
$table = Factory::table();

/**
 * 表配置
 */
$table->options(
    'props', [
               'emptyText' => "求求你别看了，没有啦",
           ]
);

// 注册搜索
$table->search($search);

/**
 * 顶部样式
 */
$table->header(
    (new Component(['el' => 'div']))->children(
        [
            (new Component())->el('div')->children(
                [
                    (new Component())->el('el-breadcrumb')->children(
                        [
                            (new Component())->el('el-breadcrumb-item')->children(['会员中心']),
                            (new Component())->el('el-breadcrumb-item')->children(['会员管理']),
                            (new Component())->el('el-breadcrumb-item')->children(['会员列表']),
                        ]
                    ),
                    (new Component())->el('h2')->children(['会员列表']),
                    (new Component())->el('el-alert')->style('margin-bottom', '20px')->props(['title' => '我是一个自定义的el-alert标签，来看看怎么用吧', 'type' => 'error', 'effect'=>'dark']),
                ]
            ),
            (new Button('el-icon-check', '提交'))->createSubmit(
                ['method' => 'post', 'data' => ['username' => 'hello'], 'url' => 'data.php'],
                '确认提交选择的数据',
                'id'
            ),
            (new Button('el-icon-refresh', '刷新'))->createRefresh(),
            $table->button('el-icon-plus', '编辑')->createPage('?form=1')->props('doneRefresh', true),
            (new Button('el-icon-search', '搜索'))->createSearch(),
        ]
    )
);


$table->columns( // 列配置
    [
        $table->selection('id'),
        $table->expand('address', '地址')->scopedSlots([$table->component(['el' => 'span', 'inject' => ['children']])]),
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
        $table->column('avatar', '头像大图')->scopedSlots(
            [
                $table->component(
                    [
                        'el'     => 'el-image',
                        'style'  => ['width' => '50px'],
                        'inject' => ['attrs' => ['src', 'array.preview-src-list']],
                    ]
                ),
            ]
        ),
        $table->column('vip', 'VIP')->scopedSlots([$table->component(['inject' => ['domProps' => 'innerHTML']])]),
        $table->column('username', '用户名')->props(['show-overflow-tooltip' => true, 'sortable' => true, 'width' => '150px']),
        $table->column('phone', '手机')->scopedSlots(
            [
                $table->writable()->props(['async' => ['method' => 'post', 'data' => ['id'], 'url' => 'data.php']]),
            ]
        )->props('width', '150px'),
        $table->column('status', '状态')->scopedSlots(
            [
                $table->switcher()->props(['async' => ['method' => 'post', 'data' => ['id'], 'url' => 'data.php',]]),
            ]
        ),
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
        $table->column('tag', '标签')->scopedSlots([$table->component(['el' => 'el-tag', 'inject' => ['children', 'title']])]),
        $table->column('options', '操作')->props('fixed', 'right')
            ->scopedSlots(
                [
                    $table->button('el-icon-edit', '编辑')
                        ->visible('option_edit') // option_edit字段为真显示按钮
                        ->createPage('?form=1', ['id', 'username' => 'hello'])
                        ->props('doneRefresh', true), // 完成之后刷新页面

                    $table->button('el-icon-delete', '删除')
                        ->createConfirm('确认删除数据？', ['method' => 'post', 'data' => ['id', 'username' => 'hello'], 'url' => 'data.php',]),
                ]
            ),
    ]
);


/**
 * 分页配置
 */
$table->pagination(
    (new Component())->props(
        [
            'async' => [
                'url' => 'data.php', // 请求地址
                //'data' => [], // 请求扩展参数
                //...axios 参数
            ],
        ]
    )
);


// 生成页面
echo $table->view();

```



 > 更多功能演示

[演示 /test/index.php](/test/index.php) 

[助手函数演示 /test/helper.php](/test/helper.php) 

## 关于

> **邮件** zswemail@qq.com
>
> **主页**  [https://zsw.ink](https://zsw.ink) 留言


## 说明

前端基于 [iszsw/surface-src](https://gitee.com/iszsw/surface-src) 

如果需要自定义后端开发 可以自行引入前端逻辑

## 演示图

> Table组件

![6jcp11.png](https://z3.ax1x.com/2021/07/03/R2TIij.png)

> Form 组件

![6jcp11.png](https://z3.ax1x.com/2021/03/26/6jcp11.png)

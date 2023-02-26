<p align="center"><img src="https://z3.ax1x.com/2021/06/29/Rdtqde.png" alt="surface" width="200px" style="border-radius: 50%" /></p>
<h1 align="center" style="margin: 30px 0 30px; font-weight: bold;">
    Surface</h1>
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

<h4 align="center">PHP页面生成器，快速生成页面，内置封装了丰富插件，前端基于Vue3</h4>

</p>

- v3完全重构，代码更友好，自由度更高。
- 后端生成json，前端的解析器解析json生成页面。
- 减少或者不写前端的代码，通过PHP就能轻松构建出任何页面。
- 自定义主题 Element-plus(默认)、iview、Ant-design-vue、naive-ui 等任何组件库都可以自由切换
- 所有HTML标签和组件库内置的组件都可以通过Component::class创建，内置的组件仅仅做代码提示或者简单初始化

## 源码地址

gitee地址：[https://gitee.com/iszsw/surface](https://gitee.com/iszsw/surface)

github地址：[https://github.com/iszsw/surface](https://github.com/iszsw/surface)


## 安装

```bash
# 运行环境要求 PHP8+
composer require iszsw/surface
```

## 组件

### 组件的构成
```
Component:class
    -el:string 所有内容都是基于组件实现，组件的唯一必须要素就是 `el:标签名字` 参数
    -props:Array 元素所有的事件 属性等
    -children:
        -array  集合
        -string 直接显示字符串内容
        -Component:class 子组件
        -Functions:class  返回自定义的子组件渲染逻辑(js返回一个function)
    -slot:string 子组件所在的插槽名
```
> 

#### 生成一个页面 内容显示 `<h1>hello world</h1>`
```php
use \surface\Component;

echo (new Component('h1'))->children("Hello world")->view();
```


## 示例

- ### 更多完整示例：[Example](/example)

- ### 快速上手
```php
$card = (new \surface\Component('el-card'))
    ->children(
        [
            (new \surface\Component('b'))
                ->slot('header') // 子组件绑定到插槽
                ->children('Title'),
            (new \surface\Component('el-button'))
                ->props(
                    [
                        'type' => 'primary',
                        // 点击事件 Functions::create()创建一个js调用的匿名函数
                        'onClick' => \surface\Functions::create("console.log('hello')")
                    ]
                )
                ->children("Hello world"),
        ]
    );

// 可以使用组件直接渲染
echo $card->view();
```
![UMadq.png](https://i.328888.xyz/2022/12/29/UMadq.png)


- ### 数据绑定

```php

$surface = new \surface\Surface();

// 注册一个input框 输入值自动渲染到h1标签中
$card = (new \surface\Component('input'))
    // 绑定一个username的响应式对象 默认值为hello vModel对象默认使用ref绑定
    ->vModel('hello', name: 'username');

$view = (new \surface\Component('h1'))->children(
    // 从当前surface的全局对象$surface->data()中获取上面绑定的username对象的值
    \surface\Functions::create("return {$surface->data()}.username.value")
);

// 加入surface容器
$surface->append($card);
$surface->append($view);

// 生成页面
echo $surface->view();
```

![Uu173.png](https://i.328888.xyz/2022/12/29/Uu173.png)

- ### 前端全局方法

#### 可以在全局调用surface的方法 

- Surface.request(object config) axios封装的request请求
- Surface.parseFn(string str)    字符串的 `FN:(){...}` 方法解析成js方法
- Surface.parseJson(string str)  字符串的 json 转为 json对象 同时解析 `FN:(){...}`
- Surface.deepParse(object obj)  json对象深度解析 `FN:(){...}`
- Surface.component(object component)  surface下组件注册
- Surface.cloneDeep(object obj)  深度克隆
- Surface.Render():返回render对象  封装的json解析器 将json转为component 调用render方法直接渲染

## 内置增强组件

### [table 表格组件 (组件名：s-table)](example/table.php)
### [form 表单组件 (组件名：s-form)](example/form.php)
![EhXkv.png](https://i.328888.xyz/2023/02/26/EhXkv.png)
![EhgB3.png](https://i.328888.xyz/2023/02/26/EhgB3.png)

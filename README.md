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
</p>

## 特性

surface的设计初衷是为了减少或者不写前端的代码能简单的构建出通用的页面

- 低代码
- 面向对象风格
- 自定义主题样式
- 动态生成Form页面
- 动态生成Table页面
- 丰富的表格表单样式
- 高扩展性，快速友好的扩展自定义的组件样式

## 源码地址

gitee地址：[https://gitee.com/iszsw/surface](https://gitee.com/iszsw/surface)

github地址：[https://github.com/iszsw/surface](https://github.com/iszsw/surface)


## 文档

[https://doc.zsw.ink](https://doc.zsw.ink) v3版本文档更新中... 更多功能演示查看test目录下测试代码


## 安装

```bash
# 运行环境要求 PHP7.1+ || PHP8.0+
composer require iszsw/surface
```

### 说明

v3版本基于VUE3+ElementPlus完全重构

surface构建器包括两部分

一、document 文档
- 通过 Surface/Document 直接构建出html内容，内置Table和Form两种文档构建器 

二、component 组件
- 通过Json构建出组件内容，Table和Form组件中内置了组件解析工具通过Json生成组件


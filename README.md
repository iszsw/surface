
surface根据PHP代码快速构建出表单、表格组件页面。

不同组件的静态资源依赖按需加载，减少页面内容。

组件不够用？还可以注入自定义的组件。

有疑问或者查看更多功能采访问[作者主页](https://www.zsw.ink)

主页  [https://www.zsw.ink](https://www.zsw.ink)

github  [https://github.com/iszsw/surface](https://github.com/iszsw/surface)

gitee   [https://gitee.com/iszsw/surface](https://gitee.com/iszsw/surface)

>  Form组件
- upload
- frame
- text
- tab
- hidden
- select
- switch
- number
- json
- rate
- editor
- tree
- range
- slider
- color
- datetime
- date
- time

>  Table组件

- text
- textEdit
- html
- switchEdit
- selectEdit
- in
- longText

![](https://ftp.bmp.ovh/imgs/2019/12/e19b95c4cb3fa40c.png)

![](https://ftp.bmp.ovh/imgs/2019/12/24a42113b67f28f5.png)

## 环境需求
>  PHP >= 7.1.3

## 安装
```shell
$ composer require iszsw/surface
```

## 使用说明

（如果使用ThinkPHP的同学使用内置助手类，对tp更友好，可以查看/vender/iszsw/test/ThinkPhp.php中示例
）
> 1、因为文件涉及到前端样式 需要复制/src/static 目录到项目入口 

> 2、注册全局配置


```shell
// 使用了thinkPHP框架可以直接在config目录添加surface.php配置文件
return [
        'upload' => [
            'manageShow' => true,    // 图片管理
            'manageUrl'  => '',    // 文件管理地址
            'action'     => '',    // 文件上传地址
            'uploadType' => 'image', // 文件类型 支持image|file
            'multiple'   => false,
            'limit'      => 1,
        ]
];

// 方式二
Form::global([
            'upload' => [
                'manageShow' => true,    // 图片管理
                'manageUrl'  => '',    // 文件管理地址
                'action'     => '',    // 文件上传地址
                'uploadType' => 'image', // 文件类型 支持image|file
                'multiple'   => false,
                'limit'      => 1,
            ]
     ]);
```
    
> 3、创建控制器 引入测试文件
    
    
```shell
use surface\test\Test;

$type = $_GET['type'] ?? null;
if ($type) {
    if ($type == 'file') {
        echo Test::table();die;
    }
}
echo Test::form();
```

参考

[/test/test.php](/test/test.php)

[/src/README.md](/src/README.md)

###  注意
 * 提交后返回格式
```shell
code === 0 成功  code > 0 失败

json_encode（['code' => 0, 'msg'=> '成功', 'data' => []]）
```

 * 文件上传
```shell
json_encode（['code' => 0, 'msg'=> '成功', 'data' => ['url' => '图片地址']]）
```

 * editor 富文本中文件上传
```shell
json_encode（['code' => '000', 'message'=> '成功', 'data' => ['url' => '....']]）
json_encode（['code' => '001', 'message'=> '失败'）
```

 * editor 富文本中文件管理
```shell
json_encode（['code' => '000', 'count'=> 100, 'data' => [[
                                                            'name' => '', // 增加 BUpload.js:578 FManager.js:230 增加item.name参数 显示资源名称
                                                            'oriURL' => '',   // 文件地址
                                                            'thumbURL' => '', //预览地址
                                                            'height' => '',  // 高度
                                                            'width' => '', // 宽度
                                                            'size' => '' // 大小
                                                        ]]）
```


## 关于
作者：zsw  
邮箱：zswemail@qq.com

感谢xaboy提供优秀的form-create工具

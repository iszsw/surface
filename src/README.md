
#### copyright © zsw zswemail@qq.com

#**用法介绍**
## 一、form

### validate用法
    Form::text("version", "版本号", '1.0.1')->validate(['message' => "版本号格式错误", 'pattern' => "\d+\.\d+\.\d+"]),
    Form::text("author", "作者")->validate("", true),
    Form::text("author_url", "作者主页")->validate(['type' => 'url', 'message' => "必须链接", 'required' => false]),

### cascader 多级联动
    //异步联动
    $form::cascader('cascader', '联动')->props([
        'lazy' => true,                 懒加载必须true
        'params' => ['a'=>'aa'],        附加参数会跟随请求一起 还有携带value选中的值一起传入array形式
        'url' => url('cascader'),       请求地址
        'options' => [[                 第一列需要提前绑定
          'value'=>'a',
          'label'=>'啊',
          'children' => ['']            有children的参数才会触发加载
        ]]
    ]),
    
    //同步加载异地js
    $form::cascader('cascader', '联动')->props([
        'options' => 'eval(window["province_city_area"])', // 格式eval(表达式) 引入外部js 绑定到window对象中
    ]),
    
    地区联动
    $form::area('cascader', '多级联动', ['四川省', '遂宁市']),
    
### upload 图片上传
    upload单图 | uploads多图
    $form::uploads('upload', '图片上传', '')->props([
        'manageShow' => true,                 允许选取服务器图片
        'manageUrl' => '',    管理图片地址
        'action' => '',       图片上传地址
        'uploadType' => 'image',                上传文件类型 读取upload_file_ext配置
        'limit' => 1                            图片个数限制 多图上传有效
    ])

### tab 标签页
#####1.对象方式
    $form::tab('pic', 'tab', '', ['children' => [
        'alioss' => [
            'name' => 'alioss01',
            'title' => '阿里01',
            'children' => [
                $form::text('name', '姓名', '')->props(['mark' => '啦啦啦啦啦']),
                $form::radio('sex', '性别', '1')->addOptions(['1' => '男', '2' => '女', '3' => '其他']),
            ]
        ],
        'upyun' => [
            'name' => 'upyun01',
            'title' => 'upyun01',
            'children' => [
                $form::text('upyun_app_id', 'appId', '')->props(['mark' => '啦啦啦啦啦']),
            ]
        ],
    ]])
    
#####2.config方式
    正常tab格式
    ['type' => 'tab', 'field' => 'aaa01', 'title' => 'hello01', 'props'=>[
        'activeValue' => true   // 在tabs下提交选中的tab的值 默认false
    ], 'children' => [
        [
            'name' => 'alioss01',
            'title' => '阿里01',
            'children' => [
                'alioss_app_secret01' => [
                    'title' => 'app_secret01',
                    'type' => 'text',
                    'value' => 'aaa',
                ],
            ]
        ],
        [
            'name' => 'upyun01',
            'title' => '又拍云01',
            'children' => [
                'upyun_app_id01' => [
                    'title' => 'app_id01',
                    'type' => 'text',
                    'value' => 'bbb',
                ]
            ]
        ],
    ]]

    无限级递归
    ['type' => 'tab', 'field' => 'aaa', 'title' => 'hello', 'props'=>['activeValue' => true], 'children' => [
        [
            'name' => 'alioss',
            'title' => '阿里',
            'children' => [
                'alioss_app_secret' => [
                    'title' => 'app_secret',
                    'type' => 'text',
                    'value' => 'aaa',
                ],
                ['type' => 'tab', 'field' => 'aaa01', 'title' => 'hello01', 'props'=>['activeValue' => true], 'children' => [
                    [
                        'name' => 'alioss01',
                        'title' => '阿里01',
                        'children' => [
                            'alioss_app_secret01' => [
                                'title' => 'app_secret01',
                                'type' => 'text',
                                'value' => 'aaa',
                            ],
                        ]
                    ],
                    [
                        'name' => 'upyun01',
                        'title' => '又拍云01',
                        'children' => [
                            'upyun_app_id01' => [
                                'title' => 'app_id01',
                                'type' => 'text',
                                'value' => 'bbb',
                            ]
                        ]
                    ],
                ]],
            ]
        ],
        [
            'name' => 'upyun',
            'title' => '又拍云',
            'children' => [
                'upyun_app_id' => [
                    'title' => 'app_id',
                    'type' => 'text',
                    'value' => 'bbb',
                ]
            ]
        ],
    ]]
    
### text 文本
    $form::text('username', '文本', '')->validate(['required' => 'true', 'message' => '用户名不能为空']),
    
### password 密码
    $form::password('password', '密码', '')->validate(['required' => 'true', 'message' => '密码不能为空', 'trigger' => 'blur']),

### number 数字
    $form::number('age', '数字', '2'),

### hidden 隐藏域
    $form::hidden('hid', '', '隐藏'),
    
### radio 单选
    $form::radio('six', '单选', '2')->addOptions(['1' => '男', '2' => '女', '3' => '其他'])->validate(),
    
### switcher 开关
    $form::switcher('switch', '开关', 1)->addOptions("开", '关'),
    

### date 日期
    $form::date('add_time', '注册时间')->props([
        'type' => 'daterange|datetimerange'           时间范围选择
    ])->col(['lg'=>['span'=>12]]),
    
### time 时间
    $form::time('time', '时间', '11:05:32'),
    
### color 颜色
    $form::color('color', '颜色')->props([
        'showAlpha'=>true,                      透明度
        'predefine'=>['#000', '#333']]
    ),
    
### rate 评分
    $form::rate('rate', '评分')->props(['max'=>10])
    
### slider 滑块
    $form::slider('slider', '滑块')->props([
        'range'=>true           范围选择
    ]),
        
### tree 树
    $form::tree('tree', '树')->props([
    'showCheckbox'=> true,                          可以选择
    'data'=>[
        ['title'=>'1', 'id'=>1, 'children'=>[
            ['title'=>'101','checked' => true,'id'=>'101'],
            ['title'=>'102','checked' => true,'id'=>'102'],
        ]],
        ['title'=>'2', 'id'=>1, 'children'=>[
            ['title'=>'201','checked' => true,'id'=>'201'],
            ['title'=>'202','checked' => true,'id'=>'202'],
        ]],
    ]]),
    
### json Json
    Form::json('extra', 'json', ['name'=>'zhangsan']),
    
### editor 富文本
    Form::editor('editor', 'editor')->props([
        'editorUploadUrl'=>url('index'),    富文本异步文件上传位置 如果为空以base64方式存入内容 成功返回['code'=>0,'data'=['url'=>'']]
    ]),
    
### frame 弹出层
    选取图片
    $form::frame('frame1', '页面1')->props([
        'type'=>'image',                           // 文件类型
        'src'=>config('manage_url'),               // 文件地址
        'height'=>'500px',
        'width'=>'1000px',
        'icon' => 'el-icon-folder',                // 默认图标
        'maxLength' => 3,                          // 选取长度
        'title' => "图库",                          // 说明
    ]),

    
## 二、table

### textEdit 可编辑文本
    Table::textEdit('weight', 'weight')->edit_url(pluginUrl('edit_field'))->width('30px'),


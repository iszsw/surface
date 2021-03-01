<?php

namespace surface\test\form;

use surface\Component;
use surface\helper\TableInterface;
use surface\table\components\Button;
use surface\table\components\Column;
use surface\table\components\Expand;
use surface\table\components\Header;
use surface\table\components\Pagination;
use surface\table\components\Select;
use surface\table\components\Selection;
use surface\table\components\Switcher;
use surface\table\components\Writable;

class Table implements TableInterface
{

    /**
     * @return Header|null
     */
    public function header(): ?Header
    {
        return (new Header(['el' => 'div']))->children(
                [
                    (new Button('el-icon-check', '提交'))->createSubmit(
                        ['method' => 'post', 'data' => ['username' => 'hello'], 'url' => 'data.php'],
                        '确认提交选择的数据',
                        'id'
                    ),
                    (new Button('el-icon-refresh', '刷新'))->createRefresh(),
                    (new Button('el-icon-plus', '编辑'))->createPage('?form=1'),
                    (new Button('el-icon-search', '搜索'))->createPage('?search=1')->props('doneRefresh', false),
                ]
            );
    }

    public function options(): array
    {
        return [
                'props' => [
                    'emptyText' => "求求你别看了，没有啦",
                ]
            ];
    }

    public function columns(): array
    {
        return [
            new Selection('id'),
            (new Expand('address', '地址'))->scopedSlots([new component(['el' => 'span', 'inject' => ['children']])]),
                (new Column('avatar', '头像'))->scopedSlots(
                    [
                        new component(
                            [
                                'el'     => 'img',
                                'style'  => ['width' => '50px'],
                                'inject' => ['attrs' => ['src']],
                            ]
                        ),
                    ]
                ),
                (new Column('avatar', '头像大图'))->scopedSlots(
                    [
                        new component(
                            [
                                'el'     => 'el-image',
                                'style'  => ['width' => '50px'],
                                'inject' => ['attrs' => ['src', 'array.preview-src-list']],
                            ]
                        ),
                    ]
                ),
                (new Column('vip', 'VIP'))->scopedSlots([new component(['inject' => ['domProps' => 'innerHTML']])]),
                (new Column('username', '用户名'))->props(['show-overflow-tooltip' => true, 'sortable' => true, 'width' => '150px']),
                (new Column('phone', '手机'))->scopedSlots(
                    [
                        (new Writable())->props(['method' => 'post', 'async' => ['data' => ['id'], 'url' => 'data.php']]),
                    ]
                )->props('width', '150px'),
                (new Column('status', '状态'))->scopedSlots(
                    [
                        (new Switcher())->props(['method' => 'post', 'async' => ['data' => ['id'], 'url' => 'data.php',]]),
                    ]
                ),
                (new Column('sex', '性别'))->scopedSlots(
                    [
                        (new Select())->props(
                            [
                                'async'   => ['method' => 'post', 'data' => ['id', 'username' => 'hello'], 'url' => 'data.php'],
                                'options' => [1 => '男', '女', '未知',],
                            ]
                        ),
                    ]
                ),
                (new Column('tag', '标签'))->scopedSlots([new Component(['el' => 'el-tag', 'inject' => ['children', 'title']])]),
                (new Column('options', '操作'))->props('fixed', 'right')
                    ->scopedSlots(
                        [
                            (new Button('el-icon-edit', '编辑'))->createPage('?form=1', ['id', 'username' => 'hello']),
                            (new Button('el-icon-delete', '删除'))
                                ->createConfirm('你要删除我吗？', ['method' => 'post', 'data' => ['id', 'username' => 'hello'], 'url' => 'data.php',]),
                        ]
                    ),
            ];
    }

    public function pagination(): ?Pagination
    {
        return (new Pagination())->props(
                [
                    'async' => [
                        'url' => '', // 请求地址
                    ],
                ]
            );
    }

    public function data($where = [], $order = '', $page = 1, $limit = 1): array
    {
        $star = ($page - 1) * 10;
        $adds = ['重庆', '北京', '上海', '深圳', '香港'];
        $tags = ['干饭人', '打工人', '程序员', '996', '不要怂'];
        $data = [];
        for ($i = 1; $i <= $limit; $i++)
        {
            $id = $i + $star;
            $username = '苹果' . $id;
            $avatar = 'http://q1.qlogo.cn/g?b=qq&nk=191587'.rand(100, 999).'&s=640';
            array_push(
                $data, [
                         'id'       => $id,
                         'avatar'   => $avatar,
                         'vip'      => '<h2>V'.rand(1, 9).'</h2>',
                         'phone'    => '155555555'.rand(10, 99),
                         'address'  => $adds[array_rand($adds)],
                         'status'   => ! rand(0, 1),
                         'tag'      => $tags[array_rand($tags, 1)],
                         'sex'      => rand(1, 3),
                         'username' => $username,
                         '_selection' => '<img src="'.$avatar.'">' . $username,
                     ]
            );
        }

        return [
            'list'  => $data,
            'count' => 800,
        ];
    }

}

<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\table\attribute;

use surface\AttrBase;

/**
 * table配置
 * Class Table
 *
 * @package surface\table\attribute
 * Author: zsw zswemail@qq.com
 */
class Table extends AttrBase
{
    protected function attr(): array
    {
        return [
            //全局
            "title" => '',                                   // title
            "pk" =>  'id',                                   // 数据提交主键名
            "url" =>  '',                                    // 请求后台的URL
            "description"  => '',                            // string 描述
            "method" =>  'post',                             // 请求方式
            "defaultParams" => [],                           // 默认提交参数
            "tableCardView" =>  true,                        // 小屏幕响应式详细视图
            "refreshBtnShow" =>  true,                       // 刷新按钮
            "columns" =>  [],                                // 列
            "topBtn" => [],                                  // 顶部按钮
            //排序
            "sortable" =>  true,                             // 是否启用排序
            "sortField" =>  null,
            "sortOrder" =>  '',                              // 排序方式
            //操作
            "operationShow" =>  true,                        // 操作
            "operations" => [],
            //选择框
            "clickToSelect" =>  true,                        // 是否启用点击选中行
            "checkShow" =>  true,                            // 选择框
            //分页
            "pageShow" =>  true,                             // 显示分页
            "pageTopShow" =>  true,                          // 显示首页和尾页
            "pageCountNum" =>  0,                            // 总数量
            "pageRowNumList" =>  [10, 15, 20, 50, 100],      // 每页显示数量列表
            "pageRowNum" =>  15,                             // 每页显示数量
            "pageCurrent" =>  1,                             // 当前页，默认第一页
            "pageListCount" =>  3,                           // 可视页码数
            //搜索
            "search" => false,                               // 搜索功能开关
            "searchShow" => false,                           // 默认搜索显示
        ];
    }

}
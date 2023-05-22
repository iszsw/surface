<?php

namespace surface\components;


/**
 *
 * Class Editor
 *
 * @see https://www.wangeditor.com/v5/ wangeditor配置\
 *
 * props配置
 *      columns: array, // sku可编辑项
 *           name: 属性名称
 *           label: 显示名称
 *           type: 显示类型 text[默认]|image|price|number
 *           width: 宽度  100[默认]
 *           props: image类型时update组件配置
 *
 *          默认项
 *         {name: 'img', label: '图片', type: 'image', width: 85, props: {}},
 *         {name: 'price', label: '价格', type: 'price'},
 *         {name: 'market_price', label: '市场价', type: 'price'},
 *         {name: 'stock', label: '库存', type: 'price'},
 *         {name: 'weight', label: '重量', type: 'number'},
 *         {name: 'code', label: '编码', width: 150},
 */
class Sku extends FormColumn
{


}


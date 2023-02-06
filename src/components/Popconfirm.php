<?php

namespace surface\components;

use surface\Component;
use surface\Surface;

class Popconfirm extends Component
{

    protected string $name = "el-popconfirm";

    /**
     * 触发 Popconfirm 显示的 HTML 元素
     *
     * @param string|Component $children
     * @param string $btnType
     *
     * @return $this
     */
    public function reference( $children = '操作', string $btnType = 'primary' ): self
    {
        if (is_string($children)) {
            $children = (new Button())->props(['type' => $btnType, 'size' => 'small'])->slot('reference')->children($children);
        }else if ($children instanceof Component){
            $children->slot('reference');
        }

        $this->children($children);
        return $this;
    }

    /**
     * @param $request
     * @param  string  $then 异步请求成功后执行的JS语句
     *
     * @return $this
     */
    public function onConfirm( $request, string $then = '' ): self
    {
        return $this->makeHandler('onConfirm', $request,  $then);
    }

    /**
     * @param $request
     * @param  string  $then 异步请求成功后执行的JS语句
     *
     * @return $this
     */
    public function onCancel( $request, string $then = '' ): self
    {
        return $this->makeHandler('onCancel', $request,  $then);
    }

    private function makeHandler(string $name, $request, string $then = ''): self
    {
        $request instanceof \Closure || $request = function (Surface $surface) use ($name, $request, $then) {
            $request = json_encode($request, JSON_UNESCAPED_UNICODE);
            // 支持参数替换 1.url中{field}替换为字段 2.无下标的参数 ['id']
            $handler = \surface\Functions::create(<<<JS
const request = $request;
request.url = request.url ? request.url.replace(/(\{.*?\})/g, function (s) {
    let f = s.substr(1, s.length - 2)
    return row.hasOwnProperty(f) ? row[f] : f
}) : '';
if (request.data) {
    let data = {}
    for (let i in request.data) {
        if (!isNaN(i)) {
            let key = i
            key = request.data[i]
            data[key] = row[key] || ''
        }else{
            data[i] = request.data[i]
        }
    }
    request.data = data
}

return function(){
    Surface.request(request).then(res => {
        if (res.code > 0) {
            ElementPlus.ElMessage({message: e.msg || "操作失败", type: 'error'})
        }else{
            {$then}
        }
    }).catch(e => {
        ElementPlus.ElMessage({message: e.msg || "操作失败", type: 'error'})
    })
}

JS, ['filed', 'row', 'prop']);

            // 动态绑定
            $this->props([':'.$name => $handler]);
        };

        $this->listen(self::EVENT_VIEW, $request);

        return $this;
    }

}


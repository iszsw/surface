<?php

namespace surface\components;

use surface\Component;
use surface\Document;
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
            $children = (new \surface\components\Button(
                ['slot' => 'reference', 'type' => $btnType]
            ))->children($children);
        }else if ($children instanceof Component){
            $children->props(['slot' => 'reference']);
        }

        $this->children($children);
        return $this;
    }

    /**
     * @param array|Closure $request
     *
     * @return $this
     */
    public function onConfirm( $request): self
    {
        return $this->makeHandler('onConfirm', $request);
    }

    /**
     * @param array|Closure $request
     *
     * @return $this
     */
    public function onCancel( $request ): self
    {
        return $this->makeHandler('onCancel', $request);
    }

    private function makeHandler(string $name, $request): self
    {
        $request instanceof \Closure || $request = function (Surface $surface, Document $document) use ($name, $request) {
            $id = $surface->id();
            $vModel = $document->getVModel();
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
            Surface.$id.$vModel && Surface.$id.$vModel.value.load()
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


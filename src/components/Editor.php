<?php

namespace surface\components;

use surface\Surface;

/**
 *
 * Class Editor
 *
 * @see https://www.wangeditor.com/v5/ wangeditor配置\
 *
 * props配置
 *      containerStyle: array, // 容器样式
 *      toolbarAttrs: array, // 工具栏配置
 *      mode: string, // 富文本模式
 *      ...attrs // 编辑器配置
 */
class Editor extends FormColumn
{

    private bool $customLoad = false;

    protected function init(): void
    {
        parent::init();

        $this->listen(self::EVENT_VIEW, function (Surface $surface){
            if (!$this->customLoad) {
                $surface->addStyle('<link href="//unpkg.com/@wangeditor/editor@latest/dist/css/style.css" rel="stylesheet">');
                $surface->addScript('<script src="//unpkg.com/@wangeditor/editor@latest/dist/index.js"></script>');
            }
        },false);
    }

    /**
     * 自定义引入样式文件
     *
     * @return $this
     */
    public function custom()
    {
        $this->customLoad = true;
        return $this;
    }

}


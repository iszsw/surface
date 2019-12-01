<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\exception;

class SurfaceException extends \Exception
{

    /**
     * 调试信息
     *
     * @var null
     */
    protected $debug;

    /**
     * 数据
     * @var array
     */
    protected $data = [];

    public function __construct($msg = "", int $code = 1, $data = [], $debug = null)
    {
        if (is_numeric($msg)) {
            $code = $msg;
        }

        $this->code = $code;

        $this->message = $msg;

        $this->data = $data;

        $this->debug = $debug;
    }

    /**
     * 获取数据
     *
     * @return array
     */
    final public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $key
     *
     * @return array|string
     */
    final public function __invoke($key = '')
    {
        if ($key) {
            return $this->$key ?? '';
        }

        $data = [
            'code' => $this->code,
            'msg'  => $this->message,
            'data' => $this->data,
            'debug' => $this->debug
        ];

        if ($this->debug === null) {
            unset($data['debug']);
        }

        return $data;
    }

    public function __toString()
    {
        return json_encode($this->__invoke(), JSON_UNESCAPED_UNICODE);
    }

}
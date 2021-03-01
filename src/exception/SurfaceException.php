<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\exception;

/**
 *
 * Class SurfaceException
 *
 * @package surface\exception
 * Author: zsw zswemail@qq.com
 */
class SurfaceException extends \Exception
{

    /** @var array 数据 */
    protected $data = [];

    public function __construct($msg = "", int $code = 1, array $data = [])
    {
        if (is_numeric($msg))
        {
            $code = $msg;
        }

        $this->code = $code;
        $this->message = $msg;
        $this->data = $data;
    }

    public static function success($msg, array $data = []): self
    {
        return new self($msg, 0, $data);
    }

    public static function fail($msg, array $data = []): self
    {
        return new self($msg, 0, $data);
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
        if ($key)
        {
            return $this->$key ?? '';
        }

        return [
            'code' => $this->code,
            'msg'  => $this->message,
            'data' => $this->data,
        ];
    }

    public function __toString()
    {
        return json_encode($this->__invoke(), JSON_UNESCAPED_UNICODE);
    }

}

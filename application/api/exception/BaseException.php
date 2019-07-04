<?php

namespace app\api\exception;

use think\Exception;

/**
 * 自定义异常类的基类
 * Class BaseException
 * @package app\api\exception
 */
class BaseException extends Exception
{
    //http状态码
    public $code = 400;

    //错误的具体信息
    public $message = 'invalid parameters';

    /**
     * 构造函数，接收一个关联数组
     * BaseException constructor.
     * @param array $params 关联数组只应包含code、msg和errorCode，且不应该是空值
     */
    public function __construct($params = [])
    {
        if (!is_array($params)) {
            return;
        }
        if (array_key_exists('code', $params)) {
            $this->code = $params['code'];
        }
        if (array_key_exists('msg', $params)) {
            $this->message = $params['msg'];
        }
    }

}
<?php

namespace app\api\exception;

/**
 * 通用参数类异常错误
 * Class ParameterException
 * @package app\api\exception
 */
class ParameterException extends BaseException
{
    public $code = 400;
    public $message = "invalid parameters";
}
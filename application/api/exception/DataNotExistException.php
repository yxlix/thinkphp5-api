<?php


namespace app\api\exception;


/**
 * 数据已经存在
 * Class DataNotExistException
 * @package app\api\exception
 */
class DataNotExistException extends BaseException
{
    public $code = 403;
    public $message = "数据不存在";
}
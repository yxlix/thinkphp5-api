<?php

namespace app\api\exception;


class UserException extends BaseException
{
    public $code = 404;
    public $message = '账号不存在';
}
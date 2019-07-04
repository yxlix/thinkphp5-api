<?php

namespace app\api\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $message = 'Token已过期或无效Token';
}
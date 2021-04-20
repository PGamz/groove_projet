<?php


namespace app\core\exception;


use Exception;

class ForbiddenException extends Exception
{
    protected $message = 'Access to vip area denied';
    protected $code = 403;
}
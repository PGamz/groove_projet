<?php


namespace app\core\exception;


use Exception;

class AdminException extends Exception
{
    protected $message = 'Access to Admin Area denied';
    protected $code = 403;
}
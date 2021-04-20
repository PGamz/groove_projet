<?php


namespace app\core\exception;


use Exception;

class NeedLoginException extends Exception
{
    protected $message = 'Please Log In to watch our Live Show';
    protected $code = 403;
}
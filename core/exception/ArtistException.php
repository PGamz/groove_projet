<?php


namespace app\core\exception;


use Exception;

class ArtistException extends Exception
{
    protected $message = 'Access to Artist Area denied';
    protected $code = 403;
}
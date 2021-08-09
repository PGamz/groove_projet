<?php


namespace app\core\exception;


use Exception;

class ArtistProfileException extends Exception
{
    protected $message = 'You already have one artist page';
    protected $code = 23000;
}
<?php

namespace app\core;
/**
 * Class Request
 * @package app\core
 */

class Request
{
    public function getPath()
    {
        if (isset($_SERVER['PATH_INFO'])) {
            return $_SERVER['PATH_INFO'];
        }
    
        if (isset($_SERVER['BASE'])) {
            $c = 1;
            return str_replace($_SERVER['BASE'], '', strtok($_SERVER['REQUEST_URI'], '?'), $c);
        }
    
        return '/';
        
        // $path = $_SERVER['REQUEST_URI'] ?? '/';
        // $position =strpos($path, '?');
        // if ($position === false) {
        //     return $path;
        // }

        // return substr($path, 0, $position);
        
    }

    public function method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet(): bool
    {
        return $this->method() ==='get';
    }

    public function isPost(): bool
    {
        return $this->method() ==='post';
    }

    public function getBody(): array

    {
      $body = [];
      if ($this->method() === 'get') {
          foreach ($_GET as $key => $value) {
              $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
          }
      }


        $body = [];
        if ($this->method() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }

}

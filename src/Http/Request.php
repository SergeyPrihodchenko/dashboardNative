<?php

namespace S\P\Http;

use S\P\Exceptions\RequestExeption;

class Request {

    public function __construct(
        protected array $params,
        protected string $uri,
    )
    {
        $this->params = $_GET;
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    public function getParam($key): mixed
    {
        if(!array_key_exists($key, $this->params)) {
            throw new RequestExeption('not found parameter');

            return null;
        } 

        return $this->params[$key];
    }

    public function getPage(): ?string
    {
        $path = explode('/', $this->uri);

        if(strlen($path[1]) == 0) {

            throw new RequestExeption('error in request');

            return null;
        }

        return $path[1];
    }
}
<?php

namespace S\P\Http;

use S\P\Exceptions\RequestException;

class Request {

    protected array $params;
    protected string $uri;

    public function __construct(
    )
    {
        $this->params = $_GET;
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    public function getParam($key): mixed
    {
        if(!array_key_exists($key, $this->params)) {
            throw new RequestException('not found parameter');

            return null;
        } 

        return $this->params[$key];
    }

    public function getPage(): ?string
    {
        $path = explode('/', $this->uri);

        if(strlen($path[1]) == 0) {

            throw new RequestException('error in request');

            return null;
        }

        return $path[1];
    }
}
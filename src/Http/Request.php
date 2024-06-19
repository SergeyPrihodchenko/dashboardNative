<?php

namespace S\P\Http;

use S\P\Exceptions\RequestException;

class Request {

    protected array $params;
    protected string $uri;
    protected array $data;

    public function __construct(
    )
    {
        $this->params = $_GET;
        $this->data = $_POST;
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

    public function getPostData(string $key): mixed
    {
        if(!array_key_exists($key, $this->data)) {
            throw new RequestException('not found data');

            return null;
        } 

        return $this->data[$key];
    }

    public function getJsonData(): array
    {
        $json = file_get_contents('php://input');

        $data = json_decode($json, true);

        return $data;
    }
}
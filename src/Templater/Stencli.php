<?php

namespace S\P\Templater;

use S\P\Exceptions\TemplateNotFoundException;

class Stencli {

    protected const VIEWS = __DIR__ . '/src/Views/';

    public function __construct(
        protected string $path
    )
    {
    }

    public function render(string $tempalte, array $data = []): string
    {
        $path = $this->path . DIRECTORY_SEPARATOR . $tempalte . '.php';

        if(!file_exists($path)) {
            throw new TemplateNotFoundException($path);
        }

        return (new Template($path, $data))->render();
    }


}
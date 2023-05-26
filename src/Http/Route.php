<?php

namespace Elysio\Http;

abstract class Route implements Routeable
{
    readonly string $path;
    readonly ?string $name;
    private Response $response;

    public function __construct(string $path, ?string $name=NULL)
    {
        $this->path = $path;
        $this->name = $name;
        $this->response = new Response();
    }

    protected function render(string $view, array $variables): Response
    {
        extract($variables);

        ob_start();
            require (_VIEWS . $view);
            $body = ob_get_contents();
        ob_end_clean();

        return $this->response->setBody($body);
    }

    protected function JSON(array $json): Response
    {
        $this->response->addHeaders("Content-Type: application/json; charset=UTF-8");
        $body = json_encode($json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
        return $this->response->setBody($body);
    }

    protected function redirectTo(string $path): Response
    {
        $this->response->addHeaders("Location: $path");
        return $this->response;
    }
}

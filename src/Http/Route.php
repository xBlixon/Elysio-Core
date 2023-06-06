<?php

namespace Elysio\Http;

abstract class Route
{
    readonly string $path;
    readonly ?string $name;
    private Request $request;
    private Response $response;

    public function __construct(string $path, ?string $name=NULL)
    {
        $this->path = $path;
        $this->name = $name;
        $this->request = Request::getInstance();
        $this->response = new Response();
    }

    protected function render(string $view, array $variables): Response
    {
        extract($variables);

        // $viewsDir is equivalent to _VIEWS constant in the Elysio Framework.
        $viewsDir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "Views" . DIRECTORY_SEPARATOR;
        ob_start();
            require ($viewsDir . $view);
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

<?php

namespace Elysio\Http;

use ReflectionClass;

class Request
{
    private static $instance = null;

    readonly string $method;

    readonly string $path;

    readonly array $params;


    private function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->setURL();
    }

    public static function getInstance(): Request
    {
        if (self::$instance == null)
        {
            self::$instance = new static();
        }

        return self::$instance;
    }

    private function setURL(): void
    {
        $URL = parse_url($_SERVER['REQUEST_URI']);
        $this->path = $URL['path'];

        if(!array_key_exists('query', $URL))
        {
            $this->params = [];
            return;
        }

        $params = explode("&", $URL['query']);

        $processedParams = [];
        foreach ($params as $param)
        {
            $param = explode("=", $param);
            $processedParams[$param[0]] = ($param[1] ?? "");
        }
        $this->params = $processedParams;
    }

    public function doesRouteMatch(Route $route): bool
    {
        if(
            $this->path === $route->path
            &&
            $this->doesRouteAllowMethod($route)
        ) return true;

        return false;
    }

    private function doesRouteAllowMethod(Route $route): bool
    {
        $METHODS = [
            'GET'  => GET::class,
            'POST' => POST::class
        ];

        $reflection = new ReflectionClass($route);
        $attributes = $reflection->getAttributes();
        $routeMethods = [];
        foreach ($attributes as $attribute)
        {
            $method = $attribute->getName();
            if ($method === ANY::class)
                return true;
            $routeMethods[] = $method;
        }

        if(in_array($METHODS[$this->method], $routeMethods)) return true;

        return false;
    }
}

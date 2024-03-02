<?php

namespace Core;

class Router
{
    protected array $routes = [];
    protected static Router|null $instance = null;

    static public function getInstance(): static
    {
        if (is_null(static::$instance)) {
            static::$instance = new self;
        }

        return static::$instance;
    }

    public function get(string $route, string $controller): void
    {
        $this->routes['GET'][$route] = $controller;
    }

    public function post(string $route, string $controller): void
    {
        $this->routes['POST'][$route] = $controller;
    }

    public function put(string $route, string $controller): void
    {
        $this->routes['PUT'][$route] = $controller;
    }

    public function delete(string $route, string $controller): void
    {
        $this->routes['DELETE'][$route] = $controller;
    }

    public function dispatch(string $method, string $uri): string
    {
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);

        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $route => $controller) {
                if ($this->matchRoute($route, $uri, $params)) {
                    list($className, $methodName) = explode('@', $controller);
                    $controllerInstance = new $className();

                    if ($controllerInstance->before($methodName, $params)) {
                        if (count($params) > 1) {
                            $params = [intval($params[1])];
                        }

                        $response = $this->callControllerAction($controller, $params);
                        $controllerInstance->after($methodName);

                        if ($response) {
                            return \Core\json_response($response['code'], [
                                'data' => $response['body'],
                                'errors' => $response['errors']
                            ]);
                        }
                    }
                }
            }
        }

        return \Core\json_response(500, [
            'data' => [],
            'errors' => [
                'message' => 'Empty response'
            ]
        ]);
    }

    protected function matchRoute(string $route, string $uri, array &$params): bool
    {
        $routeParts = explode('/', $route);
        $uriParts = explode('/', $uri);

        // Перевірка на різну кількість елементів
        if (count($routeParts) != count($uriParts)) {
            return false;
        }

        foreach ($routeParts as $i => $part) {
            if ($part != $uriParts[$i]) {
                // Якщо поточні частини не співпадають і не є параметрами, то маршрути не співпадають
                if (!preg_match('/{(.*)}/', $part)) {
                    return false;
                }
                // Якщо поточні частини не співпадають, але одна з них є параметром, то відкидаємо її
                unset($uriParts[$i]);
            } elseif (preg_match('/{(.*)}/', $part)) {
                // Якщо поточні частини співпадають і одна з них є параметром, то додаємо його до масиву параметрів
                $params[] = $uriParts[$i];
            }
        }

        return true;
    }

    protected function callControllerAction(string $controller, array $params): mixed
    {
        list($className, $methodName) = explode('@', $controller);

        if (class_exists($className)) {
            $instance = new $className();
            if (method_exists($instance, $methodName)) {
                return call_user_func_array([$instance, $methodName], $params);
            }
            else {
                throw new \Exception("Method $methodName does not exist in class $className");
            }
        } else {
            throw new \Exception("Class $className does not exist");
        }
    }
}

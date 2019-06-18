<?php declare(strict_types=1);

namespace ArchFW\Routing;

use ArchFW\Controllers\ControllerInterface;
use ArchFW\Exceptions\Routing\ControllerNotExtendsBaseException;
use ArchFW\Exceptions\Routing\ControllerNotFoundException;
use ArchFW\Exceptions\Routing\MethodNotFoundException;
use ArchFW\Utilities\UriParser;

class Router implements RouterInterface
{
    /** @var string */
    private $controllerName;

    /** @var string */
    private $methodName;

    /** @var array */
    private $requestGetVars;

    /**
     * Router
     *
     * @param string $uri
     */
    public function __construct(string $uri)
    {
        // parse get variables
        $exploded = explode('?', $uri);
        $this->requestGetVars = array_key_exists(1, $exploded) ? UriParser::getVariables($exploded[1]) : [];

        // parse request URI
        $search = $exploded[0];
    }

    /**
     * @return array
     */
    public function getRequestGetVars(): array
    {
        return $this->requestGetVars;
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    /**
     * @param string $controllerName
     * @return Router
     * @throws ControllerNotFoundException
     * @throws ControllerNotExtendsBaseException
     */
    public function setControllerName(string $controllerName): Router
    {
        if (!class_exists($controllerName)) {
            $message = sprintf("Controller '%s' wasn\'t found.", $controllerName);
            throw new ControllerNotFoundException($message);
        }

        if (!$controllerName instanceof ControllerInterface) {
            $message = 'Your controller has to extend AbstractController class.';
            throw new ControllerNotExtendsBaseException($message);
        }

        $this->controllerName = $controllerName;
        return $this;

    }

    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return $this->methodName;
    }

    /**
     * @param string $methodName
     * @return Router
     * @throws MethodNotFoundException
     */
    public function setMethodName(string $methodName): Router
    {
        if (!method_exists($this->controllerName, $methodName)) {
            $message = sprintf("Method '%s' in class '%s' wasn\'t found.", $this->controllerName, $methodName);
            throw new MethodNotFoundException($message);
        }

        $this->methodName = $methodName;
        return $this;
    }
}

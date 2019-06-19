<?php declare(strict_types=1);

namespace ArchFW\Routing;

class Route
{
    /** @var string */
    private $path;

    /** @var string */
    private $className;

    /** @var string */
    private $methodName;

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return Route
     */
    public function setPath(string $path): Route
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->className;
    }

    /**
     * @param string $className
     * @return Route
     */
    public function setClassName(string $className): Route
    {
        $this->className = $className;
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
     * @return Route
     */
    public function setMethodName(string $methodName): Route
    {
        $this->methodName = $methodName;
        return $this;
    }
}

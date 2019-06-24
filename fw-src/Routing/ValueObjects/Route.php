<?php declare(strict_types=1);

namespace ArchFW\Routing\ValueObjects;

use ArchFW\Renderers\RenderableInterface;

/**
 * Representation of one route
 *
 * @package ArchFW\Routing
 */
class Route
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $path;

    /** @var string */
    private $class;

    /** @var string */
    private $method;

    /** @var RenderableInterface */
    private $renderer;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Route
     */
    public function setId(int $id): Route
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Route
     */
    public function setName(string $name): Route
    {
        $this->name = $name;
        return $this;
    }

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
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     * @return Route
     */
    public function setClass(string $class): Route
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return Route
     */
    public function setMethod(string $method): Route
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return RenderableInterface
     */
    public function getRenderer(): RenderableInterface
    {
        return $this->renderer;
    }

    /**
     * @param RenderableInterface $renderer
     * @return Route
     */
    public function setRenderer(RenderableInterface $renderer): Route
    {
        $this->renderer = $renderer;
        return $this;
    }
}

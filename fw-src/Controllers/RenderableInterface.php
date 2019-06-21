<?php declare(strict_types=1);

namespace ArchFW\Controllers;

/**
 * Represents base method every render has to have
 *
 * @package ArchFW\Controllers
 */
interface RenderableInterface
{
    /**
     * Function used to render data
     *
     * @param string $templateName
     * @param array  $vars
     * @return string
     */
    public function render(string $templateName, array $vars = []): string;
}
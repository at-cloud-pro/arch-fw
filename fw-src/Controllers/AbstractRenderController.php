<?php declare(strict_types=1);

namespace ArchFW\Controllers;

/**
 * Functionaries required to render stuff
 *
 * @package ArchFW\Controllers
 */
abstract class AbstractRenderController extends AbstractController
{
    /**
     * Renders valid JSON string
     *
     * @param $data
     * @return string
     */
    public function renderJson($data): string
    {
        header('Content-Type application/json');
        return json_encode($data);
    }

    /**
     * Renders valid JSON string
     *
     * @param $data
     * @return string
     */
    public function renderPlain(string $data): string
    {
        header('Content-Type application/plain');
        return $data;
    }
}

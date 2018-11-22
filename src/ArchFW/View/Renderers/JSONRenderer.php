<?php
/**
 * ArchFramework (ArchFW in short) is universal template for server-side rendered applications and services.
 * ArchFW comes with pre-installed router and JSON API functionality.
 * Visit https://github.com/archi-tektur/ArchFW/ for more info.
 *
 * PHP version 7.2
 *
 * @category  Framework/Boilerplate
 * @package   ArchFW
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT
 * @version   2.6.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchFW\View\Renderers;

use ArchFW\Exceptions\NoFileFoundException;
use ArchFW\Interfaces\Renderable;
use function file_exists;
use function header;
use function json_encode;

/**
 * Renders JSON as response
 *
 * @package ArchFW\View\Renderers
 */
class JSONRenderer implements Renderable
{
    /**
     * @var string Holds path to API wrapper file
     */
    private $path;

    /**
     * @var mixed Holds array to be encoded as JSON
     */
    private $values;

    /**
     * JSONRenderer constructor.
     *
     * @param string $path
     * @throws NoFileFoundException
     */
    public function __construct(string $path)
    {
        // change file locator into file path
        $this->path = $this->locateFile($path);
        // load values from file
        $this->values = require_once $this->path;
    }

    /**
     * Prepare to rendering JSON content
     *
     * @return string
     */
    public function render(): string
    {
        header('Content-Type: application/json; charset=utf-8');
        return json_encode($this->values);
    }

    /**
     * Change file locator into file path
     *
     * @param $path
     * @return string
     * @throws NoFileFoundException
     */
    private function locateFile(string $path): string
    {
        // adding extention
        $file = $path . '.php';

        // check if file exists
        if (file_exists($file)) {
            return $file;
        } else {
            throw new NoFileFoundException('API Wrapper not found', 500);
        }
    }
}

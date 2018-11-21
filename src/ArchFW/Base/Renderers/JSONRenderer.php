<?php
/**
 * Created by PhpStorm.
 * User: konta
 * Date: 21 November 2018
 * Time: 0:02
 */

namespace ArchFW\Base\Renderers;


use ArchFW\Exceptions\NoFileFoundException;
use ArchFW\Interfaces\Renderable;
use function file_exists;
use function header;
use function json_encode;

class JSONRenderer implements Renderable
{
    private $path;

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

        $this->values = require_once $this->path;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        header('Content-Type: application/json; charset=utf-8');
        return json_encode($this->values);
    }

    /**
     * @param $path
     * @return string
     * @throws NoFileFoundException
     */
    private function locateFile($path): string
    {
        $file = $path . '.php';
        if (file_exists($file)) {
            return $file;
        } else {
            throw new NoFileFoundException('API Wrapper not found', 500);
        }
    }
}
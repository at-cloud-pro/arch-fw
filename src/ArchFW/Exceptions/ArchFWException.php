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
 * @version   4.0.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchFW\Exceptions;

use ArchFW\Controller\Config;
use ArchFW\Controller\Logger;
use Exception;
use Throwable;

/**
 * Special ArchFW Exception that logs every thrown exception to logs. Allows to monitor when and why something has
 * thrown an exception.
 *
 * @package ArchFW\Exceptions
 */
class ArchFWException extends Exception implements Throwable
{
    /**
     * ArchFWException constructor enforces giving an message, it also loads all data to dedicated log file.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message, int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->log();
    }

    /**
     * Method logs data to dedicated log file, specified in config
     *
     */
    protected function log()
    {
        $Log = new Logger(Config::get(Config::SECTION_APP, 'exceptionLogPath'));
        $msg = "\n[{$Log->getDate()}]";
        $msg .= "\n\t\t[{$this->code}] [{$this->message}]";
        $msg .= "\n\t\tLine {$this->line} in file [{$this->file}]";
        $Log->log($msg, $this->code);
    }
}
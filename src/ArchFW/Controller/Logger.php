<?php
/**
 * ArchFramework (ArchFW in short) is universal template for server-side rendered applications and services.
 * ArchFW comes with pre-installed router and JSON API functionality.
 * Visit https://github.com/archi-tektur/ArchFW/ for more info.
 *
 * PHP version 7.2
 *
 * @category  Framework / Template
 * @package   ArchFW
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT
 * @version   2.5.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchFW\Controller;

/**
 * Logger object is used to create new messages in server log files.
 *
 * @package ArchFW\Controller
 */
class Logger
{
    const PATH = "../logs/ArchFWLogFile.log";

    /**
     * @var string Holds actual date
     */
    private $date;

    /**
     * @var string|null Holds last entered message if entered, or null if did not.
     */
    private $last;

    /**
     * @var Holds information if object is running in debug mode.
     */
    private $debug;

    /**
     * Constructor creates new field with actual date and creates a log file if it does not exist yet.
     */
    public function __construct()
    {
        $this->debug = false;
        $this->date = date('Y-m-d H:i:s');
        $this->last = null;

        if (!file_exists(self::PATH)) {
            $this->initNew();
        }
    }

    /**
     * Log an error to custom log file
     *
     * @param int $code provide error code
     * @param string $message provide a message that describes the problem
     * @param string $callbackMessage provide an information what will happen after error occurs
     * @return bool true on success, false on fail
     */
    public function log(int $code, string $message, string $callbackMessage = ''): bool
    {
        if (!empty($callbackMessage)) {
            $message = "[{$this->date}] > [CODE {$code}]: {$message}. Callback: {$callbackMessage}. \n";
        } else {
            $message = "[{$this->date}] > [CODE {$code}]: {$message}. No callback provided. \n";
        }
        // Write last sent message as field
        $this->last = $message;

        if ($this->debug) {
            die($message);
        }
        // Using the FILE_APPEND flag to append the content to the end of the file
        // The LOCK_EX flag to prevent anyone else writing to the file at the same time
        return file_put_contents(self::PATH, $message, FILE_APPEND | LOCK_EX) ? true : false;
    }

    /**
     * Displays actual information instead of writing it to system logs.
     * Usable when need to check something quickly.
     *
     * @return Logger Returns itself with debug option turned on
     */
    public function debug(): Logger
    {
        $this->debug = true;
        return $this;
    }

    /**
     * Creates new log file with name saved in const and initiate it with proper message
     */
    private function initNew(): void
    {
        if ($File = fopen(self::PATH, 'w+')) {
            $path = realpath(self::PATH);
            fwrite($File, "ArchFW Log File, created on [{$this->date}] in [{$path}]. \n");
            fclose($File);
        } else {
            echo 'Logger sends visual error, because error occured on creating log';
        }
    }

    /**
     * Delete date attribute before serializing an object
     *
     * @return array fields to delete before serializing
     */
    public function __sleep(): array
    {
        return ['date'];
    }

    /**
     * On unserialize create new field with date - prevent logging old time
     */
    public function __wakeup(): void
    {
        $this->date = date('Y-m-d H:i:s');
    }

    /**
     * Return a last message sent when user tries to echo this object
     *
     * @return string last message
     */
    public function __toString(): string
    {
        return isset($this->last) ? $this->last : 'No previous messages were sent.';
    }

    /**
     * Prints additional information on var_dump debug
     */
    public function __debugInfo(): array
    {
        $last = isset($this->last) ? $this->last : 'No previous messages were sent.';
        $debug = ($this->debug) ? 'on' : 'off';
        return [
            'currentTime' => $this->date,
            'last'        => $last,
            'debugMode'   => $debug,
        ];
    }
}
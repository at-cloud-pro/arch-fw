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
 * @author    Oskar 'archi-tektur' Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT https://opensource.org/licenses/MIT
 * @version   2.7.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchFW\Controllers;

use function date;
use function fclose;
use function file_exists;
use function file_put_contents;
use function fopen;
use function fwrite;
use function realpath;

/**
 * Logger object is used to create new messages in server log files.
 *
 * @package ArchFW\Controller
 */
class Logger
{

    /**
     * @var string $path Holds path to log file
     */
    private $path;

    /**
     * @var string Holds actual date
     */
    private $date;

    /**
     * @var string|null Holds last entered message if entered, or null if did not.
     */
    private $last;

    /**
     * @var boolean Holds information if object is running in debug mode.
     */
    private $debug;

    /**
     * Constructor creates new field with actual date and creates a log file if it does not exist yet.
     *
     * @param string $customPath Custom file path
     */
    public function __construct(string $customPath = null)
    {
        $this->debug = false;
        $this->date = date('Y-m-d H:i:s');

        $this->path = $customPath ? $customPath : Config::get(Config::SECTION_APP, 'defaultLogPath');

        if (!file_exists(realpath($_SERVER['DOCUMENT_ROOT'] . $this->path))) {
            $this->initNew();
        }
    }

    /**
     * Creates new log file with name saved in const and initiate it with proper message
     */
    private function initNew(): void
    {
        if ($File = fopen($_SERVER['DOCUMENT_ROOT'] . $this->path, 'w+')) {
            $path = realpath($_SERVER['DOCUMENT_ROOT'] . $this->path);
            fwrite($File, "ArchFW Log File, created on [{$this->date}] in [{$path}]");
            fclose($File);
        } else {
            echo 'Logger sent visual error, because error occured on creating log';
        }
    }

    /**
     * Log an error to custom log file
     *
     * @param string $message provide a message that describes the problem
     * @param int|null $code provide error code
     * @param string|null $callbackMessage provide an information what will happen after error occurs
     * @return bool true on success, false on fail
     */
    public function log(string $message, int $code = null, string $callbackMessage = null): bool
    {

        // Message is builded on standard log file, and raw on other files
        if ($this->path === Config::get(Config::SECTION_APP, 'defaultLogPath')) {
            // CREATE CODE TEMPLATE
            if ($callbackMessage !== null) {
                $message = "\n[{$this->date}] > [CODE {$code}]: {$message}. Callback: {$callbackMessage}.";
            } else {
                $message = "\n[{$this->date}] > [CODE {$code}]: {$message}. No callback provided.";
            }
        }
        // Write last sent message as field
        $this->last = $message;

        // I debug mode is on, echo message to screen
        if ($this->debug) {
            echo $message;
        }
        // Using the FILE_APPEND flag to append the content to the end of the file
        // The LOCK_EX flag to prevent anyone else writing to the file at the same time
        return file_put_contents(
            realpath($_SERVER['DOCUMENT_ROOT'] . $this->path),
            $message,
            FILE_APPEND | LOCK_EX
        ) ? true : false;
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
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
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
        return $this->last ? $this->last : 'No previous messages were sent.';
    }

    /**
     * Prints additional information on var_dump debug
     */
    public function __debugInfo(): array
    {
        $last = (string)$this;
        $debug = $this->debug ? 'on' : 'off';
        return [
            'currentTime' => $this->date,
            'last'        => $last,
            'debugMode'   => $debug,
        ];
    }
}

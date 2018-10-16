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

class Logger
{
    const PATH = "../logs/ArchFWLogFile.log";

    private $date;

    public function __construct()
    {
        $this->date = date('Y-m-d H:i:s');

        if (!file_exists(self::PATH)) {
            $this->createNewLogFile();
        }
    }

    private function createNewLogFile()
    {
        if ($File = fopen(self::PATH, 'w+')) {
            $path = realpath(self::PATH);
            fwrite($File, "ArchFW Log File, created on [{$this->date}] in [{$path}].");
            fclose($File);
        } else {
            echo 'Logger sends visual error, because error occured on creating log';
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
            $message = "[{$this->date}]: ERROR {$code}: {$message}. Callback: {$callbackMessage}.";
        } else {
            $message = "[{$this->date}]: ERROR {$code}: {$message}. No callback provided.";
        }

        // using the FILE_APPEND flag to append the content to the end of the file
        // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
        return file_put_contents(self::PATH, $message, FILE_APPEND | LOCK_EX) ? true : false;
    }

    /**
     * Delete date attribute before serializing an object
     *
     * @return array fields to delete before serializing
     */
    public function __sleep()
    {
        return ['date'];
    }

    /**
     * On unserialize create new field with date - prevent logging old time
     */
    public function __wakeup()
    {
        $this->date = date('Y-m-d H:i:s');
    }
}
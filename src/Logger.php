<?php

declare(strict_types=1);

/*
 * This file is part of Symdoc.
 *
 * (c) Emanuel Rukavina <rukanuel@gmail.com>
 *
 * This source file is subject to the LGPL-2.1-only license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Symdoc;

class Logger
{
    private static string $logFile;

    // Set the log file path when the class is first used
    public static function init(): void
    {
        self::$logFile = Kernel::getInstance()->getDirectory() . "/symdoc.log";
    }

    // Log a message without a log level
    public static function Log(string $message): void
    {
        // Ensure log file path is initialized
        if (empty(self::$logFile)) {
            self::init();
        }

        // Format the log message with a timestamp
        $timestamp = (new \DateTime())->format('Y-m-d H:i:s');
        $logMessage = "[$timestamp] $message" . PHP_EOL;

        // Write the log message to the file
        file_put_contents(self::$logFile, $logMessage, FILE_APPEND);
    }
}

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

    public static function init(): void
    {
        self::$logFile = Kernel::getInstance()->getDirectory() . "/symdoc.log";
    }

    public static function Log(string $message): void
    {
        if (!Kernel::getInstance()->getConfig('ENABLE_LOGGING')) {
            return;
        }

        if (empty(self::$logFile)) {
            self::init();
        }

        $timestamp = (new \DateTime())->format('Y-m-d H:i:s');
        $logMessage = "[$timestamp] $message" . PHP_EOL;

        file_put_contents(self::$logFile, $logMessage, FILE_APPEND);
    }
}

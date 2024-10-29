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

class Kernel
{
    /**
     * 1. Deal with the .ini file, do we create it, or just load it (if create, no need to continue, create it and stop)
     * 2. 
     */
    public function run()
    {
        echo "Reading project files from current directory...\n";
        $configFilePath = getcwd() . '/symdoc.ini';
        if (!file_exists($configFilePath)) {
            echo "symdoc.ini not found. Creating a new one...\n";
            file_put_contents($configFilePath, "[symdoc]\ncreated=" . date('Y-m-d H:i:s') . "\n");
            echo "symdoc.ini created at $configFilePath\n";
        } else {
            echo "symdoc.ini already exists at $configFilePath\n";
        }
        $directory = getcwd();

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $fileInfo) {
            echo $fileInfo->getPathname() . PHP_EOL;
        }
    }
}

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
    private string $directory;
    private string $configPath;
    private $config;

    public function __construct()
    {
        $this->directory = getcwd();
        $this->configPath = getcwd() . '/symdoc.ini';
    }
    public function run(): void
    {
        if (!file_exists($this->configPath)) {
            mkdir(dirname($this->configPath), 0777, true);
            copy(__DIR__ ."/resources/symdoc.ini", $this->configPath);
        } 
        $config = parse_ini_file($this->configPath);
        $directory = getcwd();

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $fileInfo) {
            #echo $fileInfo->getPathname() . PHP_EOL;
        }
    }
}

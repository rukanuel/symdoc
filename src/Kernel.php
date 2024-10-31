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
    private array $args;

    public function __construct(array $args = [])
    {
        $this->args = $args;
        $this->directory = getcwd();
        $this->configPath = getcwd() . '/symdoc.ini';
    }
    public function run(): void
    {
        // Prepare for flags func.
        foreach ($this->args as $arg) {
            if ($arg === '--flag1') {
                echo "Flag1 is set!" . PHP_EOL;
            }

            if (str_starts_with($arg, '--flag2=')) {
                $flag2Value = explode('=', $arg)[1];
                echo "Flag2 is set with value: $flag2Value" . PHP_EOL;
            }
        }

        // Make this into a class of its ow so it can be used across the project
        if (!file_exists($this->configPath)) {
            mkdir(dirname($this->configPath), 0777, true);
            // TODO swith version with actual version
            copy(__DIR__ . "/_resources/symdoc.ini", $this->configPath);
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

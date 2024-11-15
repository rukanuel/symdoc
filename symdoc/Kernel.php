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

use Symdoc\SymdocException;

class Kernel implements KernelInterface
{
    private const EXCLUDE_FROM_PROJECT = ['vendor', 'var', '.git', 'bin'];

    private static ?Kernel $instance = null;

    private string $directory;
    private string $configPath;
    private $config;

    private function __construct()
    {
        $this->directory = getcwd();
        $this->configPath = $this->directory . '/symdoc.ini';
    }

    public static function getInstance(): Kernel
    {
        if (self::$instance === null) {
            self::$instance = new Kernel();
        }

        return self::$instance;
    }

    public function getDirectory(): string
    {
        return $this->directory;
    }

    public function getConfig($value = "")
    {
        if (!empty($value)) {
            return isset($this->config[$value]) ? $this->config[$value] : null;
        } else {
            return $this->config;
        }
    }

    /**
     * @throws SymdocException
     */
    public function run(): void
    {
        \Symdoc\Configuration::Configuration($this->configPath);

        $this->config = parse_ini_file($this->configPath);

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveCallbackFilterIterator(
                new \RecursiveDirectoryIterator(
                    $this->directory,
                    \FilesystemIterator::SKIP_DOTS
                ),
                function ($current, $key, $iterator) {
                    return !in_array(
                        $current->getFilename(),
                        self::EXCLUDE_FROM_PROJECT
                    );
                }
            )
        );

        foreach ($iterator as $fileInfo) {
            echo $fileInfo->getPathname() . PHP_EOL;
            //Logger::Log("Test");
        }
    }
}

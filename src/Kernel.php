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
    private const SYMDOC_VERSION = '/../version';
    private const SYMDOC_INI = '/_resources/symdoc.ini';
    private string $directory;
    private string $configPath;
    private $config;

    public function __construct()
    {
        $this->directory = getcwd();
        $this->configPath = $this->directory . '/symdoc.ini';
    }

    /**
     * @throws SymdocException
     */
    public function run(): void
    {
        self::config();

        $this->config = parse_ini_file($this->configPath);

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveCallbackFilterIterator(
                new \RecursiveDirectoryIterator($this->directory, \FilesystemIterator::SKIP_DOTS),
                function ($current, $key, $iterator) {
                    // Exclude the "vendor" and "var" directories
                    return !in_array($current->getFilename(), ['vendor', 'var']);
                }
            )
        );

        foreach ($iterator as $fileInfo) {
            // Process each file as needed
            echo $fileInfo->getPathname() . PHP_EOL;
        }

    }

    /**
     * Check if symdoc.ini file exists. If it does continue, if not, create it and return.
     * @throws SymdocException
     */
    private function config(): void
    {
        if (!file_exists($this->configPath)) {
            $configDir = dirname($this->configPath);
            if (!is_dir($configDir) && !mkdir($configDir, 0777, true)) {
                throw new SymdocException("Cannot create directory: $configDir");
            }

            $version = @trim(file_get_contents(__DIR__ . self::SYMDOC_VERSION))
                ?: throw new SymdocException("Cannot read version.");
            $configTemplate = @file_get_contents(__DIR__ . self::SYMDOC_INI)
                ?: throw new SymdocException("Cannot load config template.");

            $configContent = str_replace('%version%', $version, $configTemplate);
            if (file_put_contents($this->configPath, $configContent) === false) {
                throw new SymdocException("Cannot write config file: $this->configPath");
            }

            echo "\033[32m'symdoc.ini' created. Edit and re-run to generate documentation.\033[0m" . PHP_EOL;
        }
    }
}

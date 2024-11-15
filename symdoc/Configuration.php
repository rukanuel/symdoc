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

class Configuration
{

    private const SYMDOC_INI_FILE = '/_resources/symdoc.ini';
    private const SYMDOC_VERSION = '/../version';

    public static function Configuration($configPath)
    {

        if (!file_exists($configPath)) {

            $configDir = dirname($configPath);
            if (!is_dir($configDir) && !mkdir($configDir, 0777, true)) {
                throw new SymdocException("Cannot create directory: $configDir");
            }

            $version = @trim(file_get_contents(__DIR__ . self::SYMDOC_VERSION))
                ?: throw new SymdocException("Cannot read version.");
            $configTemplate = @file_get_contents(__DIR__ . self::SYMDOC_INI_FILE)
                ?: throw new SymdocException("Cannot load config template.");

            $configContent = str_replace('%version%', $version, $configTemplate);
            if (file_put_contents($configPath, $configContent) === false) {
                throw new SymdocException("Cannot write config file: $configPath");
            }
            Logger::Log("Created symdoc.ini");
            echo "\033[32m'symdoc.ini' created. Edit and re-run to generate documentation.\033[0m" . PHP_EOL;
            exit();
        }
    }
}

<?php
namespace Symdoc;

class Configuration{
    
    public static function Configuration($configPath){
        if (!file_exists($configPath)) {
            $configDir = dirname($configPath);
            if (!is_dir($configDir) && !mkdir($configDir, 0777, true)) {
                throw new SymdocException("Cannot create directory: $configDir");
            }

            $version = @trim(file_get_contents(__DIR__ . Globals::SYMDOC_VERSION))
                ?: throw new SymdocException("Cannot read version.");
            $configTemplate = @file_get_contents(__DIR__ . Globals::SYMDOC_INI)
                ?: throw new SymdocException("Cannot load config template.");

            $configContent = str_replace('%version%', $version, $configTemplate);
            if (file_put_contents($configPath, $configContent) === false) {
                throw new SymdocException("Cannot write config file: $configPath");
            }

            echo "\033[32m'symdoc.ini' created. Edit and re-run to generate documentation.\033[0m" . PHP_EOL;
            exit();
        }
    }
}
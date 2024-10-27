<?php

namespace Symdoc;

class Runner
{
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

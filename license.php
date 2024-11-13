<?php

$header = <<<HEADER
/*
 * This file is part of Symdoc.
 *
 * (c) Emanuel Rukavina <rukanuel@gmail.com>
 *
 * This source file is subject to the LGPL-2.1-only license that is bundled
 * with this source code in the file LICENSE.
 */
HEADER;

// Define the directory to scan
$srcDir = __DIR__ . '/src';

// Function to add header if missing
function addHeaderIfMissing($filePath, $header) {
    $content = file_get_contents($filePath);

    // Check if the header already exists in the file
    if (strpos($content, $header) !== false) {
        return; // Header already exists, do nothing
    }

    // Find position of declare(strict_types=1); and namespace
    if (preg_match('/<\?php\s+declare\(strict_types\s*=\s*1\);\s*/', $content, $matches, PREG_OFFSET_CAPTURE)) {
        $declareEnd = $matches[0][1] + strlen($matches[0][0]);
        
        // Insert the header with the desired spacing format
        $formattedHeader = "\n$header\n\n";
        $content = substr_replace($content, $formattedHeader, $declareEnd, 0);
        
        // Write the modified content back to the file
        file_put_contents($filePath, $content);
        echo "Header added to: $filePath\n";
    }
}

// Recursive function to scan directory for PHP files
function scanDirectory($dir, $header) {
    $files = scandir($dir);

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        $filePath = $dir . DIRECTORY_SEPARATOR . $file;

        if (is_dir($filePath)) {
            scanDirectory($filePath, $header); // Recursive call for subdirectories
        } elseif (pathinfo($filePath, PATHINFO_EXTENSION) === 'php') {
            addHeaderIfMissing($filePath, $header);
        }
    }
}

// Start scanning from the src directory
scanDirectory($srcDir, $header);

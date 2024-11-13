<?php

namespace Symdoc;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\Mime\MimeTypes;

class Controller
{
    public static function Controller(string $filepath = ''): Response
    {
        $baseDir = '../html/';

        $fullPath = $baseDir . DIRECTORY_SEPARATOR . $filepath;

        if (!file_exists($fullPath)) {
            throw new FileNotFoundException('File not found: ' . $filepath);
        }

        $fileContent = file_get_contents($fullPath);

        $mimeTypes = new MimeTypes();
        $mimeType = $mimeTypes->guessMimeType($fullPath) ?? 'application/octet-stream';  // Default MIME type if not found

        $response = new Response($fileContent);
        $response->headers->set('Content-Type', $mimeType);

        return $response;
        }
}

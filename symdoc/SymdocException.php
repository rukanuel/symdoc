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

class SymdocException extends \Exception
{
    public function __construct($message = "An error occurred in Symdoc", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        Logger::Log($this->message);
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

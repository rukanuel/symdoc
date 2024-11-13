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
    // Optional: Customize the exception message or add other properties as needed
    public function __construct($message = "An error occurred in Symdoc", $code = 0, \Throwable $previous = null)
    {
        // Call the parent constructor to set the message, code, and previous exception
        parent::__construct($message, $code, $previous);
    }

    // Optional: Custom string representation of the exception
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

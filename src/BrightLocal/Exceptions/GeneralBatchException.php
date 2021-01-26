<?php
namespace BrightLocal\Exceptions;

use Exception;

class GeneralBatchException extends Exception {

    public function __construct($message = "", $code = 0, Exception $previous = null, array $errors = null) {
        $errorsString = "\n\tERRORS:\n";
        foreach ($errors as $key => $value) {
            $errorsString .= sprintf("\t\t%s => %s\n", $key, $value);
        }
        $message = sprintf('%s%s', $message, $errorsString);
        parent::__construct($message, $code, $previous);
    }
}

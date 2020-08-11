<?php

// TODO: Documentation

/** */
function at_eof($ir) { return !((bool) $ir->remaining); }

/** */
function combine($a, $b) {}


/** */
class IR
{
    /** type: html (string) */
    public $data;

    /** type: string (remainder of input) */
    public $remaining;

    public function __construct($data, $remaining)
    {
        $this->data = $data;
        $this->remaining = $remaining;
    }

    public function __toString()
    {
        return $this->data;
    }
}

?>

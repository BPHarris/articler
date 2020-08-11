<?php

// TODO: Documentation


/** */
function newline_expected_error($what, $lineno)
{
    return new ArticlerError(
        "ParseError", "Newline expected after $what.", $lineno - 1);
}


/** */
class ArticlerError
{
    /** */
    public $type;

    /** */
    public $message;

    /** */
    public $lineno;


    public function __construct($type, $message, $lineno = null)
    {
        $this->type = $type;
        $this->message = $message;
        $this->lineno = $lineno;
    }

    public function __toString()
    {
        $lineno_html = $this->lineno ?
            "<div class=\"lineno\">$this->lineno</div>" : "";
        $html = <<<EOT
            <div class="articler-error">
                <div class="type">$this->type</div>
                $lineno_html
                <div class="message">$this->message</div>
            </div>
        EOT;
        return $html;
    }
}

?>

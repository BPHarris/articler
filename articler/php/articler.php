<?php
/** articler main script file */

require_once("ir.php");
require_once("error.php");

require_once("html.php");


/**
 * 
 * TODO: b, i, u
 * 
 * Articler Language Grammar (*.articler)
 *      articler    ::= (title | h1 | h2 | p | figure)*
 *
 *      title       ::= '#'   LINE
 * 
 *      h1          ::= '##'  LINE
 *      h1          ::= '###' LINE
 *      p           ::= LINE+ NEWLINE
 * 
 *      figure      ::= '[' ']' '('        ')' NEWLINE  // the empty figure
 *                  |   '[' ']' '('  URL   ')' NEWLINE  // figure sans caption
 *                  |   '[' CAPTION (',' 'width' '=' NUMBER '%') ']' '(' URL ')'
 * 
 *      LINE        ::= (ANY - {NEWLINE, '#', '['}) (ANY - {NEWLINE})* NEWLINE
 *      URL         ::= [a-z A-Z 0-9 \ / - _ . :]+
 *      CAPTION     ::= (ANY - {NEWLINE, '[', ']', '(', ')', ','})+
 *      NUMBER      ::= [0-9]+
 *      NEWLINE     ::= '\n'
 */

$lineno = 1;


/** @return html articler html for the given raw text */
function to_html($article) {}

/** */
function parse($input)
{
    global $lineno;
    
    $html = "";

    if (!$input)    return new ArticlerError("EmptyFile", "this only exists for debug");
    
    // HACK: Replace "\r" as parser assumes "\n" new lines
    //       Changing "\n" to "\r\n" in the parser does not fix the problem :(
    // FIXME: Does this break OSX support?
    $input = str_replace("\r", "", $input);

    while ($input)
    {
        // parse next element
        if (starts_with($input, "####"))
            return new ArticlerError("ParseError", "Unrecognised heading.", $lineno);
        elseif (starts_with($input, "###"))
            $ir = parse_title($input, "subsubtitle", strlen("###"), "subsubtitle_html");
        elseif (starts_with($input, "##"))
            $ir = parse_title($input, "subtitle",   strlen("##"),   "subtitle_html");
        elseif (starts_with($input, "#"))
            $ir = parse_title($input, "title",      strlen("#"),    "title_html");
        elseif (starts_with($input, "["))
            $ir = parse_figure($input);
        else
            $ir = parse_paragraph($input);

        if ($ir instanceof ArticlerError)
            return (string) $ir;

        $html  = $html . $ir->data;
        $input = $ir->remaining;
    }

    return "<div class=\"articler\">$html</div>";
}

/** */
function parse_title($input, $level, $skip_chars, $to_html)
{
    $ir = read_line($input, $skip_chars, $level);
    return new IR($to_html($ir->data), $ir->remaining);
}

function parse_figure($input)
{
    global $lineno;

    // $lineno++;
    return new IR("FIGURE", "");
}

function parse_paragraph($input)
{
    global $lineno;
    
    $lines = array();
    while ($input)
    {
        $ir = read_line($input, strlen(""), "paragraph");

        array_push($lines, $ir->data);
        $input = $ir->remaining;

        if (starts_with($input, "\n"))
        {
            $lineno++;
            $input = substr($input, 1);
            break;
        }

        if (starts_with($input, "#"))
            break;
        if (starts_with($input, "["))
            break;
    }

    return new IR(paragraph_html(join("", $lines)), $input);
}

/** substring from $from to first instance of the string $to */
function parse_text_to($string, $from, $to)
{
    $to = strpos($string, $to);

    if ($to == 0) return null;

    $text = substr($string, $from, $to - $from);    // TODO: htmlspecialchars
    return new IR($text, substr($string, $to + 1));
}


/**
 * 
 * @param   input   string
 * @param   from    int
 * @param   caller  string
 */
function read_line($input, $from, $caller = null)
{
    global $lineno;

    if (!isset($caller))
        $caller = "line $lineno";
    
    $ir = parse_text_to($input, $from, "\n");
    if ($ir == null)
        return newline_expected_error($caller, $lineno);
    $lineno++;

    return $ir;
}


// TODO: lib file?
function starts_with($haystack, $needle) {
    return substr_compare($haystack, $needle, 0, strlen($needle)) === 0;
}

function ends_with($haystack, $needle) {
    return substr_compare($haystack, $needle, -strlen($needle)) === 0;
}

?>

<?php
/** articler main script file */

require_once("ir.php");
require_once("error.php");

require_once("html.php");


/**
 * 
 * TODO: b, i, u, a inside para
 * 
 * Articler Language Grammar (*.articler)
 *      articler    ::= (title | h1 | h2 | p | figure | NEWLINE)*
 *
 *      title       ::= '#'   LINE
 * 
 *      h1          ::= '##'  LINE
 *      h1          ::= '###' LINE
 *      p           ::= LINE+ NEWLINE
 * 
 *      figure      ::= '!' '[' ']' '('        ')' NEWLINE
 *                  |   '!' '[' ']' '('  URL   ')' NEWLINE
 *                  |   '!' '[' CAPTION (',' 'width' '=' NUMBER '%') ']' '(' URL ')' NEWLINE
 * 
 *      LINE        ::= (ANY - {NEWLINE, '#', '[', '!'}) (ANY - {NEWLINE})* NEWLINE
 *      URL         ::= [a-z A-Z 0-9 \ / - _ . : % @ ? # =]+
 *      CAPTION     ::= (ANY - {NEWLINE, '(', ')', ',', ']'}) (ANY - {NEWLINE, ']'})*
 *      NUMBER      ::= [0-9]+
 *      NEWLINE     ::= '\n'
 */

$lineno = 1;


/** @return html articler html for the given raw text */
function to_html($article)
{
    $start_time = microtime(true);

    // parse
    $html = parse($article);

    $time_taken = round(1000000.0 * (microtime(true) - $start_time));
    print "<p>Time Elapsed: $time_taken ms</p><br>";

    return $html;
}


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
        // skip newlines
        if (starts_with($input, "\n"))
        {
            $input = substr($input, 1);
            continue;
        }

        // parse next element
        if (starts_with($input, "####"))
            return new ArticlerError("ParseError", "Unrecognised heading.", $lineno);
        elseif (starts_with($input, "###"))
            $ir = parse_title($input, "subsubtitle", strlen("###"), "subsubtitle_html");
        elseif (starts_with($input, "##"))
            $ir = parse_title($input, "subtitle",   strlen("##"),   "subtitle_html");
        elseif (starts_with($input, "#"))
            $ir = parse_title($input, "title",      strlen("#"),    "title_html");
        elseif (starts_with($input, "!"))
            $ir = parse_figure($input);
        // elseif (starts_with($input, "["))
        //     $ir = parse_link($input);
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
function parse_title($input, $level, $skip_chars, $to_html_function_name)
{
    $ir = read_line($input, $skip_chars, $level);
    return new IR($to_html_function_name($ir->data), $ir->remaining);
}

function parse_figure($input)
{
    global $lineno;

    // Empty Figure
    if (starts_with($input, "![]()\n"))
        return new IR(figure_html("", ""), substr($input, strlen("![]()\n")));
    
    $input = substr($input, 1);     // consume '!'

    if (!starts_with($input, "["))
        return unexpected_char_error($input[0], "[", 1, $lineno);

    // Get CAPTION
    $ir  = parse_text($input, strlen("["), "]");
    if ($ir == null)
        return new ArticlerError("ParseError", "Figure expects ']' after caption.", $lineno);
    $caption = $ir->data;
    $input = $ir->remaining;

    if (!starts_with($input, "("))
        return unexpected_char_error($input[0], "(", -1, $lineno);  // TODO: charno

    // Get URL
    $ir = read_line($input, strlen("("), "figure");
    if ($ir instanceof ArticlerError)
        return $ir;
    $url = $ir->data;
    $input = $ir->remaining;

    // Remove trailing ")" (from reading to "\n" not ")")
    if (!ends_with($url, ")"))
        return unexpected_char_error("EOL", ")", -1, $lineno);      // TODO: charno
    $url = substr($url, 0, -1);

    return new IR(figure_html($caption, $url), $input);
}

// function parse_link($input)
// {
//     // Empty link
//     if (starts_with($input, "[]()\n"))
//         return new IR(link_html("", ""), substr($input, strlen("![]()\n")));
    
//     if (!starts_with($input, "["))
//         return unexpected_char_error($input[0], "[", 0, $lineno);
    
//     // Get TEXT
//     $ir  = parse_text($input, strlen("["), "]");
//     if ($ir == null)
//         return new ArticlerError("ParseError", "Link expects ']' after text.", $lineno);
//     $text = $ir->data;
//     $input = $ir->remaining;

//     if (!starts_with($input, "("))
//         return unexpected_char_error($input[0], "(", -1, $lineno);  // TODO: charno

//     // Get URL
//     $ir = read_line($input, strlen("("), "link");
//     if ($ir instanceof ArticlerError)
//         return $ir;
//     $url = $ir->data;
//     $input = $ir->remaining;

//     // Remove trailing ")" (from reading to "\n" not ")")
//     if (!ends_with($url, ")"))
//         return unexpected_char_error("EOL", ")", -1, $lineno);      // TODO: charno
//     $url = substr($url, 0, -1);

//     return new IR(link_html($text, $url), $input);
// }

function parse_paragraph($input)
{
    global $lineno;
    
    $lines = array();
    while ($input)
    {
        $ir = read_line($input, strlen(""), "paragraph");

        if ($ir instanceof ArticlerError)
            return $ir;

        array_push($lines, $ir->data);
        $input = $ir->remaining;

        // Paragraph FOLLOWSET: {"\n", "#", "!"}
        if (starts_with($input, "\n"))
        {
            $lineno++;
            $input = substr($input, 1);
            break;
        }
        if (starts_with($input, "#"))
            break;
        if (starts_with($input, "!"))
            break;
    }

    return new IR(paragraph_html(join(" ", $lines)), $input);
}

/** substring from $from (exclusive) to first instance of the string $to (inclusive) */
function parse_text($string, $from, $to)
{
    $to = strpos($string, $to);

    if ($to == 0) return null;

    // TODO: htmlspecialchars($text) ?
    $text = substr($string, $from, $to - $from);
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
    
    $ir = parse_text($input, $from, "\n");
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

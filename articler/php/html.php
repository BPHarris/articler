<?php
/** articler as_*_html functions */


function title_html($title)
{
    return "<div class=\"aricle-title\">$title</div>";
}

function subtitle_html($subtitle)
{
    return "<h1>$subtitle</h1>";
}

function subsubtitle_html($subsubtitle)
{
    return "<h2>$subsubtitle</h2>";
}

function paragraph_html($paragraph)
{
    return "<p>$paragraph</p>";
}

function figure_html($caption, $target)
{
    $figure_html = <<<EOT
    <figure>
        <img src="$target"></img>
        <figcaption>$caption</figcaption>
    </figure>
    EOT;
    return $figure_html;
}

function link_html($text, $target)
{
    return "<a href=\"$target\">$text</a>";
}

?>

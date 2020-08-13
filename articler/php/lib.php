<?php


/** @return [string] html for a Font Awesome icon button */
function fa_icon_button($url, $icon)
{
    return "<a class=\"fa-icon-button\" href=\"$url\"><i class=\"$icon\"></i></a>";
}

?>
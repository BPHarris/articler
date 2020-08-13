<?php


/** @return [string] html for a Font Awesome icon button */
function fa_icon_button($url, $icon, $id = null)
{
    if ($id)
        return "<a id=\"$id\" class=\"fa-icon-button\" onclick=\"$url\"><i class=\"$icon\"></i></a>";
    return "<a class=\"fa-icon-button\" onclick=\"$url\"><i class=\"$icon\"></i></a>";
}

?>
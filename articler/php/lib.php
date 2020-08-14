<?php


/** 
 * 
 * @return [string] html for a Font Awesome icon button
 */
function fa_icon_button($action, $icon, $id = null)
{
    $action_html = $action ? " onclick=\"$action\" " : "";
    $icon_html = $icon ? "<i class=\"$icon\"></i>" : "<i class=\"far fa-square\"></i>";
    $id_html = $id ? "id=\"$id\"" : "";
    $class_html = $action ? "class=\"fa-icon-button\"" : "class=\"fa-icon-button fa-static-icon\"";
    return "<a $id_html $class_html $action_html>$icon_html</a>";
}

?>
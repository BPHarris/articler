<?php

require_once("php/articler.php");

/*
 * Given raw text in get, print the article-ified equivelant
 * For use in ajax request
 * 
 * If not ajax, redirect to index
 * 
 * Security
 *      clean input
 *          https://johnmorrisonline.com/validate-sanitize-user-input-php-using-filter_input-filter_var/
 *      if ANY parse error, do not return result (only errror code)
 */

if ($_SERVER["REQUEST_METHOD"] != "POST")
    die();


$article = "";
if (isset($_POST['article']))
    $article = $_POST['article'];
elseif (isset($_POST['article_url']))
    // TODO: Article from file
    die();
else
    die();

// TODO: Sanitise

// Call Articler Core when finished:
// https://www.tutorialspoint.com/How-to-call-Python-file-from-within-PHP

print to_html($article);

?>

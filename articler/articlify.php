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

// print to_article(RAW TEXT FROM GET);

?>

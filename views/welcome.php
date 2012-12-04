<?php

/*************************************************************************************************************************************************************************************
 *
 * WELCOME VIEW
 * Sets master template content
 * XHTML paragraph with some placeholder text
 * Also sets the $heading value for the master template
 *
 ************************************************************************************************************************************************************************************/

// set the page's heading for master template
$heading = $lang['hWelcome'];

// get the XHTML content
$tpl = file_get_contents('templates/welcome.tpl.html');

// set the keys and values to replace XHTML template
$values[] = $lang['placeholderText'];
$keys[] = '[+view+]';

// replace XHTML template
$content = str_replace($keys, $values, $tpl);

?>
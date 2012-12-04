<?php

/*************************************************************************************************************************************************************************************
 *
 * LANGUAGE VIEW
 * Sets master template language repeating area
 * List of all available languages for the application
 *
 ************************************************************************************************************************************************************************************/

// get the XHTML content
$tpl = file_get_contents('templates/language.tpl.html');

// set the string for the table rows
$langList = '';

// concat $language array into XHTML string adapted from http://stackoverflow.com/questions/3406726/echo-key-and-value-of-an-array-without-and-with-loop
foreach($language as $key => $row)
{
	if($clean_language != $key)
	{
		$rowValues[0] = $key;
		$rowValues[1] = $row;

		$rowKeys[0] = '[+langCode+]';
		$rowKeys[1] = '[+langName+]';
	
		$langList .= str_replace($rowKeys, $rowValues, $tpl);
	}
}

?>
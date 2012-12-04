<?php

/*************************************************************************************************************************************************************************************
 *
 * SONGS VIEW
 * Sets master template content
 * XHTML table of all Songs in the database with their Artist name and duration ordered by Artist name then by Song title in ascending order
 * Also sets the $heading value for the master template
 *
 ************************************************************************************************************************************************************************************/

// set the page's heading for master template
$heading = $lang['hSong'];

// get the XHTML content
$rowtpl = file_get_contents('templates/songRow.tpl.html');
$tpl = file_get_contents('templates/songs.tpl.html');

// get db data and bind to $songList array
$songList = $conn->getData(SQL_LIST_SONGS);

// set the string for the table rows
$songRow = '';

// concat and htmlentities data from $songList array into $songRow string
foreach($songList as $song)
{
	$rowValues[0] = htmlentities($song['Name']);
	$rowValues[1] = htmlentities($song['Title']);
	$rowValues[2] = date('i:s', htmlentities($song['Duration']));

	$rowKeys[0] = '[+artist+]';
	$rowKeys[1] = '[+title+]';
	$rowKeys[2] = '[+duration+]';
	
	$songRow .= str_replace($rowKeys, $rowValues, $rowtpl);
}

// set the values to replace XHTML template
$values[] = $songRow;
$values[] = $lang['artist'];
$values[] = $lang['title'];
$values[] = $lang['duration'];

// set the keys to replace XHTML template
$keys[] = '[+songRows+]';
$keys[] = '[+artist+]';
$keys[] = '[+title+]';
$keys[] = '[+duration+]';

// replace XHTML template
$content = str_replace($keys, $values, $tpl);

?>
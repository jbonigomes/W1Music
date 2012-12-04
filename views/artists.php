<?php

/*************************************************************************************************************************************************************************************
 *
 * ARTISTS VIEW
 * Sets master template content
 * XHTML table of all Artists in the database that are asscossiated to 1 or more songs as well as how many songs are associated to them ordered by Artist name
 * Also sets the $heading value for the master template
 *
 ************************************************************************************************************************************************************************************/

// set the page's heading for master template
$heading = $lang['hArtist'];

// get the XHTML content
$rowtpl = file_get_contents('templates/artistRow.tpl.html');
$tpl = file_get_contents('templates/artists.tpl.html');

// get db data and bind to $artitsList array
$artistList = $conn->getData(SQL_LIST_ARTISTS);

// set the string for the table rows
$artistRow = '';

// concat and htmlentities data from $artistList array into $artistRow string
foreach($artistList as $artist)
{
	$rowValues[0] = htmlentities($artist['Artist']);
	$rowValues[1] = htmlentities($artist['SongsCount']);

	$rowKeys[0] = '[+artistName+]';
	$rowKeys[1] = '[+artistSongs+]';
	
	$artistRow .= str_replace($rowKeys, $rowValues, $rowtpl);
}

// set the values to replace XHTML template
$values[] = $artistRow;
$values[] = $lang['artist'];
$values[] = $lang['totalSongs'];

// set the values to replace XHTML template
$keys[] = '[+artistRows+]';
$keys[] = '[+artist+]';
$keys[] = '[+songsCountHeader+]';

// replace XHTML template
$content = str_replace($keys, $values, $tpl);

?>
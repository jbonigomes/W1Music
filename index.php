<?php

/*************************************************************************************************************************************************************************************
 *
 * INDEX SCRIPT
 * This script provides the application only entry point
 * It then decides what view and language to render
 * Instantiates the database handler object
 * Binds all values to the XHTML templates
 * And finnally outputs the result to the browser
 *
 ************************************************************************************************************************************************************************************/

// require the config file
require_once('config.php');

// start session
session_set_cookie_params(APP_LANGSESSION);
session_start();

// set language to applications default
$clean_language = APP_LANG;

// check if user has chosen a language
if(isset($_GET['lang']))
{
	// sanitize $_GET
	if(array_key_exists($_GET['lang'], $language))
	{
		$_SESSION['lang'] = $_GET['lang'];
	}
}

// check if user has language pref
if(isset($_SESSION['lang']))
{
	// sanitize $_SESSION
	if(array_key_exists($_SESSION['lang'], $language))
	{
		$clean_language = $_SESSION['lang'];
	}
}

// require the other nescessary files
require_once('classes/dbHandler.class.php');
require_once('lang/' . $clean_language . '.php');
require_once('views/language.php');

// instantiate a new connection and connect to the db
$conn = new dbHander(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_SCHEMA);
$conn->dbConnect();

// data for the summary
$songCount = $conn->getData(SQL_TOTAL_SONGS);
$artistCount = $conn->getData(SQL_TOTAL_ARTISTS);

// default first view to 1 (views/welcome.php)
$clean_page = 1;

// check if $_GET has a valid reference, validation logic adapted from http://stackoverflow.com/questions/7752722/how-to-determine-whether-the-number-is-float-or-integer-in-sql-server
if(isset($_GET['page']) && is_numeric($_GET['page']) && (floor($_GET['page']) == ceil($_GET['page'])) && $_GET['page'] > 0 && $_GET['page'] < 4)
{
	$clean_page = $_GET['page'];
}

// decide what view to render
switch ($clean_page)
{
	case 2 : require_once('views/artists.php');
	break;
	
	case 3 : require_once('views/songs.php');
	break;
	
	default : require_once('views/welcome.php');
}

// get the master XHTML content
$tpl = file_get_contents('templates/master.tpl.html');

// set the $values array to replace master content
$values[] = APP_NAME;
$values[] = $heading;
$values[] = $content;
$values[] = htmlentities($artistCount[0]['ArtitsTotal']);
$values[] = htmlentities($songCount[0]['SongsTotal']);
$values[] = date("Y");
$values[] = $lang['validCSS'];
$values[] = $lang['validXHTML'];
$values[] = $lang['rights'];
$values[] = $lang['home'];
$values[] = $lang['artists'];
$values[] = $lang['songs'];
$values[] = $lang['summary'];
$values[] = $lang['activeArtists'];
$values[] = $lang['activeSongs'];
$values[] = $lang['iconsBy'];
$values[] = $lang['flagsBy'];
$values[] = $lang['validationIcons'];
$values[] = $clean_page;
$values[] = $clean_language;
$values[] = $language[$clean_language];
$values[] = $langList;

// set the $keys array to replace master content
$keys[] = '[+appName+]';
$keys[] = '[+heading+]';
$keys[] = '[+content+]';
$keys[] = '[+artistsCount+]';
$keys[] = '[+songsCount+]';
$keys[] = '[+year+]';
$keys[] = '[+validCSS+]';
$keys[] = '[+validXHTML+]';
$keys[] = '[+allRightsReserved+]';
$keys[] = '[+home+]';
$keys[] = '[+artists+]';
$keys[] = '[+songs+]';
$keys[] = '[+summary+]';
$keys[] = '[+activeArtists+]';
$keys[] = '[+activeSongs+]';
$keys[] = '[+iconsBy+]';
$keys[] = '[+flagsBy+]';
$keys[] = '[+validationIconsBy+]';
$keys[] = '[+currentPage+]';
$keys[] = '[+langCode+]';
$keys[] = '[+langName+]';
$keys[] = '[+langList+]';

// replace master content
$output = str_replace($keys, $values, $tpl);

// close db connection
$conn->dbDisconnect();

// display output
echo $output;

?>

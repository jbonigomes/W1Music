++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
+
+	PHP with MySQL TMA Exercise
+	jgomes01 - 12500741 - FDWT - June 2012
+	Adapted from Hands-On Excercises
+
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

Description
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
This is the source code for the music store for the PHP with MySQL TMA Exercise
The sample application can be found at:
http://www.dcs.bbk.ac.uk/~jgomes01/w1music
 
Installation
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Before deploying this application, the necessary database tables need to be created.
If you need to create them, you should login to your database and execute the queries found in: install/w1tma_tables.sql
The install/w1tma_queries.sql is only a reference file as the queries are built into the application and found at: config.php
NB: the "install" directory should not be deployed with the application

Configuration
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
All configuration settings for this application can be found in: config.php
Adjust these to suit your environment before deploying the application

Adding a new language
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
To add a new language, follow the steps below:

 * Download the package 'Flag Icons' from http://icondrawer.com/free.php
 * Extract the package and copy only the required flag(s) to the images directory
     + The images used for this application are the 32px x 32px, thus located inside the folder named 32
     + Rename the file (keep the file extension), this application uses ISO 639-1 codes to differentiate between languages but the images from IconDrawer use ISO 3166-1 alpha-2 codes
     + This link can help with the conversion: http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
 * Copy and paste in the same directory lang/en.php or any other language of your choice and rename the file with the same code used for the image (keep the file extension)
 * Translate the file, not the array keys, but the values. More information can be found in the comments section of the language file (at the top)
 * On config.php, add the new language to the $language array (in the language section), the key should be the ISO 639-1, same as above and the value should be the language name as it should be displayed
     + For example, to add Portuguese language, a new line that reads "$language['pt'] = 'Português';" should be added, where pt is the ISO 639-1 and Português is the language name as it should be displayed
     + More details on arrays can be found at: http://php.net/manual/pt_BR/language.types.array.php
 * There are two other parameters that can be amended in the language configuration,
     + The session expiration time for remembering a user language preference: This is set in seconds and the default is 15 days long or 1296000, it can be amended on "define("APP_LANGSESSION", "1296000");"
     + The default language can be amended on "define("APP_LANG", "en");" again, using the ISO 639-1 of a language that exists in the application

NB: If a user chooses a language during run time, the application default will be overwritten for as long as the session last.
    Also, only edit the value of the constant, not the constant name (more on constants at http://php.net/manual/en/language.constants.php)

Notes
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Icons have been provided by http://dryicons.com, the flag icons by http://www.icondrawer.com and the XHTML and CSS validation icons by http://www.validationicons.com/
Special thanks to http://php.net/ and http://www.w3schools.com/ for providing such concise and helpful documentation
The language list markup has been adapted from http://stackoverflow.com/questions/2400482/how-do-i-make-a-div-button-submit-the-form-its-sitting-in
The application validates as DTD XHTML 1.0 Strict and CSS 3
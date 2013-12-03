<?php
/*
Website base url
*/
define( 'BASEURL', 'http://localhost/' );

/*
Website Application directory relative to root
where the application scripts are placed. If
installedin root just leave blank
*/
define( 'APPDIR', '' );

/*
Site URL
*/
define( 'SITEURL', BASEURL . APPDIR );

/*
Directory location where controllers, models, views are kept
*/
define( 'APPFOLDER', 'application/' );

/*
Class libraries directory
*/
define( 'LIBRARIESFOLDER', 'includes/libraries/' );

/*
Helper Classes directory
*/
define( 'HELPERSFOLDER', 'includes/helpers/' );

/*
Application controllers folder
*/
define( 'CONTROLLERSFOLDER', 'application/controllers/' );

/*
Application models folder
*/
define( 'MODELSFOLDER', 'application/models/' );

/*
Application views folder
*/
define( 'VIEWSFOLDER', 'application/views/' );

/*
Application themes folder
*/
define( 'THEMESFOLDER', 'themes/' );

/*
Application css folder
*/
define( 'THEMESCSSFOLDER', 'themes/css/' );

/*
Application javascript folder
*/
define( 'THEMESJSFOLDER', 'themes/js/' );

/*
Application layout images folder
*/
define( 'THEMESIMAGESFOLDER', 'themes/images/' );

/*
Application template file to use in loading a view
*/
define( 'TEMPLATEFILE', 'template' );

/* 
Application file extension
*/
define( 'EXT', '.php' );

/*
Uploads directory
*/


/*
Application default controller to call if there is no
controller specified in the requested url
*/
define( 'DEFAULTCONTROLLER', 'home' );

/*
Application Enviroment
- production
- development
*/
define( 'ENVIRONMENT', 'development' );

/*
Benchmark
*/
define( 'BENCHMARK', true );

//////////////////////////////////////////////////////// ADDITIONAL CONFIGURATION //////////////////////////////////////////////////////
$config['autoload']['libraries'] = array( 'validator' );
$config['autoload']['helpers'] = array( 'db', 'url' );

?>
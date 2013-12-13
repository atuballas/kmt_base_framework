<?php
session_start();
include_once( 'includes/configuration.php' );
include_once( 'includes/frontController.php' );
include_once( 'includes/database.php' );

if( defined( ENVIRONMENT ) ){
	switch( ENVIRONMENT ){
		case 'development':
			error_reporting(E_ALL);
		break;
		case 'production';
			error_reporting(0);
		break;
		default:
			exit( 'Application environment is not set properly.' );
		break;
	}
}

$system = new FrontController();
$system->initSystem();
?>
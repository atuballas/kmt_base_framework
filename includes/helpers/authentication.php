<?php
class Authentication extends FrontController{
	function __construct(){
	}
	
	function checkIfAuthenticated(){
		if( isset( $_SESSION['admin']['authenticated'] ) ){
			return true;
		}else{
			header( 'Location: ' . SITEURL . 'admin/login/' );
			exit;
		}
	}
}
?>
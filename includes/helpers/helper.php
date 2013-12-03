<?php
class Helper extends FrontController{
	public function mysqlCleanString( $string ){
		return mysql_real_escape_string( $string );
	}
	
	public function formatDate( $format, $date ){
		return date( $format, strtotime( $date ) );
	}
	
	public function utf8ConvertString( $string ){
		return utf8_encode( $string );
	}
}
?>
<?php
class Db extends FrontController{
	
	public $dbRequests = 0;

	public function exec( $query ){
		$this->dbRequests++;
		return mysql_query( $query );
	}
}
?>
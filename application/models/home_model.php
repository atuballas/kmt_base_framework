<?php
class Home_model extends FrontController{
	public function __construct(){
		$this->loadHelper( 'db' );	// load helper db class
	}
	
	public function testModelMethod(){
		$query = $this->db->exec( 'SELECT id FROM admin' );
	}
}
?>
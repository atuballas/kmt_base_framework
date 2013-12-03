<?php
class Home extends FrontController{
	public function __construct(){
		$this->autoLoader();	// autoloads helper and library classes
										// see configuration.php file for hte config variable
		$this->loadModel( 'home_model' );	// load model class
		//$this->loadLibrary( 'validator' );	// load library validator class
		//$this->loadHelper( 'url' );	// load helper validator class
	}
	
	public function index(){
		echo $this->validator->addRule();
		$this->home_model->testModelMethod();
		$this->loadView( 'home', $data=array() );	// load the view file
	}
	
}
?>
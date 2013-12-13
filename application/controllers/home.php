<?php
class Home extends FrontController{
	public function __construct(){
		$this->autoLoader();								// load libraries and helpers defined in 
																			// autoload .php file
		$this->loadModel( 'home_model' );	// load model class
		//$this->loadLibrary( 'validator' );	// load library validator class
		//$this->loadHelper( 'url' );	// load helper validator class
	}
	
	public function index(){
		$this->home_model->testModelMethod();
		$this->loadView( 'home', $data=array() );	// load the view file
	}
	
}
?>
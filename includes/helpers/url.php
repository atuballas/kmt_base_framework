<?php
class Url extends FrontController{
	public function __construct(){
	}
	
	/*
	@function: getSegments()
	@desc: returns the url segments based on the requested url
	@parameters: none
	@return: array
	*/
	public function getSegments(){
		$uri = $_SERVER['REQUEST_URI'];
		$uri = rtrim( ltrim( $uri, '/' ), '/' );
		$uri = explode( '/', $uri );
		return $uri;
	}
	
	/*
	@function: getControllerName()
	@desc: returns the current controller name requested
	@parameters: none
	@return: string
	*/
	public function getControllerName(){
		return FrontController::$controller;
	}
	
	/*
	@function: getMethodName()
	@desc: returns the current method name executed
	@parameters: none
	@return: string
	*/
	public function getMethodName(){
		return FrontController::$method;
	}
	
	/*
	@function: getParameters()
	@desc: returns the parameters from the requested url
	@parameters: none
	@return: array
	*/
	public function getParameters(){
		return FrontController::$parameters;
	}
	
	/*
	@function: text2Url()
	@desc: converts text to a good SEO URL
	@parameter: string
	@return: string
	*/
	public function text2Url( $texteaurl ){
		$texteaurl=strtr($texteaurl,"ΰαβγδηθικλμνξορςστυφωϊϋόύÿΐΑΒΓΔΗΘΙΚΛΜΝΞΟΡÒΣΤΥΦΩΪΫάέ /.-",
		"aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY    ");
		$texteaurl=trim($texteaurl);
		$texteaurl = eregi_replace(" ", ",", $texteaurl);
		$texteaurl = eregi_replace("[^a-z0-9,]", ",", $texteaurl);
		$texteaurl = eregi_replace("[,]+", ",", $texteaurl);
		$texteaurl = strtolower($texteaurl);
		return $texteaurl;
	}
}
?>
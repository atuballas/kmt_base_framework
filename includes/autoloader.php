<?php
class Autoloader extends FrontController{

	public  function autoload( $autoload ){
		// autoload libraries
		if( isset( $autoload['libraries'] ) && ! empty( $autoload['libraries'] ) ){
			foreach( $autoload['libraries'] as $k => $v ){
				
			}
		}
		
		// autoload helpers
		if( isset( $autoload['helpers'] ) && ! empty( $autoload['helpers'] ) ){
			foreach( $autoload['helpers'] as $k => $v ){
				include_once( HELPERSFOLDER . $v . EXT );
				$helperClass = ucfirst( strtolower( $v ) );
				//self::$autoloads['helpers'][] = $helperClass;
				$this->$v = new $helperClass();	// create class instance
			}
		}
	}
}
?>
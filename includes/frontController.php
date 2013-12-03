<?php
class FrontController{
	protected static $controller = DEFAULTCONTROLLER;
	protected static $method = 'index';
	protected static $parameters = array();
	protected static $config = array();
	
	final static public function initSystem(){
		session_start();
		include_once( 'includes/configuration.php' );
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
		self::$config = $config;
		Database::dbConnect();
		self::router();
	}

	final static private function loadController(){
		if( ! file_exists( CONTROLLERSFOLDER . self::$controller . EXT ) ){
			echo 'error 404';
			exit;
		}
		/*
		Load the controller class file and execute its method, based
		on the requested URI string
		*/
		include_once( CONTROLLERSFOLDER . self::$controller . EXT );
		self::$controller = explode( '/', self::$controller );
		self::$controller = end( self::$controller );
		$classname = ucfirst( strtolower( self::$controller ) );
		$classname = new $classname();	// create class instance
		$method = self::$method;
		if( ! method_exists( $classname, $method ) ){
			echo 'error 404';
			exit;
		}
		$classname->$method();
	}
	
	final protected function autoLoader(){
		$autoload = self::$config['autoload'];
		
		// autoload libraries
		if( isset( $autoload['libraries'] ) && ! empty( $autoload['libraries'] ) ){
			foreach( $autoload['libraries'] as $k => $v ){
				include_once( LIBRARIESFOLDER . $v . EXT );
				$libraryClass = ucfirst( strtolower( $v ) );
				$this->$v = new $libraryClass();	// create class instance
			}
		}
		
		// autoload helpers
		if( isset( $autoload['helpers'] ) && ! empty( $autoload['helpers'] ) ){
			foreach( $autoload['helpers'] as $k => $v ){
				include_once( HELPERSFOLDER . $v . EXT );
				$helperClass = ucfirst( strtolower( $v ) );
				$this->$v = new $helperClass();	// create class instance
			}
		}
	}
	
	final protected function loadModel( $model ){
		if( ! file_exists( MODELSFOLDER . $model . EXT ) ){
			echo 'unable to load the requested model file';
			exit;
		}
		include_once( MODELSFOLDER . $model . EXT );
		$model = explode( '/', $model );
		$model = array_reverse( $model );
		$classname = ucfirst( strtolower( $model[0] ) );
		$this->$model[0] = new $classname();	// create class instance, and return the instance to the passed parameter
	}
	
	final protected function loadView( $view , $data = array() ){
		if( ! file_exists( VIEWSFOLDER . $view . EXT ) ){
			echo 'unable to load the requested view file';
			exit;
		}
		if( ! file_exists( THEMESFOLDER . TEMPLATEFILE . EXT ) ){
			echo 'unable to load the template file';
			exit;
		}
		extract( $data );
		
		// if $data['templatefile'] exists then override the default template to use in the view
		include_once( THEMESFOLDER . ( ( isset( $data['templateFile'] ) && ! empty( $data['templateFile'] ) ) ? $data['templateFile'] : TEMPLATEFILE ) . EXT );
	}
	
	final protected function loadLibrary( $library ){
		if( ! file_exists( LIBRARIESFOLDER . $library . EXT ) ){
			echo 'unable to load the requested library file';
			exit;
		}
		include_once( LIBRARIESFOLDER . $library . EXT );
		$classname = ucfirst( strtolower( $library ) );
		$this->$library = new $classname();	// create class instance, and return the instance to the passed parameter
	}
	
	final protected function loadHelper( $helper ){
		if( ! file_exists( HELPERSFOLDER . $helper . EXT ) ){
			echo 'unable to load the requested library file';
			exit;
		}
		include_once( HELPERSFOLDER . $helper . EXT );
		$classname = ucfirst( strtolower( $helper ) );
		$this->$helper = new $classname();	// create class instance, and return the instance to the passed parameter
	}
	
	final static private function router(){
		$uri = $_SERVER['REQUEST_URI'];
		$uri = rtrim( ltrim( $uri, '/' ), '/' );
		$uri = explode( '/', $uri );
		$segments = ( ( APPDIR != '' ) ? count( $uri ) - 1 : ( ( $uri[0] != '' ) ? count( $uri ) : count( $uri ) -1 ) );
		$controllerPath =  '';
		$lastSegment = 0;
		$isSeen = false;
		
		// Determine the proper controller
		if( isset( $uri[( ( APPDIR != '' ) ? 1 : 0 )] ) && $uri[( ( APPDIR != '' ) ? 1 : 0 )] != '' ){
			foreach( $uri as $i=>$u ){
				if( $segments == $i ) break;
				if( file_exists( CONTROLLERSFOLDER . $controllerPath . ( ( APPDIR != '' ) ? $uri[$i+1]: $uri[$i] ) . EXT ) ){
					self::$controller = $controllerPath . ( ( APPDIR != '' ) ? $uri[$i+1]: $uri[$i] );
					$isSeen = true;
					$lastSegment = ( ( APPDIR != '' ) ? $i+1 : $i );
					break;
				}else $controllerPath .= ( ( APPDIR != '' ) ? $uri[$i+1]: $uri[$i] ) . '/';
			}
		}
		
		// Check if controller is seen
		if( $isSeen === false && $segments > 0 ){
			echo 'Unable to load the requested controller';
			exit;
		}
		
		// Determine the proper method
		if( isset( $uri[$lastSegment+1] ) && $uri[$lastSegment+1] != '' ){
			self::$method = $uri[$lastSegment+1];
		}
		
		// Determine the proper parameters
		if( $segments > $lastSegment+1 ){
			for( $i=$lastSegment+2; $i<( ( APPDIR != '' ) ? $segments+1 : $segments ); $i++ ){
				self::$parameters[] = $uri[$i];
			}
		}
	
		self::loadController();
	}
}
?>
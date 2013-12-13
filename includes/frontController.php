<?php
class FrontController{

	protected $controller = DEFAULTCONTROLLER;
	protected $method = 'index';
	protected $parameters = array();
	protected $config = array();

	final public function initSystem(){
		$dbObj = new Database();
		$dbObj->dbConnect();
		$this->router();
	}

	final private function loadController(){
		if( ! file_exists( CONTROLLERSFOLDER . $this->controller . EXT ) ){
			echo 'error 404';
			exit;
		}
		/*
		Load the controller class file and execute its method, based
		on the requested URI string
		*/
		include_once( CONTROLLERSFOLDER . $this->controller . EXT );
		$this->controller = explode( '/', $this->controller );
		$this->controller = end( $this->controller );
		$classname = ucfirst( strtolower( $this->controller ) );
		$classname = new $classname();	// create class instance
		$method = $this->method;
		if( ! method_exists( $classname, $method ) ){
			echo 'error 404';
			exit;
		}
		$classname->$method();
	}
	
	final protected function autoLoader(){
		include_once( 'autoload.php' );
	
		// autoload libraries
		if( isset( $autoload['libraries'] ) && ! empty( $autoload['libraries'] ) ){
			foreach( $autoload['libraries'] as $k => $v ){
				$this->loadLibrary( $v );
			}
		}
		
		// autoload helpers
		if( isset( $autoload['helpers'] ) && ! empty( $autoload['helpers'] ) ){
			foreach( $autoload['helpers'] as $k => $v ){
				$this->loadHelper( $v );
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
	
	final private function router(){
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
					$this->controller = $controllerPath . ( ( APPDIR != '' ) ? $uri[$i+1]: $uri[$i] );
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
			$this->method = $uri[$lastSegment+1];
		}
		
		// Determine the proper parameters
		if( $segments > $lastSegment+1 ){
			for( $i=$lastSegment+2; $i<( ( APPDIR != '' ) ? $segments+1 : $segments ); $i++ ){
				$this->parameters[] = $uri[$i];
			}
		}
	
		$this->loadController();
	}
}
?>
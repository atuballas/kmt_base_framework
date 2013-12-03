<?php
/*  
Form Validator Class
Author: Alvin Mark Tuballas(atuballas@github.com)
Description:
	Form validator class is very simple and useful 
	for rapid form post variables validation.
	Currently it has the following set of validation
	rules:
	> Required
	> Minimun Length
	> Maximum Length
	> Pattern
Sample Usage:
$v = new Validator();			// instantiate the class
$_POST['name'] = 'Alvin mark';		// sample form post variable
$_POST['lastname'] = 'Alvin Mark';	// sample form post variable

// Create the validation rules, take note the key in the array,
// matches the key in the POST
$rules = array(
				'name' => array( 'required' => true, 'minimum' => 5, 'maximum' => 8, 'pattern' => '/^[0-9]+$/' ),
				'lastname' => array( 'required' => true, 'minimum' => 5, 'maximum' => 20 )
			  );

// Call the addRule() method in the class to prepare the validations			  
$v->addRule( $rules );

// Run the validation
$v->run();


echo '<pre>';
// To check for a validation error get the value of the property $v->error
echo 'Form Validation Error: ' . $v->error . '<br>';

// To get the validation error descriptions, print the value of the property
// $v->error_desc
echo 'Form Validation Error Descriptions: <br>';
print_r( $v->error_desc );		
*/
class Validator{

	private $rules = array();
	public $error = false;
	public $error_desc = array();
	
	public function __construct(){
	}
	
	final public function run(){
		foreach( $this->rules as $index => $validations ){
			foreach( $validations as $k	=> $v ){
				$this->$k( $index, $v );
			}
		}
		
		// If there are errors, set $this->error to true
		if( ! empty( $this->error_desc ) ){
			$this->error = true;
		}
	}
	
	final public function addRule( $rules ){
		$this->rules = $rules;
	}
	
	/*
	@Function: required()
	@Description: checks if the field has value and not empty
	@Params: none
	@Returns: none
	*/
	final private function required( $index, $required ){
		if( $required ){
			if( $_POST[$index] == '' ){
				$this->error_desc['required'][] = $index;
			}
		}
	}

	/*
	@Function: minimum()
	@Description: checks for field's value minimum length
	@Params: none
	@Returns: none
	*/
	final private function minimum( $index, $length ){
		if( strlen( $_POST[$index] ) < $length ){
			$this->error_desc['minimum'][] = $index; 
		}
	}
	
	/*
	@Function: maximum()
	@Description: checks for field's value maximum length
	@Params: none
	@Returns: none
	*/
	final private function maximum( $index, $length ){
		if( strlen( $_POST[$index] ) > $length ){
			$this->error_desc['maximum'][] = $index; 
		}
	}
	
	/*
	@Function: maximum()
	@Description: checks for field's value pattern
	@Params: none
	@Returns: none
	*/
	final private function pattern( $index, $pattern ){
		if( ! preg_match( $pattern, $_POST[$index] ) ){
			$this->error_desc['pattern'][] = $index; 
		}
	}
	
}
?>
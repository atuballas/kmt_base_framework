-------------------------------------------------------------------
Mark's Framework
-------------------------------------------------------------------
I. Url Structure
	A. APPDIR(configuration.php) is set
		- http://domain.com/framework/controller/method/parameter1/parameter2
		where:
		framework/ - is the APP DIR
		
	B. APPDIR(configuration.php) is not set
		- http://domain.com/controller/method/parameter1/parameter2
		
II. Default Controller and Method
	If there is no defined controller and method in the requested URL, then the
	framework will load the following:
	home - controller
	index - method
	
	Example:
		- http://domain.com/
		In the example above, the framework will automatically load home controller and index method.
		

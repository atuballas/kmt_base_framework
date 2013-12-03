<style>
body{ font-family:"Helvetica Neue",Arial,Helvetica,sans-serif }
h1{ color:#444;font-size:30px }
ul{ list-style:none;padding:0;font-size:14px; }
</style>
<h1>
KMT PHP Application Framework
</h1>

<ul>
	<li>
		Controller: <?php echo $this->url->getControllerName();?><br>
		Method: <?php echo $this->url->getMethodName();?><br>
		Parameters: <?php print_r( $this->url->getParameters() );?><br>
	</li>
</ul>
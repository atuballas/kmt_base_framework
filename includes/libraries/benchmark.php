<style>
div#benchmark-pane{position:fixed;bottom:0;left:0;width:100%;border:1px solid #a1a1a1;border-left:0px;border-right:0px;height:30px;}
div#benchmark-pane ul li{list-style:none;float:left;padding:6px 10px;border:1px solid #a1a1a1;border-top:0px;border-bottom:0px solid;margin:-14px -1px 0 0;cursor:pointer;}
span.data{display:none}
div#data-pane{position:fixed;left:0;bottom:20px;width:100%;padding:10px 10px 25px 10px;height:auto;border-top:1px solid #a1a1a1;display:none;}
</style>
<div id="data-pane">
	<span class="database data" id="database">database</span>
	<span class="memory data" id="memory">
		<h3>Memory Management</h3>
		<p>PHP Memory Allocation: <?php echo round( ( memory_get_usage() / 1024 / 1024 ), 3 );?> MB</p>
		<p>PHP Peak Memory Allocation: <?php echo round( ( memory_get_peak_usage() / 1024 / 1024 ), 3 );?> MB</p>
	</span>
	<span></span>
</div>
<div id="benchmark-pane">
	<div class="container">
		<ul>
			<li class="benchmark-database benchmark" onclick="showBenchmark('database');">Database Queries</li>
			<li class="benchmark-memory benchmark" onclick="showBenchmark('memory');">Memory Management</li>
		</ul>
	</div>
</div>
<script>
function showBenchmark(a){
	document.getElementById('data-pane').style.display='block';
	document.getElementById(a).style.display='block';
}
</script>
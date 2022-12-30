<?php
script('sciencemesh', 'contacts');
style('sciencemesh', 'style');
?>
<meta http-equiv="Content-Security-Policy" content="default-src *; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline' 'unsafe-eval' http://www.google.com">
<div id="app">
	<div id="app-navigation">
		<?php print_unescaped($this->inc('navigation/index')); ?>
	</div>
	<div id="app-content">
		<div id="app-content-wrapper" class="viewcontainer">
			<div class="app-content-list" id="test">
			</div>
		</div>
	</div> 	
</div>

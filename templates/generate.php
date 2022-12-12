<?php
script('sciencemesh', 'generate');
style('sciencemesh', 'style');
?>
<div id="app">
	<div id="app-navigation">
		<?php print_unescaped($this->inc('navigation/index')); ?>
	</div>

	<div id="app-content">
		<div id="app-content-wrapper" class="viewcontainer">
			<div class="app-content-list" style="display:flex;padding:5px">

				<div class="app-content-list-item-icon token-added" id="elem">+</div>
				<div href="#" class="app-content-list-item token-generator">
					<div class="app-content-list-item-line-one">Generate a new token</div>
					<div class="app-content-list-item-line-two"><small>Tokens are valid for 24 hours</small></div>					
				</div>
			</div>
			<div id="test" href="#" class="app-content-list-item-token">
				<div class="app-content-list-item-token-div" id="show_result"></div>
			</div>
		</div> 
	</div>
</div>
<?php 
script('sciencemesh', 'generate-footer');
?>


<?php 
	
	add_action( 'wd_loading_page', 'wd_print_loading_html', 10 );
	function wd_print_loading_html(){
		?>
		<div class="wd-loading-wrapper"></div>
		<script style="text/javascript">
			
			jQuery(document).ready(function(){
				"use strict";
				jQuery('.wd-loading-wrapper').hide();
			});
		</script>
		<?php 
	}
	
?>
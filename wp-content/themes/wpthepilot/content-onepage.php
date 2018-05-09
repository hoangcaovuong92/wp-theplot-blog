<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<?php 
the_content();
?>
<script type='text/javascript'>
jQuery(document).ready(function() {
			
    var $htmlBody = jQuery('html, body');
	jQuery('#fullpage .row_page').remove();
	 
	if( jQuery('#fullpage').length && jQuery(window).width() > 1024 ) {
		if(jQuery('#fullpage').hasClass('enable_pc')) {
			jQuery('#fullpage.enable_pc').fullpage({
				'css3': true,
				'sectionsColor': ['#F0F2F4', '#fff', '#fff', '#fff'],
				'navigation': true,
				'navigationPosition': 'right',
				'afterLoad': function(anchorLink, index){
					
					if(jQuery('#fullpage div:first').hasClass('active')){

						jQuery('#template-wrapper header').show();

					} else{
						jQuery('#template-wrapper header').hide();
					}
				}
				
			});
		}	
	}
	$htmlBody.css({
                    'overflow' : 'hidden',
                    'height' : '100vh'
                });
			
});


</script>
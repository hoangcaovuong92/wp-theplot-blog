<?php 

function wd_custom_avatar_field( $user ) { ?>
	<h3>Custom Avatar</h3>
	 
	<table class="form-table">
		<tbody>
			<tr class="wd-user-avatar-wrap">
				<th><label for="user_avartar">Custom atatar URL:</label></th>
				<td>
					<input type="hidden" class="user_avartar" name="user_avartar" value="" />
					<img src="" alt="" class="wd-image-preview" width="100px" height="100px" style="display: block; margin-bottom: 10px;" />
					<a href="#" class="wd-upload-avatar button button-secondary">Select Image</a>
					<a href="#" class="wd-clear-avatar button button-delete">Clear Image</a>
				</td>
			</tr>
		</tbody>
	</table>
	
	<script type="text/javascript">
		jQuery(document).ready(function() {
			"use strict";
			
		});

	</script>
	<?php 
}


add_action( 'show_user_profile', 'wd_custom_avatar_field' );
add_action( 'edit_user_profile', 'wd_custom_avatar_field' );

add_action('admin_enqueue_scripts', 'init_admin_script');

function init_admin_script(){
	wp_enqueue_script('jquery');
		
	if( !did_action('wp_enqueue_media') )
		wp_enqueue_media();
		
	wp_register_script('wdsi_admin_media_lib', THEME_JS . '/admin-user-avatar-media-lib.js', 'jquery', false,false);
	wp_enqueue_script('wdsi_admin_media_lib');
		
}


?>
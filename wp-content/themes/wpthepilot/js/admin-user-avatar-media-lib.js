(function ($) {
    var file_frame;
	var _this_button;
    $('.wd-upload-image-button').live('click', function( event ){
        _this_button = $(this);
        event.preventDefault();
			 
        if ( file_frame ) {
            file_frame.open();
            return;
        }

        var _states = [new wp.media.controller.Library({
            filterable: 'uploaded',
            title: 'Select an Image',
            multiple: false,
            priority:  20
        })];
			 
        file_frame = wp.media.frames.file_frame = wp.media({
            states: _states,
            button: {
                text: 'Insert URL'
            }
        });

        file_frame.on( 'select', function() {
            var attachment = file_frame.state().get('selection').first().toJSON();
			var attachment_id = attachment.id;
			var attachment_url = attachment.url;
            _this_button.siblings('.wd-image-preview').attr('src',attachment_url); 
            _this_button.siblings('.attachment_id').val(attachment_id); 
        });
		 
        file_frame.open();
    });
	
	jQuery('.wd-clear-image-button').live('click',function(e){
		var ok = confirm('Do you want to remove this image?');
		if( ok ){
			jQuery(this).siblings('img').attr('src','');
			e.preventDefault();
		}
		else{
			e.preventDefault();
		}
	});
    
})(jQuery);

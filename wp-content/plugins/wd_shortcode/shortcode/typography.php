<?php 
if(!function_exists ('heading_function')){
	function heading_function($atts, $content = null){
		extract(shortcode_atts(array(
			'size' 		=> 'h1',
			'align'		=> '',
			'icon_fontawesome' =>'',
			'icon_openiconic' => '',
			'icon_typicons'  => '',
			'icon_entypo'	=>'',
			'icon_linecons' =>'',
			'style'		=> 'style1'
		), $atts));
		return "<div class='heading-title-block {$style}'><{$size}><span class='title-text'>".do_shortcode($content)."</span><span class='icon'><i class='{$icon_fontawesome} {$icon_openiconic} {$icon_typicons} {$icon_entypo} {$icon_linecons}'></i></{$size}></span></div>";				
	}
}
add_shortcode('wd_heading','heading_function');



if(!function_exists ('checklist_function')){
	function checklist_function($atts, $content){
		extract(shortcode_atts(array(
			'icon' 		=> 'none',
		), $atts));
		
		$icon = trim($icon);
		
		$match = preg_match('/.*?<ul>(.*?)<\/ul>.*?/ism',$content,$content_match);
		if( $match ){
			$math = preg_match_all('/<li>(.*?)<\/li>/ism',$content,$content_match);
			if( $math ){
				$new_string = "<li><i class=\"{$icon}\"></i>";
				$content = str_replace ( "<li>" , $new_string , $content );
			}
		}
		

		return "<div class='checklist-block shortcode-icon-list shortcode-icon-{$icon}'>".do_shortcode($content)."</div>";
	}
}
add_shortcode('wd_checklist','checklist_function');
?>
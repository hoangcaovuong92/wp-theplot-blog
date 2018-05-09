<?php 
if(!function_exists ('wd_quote_function')){
	function wd_quote_function($atts,$content){
		extract(shortcode_atts(array(
			'class'		=>'',
			'style'		=> 'style1'
		),$atts));
		//$result="<div class='quote-style {$class}'><span>".do_shortcode($content)."</span><span class='end'></span></div>";
		$result="<blockquote class='{$style}'><p>".do_shortcode($content)."</p></blockquote>";
		return $result;
	}
}
add_shortcode('wd_quote','wd_quote_function');
?>
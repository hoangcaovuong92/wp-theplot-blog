<?php
	include_once('wp-load.php');
	$_config_uri = get_option( "siteurl", "" );
	$hostMyUrls = array(
		$_config_uri
	);
	global $wpdb;
	$thisPreFix = $wpdb->base_prefix;
	if(isset($_POST) && isset($_POST['wp_url'])){
		$siteUrl = $_POST['wp_url'];
		$result1 = $wpdb->query("
			update `{$thisPreFix}options` set `option_value`='{$siteUrl}' where `option_name` in('siteurl','home');
		");
		foreach($hostMyUrls as $thisUrl){
			$result0 = $wpdb->query("update `{$thisPreFix}links` set `link_url` = replace(`link_url`, '{$thisUrl}', '{$siteUrl}');");
			$result2 = $wpdb->query("update `{$thisPreFix}posts` set `guid` = replace(`guid`, '{$thisUrl}', '{$siteUrl}');");
			$result3 = $wpdb->query("update `{$thisPreFix}posts` set `post_content` = replace(`post_content`, '{$thisUrl}', '{$siteUrl}');");
			$result4 = $wpdb->query("update `{$thisPreFix}postmeta` set `meta_value` = replace(`meta_value`, '{$thisUrl}', '{$siteUrl}');");
		}
		if ($result1===false || $result2===false || $result3===false || $result4===false || $result0===false) {
			die('Invalid query');
		}else{
			echo "<br>Success!Please go to Backend,Permalink Settings(Settings > Permalinks).Hit Save Changes button";
		}
	}
	$uploads = wp_upload_dir();
	if(!is_dir($uploads['basedir'].'/ew_images')){
		mkdir($uploads['basedir'].'/ew_images', 0777,true);
		chmod($uploads['basedir'].'/ew_images', 0777);
	}else{
		chmod($uploads['basedir'].'/ew_images', 0777);
	}
	
	$themeURI = get_theme_root().'/'.get_template();
	
	if(!is_dir($themeURI.'/cache')){
		mkdir($themeURI.'/cache', 0777,true);
		chmod($themeURI.'/cache', 0777);
	}else{
		chmod($themeURI.'/cache', 0777);
	}

	if(!is_dir($themeURI.'/cache_theme')){
		mkdir($themeURI.'/cache_theme', 0777,true);
		chmod($themeURI.'/cache_theme', 0777);
	}else{
		chmod($themeURI.'/cache_theme', 0777);
	}
?>

<form name="input" action="" method="post">
<p>
Input your wordpress url: <input type="text" name="wp_url" /> <strong>(* : without '/' at the end of url)</strong>
</p>
<input type="submit" value="Submit" />
</form> 
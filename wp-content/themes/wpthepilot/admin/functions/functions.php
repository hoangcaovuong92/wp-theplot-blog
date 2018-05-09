<?php
global $xml_arr_file, $xml_headers;
$xml_arr_file = array();
$target_dir = get_template_directory() ."/config_xml/";

$files = scandir($target_dir);
$xml_arr_file = array();
foreach($files as $file) {
	$pos = strripos($file, '.xml');
	$pos2 = strripos($file, 'color');
	if($pos2 !== false && $pos !== false) array_push($xml_arr_file, substr($file, 0, $pos));
}

function wd_get_export_color_theme(){
	global $smof_data;
	$slug = $_POST['slug'];
	$file = $smof_data[$slug];
	$xml_dir = get_template_directory() ."/config_xml/";
	$img_dir = get_template_directory() ."/admin/assets/images/";
	$xml_exports = get_template_directory() ."/config_xml/exports/";
	if(!file_exists($xml_exports)) mkdir($xml_exports, 0755);
	$url_xml_file = THEME_DIR."/config_xml/".$file.".xml";
	$objXML_color = simplexml_load_file($url_xml_file);
	foreach ($objXML_color->children() as $child) {
		foreach ($child->items->children() as $childofchild) {
			$name =  (string)$childofchild->slug;
			$childofchild->std = $smof_data['wd_'.$name];
		}
	}
	$objXML_color->asXML($xml_exports.$file."_export.xml");
	$zip = new ZipArchive;
	if(file_exists($xml_exports.$file."_export.zip")) {
		unlink($xml_exports.$file."_export.zip");
	}
	$res = $zip->open($xml_exports.$file."_export.zip", ZipArchive::CREATE);
	if ($res === TRUE) {
		$zip->addFile($xml_exports.$file."_export.xml", $file.'_export.xml');
		$zip->addFile($img_dir.$file.'.png', $file.'_export.png');
		$zip->close();
		unlink($xml_exports.$file."_export.xml");
		echo XML_DIR . 'exports/' . $file.'_export.zip';
		die();
	} else {
		unlink($xml_exports.$file."_export.xml");
		echo 'error';
	}
	
}
add_action('wp_ajax_export_color_theme','wd_get_export_color_theme',10);

function wd_remove_color_theme(){
	$file = $_POST['file'];
	$pa_id = $_POST['pa_id'];
	$color_theme_saved = of_get_options($pa_id);
	$res = array();
	if($file !== $color_theme_saved ) {
		$xml_file = XML_PATH . $file . '.xml';
		$img_file = ADMIN_PATH . "assets/images/" . $file . '.png';
		if (file_exists($xml_file) && file_exists($img_file)) {
			@unlink($xml_file);
			@unlink($img_file);
			$res['status'] = 'success';
			$res['msg'] = $color_theme_saved;
		} else {
			$res['status'] = 'error';
			$res['msg'] = __('Error: Color theme files are not exist.', 'wpdance');
		}
		
	} else {
		$res['status'] = 'error';
		$res['msg'] = __('Error: Color theme are using, you can\'t remove it.', 'wpdance');
	}
	echo json_encode($res);
	die();
}
add_action('wp_ajax_remove_color_theme','wd_remove_color_theme',10);

$xml_headers = array(
		'Name' => 'Name',
		'Slug' => 'Slug',
		'Description' => 'Description',
    );

function wd_import_color_theme(){
	global $xml_headers;
	$uploadedfile = $_FILES['file_upload'];
	$xml_dir = get_template_directory() . "/config_xml/";
	$target_dir = XML_PATH . "tmp/";
	if(file_exists($target_dir)) wd_removeDir($target_dir);
	mkdir($target_dir, 0777);
	$target_file = $target_dir . basename( $_FILES["file_upload"]["name"]);
	$resturn = array();
	
	if($_FILES["file_upload"]["type"] === 'application/octet-stream') {
		if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {
			$zip = new ZipArchive;
			$res = $zip->open($target_file);
			if($res) {
				$zip->extractTo($target_dir);
				$zip->close();
				unlink($target_file);
				$tmp_file_xml = glob($target_dir . "*.xml");
				$tmp_file_png = glob($target_dir . "*.png");
				$header_datas = get_file_data($tmp_file_xml[0], $xml_headers);
				if(isset($header_datas['Slug']) && $header_datas['Slug'] !== '') {
					if(!file_exists(XML_PATH . $header_datas['Slug'].'.xml')) {
						if(copy($tmp_file_png[0],ADMIN_PATH .'assets/images/'.$header_datas['Slug'].'.png') 
							&& copy($tmp_file_xml[0],XML_PATH.$header_datas['Slug'].'.xml')) {
							$resturn['status'] = "success";
							$resturn['msg'] = __('Import success!', 'wpdance');
						} else {
							$resturn['status'] = 'error';
							$resturn['msg'] = __('Error: Import color theme not success.', 'wpdance');
						}
					} else {
						$resturn['status'] = 'error';
						$resturn['msg'] = __('Error: Color theme slug exist.', 'wpdance');
					}
				} else {
					$resturn['status'] = 'error';
					$resturn['msg'] = __('Error: XML syntax error.', 'wpdance');
				}
					
			} else {
				$resturn['status'] = 'error';
				$resturn['msg'] = __('Error: Extracting file is error.', 'wpdance');
			}
		} else {
			$resturn['status'] = 'error';
			$resturn['msg'] = __('Error: Upload file is error', 'wpdance');
		}
	}
    wd_removeDir($target_dir);
	echo json_encode($resturn);
	die();
}
add_action('wp_ajax_import_color_theme','wd_import_color_theme',10);

function wd_removeDir($path) {
	if(file_exists($path)) {
		$path = rtrim($path, '/') . '/';
		$items = glob($path . '*');
		foreach($items as $item) {
			is_dir($item) ? wd_removeDir($item) : unlink($item);
		}
		rmdir($path);
	}
}




function wd_get_tab_html_content(){
	global $wd_of_options,$xml_arr_file, $xml_headers;
	
	$nonce=$_POST['security'];
	
	if (! wp_verify_nonce($nonce, 'of_ajax_nonce') ) die('-1'); 
	
	$wd_of_options = array();
	
	$xml_file = $_POST['file'];
	
	$url =  ADMIN_DIR . 'assets/images/';
	$color_image_options = array();
	foreach($xml_arr_file as $xml){
		$header_datas = get_file_data(XML_PATH . $xml . '.xml', $xml_headers);
		$color_image_options[$xml]['img'] = $url . $xml .'.png';
		$color_image_options[$xml]['name'] = $header_datas['Name'];
		$color_image_options[$xml]['desc'] = $header_datas['Description'];
	}
	$wd_of_options[] = array( 	"name" 		=> "Theme Scheme",
							"desc" 		=> "Select a color.",
							"id" 		=> "wd_color_scheme",
							"std" 		=> $xml_file,
							"type" 		=> "theme_colors",
							"actions"	=> 1,
							"update"	=> "1",
							"options" 	=> $color_image_options
					);
	
	$url_xml_file = THEME_URI."/config_xml/".$xml_file.".xml";

	$objXML_color = simplexml_load_file($url_xml_file);
	foreach ($objXML_color->children() as $child) {	//group
		$group_name = (string)$child->getName();
		$wd_of_options[] = array( 	"name" 		=> $group_name." Scheme"
				,"id" 		=> "introduction_".$group_name
				,"std" 		=> "<h3 slug='".$group_name."' style=\"margin: 0 0 10px;\">".$group_name." Scheme</h3>"
				,"icon" 	=> true
				,"type" 	=> "info"
		);	

		foreach ($child->items->children() as $childofchild) { //items => item
		
			$name =  (string)$childofchild->name;
			$slug =  (string)$childofchild->slug; 
			$std =  (string)$childofchild->std; 
			//$class_name =  (string)$childofchild->class_name;		
			
			if($childofchild->getName()=='background_item'){
				$wd_of_options[] = array( 	"name" 		=> "Background Image"
						,"id" 		=> "wd_".$slug.'_image'
						,"type" 	=> "upload"
				);
				$wd_of_options[] = array( 	"name" 		=> "Repeat Image"
						,"id" 		=> "wd_".$slug.'_repeat'
						,"std" 		=> "repeat"
						,"type" 	=> "select"
						,"options"	=> array("repeat","no-repeat","repeat-x","repeat-y")
				);
				$wd_of_options[] = array( 	"name" 		=> "Position Image"
						,"id" 		=> "wd_".$slug.'_position'
						,"std" 		=> "left top"
						,"type" 	=> "select"
						,"options"	=> array("left top","right top","center top","center center")
				);
			}
			
			
			$wd_of_options[] = array( 	"name" 		=> trim($name)
					,"id" 		=> "wd_".$slug
					,"std" 		=> $std
					,"type" 	=> "color-update"
			);
		}
	}	
	
	$rs_arr = array();
	$wd_options_machine = new Options_Machine($wd_of_options);
	$rs_arr = $wd_options_machine->Inputs;
	echo json_encode( $rs_arr );
	die(1);
}
add_action('wp_ajax_tab_refesh','wd_get_tab_html_content',10);


function wd_import_xml(){
	//$file = $_POST['upload_file'];
	//echo json_encode($file);
	echo "kinhdon";
}

add_action('wp_ajax_import_xml','wd_import_xml',10);

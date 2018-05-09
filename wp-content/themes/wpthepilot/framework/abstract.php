<?php 
class WdTheme 
{
	protected $options = array();
	protected $arrFunctions = array();
	protected $arrWidgets = array();
	protected $arrIncludes = array();
	public function __construct($options){
		$this->options = $options;
		$this->initArrFunctions();
		$this->tvlgiao_wpdance_initArrWidgets();
		$this->initArrIncludes();
		$this->constant($options);
	}

	public function init(){
		////// Active theme
		$this->hookActive($this->options['theme_slug'], array($this,'activeTheme'));

		$this->initIncludes();
		
		///// After Setup theme
		add_action( 'after_setup_theme', array($this,'wpdancesetup'));
		
		////// deactive theme
		$this->hookDeactive($this->options['theme_slug'], array($this,'deactiveTheme'));
				
		add_action('wp_enqueue_scripts',array($this,'tvlgiao_wpdance_addScripts'));
		
		//add_action('wp_enqueue_scripts',array($this,'addTailScripts'),1000000);
			
		$this->initFunctions();
		$this->initWidgets();
		
		//call admin
		require_once THEME_INCLUDES.'/metaboxes.php';
		$classNameAdmin = 'AdminTheme';
		$panel = new $classNameAdmin();
		
		//$this->loadImageSize();
		add_action( 'init' , array($this, 'tvlgiao_wpdance_loadImageSize'));
		$this->extension();
		//add_action('wp_enqueue_scripts',array($this,'addLastScripts'));
	}
	
	protected function initArrFunctions(){
		$this->arrFunctions = array('main','global_var','video','breadcrumbs','excerpt','pagination','theme_control','filter_theme','comment','theme_sidebar','custom_style','header_function','footer_function','woo-cart','woo-hook', 'loading_page', 'ajax_function');
	}
	
	
	protected function tvlgiao_wpdance_initArrWidgets(){
		$this->arrWidgets = array('customrecent','emads','custompages'
								,'ew_video','recent_comments_custom','ew_social','productaz','ew_subscriptions','team_member','wd_testimonials');
	}
	
	protected function initArrIncludes(){
		$this->arrIncludes = array('class-tgm-plugin-activation');
	}
	
	
	public function theme_slug_render_title_filter( $title, $sep  ){
		
		if ( is_feed() ) {
			return $title;
		}
		global $page, $paged;	
			
		$title .= get_bloginfo( 'name', 'display' );
		
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'wpdance' ), max( $paged, $page ) );
		}
		
		return $title;
			
	}
	
	public function wpdancesetup() {
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
		//add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
		$args = array(
			'width'         => 940,
			'height'        => 198,
			'default-image' => get_template_directory_uri() . '/images/headers/header-v1.jpg',
		);
		// This theme supports a variety of post formats.
		add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );		
		add_theme_support( 'custom-header', $args ) ;
		
		add_theme_support( 'title-tag' );
		
		
		if ( ! function_exists( '_wp_render_title_tag' ) ) :
			add_action( 'wp_head', array( $this, 'theme_slug_render_title' ) );
		endif;
		
		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		$defaults = array(
			'default-color'          => '',
			'default-image'          => get_template_directory_uri()."/images/default-background.png",
			// 'wp-head-callback'       => 'head_callback_on_bg',
			// 'admin-head-callback'    => '',
			// 'admin-preview-callback' => ''
		);
		
		global $wp_version;
		/*if ( version_compare( $wp_version, '3.4', '>=' ) ) :
			add_theme_support( 'custom-background', $defaults );
		else :
			add_custom_background( $defaults );
		endif;	*/
		add_theme_support( 'custom-background', $defaults );
				
		add_post_type_support( 'forum', array('thumbnail') );
		add_theme_support( 'woocommerce' );	
		if ( ! isset( $content_width ) ) $content_width = 960;
		
		// Make theme available for translation
		// Translations can be filed in the /languages/ directory
		load_theme_textdomain( 'wpdance', get_template_directory() . '/languages' );

		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once get_template_directory()."/languages/$locale.php";

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'wpdance' )
		) );
		
		register_nav_menus( array(
			'mobile' =>  __( 'Mobile Navigation', 'wpdance' )
		) );
		
		register_nav_menus( array(
			'vertical_menu' =>  __( 'Vertical Navigation', 'wpdance' )
		) );
		


		// Your changeable header business starts here
		if ( ! defined( 'HEADER_TEXTCOLOR' ) )
			define( 'HEADER_TEXTCOLOR', '' );

		// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
		if ( ! defined( 'HEADER_IMAGE' ) )
			define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );

		// The height and width of your custom header. You can hook into the theme's own filters to change these values.
		// Add a filter to wpdance_header_image_width and wpdance_header_image_height to change these values.
		//define( 'HEADER_IMAGE_WIDTH', apply_filters( 'wpdance_header_image_width', 940 ) );
		//define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'wpdance_header_image_height', 198 ) );

		// We'll be using post thumbnails for custom header images on posts and pages.
		// We want them to be 940 pixels wide by 198 pixels tall.
		// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
		set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

		// Don't support text inside the header image.
		if ( ! defined( 'NO_HEADER_TEXT' ) )
			define( 'NO_HEADER_TEXT', true );

		// Add a way for the custom header to be styled in the admin panel that controls
		// custom headers. See wpdance_admin_header_style(), below.


		// ... and thus ends the changeable header business.
		
	}
	
	protected function constant($options){
		define('DS',DIRECTORY_SEPARATOR);	
		define('THEME_NAME', $options['theme_name']);
		define('THEME_SLUG', $options['theme_slug'].'_');
		
		define('THEME_DIR', get_template_directory());
		
		define('THEME_CACHE', get_template_directory().DS.'cache_theme'.DS);
		
		define('THEME_URI', get_template_directory_uri());
		
		define('THEME_FRAMEWORK', THEME_DIR . '/framework');
		
		define('THEME_FRAMEWORK_URI', THEME_URI . '/framework');
		
		define('THEME_FUNCTIONS', THEME_FRAMEWORK . '/functions');
		
		define('THEME_WIDGETS', THEME_FRAMEWORK . '/widgets');

		define('THEME_INCLUDES', THEME_FRAMEWORK . '/includes');
		
		define('THEME_INCLUDES_AJAX', THEME_INCLUDES . '/ajax');
		
		define('THEME_LIB', THEME_FRAMEWORK . '/lib');
		
		define('THEME_INCLUDES_URI', THEME_URI . '/framework/includes');
		
		define('THEME_EXTENSION', THEME_FRAMEWORK . '/extension');
		
		define('THEME_EXTENDS_EXTENDVC_URI', THEME_FRAMEWORK.'/extendvc');
		
		define('THEME_IMAGES', THEME_URI . '/images');
		define('THEME_CSS', THEME_URI . '/css');
		define('THEME_JS', THEME_URI . '/js');

		/*	
		define('ENABLED_FONT', false);
		define('ENABLED_COLOR', false);
		define('ENABLED_PREVIEW', false);
		define('SITE_LAYOUT', 'wide');
		*/
		
		define('USING_CSS_CACHE', true);
		
	}
	
	protected function initFunctions(){
		foreach($this->arrFunctions as $function){
			if(file_exists(THEME_FUNCTIONS."/{$function}.php"))
			{
				require_once THEME_FUNCTIONS."/{$function}.php";
			}	
		}
	}
	
	protected function extension(){
		$this->extendVC();
	}
	
	protected function initWidgets(){
		foreach($this->arrWidgets as $widget){
			if(file_exists(THEME_WIDGETS."/{$widget}.php"))
			{
				require_once THEME_WIDGETS."/{$widget}.php";
			}
		}
		add_action( 'widgets_init', array($this,'loadWidgets'));
	}
	
	protected function initIncludes(){
		foreach($this->arrIncludes as $include){
			if(file_exists(THEME_LIB."/{$include}.php")){
				require_once THEME_LIB."/{$include}.php";
			}
		}
	}
		
	public function loadWidgets(){
		foreach($this->arrWidgets as $widget)
			register_widget( 'WP_Widget_'.ucfirst($widget) );
	}
	
	public function activeTheme(){
		//Single Image
		update_option( 'shop_single_image_size', array('height'=>'700', 'width' => '570', 'crop' => 1 ));
		//Thumbnail Image
		update_option( 'shop_thumbnail_image_size', array('height'=>'109', 'width' => '98', 'crop' => 1 ));
		//Catalog Image
		update_option( 'shop_catalog_image_size', array('height'=>'353', 'width' => '278', 'crop' => 1 ));
		
						
		
	}
	
	public function hookActive($code, $function){
		$optionKey="theme_is_activated_" . $code;
		if(!get_option($optionKey)) {
			call_user_func($function);
			update_option($optionKey , 1);
		}
	}
	
	public function deactiveTheme(){
	
	}
	
	/**
	 * @desc registers deactivation hook
	 * @param string $code : Code of the theme. This must match the value you provided in wp_register_theme_activation_hook function as $code
	 * @param callback $function : Function to call when theme gets deactivated.
	 */
	public function hookDeactive($code, $function) {
		// store function in code specific global
		$GLOBALS["wp_register_theme_deactivation_hook_function" . $code]=$function;

		// create a runtime function which will delete the option set while activation of this theme and will call deactivation function provided in $function
		$fn=create_function('$theme', ' call_user_func($GLOBALS["wp_register_theme_deactivation_hook_function' . $code . '"]); delete_option("theme_is_activated_' . $code. '");');

		// add above created function to switch_theme action hook. This hook gets called when admin changes the theme.
		// Due to wordpress core implementation this hook can only be received by currently active theme (which is going to be deactivated as admin has chosen another one.
		// Your theme can perceive this hook as a deactivation hook.)
		add_action("switch_theme", $fn);
	}
	
	public function addTailScripts(){

		global $tvlgiao_wpdance_wd_data;
	
		wp_register_style( 'custom_default', THEME_CSS.'/custom_default.less');
		wp_enqueue_style('custom_default');	
		
		

		wp_register_script( 'less', THEME_JS.'/less.js');
		wp_enqueue_script('less');	
	}
	
	public function addLastScripts(){
		if(is_rtl()) {
			wp_register_style( 'wd-rtl', THEME_CSS.'/wd_rtl.css');
			wp_enqueue_style('wd-rtl');
		}
	}
	
	public function tvlgiao_wpdance_addScripts(){
		global $is_IE, $tvlgiao_wpdance_wd_data;
		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'default-quicksand', "$protocol://fonts.googleapis.com/css?family=Quicksand:400,300,700" );
		wp_enqueue_style( 'default-raleway', "$protocol://fonts.googleapis.com/css?family=Raleway:400,500,600,700" );
		wp_enqueue_style( 'default-teko', "$protocol://fonts.googleapis.com/css?family=Teko:400,300,500,600,700" );
		wp_enqueue_style( 'default-montserrat', "$protocol://fonts.googleapis.com/css?family=Montserrat:400,700" );
		wp_enqueue_style( 'default-lora', "$protocol://fonts.googleapis.com/css?family=Lora:400,400italic,700,700italic" );
		wp_enqueue_style( 'default-archivoNarrow', "$protocol://fonts.googleapis.com/css?family=Archivo+Narrow:400,700" );
		wp_enqueue_style( 'default-lato', "$protocol://fonts.googleapis.com/css?family=Lato:400,700" );
		wp_enqueue_style( 'default-alikeAngular', "$protocol://fonts.googleapis.com/css?family=Alike+Angular" );
		wp_register_style( 'bootstrap', THEME_CSS.'/bootstrap.css');
		wp_enqueue_style('bootstrap');
		
		wp_register_style( 'bootstrap-theme', THEME_CSS.'/bootstrap-theme.css');
		wp_enqueue_style('bootstrap-theme');
		
		wp_enqueue_style( 'default', get_stylesheet_uri() ); 
		wp_register_style( 'reset', THEME_CSS.'/reset.css');
		wp_enqueue_style('reset');
		wp_register_style( 'flexslider', THEME_CSS.'/flexslider.css');
		wp_enqueue_style('flexslider');
		wp_register_style( 'colorpicker', THEME_CSS.'/colorpicker.css');
		wp_enqueue_style('colorpicker');
		wp_register_style( 'fancybox_css', THEME_CSS.'/jquery.fancybox.css');
		wp_enqueue_style('fancybox_css');
		
		/*
		wp_register_style( 'ticker-css', THEME_FRAMEWORK_CSS_URI.'/ticker-style.css');
		wp_enqueue_style('ticker-css');
		*/
		
		wp_register_style( 'font-awesome', THEME_FRAMEWORK_URI.'/css/font-awesome.css');
		wp_enqueue_style('font-awesome');
		wp_register_style( 'base', THEME_CSS.'/base.css');
		wp_enqueue_style('base');
		wp_register_style( 'wd-widget', THEME_CSS.'/widget.css');
		wp_enqueue_style('wd-widget');
		wp_register_style( 'select2', THEME_CSS.'/select2.css');
		wp_enqueue_style('select2');
		wp_register_style( 'cs-animate', THEME_CSS.'/cs-animate.css');
		wp_enqueue_style('cs-animate');
		
		if(is_rtl()) {
			wp_register_style( 'wd-rtl', THEME_CSS.'/wd_rtl.css');
			wp_enqueue_style('wd-rtl');
		}
		
		wp_register_style( 'responsive', THEME_CSS.'/responsive.css');
		wp_enqueue_style('responsive');
		
		wp_enqueue_script('jquery');	
		wp_register_script( 'bootstrap', THEME_JS.'/bootstrap.js',false,false,true);
		wp_enqueue_script('bootstrap');		
		wp_register_script( 'TweenMax', THEME_JS.'/TweenMax.min.js',false,false,true);
		wp_enqueue_script('TweenMax');
		wp_enqueue_script('flexslider-js',THEME_JS.'/jquery.flexslider-min.js',false,true);

		wp_register_script( 'bootstrap-colorpicker', THEME_JS.'/bootstrap-colorpicker.js',false,false,true);
		wp_enqueue_script('bootstrap-colorpicker');	
		
		wp_register_script( 'include-script', THEME_JS.'/include-script.js',false,false,true);
		wp_enqueue_script('include-script');

		wp_register_script( 'jquery.carouFredSel', THEME_JS.'/jquery.carouFredSel-6.2.1.min.js',false,false,true);
		wp_enqueue_script('jquery.carouFredSel');

		wp_register_script( 'owl.carousel', THEME_JS.'/owl.carousel.min.js',false,false,true);
		wp_enqueue_script('owl.carousel');
			
		wp_register_script( 'jquery.select2', THEME_JS.'/select2.js',false,false,true);
		wp_enqueue_script('jquery.select2');

		wp_register_script( 'sticky-sidebar-js', THEME_JS.'/theia-sticky-sidebar.js',false,false,true);
		wp_enqueue_script('sticky-sidebar-js');		

		wp_register_script( 'jquery-appear', THEME_JS.'/jquery.appear.js',false,false,true);
		wp_enqueue_script('jquery-appear');
		
		wp_register_script( 'isotope-min', THEME_JS.'/isotope.min.js',false,false,true);
		wp_enqueue_script('isotope-min');
		
		wp_register_script( 'tiltfx', THEME_JS.'/tiltfx.js');
		wp_enqueue_script('tiltfx');
		
		if( is_page_template( 'page-templates/onepage-template.php' ) ) {
			wp_register_style( 'jquery.fullPage.css', THEME_CSS.'/jquery.fullPage.css');
			wp_enqueue_style('jquery.fullPage.css');
			
			wp_register_script( 'jquery.fullPage', THEME_JS.'/jquery.fullPage.js',false,false,true);
			wp_enqueue_script( 'jquery.fullPage' );
			
		}
		
			wp_register_script( 'jquery.prettyPhoto', THEME_JS.'/jquery.prettyPhoto.min.js',false,false,true);
			wp_enqueue_script('jquery.prettyPhoto');	
			wp_register_script( 'jquery.prettyPhoto.init', THEME_JS.'/jquery.prettyPhoto.init.min.js',false,false,true);
			wp_enqueue_script('jquery.prettyPhoto.init');				
			wp_register_style( 'css.prettyPhoto', THEME_CSS.'/prettyPhoto.css');
			wp_enqueue_style('css.prettyPhoto');		
		
		if(!is_admin()){		
			if(wp_is_mobile()) {
				wp_register_script( 'mobile-jquery', THEME_JS.'/jquery.mobile.min.js',false,false,true);
				wp_enqueue_script('mobile-jquery');
				
				wp_register_script( 'mobile-event', THEME_JS.'/mobile-event.js',false,false,true);
				wp_enqueue_script('mobile-event');
			}
			
			
			wp_register_script( 'main-js', THEME_JS.'/main.js',false,false,true);
			wp_enqueue_script('main-js');
			
			
			if(isset($tvlgiao_wpdance_wd_data['wd_smooth_scroll']) && absint($tvlgiao_wpdance_wd_data['wd_smooth_scroll']) == 1){
				if(!wp_is_mobile()) {
					if($this->is_windows() && $this->is_chrome()) {
						wp_register_script( 'smooth-scroll', THEME_JS.'/smoothScroll.js',false,false,true);
						wp_enqueue_script('smooth-scroll');
					}
				}
			}
			
			if(isset($tvlgiao_wpdance_wd_data['wd_loading_page']) && absint($tvlgiao_wpdance_wd_data['wd_loading_page']) == 1){ 
				if(!wp_is_mobile()) { 
					wp_register_style( 'pace-page', THEME_CSS.'/pace.page.css');
					wp_enqueue_style('pace-page');
					wp_register_script( 'pace-min', THEME_JS.'/pace.min.js',false,false,true);
					wp_enqueue_script('pace-min');
				}
			}
		}
	}
	
	public function is_windows(){
		$u = $_SERVER['HTTP_USER_AGENT'];
		$window  = (bool)preg_match('/Windows/i', $u );
		return $window;
	}
	public function is_chrome(){
		$u = $_SERVER['HTTP_USER_AGENT'];
		$chrome  = (bool)preg_match('/Chrome/i', $u );
		return $chrome;
	}
	
	public function wd_vcSetAsTheme() {
		vc_set_as_theme();
	}
	//extend visual composer 
	protected function extendVC(){
		
		

		// Initialising Shortcodes
		if (false||class_exists('WPBakeryVisualComposerAbstract')) {
			require_once THEME_EXTENSION. '/extendvc/vc_includes/vc_functions.php';
			require_once THEME_EXTENSION. '/extendvc/vc_includes/vc_images.php';
			function requireVcExtend(){	
				$vc_generates = array('heading','quote','gap','banner','team_member','portfolio','pricing_table','count_down_icon','button','testimonial','recent_blogs','wd_projects','simple_blog','wd_gallery');		
				foreach($vc_generates as $vc_generate){
					if(file_exists(THEME_EXTENSION."/extendvc/vc_generate/{$vc_generate}.php"))
						require_once THEME_EXTENSION. "/extendvc/vc_generate/{$vc_generate}.php";
				}	
				
			}
			add_action('admin_init', 'requireVcExtend',2);
		}
	}
	
	//overrite row and column classes
	protected function changing_rows_columns_classes(){
		function custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
			if ($tag=='vc_row' || $tag=='vc_row_inner') {
				$class_string = str_replace('vc_row-fluid', 'row vc_row-fluid', $class_string);
			}

			return $class_string;
		}
		add_filter('vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2);
	}
	
	function tvlgiao_wpdance_loadImageSize(){
		if ( function_exists( 'add_image_size' ) ) {
		   // Add image size for main slideshow
			global $tvlgiao_wpdance_wd_data;
			$wd_blog_single_thumbnail_width = ( isset($tvlgiao_wpdance_wd_data['wd_blog_single_thumbnail_width']) && absint($tvlgiao_wpdance_wd_data['wd_blog_single_thumbnail_width']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_blog_single_thumbnail_width']) : 1170;
			
			$wd_blog_thumbnail_width = ( isset($tvlgiao_wpdance_wd_data['wd_blog_thumbnail_width']) && absint($tvlgiao_wpdance_wd_data['wd_blog_thumbnail_width']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_blog_thumbnail_width']) : 420;
			$wd_blog_thumbnail_height = ( isset($tvlgiao_wpdance_wd_data['wd_blog_thumbnail_height']) && absint($tvlgiao_wpdance_wd_data['wd_blog_thumbnail_height']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_blog_thumbnail_height']) : 300;
			
			$wd_blog_shortcode_thumbnail_width = ( isset($tvlgiao_wpdance_wd_data['wd_blog_shortcode_thumbnail_width']) && absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_thumbnail_width']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_thumbnail_width']) : 345;
			$wd_blog_shortcode_thumbnail_height = ( isset($tvlgiao_wpdance_wd_data['wd_blog_shortcode_thumbnail_height']) && absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_thumbnail_height']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_thumbnail_height']) : 223;
			
			$wd_blog_shortcode_auto_thumbnail_width = ( isset($tvlgiao_wpdance_wd_data['wd_blog_shortcode_auto_thumbnail_width']) && absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_auto_thumbnail_width']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_auto_thumbnail_width']) : 570;
			
			$wd_blog_shortcode_widget_thumbnail_width = ( isset($tvlgiao_wpdance_wd_data['wd_blog_shortcode_widget_thumbnail_width']) && absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_widget_thumbnail_width']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_widget_thumbnail_width']) : 100;
			$wd_blog_shortcode_widget_thumbnail_height = ( isset($tvlgiao_wpdance_wd_data['wd_blog_shortcode_widget_thumbnail_height']) && absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_widget_thumbnail_height']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_blog_shortcode_widget_thumbnail_height']) : 70;
			
			$wd_tini_shopping_cart_thumbnail_width = ( isset($tvlgiao_wpdance_wd_data['wd_tini_shopping_cart_thumbnail_width']) && absint($tvlgiao_wpdance_wd_data['wd_tini_shopping_cart_thumbnail_width']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_tini_shopping_cart_thumbnail_width']) : 100;
			$wd_tini_shopping_cart_thumbnail_height = ( isset($tvlgiao_wpdance_wd_data['wd_tini_shopping_cart_thumbnail_height']) && absint($tvlgiao_wpdance_wd_data['wd_tini_shopping_cart_thumbnail_height']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_tini_shopping_cart_thumbnail_height']) : 120;
			
			$wd_single_products_thumbnail_width = ( isset($tvlgiao_wpdance_wd_data['wd_single_products_thumbnail_width']) && absint($tvlgiao_wpdance_wd_data['wd_single_products_thumbnail_width']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_single_products_thumbnail_width']) : 135;
			$wd_single_products_thumbnail_height = ( isset($tvlgiao_wpdance_wd_data['wd_single_products_thumbnail_height']) && absint($tvlgiao_wpdance_wd_data['wd_single_products_thumbnail_height']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_single_products_thumbnail_height']) : 171;
			
			$wd_product_subcategories_thumbnail_width = ( isset($tvlgiao_wpdance_wd_data['wd_product_subcategories_thumbnail_width']) && absint($tvlgiao_wpdance_wd_data['wd_product_subcategories_thumbnail_width']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_product_subcategories_thumbnail_width']) : 270;
			$wd_product_subcategories_thumbnail_height = ( isset($tvlgiao_wpdance_wd_data['wd_product_subcategories_thumbnail_height']) && absint($tvlgiao_wpdance_wd_data['wd_product_subcategories_thumbnail_height']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_product_subcategories_thumbnail_height']) : 200;
			
			$wd_product_categories_shortcode_thumbnail_width = ( isset($tvlgiao_wpdance_wd_data['wd_product_categories_shortcode_thumbnail_width']) && absint($tvlgiao_wpdance_wd_data['wd_product_categories_shortcode_thumbnail_width']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_product_categories_shortcode_thumbnail_width']) : 370;
			$wd_product_categories_shortcode_thumbnail_height = ( isset($tvlgiao_wpdance_wd_data['wd_product_categories_shortcode_thumbnail_height']) && absint($tvlgiao_wpdance_wd_data['wd_product_categories_shortcode_thumbnail_height']) > 0 )? absint($tvlgiao_wpdance_wd_data['wd_product_categories_shortcode_thumbnail_height']) : 540;
			
			add_image_size('blog_single',$wd_blog_single_thumbnail_width); /* image for blog thumbnail */
			
			add_image_size('prod_small_thumb',141,141,true); /* image for slideshow */
			//add_image_size('prod_tini_thumb',70,90,true); /* image for slideshow */
			add_image_size('slider_thumb_wide',150,150,true); /* image for slideshow */
			/*add_image_size('slideshow_box',960,350,true); image for slideshow */
			/*add_image_size('slideshow_wide',1200,450,true); image for slideshow */
			add_image_size('slider',222,48,true); /* image for slideshow */
			add_image_size('slider_thumb_box',100,100,true); /* image for slideshow */
			add_image_size('related_thumb',400,255,true); /* image for slideshow */
			add_image_size('blog_shortcode_auto',$wd_blog_shortcode_auto_thumbnail_width); /* blog shortcode */
			add_image_size('blog_shortcode',$wd_blog_shortcode_thumbnail_width,$wd_blog_shortcode_thumbnail_height, true);
			add_image_size('blog_recent',$wd_blog_shortcode_widget_thumbnail_width,$wd_blog_shortcode_widget_thumbnail_height,true);
			add_image_size('blog_thumb',$wd_blog_thumbnail_width,$wd_blog_thumbnail_height,true);
			
			add_image_size('wd_cart_dropdown',$wd_tini_shopping_cart_thumbnail_width,$wd_tini_shopping_cart_thumbnail_height,true);
			add_image_size('wd_single_product_thumbnail_',$wd_single_products_thumbnail_width,$wd_single_products_thumbnail_height,true);
			add_image_size('wd_sub_categories_thumbnail',$wd_product_subcategories_thumbnail_width,$wd_product_subcategories_thumbnail_height,true); /* image for single product detail */
			add_image_size('wd_categories_thumbnail',$wd_product_categories_shortcode_thumbnail_width,$wd_product_categories_shortcode_thumbnail_height,true); /* image for single product detail */
			
			add_image_size('wd_gallery_1', 600, 600, true);
			add_image_size('wd_gallery_2', 600, 300, true);
			add_image_size('wd_gallery_3', 300, 300, true);
			
			add_image_size('blog_shortcode_recent_left',400,400, true);
		}
	}
}
?>
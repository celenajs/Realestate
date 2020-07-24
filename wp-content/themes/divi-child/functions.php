<?php 


	add_action( 'wp_enqueue_style', 'et-builder-modules-style', 19 );
	add_action( 'wp_enqueue_scripts', 'divi_child_enqueue_styles', 20 );

	function divi_child_enqueue_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/dist/css/theme-style.min.css' );
		wp_enqueue_script( 'child-script', get_stylesheet_directory_uri() . '/dist/js/theme.min.js', array(), false, true ); 
	}

	//Remove Projects folder in DIVI
	add_filter( 'et_project_posttype_args', 'ds_et_project_posttype_args', 10, 1 );
	function ds_et_project_posttype_args( $args ) {
		return array_merge( $args, array(
			'public'              => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => false,
			'show_in_nav_menus'   => false,
			'show_ui'             => false
		));
	}	
	
	//Shortcode for get_template_part()
	//Usage [ds_get_template slug="partials/content" name="post"]
	function get_template_shortcode($attr) {
			if(!empty($attr['slug'])){
				if(!empty($attr['name'])){
					$slug = $attr['slug'];
					$name = $attr['name'];
					ob_start();
					get_template_part("{$slug}","{$name}");
					$local_template = ob_get_clean();
				}else{
					$slug = $attr['slug'];
					ob_start();
					get_template_part("{$slug}");
					$local_template = ob_get_clean();
				}
			}else{
				$local_template = 'Error on using the shortcode. Slug should not be empty!';
			}
		return $local_template;
	}

	add_shortcode('ds_get_template', 'get_template_shortcode');

	//Debugging Function
	//Usage: d($variable); FOR VAR_DUMP
	function d($content, $bool = false){
		ob_start();
		echo '<pre style="
						background: #633a7b;
						border: 3px solid #1b1b1b;
						color: #fff;
						font-family: &quot;Courier New&quot;, monospace;
						font-size: 14px;
						font-weight: bold;
					">';
				echo '<span style="
							color: #f92b2b;
							text-shadow: 1px 1px 1px #281831;
						">';
					echo 'Line:'.debug_backtrace(1)[0]['line'].' '.debug_backtrace(1)[0]['file'].'<br/>';
				echo '</span>';
				echo '<span>';
					var_dump($content);
				echo '</span>';
		echo '</pre>';
			$output = ob_get_clean();
		echo $output;

		if($bool)
			die;
	}

	//Usage: d($variable); FOR print_r
	function dd($content, $bool = false){
		ob_start();
		echo '<pre style="
						background: #633a7b;
						border: 3px solid #1b1b1b;
						color: #fff;
						font-family: &quot;Courier New&quot;, monospace;
						font-size: 14px;
						font-weight: bold;
					">';
				echo '<span style="
							color: #f92b2b;
							text-shadow: 1px 1px 1px #281831;
						">';
					echo 'Line:'.debug_backtrace(1)[0]['line'].' '.debug_backtrace(1)[0]['file'].'<br/>';
				echo '</span>';
				echo '<span>';
					print_r($content);
				echo '</span>';
		echo '</pre>';
			$output = ob_get_clean();
		echo $output;

		if($bool)
			die;
	}

	// Live Search Ajax
	function knowledge_search(){
		ob_start();
			get_template_part('partials/content','datasearch');
		$contents = ob_get_clean();
		$final_contents = preg_replace('/\[\/?et_pb.*?\]/', '', $contents);
		echo json_encode( array('error' => false , 'data_html' => $final_contents) );
		die();
	}

	add_action("wp_ajax_knowledge_search", "knowledge_search");
	add_action("wp_ajax_nopriv_knowledge_search", "knowledge_search");



	// Custom WP ADMIN LOGO
	add_filter('login_headerurl' , function(){
		return home_url();
	});
	
	add_action( 'login_enqueue_scripts', function(){
	
		$style = ' <style>
						#login h1 a, .login h1 a {
							background-image: url('.(!empty(et_get_option( 'divi_logo' )) ? et_get_option( 'divi_logo' ) : '../wp-admin/images/wordpress-logo.svg').');
							width: 100%;
							height: 80px;
							background-size: contain;
							background-repeat: no-repeat;
							padding-bottom: 0;
						}
					</style>';
		echo $style;
	});


 ?>
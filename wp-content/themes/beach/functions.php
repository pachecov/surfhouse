<?php

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Adds helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds image upload and color select to Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Includes Child Theme Functions CSS.
require_once get_stylesheet_directory() . '/lib/child-functions.php';

// Includes Genesis Hooks
require_once get_stylesheet_directory() . '/lib/genesis-hooks.php';

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Adds the required WooCommerce styles and Customizer CSS.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Adds the Genesis Connect WooCommerce notice.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

// wp_enqueue_style(
//     genesis_get_theme_handle() . '-mfp',
//     get_stylesheet_directory_uri() . '/vendor/css/magnific-popup.css',
//     [ genesis_get_theme_handle() ],
//     genesis_get_theme_version()
// );
// wp_enqueue_style(
//     genesis_get_theme_handle() . '-aos',
//     get_stylesheet_directory_uri() . '/vendor/css/aos.css',
//     [ genesis_get_theme_handle() ],
//     genesis_get_theme_version()
// );
// wp_enqueue_script(
//     genesis_get_theme_handle() . '-aos-js',
//     get_stylesheet_directory_uri() . '/vendor/js/aos.js',
//     array( 'jquery' ),
//     genesis_get_theme_version(),
//     true
// );
// wp_enqueue_style(
//     genesis_get_theme_handle() . '-owl-default',
//     get_stylesheet_directory_uri() . '/vendor/css/owl-styles/owl-theme-default.min.css',
//     [ genesis_get_theme_handle() ],
//     genesis_get_theme_version()
// );

// wp_enqueue_style(
//     genesis_get_theme_handle() . '-owl-carousel',
//     get_stylesheet_directory_uri() . '/vendor/css/owl-styles/owl-carousel.min.css',
//     [ genesis_get_theme_handle() ],
//     genesis_get_theme_version()
// );
// wp_enqueue_script(
//     genesis_get_theme_handle() . '-owl-slider',
//     get_stylesheet_directory_uri() . '/vendor/js/owl-slider.js',
//     array( 'jquery' ),
//     genesis_get_theme_version(),
//     true
// );

// add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
// function genesis_sample_enqueue_scripts_styles() {
//     wp_enqueue_style(
// 		genesis_get_theme_handle() . '-aos',
// 		get_stylesheet_directory_uri() . '/vendor/css/aos.css',
// 		[ genesis_get_theme_handle() ],
// 		genesis_get_theme_version()
//     );
//     wp_enqueue_script(
// 		genesis_get_theme_handle() . '-aos-js',
// 		get_stylesheet_directory_uri() . '/vendor/js/aos.js',
// 		array( 'jquery' ),
// 		genesis_get_theme_version(),
// 		true
// 	);
// }
// function template_chooser($template)   
// {    
//   global $wp_query;   
//   $post_type = get_query_var('post_type');   
//   if( $wp_query->is_search && $post_type == 'receta' )   
//   {
//     return locate_template('archive-search.php');  //  redirect to archive-search.php
//   }   
//   return $template;   
// }
// add_filter('template_include', 'template_chooser');    




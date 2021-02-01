<?php

add_action( 'wp_enqueue_scripts', 'custom_load_font_awesome' );
function custom_load_font_awesome() {
    wp_enqueue_style( 'font-awesome-free', '//use.fontawesome.com/releases/v5.2.0/css/all.css' );
}
/* Custom Post Types
--------------------------------------------- */
add_action( 'init', 'smtcode_team' );
function smtcode_team() {
	$labels = array(
		'name'               => __( 'Team' ),
		'singular_name'      => __( 'Team' ),
		'all_items'          => __( 'All Team' ),
		'add_new'            => _x( 'Add new Team', 'Team' ),
		'add_new_item'       => __( 'Add new Team' ),
		'edit_item'          => __( 'Edit Team' ),
		'new_item'           => __( 'New Team' ),
		'view_item'          => __( 'View Team' ),
		'search_items'       => __( 'Search in Team' ),
		'not_found'          => __( 'No Team found' ),
		'not_found_in_trash' => __( 'No Team found in trash' ),
		'parent_item_colon'  => ''
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'has_archive'        => false, // Set to false hides Archive Pages
		'menu_icon'          => 'dashicons-admin-users', //pick one here ~> https://developer.wordpress.org/resource/dashicons/
		'rewrite'            => array( 'slug' => 'team' ),
		'taxonomies'         => array( ),
		'query_var'          => true,
		'menu_position'      => 5,
		'capability_type'    => 'page',
    		'publicly_queryable' => false, // Set to false hides Single Pages
		'supports'           => array(  'thumbnail' , 'custom-fields', 'excerpt', 'comments', 'title', 'editor')
	);
	register_post_type( 'team', $args );
}
/* Taxonomies
--------------------------------------------- */
register_taxonomy( 'team-category', 'team',
	array(
		'labels' => array(
			'name'                       => _x( 'Team Categories', 'taxonomy general name' , 'genesis-base' ),
			'singular_name'              => _x( 'Team Category' , 'taxonomy singular name', 'genesis-base' ),
			'search_items'               => __( 'Search Team Categories'                   , 'genesis-base' ),
			'popular_items'              => __( 'Popular Team Categories'                  , 'genesis-base' ),
			'all_items'                  => __( 'All Team'                                , 'genesis-base' ),
			'edit_item'                  => __( 'Edit Team Category'                      , 'genesis-base' ),
			'update_item'                => __( 'Update Team Category'                    , 'genesis-base' ),
			'add_new_item'               => __( 'Add New Team Category'                   , 'genesis-base' ),
			'new_item_name'              => __( 'New Team Category Name'                  , 'genesis-base' ),
			'separate_items_with_commas' => __( 'Separate Team Categories with commas'     , 'genesis-base' ),
			'add_or_remove_items'        => __( 'Add or remove Team Categories'            , 'genesis-base' ),
			'choose_from_most_used'      => __( 'Choose from the most used Team Categories', 'genesis-base' ),
			'not_found'                  => __( 'No Team Categories found.'                , 'genesis-base' ),
			'menu_name'                  => __( 'Team Categories'                          , 'genesis-base' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
		),
		'exclude_from_search' => true,
		'has_archive'         => true,
		'hierarchical'        => true,
		'rewrite'             => array( 'slug' => _x( 'team-type', 'team-type slug' , 'genesis-team-pro' ), 'with_front' => false ),
		'show_ui'             => true,
		'show_tagcloud'       => false,
	)
);
add_action( 'init', 'smtcode_recetas' );
function smtcode_recetas() {
	$labels = array(
		'name'               => __( 'Receta' ),
		'singular_name'      => __( 'Receta' ),
		'all_items'          => __( 'Todas las Recetas' ),
		'add_new'            => _x( 'Nueva Receta', 'Receta' ),
		'add_new_item'       => __( 'Añadir nueva Receta' ),
		'edit_item'          => __( 'Editar Receta' ),
		'new_item'           => __( 'Nueva Receta' ),
		'view_item'          => __( 'Ver Receta' ),
		'search_items'       => __( 'Buscar en Receta' ),
		'not_found'          => __( 'No Recetas encontradas' ),
		'not_found_in_trash' => __( 'No Recetas encontradas en la papelera' ),
		'parent_item_colon'  => ''
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'has_archive'        => true, // Set to false hides Archive Pages
		'menu_icon'          => 'dashicons-edit-large', //pick one here ~> https://developer.wordpress.org/resource/dashicons/
		'rewrite'            => array( 'slug' => 'receta' ),
		'taxonomies'         => array( ),
		'query_var'          => true,
		'menu_position'      => 5,
		'capability_type'    => 'page',
    		'publicly_queryable' => true, // Set to false hides Single Pages
		'supports'           => array(  'thumbnail' , 'excerpt', 'comments', 'title', 'editor')
	);
	register_post_type( 'receta', $args );
	
	// Podcast
	// register_post_type(
	// 	'podcast',
	// 	array(
	// 		'labels'      	=> array(
	// 			'name'          => __('Podcasts', 'textdomain'),
	// 			'singular_name' => __('Podcast', 'textdomain'),
	// 		),
	// 		'public'      	=> true,
	// 		'has_archive' 	=> true,
	// 		'show_in_rest'	=> true,
	// 		'menu_icon'		=> 'dashicons-playlist-audio',
	// 		'supports' 		=> array('title', 'editor', 'author', 'thumbnail', 'excerpt'),

	// 	)
	// );
}
/* Taxonomies
--------------------------------------------- */
register_taxonomy( 'tipos-de-receta', 'receta',
	array(
		'labels' => array(
			'name'                       => _x( 'Recetas Categorias', 'taxonomy general name' , 'genesis-base' ),
			'singular_name'              => _x( 'Recetas Categoria' , 'taxonomy singular name', 'genesis-base' ),
			'search_items'               => __( 'Buscar Receta Categorias'                   , 'genesis-base' ),
			'popular_items'              => __( 'Lo mas popularas recetas Categorias'                  , 'genesis-base' ),
			'all_items'                  => __( 'Todas las Categorias'                                , 'genesis-base' ),
			'edit_item'                  => __( 'Editar Receta en las Categorias'                      , 'genesis-base' ),
			'update_item'                => __( 'Actualizar Receta Categorias'                    , 'genesis-base' ),
			'add_new_item'               => __( 'Añadir nuevas Categorias'                   , 'genesis-base' ),
			'new_item_name'              => __( 'Nueva Nombre de Receta Categorias '                  , 'genesis-base' ),
			'separate_items_with_commas' => __( 'Separate Receta Categories with commas'     , 'genesis-base' ),
			'add_or_remove_items'        => __( 'Add or remove Receta Categories'            , 'genesis-base' ),
			'choose_from_most_used'      => __( 'Choose from the most used Receta Categories', 'genesis-base' ),
			'not_found'                  => __( 'No Receta Categories found.'                , 'genesis-base' ),
			'menu_name'                  => __( 'Receta Categories'                          , 'genesis-base' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
		),
		'exclude_from_search' => true,
		'has_archive'         => true,
		'hierarchical'        => true,
		'rewrite'             => array( 'slug' => _x( 'tipos-de-receta', 'tipos-de-receta slug' ), 'with_front' => true ),
		'show_ui'             => true,
		'show_tagcloud'       => false,
	)
);


add_action( 'init', 'smtcode_video' );
function smtcode_video() {
	$labels = array(
		'name'               => __( 'Video' ),
		'singular_name'      => __( 'Video' ),
		'all_items'          => __( 'All Video' ),
		'add_new'            => _x( 'Add new Video', 'Video' ),
		'add_new_item'       => __( 'Add new Video' ),
		'edit_item'          => __( 'Edit Video' ),
		'new_item'           => __( 'New Video' ),
		'view_item'          => __( 'View Video' ),
		'search_items'       => __( 'Search in Video' ),
		'not_found'          => __( 'No Video found' ),
		'not_found_in_trash' => __( 'No Video found in trash' ),
		'parent_item_colon'  => ''
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'has_archive'        => false, // Set to false hides Archive Pages
		'menu_icon'          => 'dashicons-video-alt', //pick one here ~> https://developer.wordpress.org/resource/dashicons/
		'rewrite'            => array( 'slug' => 'video' ),
		'taxonomies'         => array( ),
		'query_var'          => true,
		'menu_position'      => 7,
		'capability_type'    => 'page',
    		// 'publicly_queryable' => false, // Set to false hides Single Pages
		'supports'           => array(  'thumbnail' ,  'excerpt', 'comments', 'title', 'editor')
	);
	register_post_type( 'video', $args );
}

// Podcast
add_action( 'init', 'smtcode_podcast' );
function smtcode_podcast() {
	$labels = array(
		'name'               => __( 'Podcast' ),
		'singular_name'      => __( 'Podcast' ),
		'all_items'          => __( 'All Podcast' ),
		'add_new'            => _x( 'Add new Podcast', 'Podcast' ),
		'add_new_item'       => __( 'Add new Podcast' ),
		'edit_item'          => __( 'Edit Podcast' ),
		'new_item'           => __( 'New Podcast' ),
		'view_item'          => __( 'View Podcast' ),
		'search_items'       => __( 'Search in Podcast' ),
		'not_found'          => __( 'No Podcast found' ),
		'not_found_in_trash' => __( 'No Podcast found in trash' ),
		'parent_item_colon'  => ''
	);
	$args = array(
		'labels'             => $labels,
		'public'      	=> true,
		'show_in_rest'	=> true,
		'has_archive'        => true, // Set to false hides Archive Pages
		'menu_icon'          => 'dashicons-playlist-audio', //pick one here ~> https://developer.wordpress.org/resource/dashicons/
		'rewrite'            => array( 'slug' => 'podcast' ),
		'taxonomies'         => array( ),
		'query_var'          => true,
		'menu_position'      => 6,
		'capability_type'    => 'page',
    		'publicly_queryable' => true, // Set to false hides Single Pages
		'supports'           => array(  'thumbnail' ,  'excerpt', 'comments', 'title', 'editor')
	);
	register_post_type( 'podcast', $args );
}
// Events
add_action( 'init', 'smtcode_event' );
function smtcode_event() {
	$labels = array(
		'name'               => __( 'Event' ),
		'singular_name'      => __( 'Event' ),
		'all_items'          => __( 'All Event' ),
		'add_new'            => _x( 'Add new Event', 'Event' ),
		'add_new_item'       => __( 'Add new Event' ),
		'edit_item'          => __( 'Edit Event' ),
		'new_item'           => __( 'New Event' ),
		'view_item'          => __( 'View Event' ),
		'search_items'       => __( 'Search in Event' ),
		'not_found'          => __( 'No Event found' ),
		'not_found_in_trash' => __( 'No Event found in trash' ),
		'parent_item_colon'  => ''
	);
	$args = array(
		'labels'             => $labels,
		'public'      	=> true,
		'show_in_rest'	=> true,
		'has_archive'        => true, // Set to false hides Archive Pages
		'menu_icon'          => 'dashicons-calendar-alt', //pick one here ~> https://developer.wordpress.org/resource/dashicons/
		'rewrite'            => array( 'slug' => 'event' ),
		'taxonomies'         => array( ),
		'query_var'          => true,
		'menu_position'      => 6,
		'capability_type'    => 'page',
    		'publicly_queryable' => true, // Set to false hides Single Pages
		'supports'           => array(  'thumbnail' ,  'excerpt', 'comments', 'title', 'editor')
	);
	register_post_type( 'event', $args );
}
/* Taxonomies Video
--------------------------------------------- */
register_taxonomy( 'video-category', 'video',
	array(
		'labels' => array(
			'name'                       => _x( 'Video Categories', 'taxonomy general name' , 'genesis-base' ),
			'singular_name'              => _x( 'Video Category' , 'taxonomy singular name', 'genesis-base' ),
			'search_items'               => __( 'Search Video Categories'                   , 'genesis-base' ),
			'popular_items'              => __( 'Popular Video Categories'                  , 'genesis-base' ),
			'all_items'                  => __( 'All Team'                                , 'genesis-base' ),
			'edit_item'                  => __( 'Edit Video Category'                      , 'genesis-base' ),
			'update_item'                => __( 'Update Video Category'                    , 'genesis-base' ),
			'add_new_item'               => __( 'Add New Video Category'                   , 'genesis-base' ),
			'new_item_name'              => __( 'New Video Category Name'                  , 'genesis-base' ),
			'separate_items_with_commas' => __( 'Separate Video Categories with commas'     , 'genesis-base' ),
			'add_or_remove_items'        => __( 'Add or remove Video Categories'            , 'genesis-base' ),
			'choose_from_most_used'      => __( 'Choose from the most used Video Categories', 'genesis-base' ),
			'not_found'                  => __( 'No Video Categories found.'                , 'genesis-base' ),
			'menu_name'                  => __( 'Video Categories'                          , 'genesis-base' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
		),
		'exclude_from_search' => true,
		'has_archive'         => true,
		'hierarchical'        => true,
		'rewrite'             => array( 'slug' => _x( 'video-type', 'video-type slug' , 'genesis-video-pro' ), 'with_front' => false ),
		'show_ui'             => true,
		'show_tagcloud'       => false,
	)
);

/* Taxonomies Podcast
--------------------------------------------- */
register_taxonomy( 'podcast-category', 'podcast',
	array(
		'labels' => array(
			'name'                       => _x( 'Podcast Categories', 'taxonomy general name' , 'genesis-base' ),
			'singular_name'              => _x( 'Podcast Category' , 'taxonomy singular name', 'genesis-base' ),
			'search_items'               => __( 'Search Podcast Categories'                   , 'genesis-base' ),
			'popular_items'              => __( 'Popular Podcast Categories'                  , 'genesis-base' ),
			'all_items'                  => __( 'All Team'                                , 'genesis-base' ),
			'edit_item'                  => __( 'Edit Podcast Category'                      , 'genesis-base' ),
			'update_item'                => __( 'Update Podcast Category'                    , 'genesis-base' ),
			'add_new_item'               => __( 'Add New Podcast Category'                   , 'genesis-base' ),
			'new_item_name'              => __( 'New Podcast Category Name'                  , 'genesis-base' ),
			'separate_items_with_commas' => __( 'Separate Podcast Categories with commas'     , 'genesis-base' ),
			'add_or_remove_items'        => __( 'Add or remove Podcast Categories'            , 'genesis-base' ),
			'choose_from_most_used'      => __( 'Choose from the most used Podcast Categories', 'genesis-base' ),
			'not_found'                  => __( 'No Podcast Categories found.'                , 'genesis-base' ),
			'menu_name'                  => __( 'Podcast Categories'                          , 'genesis-base' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
		),
		'exclude_from_search' => true,
		'has_archive'         => true,
		'hierarchical'        => true,
		'rewrite'             => array( 'slug' => _x( 'podcast-type', 'podcast-type slug' , 'genesis-podcast-pro' ), 'with_front' => false ),
		'show_ui'             => true,
		'show_tagcloud'       => false,
	)
);
/* Taxonomies Event
--------------------------------------------- */
register_taxonomy( 'event-category', 'event',
	array(
		'labels' => array(
			'name'                       => _x( 'Event Categories', 'taxonomy general name' , 'genesis-base' ),
			'singular_name'              => _x( 'Event Category' , 'taxonomy singular name', 'genesis-base' ),
			'search_items'               => __( 'Search Event Categories'                   , 'genesis-base' ),
			'popular_items'              => __( 'Popular Event Categories'                  , 'genesis-base' ),
			'all_items'                  => __( 'All Team'                                , 'genesis-base' ),
			'edit_item'                  => __( 'Edit Event Category'                      , 'genesis-base' ),
			'update_item'                => __( 'Update Event Category'                    , 'genesis-base' ),
			'add_new_item'               => __( 'Add New Event Category'                   , 'genesis-base' ),
			'new_item_name'              => __( 'New Event Category Name'                  , 'genesis-base' ),
			'separate_items_with_commas' => __( 'Separate Event Categories with commas'     , 'genesis-base' ),
			'add_or_remove_items'        => __( 'Add or remove Event Categories'            , 'genesis-base' ),
			'choose_from_most_used'      => __( 'Choose from the most used Event Categories', 'genesis-base' ),
			'not_found'                  => __( 'No Event Categories found.'                , 'genesis-base' ),
			'menu_name'                  => __( 'Event Categories'                          , 'genesis-base' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
		),
		'exclude_from_search' => true,
		'has_archive'         => true,
		'hierarchical'        => true,
		'rewrite'             => array( 'slug' => _x( 'event-type', 'event-type slug' , 'genesis-event-pro' ), 'with_front' => false ),
		'show_ui'             => true,
		'show_tagcloud'       => false,
	)
);

/* Register Widgets
--------------------------------------------- */
genesis_register_sidebar( array(
    'id' => 'custom-widget',
    'name' => __( 'Custom Widget', 'genesis' ),
    'description' => __( 'Custom Widget Area', 'childtheme' ),
) );

// Call:
// genesis_widget_area( 'custom-widget', array(
//     'before' => '<div class="custom-widget widget-area">',
//     'after'  => '</div>',
// ) );


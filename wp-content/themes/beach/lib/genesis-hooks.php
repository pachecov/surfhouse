<?php

// Localizations
add_action('after_setup_theme', 'genesis_sample_localization_setup');
function genesis_sample_localization_setup()
{
    load_child_theme_textdomain(genesis_get_theme_handle(), get_stylesheet_directory() . '/languages');
}

add_action('after_setup_theme', 'genesis_child_gutenberg_support');
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * @since 2.7.0
 */
function genesis_child_gutenberg_support()
{ // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
    require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}

// Registers the responsive menus.
if (function_exists('genesis_register_responsive_menus')) {
    genesis_register_responsive_menus(genesis_get_config('responsive-menus'));
}

add_action('wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles');
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function genesis_sample_enqueue_scripts_styles()
{

    $appearance = genesis_get_config('appearance');

    wp_enqueue_style(
        genesis_get_theme_handle() . '-fonts',
        $appearance['fonts-url'],
        [],
        genesis_get_theme_version()
    );

    wp_enqueue_style('dashicons');

    if (genesis_is_amp()) {
        wp_enqueue_style(
            genesis_get_theme_handle() . '-amp',
            get_stylesheet_directory_uri() . '/lib/amp/amp.css',
            [genesis_get_theme_handle()],
            genesis_get_theme_version()
        );
    }

    wp_enqueue_style(
        genesis_get_theme_handle() . '-main',
        get_stylesheet_directory_uri() . '/assets/css/main.css',
        [genesis_get_theme_handle()],
        genesis_get_theme_version()
    );

    // Js files
    wp_enqueue_script(
        genesis_get_theme_handle() . '-main-js',
        get_stylesheet_directory_uri() . '/assets/js/main.min.js',
        array('jquery'),
        genesis_get_theme_version(),
        true
    );
}

add_action('after_setup_theme', 'genesis_sample_theme_support', 9);
/**
 * Add desired theme supports.
 *
 * See config file at `config/theme-supports.php`.
 *
 * @since 3.0.0
 */
function genesis_sample_theme_support()
{

    $theme_supports = genesis_get_config('theme-supports');

    foreach ($theme_supports as $feature => $args) {
        add_theme_support($feature, $args);
    }
}

add_action('after_setup_theme', 'genesis_sample_post_type_support', 9);
/**
 * Add desired post type supports.
 *
 * See config file at `config/post-type-supports.php`.
 *
 * @since 3.0.0
 */
function genesis_sample_post_type_support()
{

    $post_type_supports = genesis_get_config('post-type-supports');

    foreach ($post_type_supports as $post_type => $args) {
        add_post_type_support($post_type, $args);
    }
}

// Adds image sizes.
add_image_size('sidebar-featured', 75, 75, true);
add_image_size('genesis-singular-images', 702, 526, true);

// Removes header right widget area.
unregister_sidebar('header-right');

// Removes secondary sidebar.
unregister_sidebar('sidebar-alt');

// Removes site layouts.
genesis_unregister_layout('content-sidebar-sidebar');
genesis_unregister_layout('sidebar-content-sidebar');
genesis_unregister_layout('sidebar-sidebar-content');

// Repositions primary navigation menu.
remove_action('genesis_after_header', 'genesis_do_nav');
add_action('genesis_header', 'genesis_do_nav', 12);

// Repositions the secondary navigation menu.
remove_action('genesis_after_header', 'genesis_do_subnav');
add_action('genesis_footer', 'genesis_do_subnav', 10);

add_filter('wp_nav_menu_args', 'genesis_sample_secondary_menu_args');
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 2.2.3
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function genesis_sample_secondary_menu_args($args)
{

    if ('secondary' === $args['theme_location']) {
        $args['depth'] = 1;
    }

    return $args;
}

add_filter('genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar');
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 2.2.3
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function genesis_sample_author_box_gravatar($size)
{

    return 90;
}

add_filter('genesis_comment_list_args', 'genesis_sample_comments_gravatar');
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 2.2.3
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function genesis_sample_comments_gravatar($args)
{

    $args['avatar_size'] = 60;
    return $args;
}

//* Force content-sidebar layout setting
//*add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );

//* Force sidebar-content layout setting
//*add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content' );

//* Force content-sidebar-sidebar layout setting
//*add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar_sidebar' );

//* Force sidebar-sidebar-content layout setting
//*add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_sidebar_content' );

//* Force sidebar-content-sidebar layout setting
//*add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content_sidebar' );

//* Force full-width-content layout setting
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

//* Remove The Title Pages
remove_action('genesis_entry_header', 'genesis_entry_header_markup_open', 5);
remove_action('genesis_entry_header', 'genesis_do_post_title');
remove_action('genesis_entry_header', 'genesis_entry_header_markup_close', 15);

// Remove site footer.
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);

function print_menu_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array('name' => null, 'class' => null), $atts));
    return wp_nav_menu(array('menu' => $name, 'menu_class' => 'myclass', 'echo' => false));
}

add_shortcode('menu', 'print_menu_shortcode');
// Customize site footer
add_action('genesis_footer', 'sp_custom_footer');
function sp_custom_footer()
{
    $footer_main_logo = get_field('footer_main_logo', 'option') ? get_field('footer_main_logo', 'option') : '';
    $foot_copyright = get_field('foot_copyright', 'option') ? get_field('foot_copyright', 'option') : '';
    $socials = get_field('social', 'option') ? get_field('social', 'option') : '';
?>

    <div class="site-footer">
        <div class="container">
            <div class="site-footer__logo">
                <a href="<?php echo get_site_url() ?>" title="Yisus"><img src="<?php echo $footer_main_logo['url'] ?>" alt="<?php echo $footer_main_logo['alt'] ?>" /></a>
            </div>
            <div class="site-footer__menu">
                <?php
                echo do_shortcode('[menu name="Menu Footer"]');
                ?>
            </div>
            <?php if ($socials != '') : ?>
                <div class="site-footer__socials">
                    <ul>
                        <?php foreach ($socials as $social) :
                            $extra = '';
                            if ($social['social_icon'] == 'facebook') $extra = '-f';
                        ?>
                            <li><a href="<?php echo $social['social_url'] ?>" title="<?php echo $social['social_icon'] ?>"><i class="fab fa-<?php echo $social['social_icon'] . $extra ?>"></i></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="site-footer__copy">
                <?php echo $foot_copyright ?>
            </div>
            <div class="site-footer__scale">
                <a href="https://www.wearescale.com/" target="_blank" title="Home"><img src="<?php echo get_site_url() ?>/wp-content/uploads/2020/08/scale-logo@2x.png" alt="Scale" /></a>
            </div>
        </div>
    </div>

<?php
}
/* Custom Header
 --------------------------------------------- */
//remove initial header functions
remove_action('genesis_header', 'genesis_header_markup_open', 5);
remove_action('genesis_header', 'genesis_header_markup_close', 15);
remove_action('genesis_header', 'genesis_do_header');

//add in the new header markup - prefix the function name - here sm_ is used
add_action('genesis_header', 'sm_genesis_header_markup_open', 5);
add_action('genesis_header', 'sm_genesis_header_markup_close', 15);
add_action('genesis_header', 'sm_genesis_do_header');

//New Header functions
function sm_genesis_header_markup_open()
{
    genesis_markup([
        'html5' => '<header %s>',
        'context' => 'site-header',
    ]);

    genesis_structural_wrap('header');
}

function sm_genesis_header_markup_close()
{


    genesis_structural_wrap('header', 'close');

    genesis_markup([
        'close' => '</header>',
        'context' => 'site-header',
    ]);
}

function sm_genesis_do_header()
{
    global $wp_registered_sidebars;

    genesis_markup([
        'open' => '<div %s>',
        'context' => 'title-area',
    ]);

    $header_logo = get_field('main_logo', 'option')
        ? get_field('main_logo', 'option')
        : '';
    $second_logo = get_field('second_logo', 'option')
        ? get_field('second_logo', 'option')
        : '';
    // echo '<a href="' .
    //     get_site_url() .
    //     '" class="custom-logo-link" rel="home">
	// 		<img src="' .
    //     $header_logo['url'] .
    //     '" class="custom-logo main--logo" alt="' .
    //     $header_logo['alt'] .
    //     '" loading="lazy">';
    // if ($second_logo != '') :
    //     echo '<img src="' .
    //         $second_logo['url'] .
    //         '" class="custom-logo second--logo" alt="' .
    //         $second_logo['alt'] .
    //         '" loading="lazy">
	// 	  </a>';
    // endif;
    genesis_markup([
        'close' => '</div>',
        'context' => 'title-area',
    ]);


    if (
        (isset($wp_registered_sidebars['header-right']) &&
            is_active_sidebar('header-right')) ||
        has_action('genesis_header_right')
    ) {
        genesis_markup([
            'open' => '<div %s>' . genesis_sidebar_title('header-right'),
            'context' => 'header-widget-area',
        ]);

        do_action('genesis_header_right');
        add_filter('wp_nav_menu_args', 'genesis_header_menu_args');
        add_filter('wp_nav_menu', 'genesis_header_menu_wrap');
        dynamic_sidebar('header-right');
        remove_filter('wp_nav_menu_args', 'genesis_header_menu_args');
        remove_filter('wp_nav_menu', 'genesis_header_menu_wrap');

        genesis_markup([
            'close' => '</div>',
            'context' => 'header-widget-area',
        ]);
    }
}

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

// ACF Theme Options
if (function_exists('acf_add_local_field_group')) :
    require_once get_stylesheet_directory() . '/lib/acf/acf-json/options.php';
endif;

function my_acf_admin_head()
{
?>
    <style type="text/css">
        .acf-flexible-content .layout .acf-fc-layout-handle {
            /*background-color: #00B8E4;*/
            background-color: #202428;
            color: #eee;
        }

        .acf-repeater.-row>table>tbody>tr>td,
        .acf-repeater.-block>table>tbody>tr>td {
            border-top: 2px solid #202428;
        }

        .acf-repeater .acf-row-handle {
            vertical-align: top !important;
            padding-top: 16px;
        }

        .acf-repeater .acf-row-handle span {
            font-size: 20px;
            font-weight: bold;
            color: #202428;
        }

        .imageUpload img {
            width: 75px;
        }

        .acf-repeater .acf-row-handle .acf-icon.-minus {
            top: 30px;
        }

        .acf_postbox {
            background-color: #0473AA;
            border-radius: 5px;
        }

        .acf_postbox input[type=text],
        .acf_postbox input[type=search],
        .acf_postbox input[type=radio],
        .acf_postbox input[type=tel],
        .acf_postbox input[type=time],
        .acf_postbox input[type=url],
        .acf_postbox input[type=week],
        .acf_postbox input[type=password],
        .acf_postbox input[type=checkbox],
        .acf_postbox input[type=color],
        .acf_postbox input[type=date],
        .acf_postbox input[type=datetime],
        .acf_postbox input[type=datetime-local],
        .acf_postbox input[type=email],
        .acf_postbox input[type=month],
        .acf_postbox input[type=number],
        .acf_postbox select,
        .acf_postbox textarea {
            border-radius: 5px;
        }

        .acf_postbox p.label {
            text-shadow: none;
        }

        .acf_postbox h2.hndle,
        .acf_postbox p.label label,
        .acf_postbox p.label,
        .acf_postbox .toggle-indicator {
            color: #ffffff;
        }

        /*---- Date Picker Style ----*/

        .ui-acf .ui-datepicker select.ui-datepicker-month,
        .ui-acf .ui-datepicker select.ui-datepicker-year {
            border-radius: 5px;
        }

        .ui-acf .ui-state-default {
            border: 1px solid #ffffff !important;
            background: none !important;
        }

        .ui-acf .ui-datepicker .ui-state-active,
        .ui-acf .ui-state-default:hover {
            background: #2EA2CC !important;
            color: #ffffff;
        }

        .ui-acf .ui-widget-header {
            background: #3e3e3e;
        }

        .ui-acf .ui-datepicker .ui-datepicker-buttonpane {
            background: #0473AA;
            border-top: none;
        }

        .ui-acf .ui-datepicker .ui-datepicker-buttonpane button {
            text-shadow: none;
            color: #ffffff;
            text-decoration: underline;
            border: none !important;
        }
    </style>
<?php
}

add_action('acf/input/admin_head', 'my_acf_admin_head');


// disable for posts gutenberg
add_filter('use_block_editor_for_post', '__return_false', 10);

// disable for post types gutenberg
add_filter('use_block_editor_for_post_type', '__return_false', 10);

//Disable Default Dashboard Widgets
function remove_dashboard_meta()
{
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); //Removes the 'incoming links' widget
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); //Removes the 'plugins' widget
    remove_meta_box('dashboard_primary', 'dashboard', 'normal'); //Removes the 'WordPress News' widget
    remove_meta_box('dashboard_secondary', 'dashboard', 'normal'); //Removes the secondary widget
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); //Removes the 'Quick Draft' widget
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); //Removes the 'Recent Drafts' widget
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); //Removes the 'Activity' widget
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //Removes the 'At a Glance' widget
    remove_meta_box('dashboard_activity', 'dashboard', 'normal'); //Removes the 'Activity' widget (since 3.8)
    remove_meta_box('rg_forms_dashboard', 'dashboard', 'normal'); //Removes the 'Activity' widget (since 3.8)
    remove_action('admin_notices', 'update_nag');
}
add_action('admin_init', 'remove_dashboard_meta');

// add_filter('admin_footer_text', remove_admin_footer_text, 1000);

function remove_admin_footer_text($footer_text = '')
{
    return '';
}

// add_filter('update_footer', remove_admin_footer_upgrade, 1000);

function remove_admin_footer_upgrade($footer_text = '')
{
    return '';
}

function example_admin_bar_remove_logo()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'example_admin_bar_remove_logo', 0);

add_action('wp_head', 'change_bar_color');
add_action('admin_head', 'change_bar_color');
function change_bar_color()
{ ?>
    <style>
        #wpadminbar,
        #adminmenu,
        #adminmenuback,
        #adminmenuwrap {
            background: #54626F;
        }
    </style>
<?php }

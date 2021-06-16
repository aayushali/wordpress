<?php
/**
 * practiceTheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package practiceTheme
 */
if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}
if (!function_exists('practicetheme_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function practicetheme_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on practiceTheme, use a find and replace
         * to change 'practicetheme' to the name of your theme in all the template files.
         */
        load_theme_textdomain('practicetheme', get_template_directory() . '/languages');
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');
        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array('menu-1' => esc_html__('Primary', 'practicetheme'),));
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',));
        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('practicetheme_custom_background_args', array('default-color' => 'ffffff', 'default-image' => '',)));
        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array('height' => 250, 'width' => 250, 'flex-width' => true, 'flex-height' => true,));
    }
endif;
add_action('after_setup_theme', 'practicetheme_setup');
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function practicetheme_content_width()
{
    $GLOBALS['content_width'] = apply_filters('practicetheme_content_width', 640);
}

add_action('after_setup_theme', 'practicetheme_content_width', 0);
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function practicetheme_widgets_init()
{
    register_sidebar(array('name' => esc_html__('Sidebar', 'practicetheme'), 'id' => 'sidebar-1', 'description' => esc_html__('Add widgets here.', 'practicetheme'), 'before_widget' => '<section id="%1$s" class="widget %2$s">', 'after_widget' => '</section>', 'before_title' => '<h2 class="widget-title">', 'after_title' => '</h2>',));
}

add_action('widgets_init', 'practicetheme_widgets_init');
/**
 * Enqueue scripts and styles.
 */
function practicetheme_scripts()
{
    wp_enqueue_style('practicetheme-style', get_stylesheet_uri(), array(), _S_VERSION);

    wp_style_add_data('practicetheme-style', 'rtl', 'replace');
    wp_enqueue_script('jquery');
    wp_enqueue_script('practicetheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'practicetheme_scripts');
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}


function enqueue_ajax_script()
{

    wp_enqueue_script('enqueuing_ajax', get_template_directory_uri() . '/js/my_ajax_script.js', array(), _S_VERSION,true);
    wp_localize_script('enqueuing_ajax', 'ajaxobj', array('ajaxurl' => site_url() . '/wp-admin/admin-ajax.php'));
}

add_action('wp_enqueue_scripts', 'enqueue_ajax_script');



function example_ajax_request()
{
    $args = array('post_type' => 'product', 'posts_per_page' => 3);
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()):
        while ($the_query->have_posts()):
            $the_query->the_post();
            the_title();
            the_content();
        endwhile;
    endif;
    wp_reset_postdata();
    // Always die in functions echoing ajax content
    die();
}

add_action('wp_ajax_example_ajax_request', 'example_ajax_request');
// If you wanted to also use the function for non-logged in users (in a theme for example)
add_action('wp_ajax_nopriv_example_ajax_request', 'example_ajax_request');


add_action('wp_enqueue_scripts','enqueue_scripts_test');

function enqueue_scripts_test(){

    return null;
}






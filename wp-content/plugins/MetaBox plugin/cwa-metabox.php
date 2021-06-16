<?php

/*
Plugin Name: WP CWA Metabox
Description: This is a custom plugin to create metabox
Version: 1.0.0
Author: Aayush Khan
*/



// register a custom post type book


function wpdocs_codex_book_init() {
    $labels = array(
        'name'                  => _x( 'Books', 'textdomain' ),
        'singular_name'         => _x( 'Book','textdomain' ),
        'menu_name'             => _x( 'Books','textdomain' ),
        'name_admin_bar'        => _x( 'Book', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Book', 'textdomain' ),
        'new_item'              => __( 'New Book', 'textdomain' ),
        'edit_item'             => __( 'Edit Book', 'textdomain' ),
        'view_item'             => __( 'View Book', 'textdomain' ),
        'all_items'             => __( 'All Books', 'textdomain' ),
        'search_items'          => __( 'Search Books', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Books:', 'textdomain' ),
        'not_found'             => __( 'No books found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No books found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'Books image ', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image','textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image','textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image','textdomain' ),
        'archives'              => _x( 'Book archives', 'textdomain' ),
        
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'book' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),

    );
 
    register_post_type( 'book', $args );
}
 
add_action( 'init', 'wpdocs_codex_book_init' );



function wpdocs_codex_product_init() {
    $labels = array(
        'name'                  => _x( 'Products', 'textdomain' ),
        'singular_name'         => _x( 'Product','textdomain' ),
        'menu_name'             => _x( 'Products','textdomain' ),
        'name_admin_bar'        => _x( 'Products', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Product', 'textdomain' ),
        'new_item'              => __( 'New Product', 'textdomain' ),
        'edit_item'             => __( 'Edit product', 'textdomain' ),
        'view_item'             => __( 'View product', 'textdomain' ),
        'all_items'             => __( 'All products', 'textdomain' ),
        'search_items'          => __( 'Search products', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent products:', 'textdomain' ),
        'not_found'             => __( 'No products found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No products found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'products image ', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image','textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image','textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image','textdomain' ),
        'archives'              => _x( 'product archives', 'textdomain' ),
        
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'product' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ,'custom-fields'),

    );
 
    register_post_type( 'product', $args );
}
 
add_action( 'init', 'wpdocs_codex_product_init' );

// removed support type for thumbnail

add_action('init', 'my_rem_editor_from_post_type');
function my_rem_editor_from_post_type() {
   
    remove_post_type_support( 'book', 'thumbnail' );
}


// Custom Taxonomies

function size_custom_taxonomies(){

	//add new taxonomy hierarchical
	$labels = array(
		'name' => 'sizes',
		'singular_name' => 'size',
		'search_items' => 'Search sizes',
		'all_items' => 'All size',
		'parent_type' => 'Parent size',
		'parent_item_colon' => 'Parent size',
		'edit_item' => 'Edit size',
		'update_item' => 'Update size',
		'add_new_item' => 'Add New size',
		'new_item_name' => 'New size name',
		'menu_name' => 'Size'

	);

	$args = array (
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' =>  array ('slug' => 'size')
	);

	register_taxonomy('size', array('product'), $args );

	//add new taxonomy not hierarchical

}
add_action('init', 'size_custom_taxonomies');








function color_custom_taxonomies(){
	$labels = array(
		'name' => 'colors',
		'singular_name' => 'color',
		'search_items' => 'Search Items',
		'all_items' => 'All colors',
		'parent_type' => 'Parent color',
		'parent_item_colon' => 'Parent color',
		'edit_item' => 'Edit Color',
		'update_item' => 'Update Color',
		'add_new_item' => 'Add New Color',
		'new_item_name' => 'New color name',
		'menu_name' => 'Color'
	);

	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'color')
	);


	register_taxonomy('color', array('product'), $args);
}

add_action('init', 'color_custom_taxonomies');


function be_change_event_posts_per_page( $query ) {
	
	if( $query->is_main_query() && !is_admin() && is_post_type_archive('book') ) {
		$query->set( 'posts_per_page', '2' );
	}

}
add_action( 'pre_get_posts', 'be_change_event_posts_per_page' );





// Re-assigned the menu position of products custom post type 

add_action( 'registered_post_type', 'reassign_the_product_menu_position', 999 , 2 );

function reassign_the_product_menu_position( $post_type, $args ) {
    if ( 'product' === $post_type ) {
        global $wp_post_types;
        $args->menu_position = 75;
        $wp_post_types[ $post_type ] = $args;
    }
} 




//adding meta box to a custom post type Product


function wpl_cwa_register_metabox(){
    add_meta_box('cwa-page-id',"Seller Name", "wp_cwa_posts_function",'product','normal','high');
}

add_action("add_meta_boxes", "wpl_cwa_register_metabox" , 9999);


//call back function for metabox at custom post type product

function wp_cwa_posts_function( $post){
   
     $id = $post->ID;
     $seller_name = get_post_meta($id, '_seller_name', true);
     print_pre($seller_name);
      ?>
    <div>
        <label for="seller">seller</label>
        <input type="text" name="seller_name" value="<?php echo $seller_name; ?>">
    </div>
     <?php wp_nonce_field( 'post', 'seller_name' ); ?>

    <?php 
   


}

// Getting value from the field


add_action( 'save_post', 'add_discount_meta',999);
 
function add_discount_meta( $post_id )
{
 
        $seller = sanitize_text_field($_POST['seller_name']);
        update_post_meta( $post_id, '_seller_name', $seller );

}




function print_pre($args){

    echo "<pre>";
    print_r($args);
    echo "</pre>";
}

?>
<?php
/*
Plugin Name: CWA Shortcode
Description: This is a simple plugin for purpose of learning
Version: 1.0.0
Author: Aayush Khan

*/
?>
<?php

/**
 * Adds Foo_Widget widget.
 */
class Foo_Widget extends WP_Widget
{
    /**
     * Register widget with WordPress.
     */
    public function __construct()
    {
        parent::__construct('foo_widget', // Base ID
            'Foo_Widget', // Name
            array('description' => __('A Foo Widget', 'text_domain'),) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     * @see WP_Widget::widget()
     *
     */
    public function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }
        echo __('Hello, World!', 'text_domain');
        echo $after_widget;
    }

    /**
     * Back-end widget form.
     *
     * @param array $instance Previously saved values from database.
     * @see WP_Widget::form()
     *
     */
    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('New title', 'text_domain');
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                       name="<?php echo $this->get_field_name('title'); ?>" type="text"
                       value="<?php echo esc_attr($title); ?>"/>
            </label>
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     * @see WP_Widget::update()
     *
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
} // class Foo_Widget
function widget_register()
{
    register_widget('Foo_Widget');
}

add_action('widgets_init', 'widget_register');
//adding shortcode
function wp_demo_shortcode()
{
    $message = "Hello This is a shortcode output";
    return $message;
}

//registering the shortcode
add_shortcode('greeting', 'wp_demo_shortcode', 999);
//adding a ad script
// The shortcode function
function display_posts_function()
{
    $args = array('post_type' => 'product', 'posts_per_page' => 5, 'offset' => 2,);
    ob_start();
//$return_string = '<ul>';
    ?>
    <div><?php
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()) : while ($the_query->have_posts()) :
            $the_query->the_post();
            /* $return_string .= '<li><h3>'.get_the_title().'</h3><br>'
           .get_the_post_thumbnail(). get_the_content() . '<br>'.
           get_the_term_list( $post->ID, 'size', 'Size: ', ', ' ).'<br>'.
           get_the_term_list( $post->ID, 'color', 'Color: ', ', ' ) .'</li>'; */ ?>
            <div><h3><?php the_title(); ?> </h3></div>
            <div> <?php the_post_thumbnail(); ?></div>
            <div> <?php the_content(); ?> </div>
            <div> <?php the_terms($post->ID, 'size', 'Size:', ", ", ''); ?> </div>
            <div> <?php the_terms($post->ID, 'color', 'Color:', ", ", ''); ?></div>
        <?php
        endwhile;
        endif;
        ?>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}

function register_shortcode()
{
    add_shortcode('display-posts', 'display_posts_function');
}

add_action('init', 'register_shortcode', 999);
function register_my_menus()
{
    register_nav_menus(array('header-menu' => 'Header Menu', 'footer-menu' => 'Footer Menu'));
}

add_action('init', 'register_my_menus', 9999);


?>



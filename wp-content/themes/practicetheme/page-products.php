<?php
get_header();
$args = array('post_type' => 'product',);
$the_query = new WP_Query($args);
if ($the_query->have_posts()):
    while ($the_query->have_posts()):
        $the_query->the_post();
        the_title();
        the_content();
    endwhile;
endif;
wp_reset_postdata();
?>










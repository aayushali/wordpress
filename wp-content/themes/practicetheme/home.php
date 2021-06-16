<?php
get_header();
$args = array('post_type' => 'product',
    'paged'=> 1);
$the_query = new WP_Query($args);
?>
<div id="posts">
    <?php
if ($the_query->have_posts()):
    while ($the_query->have_posts()):
        $the_query->the_post();
        the_title();
        the_content();
    endwhile;
endif;
wp_reset_postdata();

?>
<button class="btn-get-posts">
    Click here to get posts
</button>
<div class="posts-content">
</div>

<?php
get_footer();

?>








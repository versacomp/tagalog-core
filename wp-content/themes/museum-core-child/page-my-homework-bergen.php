<?php
/*
	Page template for My-Homework-Bergen
*/
get_header();


$page_slug = get_post_meta($post->ID, 'homework_slug', true);

$args = array(
    'name'        => $page_slug,
    'post_type'   => 'post',
    'post_status' => 'publish',
    'numberposts' => 1
);
$my_posts = get_posts($args);

?>

<?php if( $my_posts ) :?>

    $ap_core_content = ap_core_get_which_content(); ?>
    <div class="content col-md-9 <?php echo esc_attr( $ap_core_content ) ?>">

        <?php echo $my_posts[0]->post_content; ?>

    </div>
    <?php get_footer(); ?>


<?php endif?>
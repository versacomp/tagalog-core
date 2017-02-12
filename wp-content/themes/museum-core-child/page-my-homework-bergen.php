<?php
/*
	Page template for My-Homework-Bergen
*/
get_header();

global $post;

$page_slug = get_post_meta($post->ID, 'homework_slug', true);

echo "page_slug: " . $page_slug;

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



<?php else: ?>

    <?php $ap_core_content = ap_core_get_which_content(); ?>
    <div class="content col-md-9 <?php echo esc_attr( $ap_core_content ) ?>">

        <?php echo "No homework found. :("; ?>

    </div>

<?php endif?>

<?php echo "<br /><br /><br />"; ?>

<?php get_footer(); ?>

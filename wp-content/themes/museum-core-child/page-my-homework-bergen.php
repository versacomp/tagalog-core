<?php
/*
	Page template for My-Homework-Bergen
*/
get_header();

global $post;

$page_slug = get_post_meta($post->ID, 'homework_slug', true);

$args = array(
    'name'        => $page_slug,
    'post_type'   => 'post',
    'post_status' => 'publish',
    'numberposts' => 1
);
$my_posts = get_posts($args);

$url  = isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http';
$url .= '://' . $_SERVER['SERVER_NAME'];
$url .= in_array( $_SERVER['SERVER_PORT'], array('80', '443') ) ? '' : ':' . $_SERVER['SERVER_PORT'];
$url .= $_SERVER['REQUEST_URI'];

?>

<?php if( $my_posts ) :?>

    <?php $ap_core_content = ap_core_get_which_content(); ?>
    <div class="content col-md-9 <?php echo esc_attr( $ap_core_content ) ?>">

        <?php echo "URL: " . $url . "<br />"; ?>
        <?php echo "<h4>" . $my_posts[0]->post_title . "</h4>"; ?>
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

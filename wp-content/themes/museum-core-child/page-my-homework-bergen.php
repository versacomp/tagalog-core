<?php
/*
	Page template for My-Homework-Bergen
*/
tha_content_before();
$ap_core_content = ap_core_get_which_content(); ?>
    <div class="content col-md-9 <?php echo esc_attr( $ap_core_content ) ?>">

        <?php get_template_part('parts/content', 'page'); ?>

    </div>
<?php get_footer(); ?>
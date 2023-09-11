<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Walkies
 */

get_header();
?>

	<main id="primary" class="site-main">

    <?php
    if ( function_exists( 'get_field' ) ) :
    ?>
		<section class="home-banner">
			<?php

				if ( get_field( 'banner_image_1' ) ) {
					echo "<img src='".esc_html( get_field( 'banner_image_1' ), 'full' )."'>";
				}
			?>
		</section>
    <?php 
    endif;
    ?>

		


	</main><!-- #main -->

<?php
get_footer();

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

    <?php if ( function_exists( 'get_field' ) ) : ?>
		<section class="home-banner">
			<?php
                if ( get_field( 'banner_image_1' ) && !get_field('banner_image_2') && !get_field('banner_image_3') ){
                    echo "<img src='".esc_html( get_field( 'banner_image_1' ), 'full' )."'>";
                } else  {
					?>
                        <div class="slideshow-container">
                            <?php if(get_field('banner_image_1')): ?>
                            <div class="img-slide fade">
                                 <img src="<?php echo esc_html( get_field( 'banner_image_1' ) ); ?>" alt="<?php echo esc_html( get_field_object( 'banner_image_1' )['label'] ); ?>">
                            </div>
                            <?php endif; ?>

                            <?php if(get_field('banner_image_2')): ?>
                            <div class="img-slide fade">
                                 <img src="<?php echo esc_html( get_field( 'banner_image_2' ) ); ?>"
                                 alt="<?php echo esc_html( get_field_object( 'banner_image_1' )['label'] ); ?>">
                            </div>
                            <?php endif; ?>

                            <?php if(get_field('banner_image_3')): ?>
                            <div class="img-slide fade">
                                <img src="<?php echo esc_html( get_field( 'banner_image_3' ) ); ?>"
                                alt="<?php echo esc_html( get_field_object( 'banner_image_1' )['label'] ); ?>">  
                            </div>
                            <?php endif; ?>

                            <!-- Next and previous buttons -->
                            <a class="prev" onclick="nextImg(-1)">&#10094;</a>
                            <a class="next" onclick="nextImg(1)">&#10095;</a>
                            </div>
                            <br>

                            <!-- The dots/circles -->
                            <div style="text-align:center">
                                <span class="dot active" onclick="currentSlide(1)"></span>
                                <span class="dot" onclick="currentSlide(2)"></span>
                                <span class="dot" onclick="currentSlide(3)"></span>
                            </div>
                        </div>

                    <?php
				}
			?>
		</section>
    <?php endif; ?>

    <?php if ( function_exists( 'get_field' ) ) : ?>
    <section class="featured-products">
    
        <?php
        if (get_field('featured_products')) :
            $featured = get_field('featured_products');
            foreach($featured as $product) :
            
                setup_postdata($product); 
                wc_get_template_part( 'content', 'product' );
            endforeach;
        endif;
            
        wp_reset_postdata();
        ?>
    </section>
    <?php endif; ?>

		


	</main><!-- #main -->

<?php
get_footer();

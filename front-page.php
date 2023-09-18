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
    <div class="col-full orange-line"></div>
    <section class="featured-collection col-full">
        <?php
        if (get_field('featured_collection')) :
            $term = get_field('featured_collection');
            $thumb = get_term_meta($term->term_id, 'thumbnail_id', true);
         
                     
            echo '<img src="'.wp_get_attachment_url($thumb).'" alt="'.esc_html( $term->name ).'">';
            echo '<div>';
            echo '<h2>'.esc_html( $term->name ).'</h2>';
            echo '<p>'.esc_html( $term->description ).'</p>';
            echo '<a href="'.esc_url(get_term_link($term)).'" class="calido-link">See Collection</a>';
            echo '</div>';
            ?>
            
             <?php
        endif;
            
        wp_reset_postdata();
        ?>
    </section>
    <?php endif; ?>
    
    <?php if ( function_exists( 'get_field' ) ) : ?>
    <div class="col-full blue-line"></div>
    <section class="featured-work col-full">
    <h2>Featured Work</h2>
        <?php
        if (get_field('featured_products')) :
            ?><div class="featured-products"><?php
            $featured = get_field('featured_products');
            $i = 0;
            foreach($featured as $product) :
                $i++;
                $post = get_post($product->ID);
                $link = get_permalink($post);
                $content = $post->post_content; 
                $image =  wp_get_attachment_image_src( get_post_thumbnail_id( $post ), 'single-post-thumbnail' )

                ?>
                <a href=<?php echo $link;?> class="single-featured-product" id=<?php echo 'single-featured-'.$i;?>>
                    
                        <img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title($post); ?>">
                        <h3 class="single-featured-header"><?php echo get_the_title($post); ?></h3>
                    
                </a>

                <?php
            endforeach;
            ?></div><?php
        endif;
            
        wp_reset_postdata();
        ?>
    </section>
    <?php endif; ?>


    <?php if ( function_exists( 'get_field' ) ) : ?>
    <div class="col-full home-cta">
        <?php
        if (get_field('home_cta_link')) :
            
            $link = get_field('home_cta_link');
            $label = get_field('home_cta_label');
           
            echo '<a href="'.$link.'" class="calido-link calido-secondary">'.esc_html($label).'</a>';
        
            ?>
            
             <?php
        endif;
            
        wp_reset_postdata();
        ?>
    </div>
    <?php endif; ?>


	</main><!-- #main -->

<?php
get_footer();

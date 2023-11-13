<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="col-full calido-footer">

			<div class="footer-left">
				<span id="copyright">&copy; <?php echo date('Y')?></span>
				<span id="calido-name">Calido Art Glass</span>
				<span id="rights">All rights reserved</span>
			</div>
			<div class="footer-right">
			<?php
					wp_nav_menu(
						array(
							'theme_location' 	=> 'socials-menu',
							'menu_id' 			=> 'socials-menu',
						)
					);
					?>
			</div>
			<a class="screen-reader-text" href="#primary"><?php esc_html_e( 'Back to content', 'calido' ); ?></a>
		</div><!-- .col-full -->
	</footer><!-- #colophon -->


</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

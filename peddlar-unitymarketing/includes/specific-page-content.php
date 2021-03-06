<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Page Content Component
 *
 * Display content from a specified page.
 *
 * @author Matty
 * @since 1.0.0
 * @package WooFramework
 * @subpackage Component
 */
$settings = array(
				'homepage_page_id' => '', 
				'thumb_single' => 'false', 
				'single_w' => 200, 
				'single_h' => 200, 
				'thumb_single_align' => 'alignleft',
				'homepage_posts_sidebar' => 'true'
				);
					
$settings = woo_get_dynamic_values( $settings );

if ( 0 < intval( $settings['homepage_page_id'] ) ) {
$query = new WP_Query( 'page_id=' . intval( $settings['homepage_page_id'] ) );
?>

<section id="main" class="homepage-area <?php if ( 'true' == $settings['homepage_posts_sidebar'] ) { echo 'col-left'; } else { echo 'fullwidth'; } ?>">

	<section id="page-content">
	<?php woo_loop_before(); ?>

	<?php
		if ( $query->have_posts() ) {
			
			while ( $query->have_posts() ) { $query->the_post();
	?>

		<article <?php post_class(); ?>>

				<div class="inner">

					<header>
						<h1><?php the_title(); ?></h1>
					</header>

					<section class="entry">
						<?php the_content( __( 'Continue Reading &rarr;', 'woothemes' ) ); ?>
					</section>

				</div>

		</article>

	<?php
			} // End WHILE Loop
		
		} else {
	?>
	    <article <?php post_class(); ?>>
	    	<div class="inner">
	        	<p><?php _e( 'Selected home page content not found.', 'woothemes' ); ?></p>
	    	</div>
	    </article><!-- /.post -->
	<?php } ?> 

	<?php woo_loop_after(); ?>
	</section>

</section><!-- /#main -->

<?php if ( 'true' == $settings['homepage_posts_sidebar'] ) { get_sidebar(); } ?>

<div class="fix"></div>

<?php } // End the main check ?>
<?php
/**
 * Template Name: Rooms
 *
 * Description: Displays excerpts of all posts in the category 'rooms'
 *
 * @since 1.0.3
 */

$args = array(
	'post_type' => 'post',
	'tax_query' => array(
		array(
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => array("rooms")
		),
	),
);
$rooms_query = new WP_Query( $args );
$force_excerpt = true;
?>


<?php if ( ! is_front_page() )	get_header(); ?>


	<div class="container">
		<div class="row">
        	<div id="primary" <?php bavotasan_primary_attr(); ?>>
        		<?php
        		if ( $rooms_query->have_posts() ) :
        			while ( $rooms_query->have_posts() ) : $rooms_query->the_post(); ?>

							<!--- post start --->
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
								<?php
								// Display a thumbnail if one exists and not on single post
								bavotasan_display_post_thumbnail();

									get_template_part( 'content', 'header' ); ?>

									<div class="entry-content description clearfix">
									<?php
										// Show only excerpt of article
										the_excerpt();
									?>
									</div><!-- .entry-content -->
									<?php if ( is_singular() && ! is_front_page() )
										get_template_part( 'content', 'footer' ); ?>
							</article><!-- #post-<?php the_ID(); ?> -->
							<!-- post end -->


							<?php
        			endwhile;

        			bavotasan_pagination();
        		else :
        			get_template_part( 'content', 'none' );
        		endif;
        		?>
        	</div>
            <?php get_sidebar(); ?>
		</div>
	</div>

<?php if ( ! is_front_page() ) get_footer(); ?>

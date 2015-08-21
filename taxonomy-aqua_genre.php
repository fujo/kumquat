<?php get_header(); ?>

<!-- taxonomy-aqua_genre.php -->
<section class="container winHeight">
	<div class="row">
		<div class="six columns">
			<h1><?php single_cat_title(); ?></h1>
		</div>
	</div>
	<div class="row">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article class="six columns">
		<?php echo get_the_post_thumbnail( $page->ID, 'thumbnail' ); ?>
		<br>
		<?php the_title(); ?>
		</article>
		<?php endwhile; else : ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
	</div>
</section>
<section id="map" class="winHeight">
	<div id="map-canvas" style="width: 100%; height: 100%"></div>
</section>

<?php get_footer(); ?>
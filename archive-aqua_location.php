<?php
/*
Template Name: archive-aqua_location
*/
get_header(); ?>

archive-aqua_location.php

<div id="container">

	<script>
		app_globals.markers = [];
	</script>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<?php $location = get_field('map'); ?>

		<script> 
			app_globals.markers.push({lat:<?php echo $location['lat']; ?>, lng:<?php echo $location['lng']; ?> } ); 
		</script>

	<?php endwhile; else : ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>

	<section id="map" class="winHeight">
		<div id="map-canvas" style="width: 100%; height: 100%"></div>
	</section>

</div><!-- #container -->

<?php get_footer(); ?>
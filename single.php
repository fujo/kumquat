<?php
/*
Template Name: archive-aqua_location
*/
get_header(); ?>

single.php

<article class="container">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="row">
		<div class="twelve columns">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div>
	</div>	
	<?php endwhile; else : ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>
</article>
<?php get_footer(); ?>
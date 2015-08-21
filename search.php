<?php get_header(); ?>

<section id="searchResults" class="container">

	<div class="row">
		<div class="twelve columns">
			<h1><?php _e( 'Results', 'locale' ); ?></h1>
			<?php echo $wp_query->found_posts; ?> 
			<?php _e( 'Search Results Found For', 'locale' ); ?>: "<?php the_search_query(); ?>"
		</div>
	</div>
	
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="row">
			<article class="six columns">
			<h2><?php the_title(); ?></h2>
			<?php the_excerpt(); ?><br>
			<a href="<?php the_permalink(); ?>" class="btn icn more">More</a>
			</article>
		</div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	<?php else : ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>
	

</section>

<?php get_footer(); ?>
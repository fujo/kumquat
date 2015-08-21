<?php 
$child_pages = new WP_Query( array(
	'post_type'      => 'page', // set the post type to page
	'posts_per_page' => 10, // number of posts (pages) to show
	'post_parent'    => ($pageID) ? $pageID : $post->ID, // enter the post ID of the parent page
	'no_found_rows'  => true, // no pagination necessary so improve efficiency of loop
));
?>

<?php if ( $child_pages->have_posts() ) : while ( $child_pages->have_posts() ) : $child_pages->the_post(); ?>
<article>
	<h2><?php the_title(); ?></h2>
	<?php the_post_thumbnail(); ?>
</article>
<?php endwhile; else : ?>
no posts
<?php endif; ?>

<?php wp_reset_postdata(); ?>
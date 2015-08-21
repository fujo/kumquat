<?php
/*
Template Name: page.php
*/
get_header(); ?>


<?php

  if ( current_user_can( 'do_cheesecake'  ) ) {
	  // do something if the current user has $capability
	  echo 'salut michel, on fait des gâteaux?';
  }
  else {
  		echo 'you cannot cook, no rights';
  }

?>



<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
$url = $thumb['0']; ?>
<section class="header_image parallax" style="background-image:url(<?php echo $url;?>);">
	<!--<?php the_post_thumbnail('full'); ?>-->
</section>

<?php _e( 'Text to translate', 'aquarelle' ); ?>

<section class="container">
	<div class="row">
		<div class="large-6 columns">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php edit_post_link( $link, '<p>', '</p>', $id ); ?> 
		</div>
	</div>
	<div class="row">
		<div class="large-6 columns">
			<?php the_content(); ?> 
		</div>

		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php global $post;
if($post->post_name == 'contact'): ?>
<section class="container">
	<div class="row">
		<div class="seven columns">
			<?php echo do_shortcode( '[contact-form-7 id="66" title="Contactform"]' ); ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
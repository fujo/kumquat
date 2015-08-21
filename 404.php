<?php wp_head(); ?> 
<section>
	<div class="container page--404">
		<div class="row">
			<div class="twelve columns textAlignCenter">
				<br>
				<img src="<?php echo get_bloginfo('template_directory'); ?>/img/404.png" alt="super mario game over">
				<h1>404</h1>
				<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<p><a href="/"><?php _e( 'Return to the homepage' ); ?></a></p>
			</div>
		</div>
	</div>
</section>
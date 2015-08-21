<?php

/** Template Name: teaser */

$post = get_post($id); 
$title = apply_filters('the_title', $post->post_title); 
$content = apply_filters('the_content', $post->post_content); 

?>
<div class="container">
  <div class="row">
    <div class="six columns">
      <h2><?php echo $title; ?></h2>
      <?php echo $content; ?>
      <a href="/page-d-exemple" class="btn icn more ajax" rel="follow" title="more">more</a>
    </div>
    <div class="six columns">
      <figure class="circle">
        <img src="http://localhost/jnthn2_ch/wp-content/uploads/2015/07/bg-300x272.jpg">
      </figure>
    </div>
  </div>
</div>
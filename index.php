<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage 
 * @since 
 */

get_header(); ?>

<div class="content">


  <section id="" class="container">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php the_content(); ?>
    <?php endwhile; else : ?>
      <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>
 
  </section>



  <?php query_posts('cat=3'); ?>
  <?php if (have_posts()) : ?> 
  <?php while (have_posts()) : the_post(); ?>
  <?php
    $thumb_id = get_post_thumbnail_id();
    $thumb_url = wp_get_attachment_image_src($thumb_id,'', true);
  ?>
  <section id="inter--hero" class="parallax winHeight" style="background: url(<?php echo $thumb_url[0]; ?>)  no-repeat 50% 50% fixed;">
      <div class="jumbotron fade">
        <svg version="1.1" id="fox" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   width="113px" height="79px" viewBox="0 0 113 79" enable-background="new 0 0 113 79" xml:space="preserve">
          <path fill="none" stroke="#FFFFFF" stroke-miterlimit="10" d="M17.266,54.674c0.031,0,0.063,0,0.094,0
          c9.669-0.032,20.565-6.355,21.481-14.829c3.761,13.452-10.756,14.476-8.788,28.389c1.945,0.662,5.371,2.248,7.436,0.675
          c0.726-3.429-2.599-2.807-4.055-4.055c1.581-8.558,10.563-9.714,16.222-14.194c3.707,1.321,2.716,6.403,0.676,8.787
          c1.712,6.004,6.036,12.814,13.519,10.815c-2.367-5.356-7.998-3.742-8.112-9.464c-0.093-4.684,6.296-7.197,6.759-12.843
          c2.955,2.001,7.679,2.237,12.844,2.027c3.027,4.859,0.696,15.076,3.379,20.279c1.468,0.381,5.535,1.613,6.76,0
          c0.619-3.323-3.291-2.117-4.056-4.056c1.253-5.957-0.588-15.008,5.408-16.224c6.453,4.526,6.465,22.153,18.25,16.899
          c-0.536-2.168-2.351-3.057-5.408-2.703c-6.317-11.249-2.045-22.196,3.381-31.771c2.828,0.811,5.246,0.704,7.435-0.676
          c-2.232-7.297-3.677-14.795-3.379-22.982c-3.84,1.118-4.112,5.802-7.437,7.435c-4.172-0.558-3.74-5.721-8.11-6.083
          c-0.291,4.091,0.557,11.223-3.38,14.194c-5.247,3.96-16.066,1.125-25.981,0.227"/>
          <path fill="none" stroke="#FFFFFF" stroke-miterlimit="10" d="M62.204,24.524c-4.887-0.443-9.553-0.417-13.224,1.126
          c-2.681,1.126-6.719,3.679-10.814,5.408c-4.027,1.699-8.639,3.314-10.815,4.731c-8.592,5.595-9.789,12.845-24.334,9.463
          c2.042,6.604,7.769,9.361,14.063,9.421"/>
        </svg>
        <h1>Bonjour.</h1>
        <!--<h3>I do <span class="icon-camera-retro"></span> with <span class="icon-heart"></span></h3>-->
      </div>
      <a href="#" class="more bounce scrollDown fade" rel="nofollow"></a>
  </section>
  <?php endwhile; ?>
  <?php endif; ?>

  <section id="portfolio">

    <div class="container">

      <div class="row">
        <div class="six columns">
          <h2>best of</h2>
        </div>
        <div class="six columns">
            <div class="custom-navigation flex-nav">
              <a href="#" class="flex-prev btn icn prev">prev</a>
              <a href="#" class="flex-next btn icn next">next</a>
            </div>
        </div>
      </div>

      <div class="row">
        <div class="twelve columns">
          <div class="flexslider">
            <ul class="slides magnificpopup">
              <?php query_posts('cat=4,5,6'); ?>
              <?php if (have_posts()) : ?> 
              <?php while (have_posts()) : the_post(); ?>
              <li>
                <?php $thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'', true); ?>
                <?php echo get_the_post_thumbnail( $page->ID, 'portfolio-thumb' ); ?>
                <?php //echo the_title(); ?>
                <a href="<?php echo $thumb_url[0]; ?>" class="btn icn expand"></a>
              </li>
              <?php endwhile; ?>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="twelve columns">
          <div class="custom-navigation flex-pagger">
            <div class="custom-controls-container"></div>
            </div>
        </div>
      </div>

    </div>
  </div>
</section>

<section id="inter--1" class="parallax winHeight"></section> 


<section id="series">

  <div class="container">

    <div class="row">
      <div class="twelve columns">
        <h2>series</h2>
      </div>
      <ul class="twelve columns isotope">
        <li class="grid-sizer"></li>
        <li class="gutter-sizer"></li>
        <?php query_posts('cat=4,5,6'); ?>
        <?php if (have_posts()) : ?> 
        <?php while (have_posts()) : the_post(); ?>
          <?php if ( in_category(6) ) { ?>
          <li class="wider">
          <?php } else { ?>
          <li>
          <?php } ?>
          <?php $thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'', true); ?>
          
          <figure>
            <?php echo get_the_post_thumbnail( $page->ID, 'portfolio-thumb' ); ?>
            <figcaption>
              <!--<h3><?php the_title(); ?></h3>-->
              <!--<a href="http://lorempixel.com/g/200/200/" class="btn icn expand ajax"></a>-->
              <a href="http://lorempixel.com/g/200/200/" class="btn icn more ajax">more</a>
            </figcaption>
          </figure>
      
        </li>
        <?php endwhile; ?>
        <?php endif; ?>
      </ul>

    </div>

  </section>

  <section id="map" class="winHeight">
    <div id="map-canvas" style="width: 100%; height: 100%"></div>
  </section>



  

   <section>

    <div class="container">

      <div class="row">
        <div class="twelve columns">
          <h2>Series</h2>
        </div>
      </div>

      <div class="row">
        <div class="twelve columns">
          <ul class="grid">
            <li>
              <figure>
                <img src="http://lorempixel.com/g/200/200/" alt="img01">
                <figcaption>
                  <h3>Camera</h3>
                  <span>Jacob Cummings</span>
                  <a href="http://lorempixel.com/g/200/200/">Take a look</a>
                </figcaption>
              </figure>
            </li>

            <li>
              <figure>
                <img src="http://lorempixel.com/g/200/200/" alt="img01">
                <figcaption>
                  <h3>Camera</h3>
                  <span>Jacob Cummings</span>
                  <a href="http://lorempixel.com/g/200/200/">Take a look</a>
                </figcaption>
              </figure>
            </li>

            <li>
              <figure>
                <img src="http://lorempixel.com/g/200/200/" alt="img01">
                <figcaption>
                  <h3>Camera</h3>
                  <span>Jacob Cummings</span>
                  <a href="http://lorempixel.com/g/200/200/">Take a look</a>
                </figcaption>
              </figure>
            </li>

            <li>
              <figure>
                <img src="http://lorempixel.com/g/200/200/" alt="img01">
                <figcaption>
                  <h3>Camera</h3>
                  <span>Jacob Cummings</span>
                  <a href="http://lorempixel.com/g/200/200/">Take a look</a>
                </figcaption>
              </figure>
            </li>
          </ul>
        </div>
      </div>

    </div>

  </section> 



 



  <section id="inter--2" class="parallax winHeight">sdfsf</section> 



  <section id="inter--3" class="parallax winHeight">sdfsdf</section> 

  <section id="contact">
    <?php 
     $id=23; 
      include (TEMPLATEPATH . "/templates/teaser.php"); 
    ?>
  </section>

</div>

	


<?php get_footer(); ?>

  </div><!-- #content -->
  <nav id="meta">
    <?php
    wp_nav_menu(
        array (
            'menu'            => 'meta',
            'container'       => FALSE,
            'container_id'    => FALSE,
            'menu_class'      => '',
            'menu_id'         => FALSE,
            'depth'           => 1,
            'items_wrap'      => '<ul class="%2$s">%3$s</ul>', // %3$s is replaced with the menu items
            'walker'          => ''
        )
    );
    ?>
    <?php get_search_form( true ); ?>
  </nav>

    <div id="map-canvas"></div>

  <!-- footer -->
  <footer>

   <?php $args = array(
        'echo'           => true,
        'redirect' => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
        'form_id'        => 'loginform',
        'label_username' => __( 'Username' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in'   => __( 'Log In' ),
        'id_username'    => 'user_login',
        'id_password'    => 'user_pass',
        'id_remember'    => 'rememberme',
        'id_submit'      => 'wp-submit',
        'remember'       => false,
        'value_username' => '',
        'value_remember' => false
      ); 
    wp_login_form( $args ); ?> 

  </footer>

  <nav id="footer">
    <?php
    wp_nav_menu(
        array (
            'menu'            => 'footer',
            'container'       => FALSE,
            'container_id'    => FALSE,
            'menu_class'      => '',
            'menu_id'         => FALSE,
            'depth'           => 1,
            'items_wrap'      => '<ul class="%2$s">%3$s</ul>', // %3$s is replaced with the menu items
            'walker'          => ''
        )
    );
    ?>
    <a href="#" rel="nofollow" class="btn icn top scrollHome">top</a>
  </nav>
  <!-- Grab Google CDN's jQuery and load local version if necessary -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script type="text/javascript">
    !window.jQuery && document.write('<script src="<?php bloginfo('template_url'); ?>/js/vendor/jquery-1.11.3.min.js"><\/script>')
  </script>
  <script src="https://maps.googleapis.com/maps/api/js"></script>
  <?php wp_footer(); ?> 
  <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
  <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='https://www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X','auto');ga('send','pageview');
  </script>
</body>
</html>
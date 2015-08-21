<!doctype html>
<html <?php language_attributes(); ?> class="no-js" >
<head>
  <title><?php get_perfect_title(); ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="">
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/style.css">
  <!-- Globals -->
  <script type="text/javascript">
  var app_globals = {
    url_base:   '<?php echo get_bloginfo('url'); ?>', 
    url_path:   window.location.pathname, 
    url_hash:   window.location.hash,
    lang:       '<?php get_locale(); ?>',
    markers: [
      {
        lat:        <?php echo get_option('aqua_latitude'); ?>,
        lng:        <?php echo get_option('aqua_longitude'); ?> 
      }
    ]
  }
  </script>
  <?php 

    wp_head();
 ?>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body <?php body_class(); ?> >
  <div id="loader-wrapper">
    <div id="loader"></div>
  </div>
  <div id="overlay"></div>


<?php if ( is_user_logged_in() ) : ?>
<div>
Welcome: <?php 


      global $current_user;
      get_currentuserinfo();
      echo $current_user->user_login;

      ?>

<a href="<?php echo wp_logout_url( home_url() ); ?>" rel="nofollow">Logout</a>

</div>
<?php else: ?>
 
 <a href="<?php echo wp_login_url( $redirect ); ?> ">Login</a>

<?php endif; ?>


  <header>
    <a href="<?php echo home_url(); ?>" title="Return to the homepage" id="logo"><img src="<?php bloginfo('template_url'); ?>/img/logo.png"></a>
    <a href="#" class="hamburger" rel="nofollow"><span></span></a>
    <nav id="main">
    <?php
    wp_nav_menu(
        array (
            'menu'            => 'main',
            'container'       => FALSE,
            'container_id'    => FALSE,
            'menu_class'      => '',
            'menu_id'         => FALSE,
            'depth'           => 2,
            'items_wrap'      => '<ul class="%2$s">%3$s</ul>', // %3$s is replaced with the menu items
            'walker'          => ''
        )
    );
    ?>
    </nav>
  </header>
  <div id="content">
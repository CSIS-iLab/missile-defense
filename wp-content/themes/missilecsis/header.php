<?php
/*-----------------------------------------------------------------------------------*/
/* This template will be called by all other template files to begin 
/* rendering the page and display the header/nav
/*-----------------------------------------------------------------------------------*/
?>
<!DOCTYPE html <?php language_attributes(); ?>>
<html>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title>
<?php bloginfo('name'); // show the blog name, from settings ?> | 
<?php is_front_page() ? bloginfo('description') : wp_title(''); // if we're on the home page, show the description, from the site's settings - otherwise, show the title of the post or page ?>
</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // We are loading our theme directory style.css by queuing scripts in our functions.php file, 
// so if you want to load other stylesheets,
// I would load them with an @import call in your style.css
?>

<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); 
// This fxn allows plugins, and Wordpress itself, to insert themselves/scripts/css/files
// (right here) into the head of your website. 
// Removing this fxn call will disable all kinds of plugins and Wordpress default insertions. 
// Move it if you like, but I would keep it around.
?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-83142345-1', 'auto');
  ga('send', 'pageview');

</script>

</head>

<body 
<?php body_class(); 
// This will display a class specific to whatever is being loaded by Wordpress
// i.e. on a home page, it will return [class="home"]
// on a single post, it will return [class="single postid-{ID}"]
// and the list goes on. Look it up if you want more.
?>
>

<header id="masthead" class="site-header" role="banner">

<div>

<div id="brand">
<a href="/home/" alt="home" >
<img class="logo" src="/wp-content/uploads/2016/07/MissileDefense_logo-02.png" alt="Missile Defense Logo" />
</a>
</div><!-- /brand -->

<div id="nav">
<nav role="navigation" class="site-navigation main-navigation">
<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); // Display the user-defined menu in Appearance > Menus ?>
</nav><!-- .site-navigation .main-navigation -->
</div>

<div class="clear"></div>
</div><!--/container -->
</header><!-- #masthead .site-header -->
<?php putRevSlider('feature', 'homepage'); ?>

<div class="main-fluid"><!-- start the page containter -->

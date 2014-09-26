<?php
/*
 * Header Section of Iconic One
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress - Themonic Framework
 * @subpackage Iconic_One
 * @since Iconic One 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> data-speed="10" data-type="background">
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<?php if ( get_theme_mod( 'themonic_logo' ) ) : ?>
		
		<div class="themonic-logo">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_theme_mod( 'themonic_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
		</div>
	<?php if( get_theme_mod( 'iconic_one_social_activate' ) == '1') {
		the_social_media();
	} ?>

		<?php else : ?>
		<div class="hgroup">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				<br /> <a class="site-description"><?php bloginfo( 'description' ); ?></a>
		</div>
	<?php if( get_theme_mod( 'iconic_one_social_activate' ) == '1') {
		the_social_media();
	} ?>	
		<?php endif; ?>

		<nav id="site-navigation" class="themonic-nav" role="navigation">
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'themonic' ); ?>"><?php _e( 'Skip to content', 'themonic' ); ?></a>
			<?php wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id' => 'menu-top',
				'menu_class' => 'nav-menu',
			) ); ?>
		</nav><!-- #site-navigation -->

		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?><div class="clear"></div>
	</header><!-- #masthead -->

	<div id="main" class="wrapper">

<?php
function the_social_media() {
?>
		<div class="socialmedia">
			<?php
				$tw = get_theme_mod( 'twitter_url' );
				$fb = get_theme_mod( 'facebook_url' );
				$yt = get_theme_mod( 'yt_url' ); // YouTube
				$su = get_theme_mod( 'su_url' ); // StumbleUpon
				$li = get_theme_mod( 'linkedin_url' ); // LinkedIn
				$fl = get_theme_mod( 'flickr_url' ); // Flickr
				$rd = get_theme_mod( 'reddit_url' ); // Reddit
				$gp = get_theme_mod( 'plus_url' );
				$rs = get_theme_mod( 'rss_url' );
				
				$ICON_SIZE = 32;
				$ICON_DIM = "width='$ICON_SIZE'";
			?>
			
			<?php if(!ctype_space($tw) && strlen($tw) > 0) : ?>
			<!-- twitter -->
			<a href="<?php echo $tw; ?>" target="_blank"><span class="genericon genericon-twitter"></span></a>
			<!--<a class="webicon twitter" href="<?php echo $tw; ?>" target="_BLANK">Twitter</a>-->
			<?php endif; ?>
			<?php if(!ctype_space($fb) && strlen($fb) > 0) : ?>
			<!-- facebook -->
			<a href="<?php echo $fb; ?>" target="_blank"><span class="genericon genericon-facebook"></span></a>
			<?php endif; ?>
			<?php if(!ctype_space($yt) && strlen($yt) > 0) : ?>
			<!-- youtube -->
			<a href="<?php echo $yt; ?>" target="_blank"><span class="genericon genericon-youtube"></span></a>
			<?php endif; ?>
			<?php if(!ctype_space($gp) && strlen($gp) > 0) : ?>
			<!-- google+ -->
			<a href="<?php echo $gp; ?>" rel="author" target="_blank"><span class="genericon genericon-googleplus-alt"></span></a>
			<?php endif; ?>
			<?php if(!ctype_space($li) && strlen($li) > 0) : ?>
			<!-- linkedin -->
			<a href="<?php echo $li; ?>" target="_blank"><span class="genericon genericon-linkedin"></span></a>
			<?php endif; ?>
			<?php if(!ctype_space($rd) && strlen($rd) > 0) : ?>
			<!-- reddit -->
			<a href="<?php echo $rd; ?>" target="_blank"><span class="genericon genericon-reddit"></span></a>
			<?php endif; ?>
			<?php if(!ctype_space($su) && strlen($su) > 0) : ?>
			<!-- stumbleupon -->
			<a href="<?php echo $su; ?>" target="_blank"><span class="genericon genericon-stumbleupon"></span></a>
			<?php endif; ?>
			<?php if(!ctype_space($fl) && strlen($fl) > 0) : ?>
			<!-- flickr -->
			<a href="<?php echo $fl; ?>" target="_blank"><span class="genericon genericon-flickr"></span></a>
			<?php endif; ?>
			<?php if(!ctype_space($rs) && strlen($rs) > 0) : ?>
			<!-- rss -->
			<a href="<?php echo $rs; ?>" target="_blank"><span class="genericon genericon-feed"></span></a>
			<?php endif; ?>
		</div>
<?php
}

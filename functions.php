<?php
/**
 * Iconic One Theme's Functions file, this is the heart of theme, modification directly is not recommended.
 * Iconic One Supports Child Themes, it is the way to go.
 * If you want to change design use custom.css, details at themonic.com/iconic-one/
 * Use a child theme for customization (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes).
 * @package WordPress - Themonic Framework
 * @subpackage Iconic_One
 * @since Iconic One 1.0
 * © 2013 Shashank Singh, Themonic.com
 */

/**
 * Primary content width according to the design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 665;

/**
 * Iconic One supported features and Registering defaults
 */
function themonic_setup() {
	/**
	 * Making Iconic One ready for translation.
	 * Translations can be added to the /languages/ directory. Sample iconic-one.pot file is included.
	 */
	load_theme_textdomain( 'themonic', get_template_directory() . '/languages' );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	
	// add theme support for post formats
	add_theme_support( 'post-formats', array(
		'aside',
		'audio',
		'chat',
		'gallery',
		'image',
		'link',
		'quote',
		'status',
		'video',
	) );
	
	$defaults = array(
		'default-image'          => '',
		'random-default'         => false,
		'width'                  => 0,
		'height'                 => 0,
		'flex-height'            => false,
		'flex-width'             => false,
		'default-text-color'     => '',
		'header-text'            => true,
		'uploads'                => true,
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $defaults );


	// Adds support for Navigation menu, Iconic One uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'themonic' ) );
	
	// Iconic One supports custom background color and image using default wordpress funtions.
	add_theme_support( 'custom-background', array(
		'default-color' => 'e8e8e8',
	) );
	
	// add_theme_support( 'infinite-scroll', array(
	//	'container' => 'content',
	//	'footer'    => 'colophon',
	// ) );
	
	add_theme_support( 'html5', array(
		'comment-list',
		'comment-form',
		// 'search-form',
	) );
	
	// TODO: Fix this!!
	// add_editor_style( 'style.css' );

	// Uncomment the following two lines to add support for post thumbnails - for classic blog layout
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 660, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'themonic_setup' );

add_image_size( 'excerpt-thumbnail', 300, 210, true );

 /**
 * Loads the Themonic Customizer for live customization, to learn more visit Themonic.com
 */
 require_once( get_template_directory() . '/inc/themonic-customizer.php' );
 
/**
 * Enqueueing scripts and styles for front-end of the Themonic Framework.
 * @since Iconic One 1.0
 */ 
function themonic_scripts_styles() {
	global $wp_styles;

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/**
	 * Adds Selectnav.js JavaScript for handling the navigation menu and creating a select based navigation for responsive layout.
	 */
	wp_enqueue_script( 'themonic-mobile-navigation', get_template_directory_uri() . '/js/selectnav.js', array(), '1.0', true );

	/**
	* Lightbox support
	*/
	wp_enqueue_style( 'theonic-lightbox-css', get_template_directory_uri() . '/lightbox/css/lightbox.css', array(), null );
	wp_enqueue_script( 'themonic-lightbox-js', get_template_directory_uri() . '/lightbox/js/lightbox-2.6.min.js', array(), null, true );
   
	/**
	 * Retina support
	 */
	wp_enqueue_script( 'themonic-retina', get_template_directory_uri() . '/js/retina-1.1.0.min.js', array(), null, true);
   
	/**
     * Loads the awesome readable Ubuntu font CSS file for Iconic One.
	 */
    // if ( 'off' !== _x( 'on', 'Ubuntu font: on or off', 'themonic' ) ) {
        // $subsets = 'latin,latin-ext';
        // $protocol = is_ssl() ? 'https' : 'http';
        // $query_args = array(
            // 'family' => 'Ubuntu:400,700',
            // 'subset' => $subsets,
        // );
        // wp_enqueue_style( 'themonic-fonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
    // } 
	/**
	 * Loads Themonic's main stylesheet and IE fixes
	 */
	wp_enqueue_style( 'themonic-style', get_template_directory_uri() . '/style.min.css' );
	wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/custom.css' );
	wp_enqueue_style( 'themonic-ie', get_template_directory_uri() . '/css/ie.min.css', array( 'themonic-style' ), '20130305' );
	$wp_styles->add_data( 'themonic-ie', 'conditional', 'lt IE 9' );
	
	// genericons support
	wp_enqueue_style( 'themonic-genericons', get_template_directory_uri() . '/genericons/genericons.min.css' );
}
add_action( 'wp_enqueue_scripts', 'themonic_scripts_styles' );

/*
 * WP Title Filter, refer http://codex.wordpress.org/Plugin_API/Filter_Reference/wp_title
 * @since Iconic One 1.0
 */
function themonic_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'themonic' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'themonic_wp_title', 10, 2 );

/**
 * Default Nav Menu fallback to Pages menu, 
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 * @since Iconic One 1.0
 */
function themonic_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'themonic_page_menu_args' );

/**
 * For all pages requiring post excerpts, displays the posts without any images
 * 	except when there is no featured image.
 * @since Iconic One 1.2.3
 * @author Geoffrey Liu
 */
function wpi_image_content_filter( $content ) {
    if ( !is_single() && ( strcmp( get_post_thumbnail_id( get_the_ID() ), "" ) !== 0 )) {
        $content = preg_replace("/<img[^>]+\>/i", "", $content);
	}
	return $content;
}
add_filter( 'the_content', 'wpi_image_content_filter', 11 );

/*
 * Adds lightbox support to all images in a post
 * @since Iconic One 1.2.3
 * @author Geoffrey Liu
 */
function themonic_lightbox($content) {
       global $post;
       
	   $pattern ="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
       $replacement = '<a$1href=$2$3.$4$5 rel="lightbox" title="' . $post -> post_title . '"$6>';
       $content = preg_replace( $pattern, $replacement, $content );
       
	   return $content;
}
add_filter( 'the_content', 'themonic_lightbox' );

/**
 * Registers the main widgetized sidebar area.
 *
 * @since Iconic One 1.0
 */
function themonic_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'themonic' ),
		'id' => 'themonic-sidebar',
		'description' => __( 'This is a Sitewide sidebar which appears on posts and pages', 'themonic' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<p class="widget-title">',
		'after_title' => '</p>',
	) );
}
add_action( 'widgets_init', 'themonic_widgets_init' );

if ( ! function_exists( 'themonic_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Iconic One 1.0
 */
function themonic_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav class="navigation" id="<?php echo $html_id; ?>" role="navigation">
		<?php
			$bignum = 999999999;
			echo paginate_links( array(
				'base' 			=> str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
				'format' 		=> '',
				'current' 		=> max( 1, get_query_var('paged') ),
				'total' 		=> $wp_query->max_num_pages,
				'prev_text' 	=> '&larr; Previous',
				'next_text' 	=> 'Next &rarr;',
				'type'			=> 'list',
				'end_size'		=> 3,
				'mid_size'		=> 3
			) );
		?>
		</nav>
		<!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;

if ( ! function_exists( 'themonic_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own themonic_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Iconic One 1.0
 */
function themonic_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'themonic' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'themonic' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 30 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// Adds Post Author to comments posted by the article writer
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'themonic' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date */
						sprintf( __( '%1$s', 'themonic' ), get_comment_date() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'themonic' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'themonic' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'themonic' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'themonic_entry_meta' ) ) :
/**
 * For Meta information for categories, tags, permalink, author, and date.
 *
 * Create your own themonic_entry_meta() to override in a child theme.
 *
 * @since Iconic One 1.0
 */
function themonic_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'themonic' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'themonic' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'themonic' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'themonic' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'themonic' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'themonic' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/*
 * WordPress body class Extender :
 * 1. Using a full-width layout without widgets.
 * 2. White or empty background color.
 * 3. Custom fonts enabled.
 * 4. Single or multiple authors.
 *
 * @since Iconic One 1.0
 */
function themonic_body_class( $classes ) {
	$background_color = get_background_color();

	if ( is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';

	if ( empty( $background_color ) )
		$classes[] = 'custom-background-empty';
	elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
		$classes[] = 'custom-background-white';

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'themonic-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'themonic_body_class' );

/*
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Iconic One 1.0
 */
function themonic_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'themonic-sidebar' ) ) {
		global $content_width;
		$content_width = 1040;
	}
}
add_action( 'template_redirect', 'themonic_content_width' );

/**
 * Detects whether the post contains an image. Looks for <img> tag
 * @return boolean
 */

function post_has_image($content) {
	if(strpos($content, "<img ") !== false) { // contains image
		return true;
	}
	return false;
}

/* Iconic One welcome text */
if ( is_admin() && isset($_GET['activated'] ) && $pagenow ==	"themes.php" )
	wp_redirect( 'themes.php?page=iconic_one_theme_options');

// require_once( get_template_directory() . '/inc/iconic-one-options.php' );

function custom_error_pages() {
    global $wp_query;
 
    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 403)
    {
        $wp_query->is_404 = FALSE;
        $wp_query->is_page = TRUE;
        $wp_query->is_singular = TRUE;
        $wp_query->is_single = FALSE;
        $wp_query->is_home = FALSE;
        $wp_query->is_archive = FALSE;
        $wp_query->is_category = FALSE;
        add_filter('wp_title','custom_error_title',65000,2);
        add_filter('body_class','custom_error_class');
        status_header(403);
        get_template_part('403');
        exit;
    }
 
    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 401)
    {
        $wp_query->is_404 = FALSE;
        $wp_query->is_page = TRUE;
        $wp_query->is_singular = TRUE;
        $wp_query->is_single = FALSE;
        $wp_query->is_home = FALSE;
        $wp_query->is_archive = FALSE;
        $wp_query->is_category = FALSE;
        add_filter('wp_title','custom_error_title',65000,2);
        add_filter('body_class','custom_error_class');
        status_header(401);
        get_template_part('401');
        exit;
    }
}
 
function custom_error_title($title='',$sep='') {
    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 403)
        return "Forbidden ".$sep." ".get_bloginfo('name');
 
    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 401)
        return "Unauthorized ".$sep." ".get_bloginfo('name');
}
 
function custom_error_class($classes) {
    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 403)
    {
        $classes[]="error403";
        return $classes;
    }
 
    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 401)
    {
        $classes[]="error401";
        return $classes;
    }
}
 
add_action('wp','custom_error_pages');

function font_size_increase() {
	?>
	<style type="text/css" rel="stylesheet">
		.wp-editor-area { font-size: 16px !important; }
	</style>
	<?php
}
add_action( 'admin_print_styles-post.php', 'font_size_increase' );
add_action( 'admin_print_styles-post-new.php', 'font_size_increase' );
<?php
/*
 * Template for displaying 403 pages.
 * Iconic One displays the list of recent posts and search box for better user experience.
 * @package WordPress - Themonic Framework
 * @subpackage Iconic_One
 * @since Iconic One 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<article id="post-0" class="post error404 no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Error 403: Forbidden!', 'themonic' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'You have wandered into territory which my server will not allow you to go.', 'themonic' ); ?></p>
					<p><?php _e( 'However, feel free to use the search box below', 'themonic' ); ?></p>
					<?php get_search_form(); ?>
					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
					<p><?php _e( 'If you believe something is seriously broken, please <a href="/contact" target="_BLANK">Contact me</a> and I will fix it ASAP.', 'themonic' ); ?></p>
					
					<p><?php _e( '<a href="/blog">Return to Home Page</a>' ); ?></p>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
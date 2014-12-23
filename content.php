<?php
/*
 * Content display template, used for both single and index/category/search pages.
 * Iconic One uses custom excerpts on search, home, category and tag pages.
 * @package WordPress - Themonic Framework
 * @subpackage Iconic_One
 * @since Iconic One 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
			<?php 
				$df = 'd M Y'; // e.g '09 Dec 2013'
				$date = get_the_date( $df );
				list( $day, $month, $year ) = explode( ' ', $date );
			?>
			<div class="entry-date">
				<span class="month"><?php echo $month; ?></span>
				<span class="day"><?php echo $day; ?></span>
				<?php if( $year != date( 'Y' ) ) : ?>
				<span class="year"><?php echo $year; ?></span>
				<?php endif; ?>
			</div>
			<h1 class="entry-title" style="display: inline;">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'themonic' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
		<?php endif; // is_single() ?>
		
		<?php if ( is_single() ) : // for date on single page ?>	
			<div class="below-title-meta">
				<div class="adt">
					<?php _e( 'By', 'themonic' ); ?>
					<span class="author"><?php echo the_author_posts_link(); ?></span>
					<span class="meta-sep">|</span>
					<date><?php echo get_the_date(); ?></date>
				</div>
				<div class="adt-comment">
					<a class="link-comments" href="<?php comments_link(); ?>"><?php comments_number( __('0 Comment','themonic'), __('1 Comment'), __('% Comments') ); ?></a>
				</div>
			</div><!-- .below-title-meta end -->
		<?php endif; // is_single() ?>
		
	</header><!-- .entry-header -->

	<?php if ( is_archive() || is_home() || is_search() ) : // Display Excerpts for Search, home, category and tag pages ?>
	
		<div class="entry-summary">
			<!-- Iconic One home page thumbnail with custom excerpt -->
			<?php if ( (function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) : ?>
				<div class="excerpt-thumb">
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themonic' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
						<?php // display full-size image if post type is image, excerpt size otherwise
							if ( strcmp( get_post_format(), 'image' ) == 0 )
								the_post_thumbnail( 'full' );
							else
								the_post_thumbnail( 'excerpt-thumbnail', 'class=alignleft' );
						?>
					</a>
				</div><!-- .excerpt-thumb -->
			<?php endif; // has_post_thumbnail() ?>
			
			<?php has_excerpt() ? the_excerpt() : the_content( 'Read more &raquo;', false ); ?>
		</div><!-- .entry-summary -->
	<?php else : // not archive or home ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'themonic' ) ); ?>
			<?php wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'themonic' ),
				'after' => '</div>',
			) ); ?>
		</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( count( get_the_category() ) ) : ?>
			<div class="post-taxonomy">
				<span>Filed under <?php the_category( ' &bull; ' ); ?></span>
			</div>
		<?php endif; ?>

		<?php if ( count( get_the_tags() ) > 1 ) : ?>
			<br />
			<div class="post-tags">
				<span><?php the_tags( 'Tagged: ', ', ' ); ?></span>
			</div> 
		<?php endif; // $tag_size > 1 ?>
		
		<?php edit_post_link( __( "\n<br />\nAdmin: Edit" , 'themonic' ), '<span class="edit-link">', '</span>' ); ?>
		<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
			<div class="author-info">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'themonic_author_bio_avatar_size', 92 ) ); ?>
				</div><!-- .author-avatar -->
				<div class="author-description">
					<h2><?php printf( __( 'About %s', 'themonic' ), get_the_author() ); ?></h2>
					<p><?php the_author_meta( 'description' ); ?></p>
					<div class="author-link">
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
							<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'themonic' ), get_the_author() ); ?>
						</a>
					</div><!-- .author-link	-->
				</div><!-- .author-description -->
			</div><!-- .author-info -->
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->

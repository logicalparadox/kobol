<?php
/**
 * @package WordPress
 * @subpackage Kobol
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'kobol' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'kobol' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->

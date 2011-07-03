<?php
/**
 * Template Name: Full-width, no sidebar/title
 * Description: A full-width template with no sidebar or title
 *
 * @package WordPress
 * @subpackage Kobol
 */

get_header(); ?>

		<div id="primary" class="full-width">
			<div id="content" role="main">

				<?php the_post(); ?>

				<?php get_template_part( 'content', 'page-no-title' ); ?>

				<?php comments_template( '', true ); ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
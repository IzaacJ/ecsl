<?php
/**
 * Easy Code Snippets CPT Single Template
 *
 * @package   Easy_CodeSnippet_CPT_Single_Template
 * @since     1.0.0
 * @author    Izaac Johansson [izaac.se]
 * @license   LICENSE.txt
 * @link      http://izaac.se
 * @copyright Copyright © 2015 Izaac Johansson
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php global $post;
				$snippet = get_post_meta($post->ID, '_ecsl');
				?>


			<?php endwhile; // end of the loop. ?>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
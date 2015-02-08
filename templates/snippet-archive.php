<?php
/**
 * Easy Code Snippets CPT Archive Template
 *
 * @package   Easy_CodeSnippet_CPT_Archive_Template
 * @since     1.0.0
 * @author    Izaac Johansson [izaac.se]
 * @license   LICENSE.txt
 * @link      http://izaac.se
 * @copyright Copyright © 2015 Izaac Johansson
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<header class="page-header">
				<h1 id="page-title"><?php echo vantage_get_archive_title() ?></h1>
				<?php
				if ( is_category() ) {
					// show an optional category description
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo apply_filters( 'vantage_category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );
				}
				elseif ( is_tag() ) {
					// show an optional tag description
					$tag_description = tag_description();
					if ( ! empty( $tag_description ) )
						echo apply_filters( 'vantage_tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
				}
				?>
			</header><!-- .page-header -->

			<?php get_template_part( 'loops/loop', siteorigin_setting('blog_archive_layout') ) ?>

		</div><!-- #content .site-content -->
	</section><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
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

                <?php
                $code_only = false;
                $linked = true;
                $rand_id = false;

                $snp = get_post_meta($id, '_ecsl');
                $snippet = $snp[0];
                $title = (get_the_title( $id ) == '' ? 'Untitled #' . ( $rand_id ? randid() : $id ) : get_the_title( $id ) );
                $date = date('M jS Y - H:i', strtotime($post->post_date));
                $author = get_userdata(get_post_field( 'post_author', $id ));
                $lang = $snippet['language'];
                $code = esc_html($snippet['code']);
                $desc = $snippet['description'];
                $perma = get_permalink($id);
                $tags = get_the_term_list($id, 'snippet_tags', '', ', ', '');
                ?>
                <div class="entry-content">
<pre><?=$title;?> - <?=$lang;?><br><hr><?=$desc;?>
<code><?=$code;?></code>Tags: <?=$tags;?><hr>Posted on <?=$date;?> by <?=$author->display_name;?></pre>
                </div>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
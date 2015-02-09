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
				<h1 id="page-title">Snippet Archive</h1>
			</header><!-- .page-header -->

            <?php if ( have_posts() ) : ?>

                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php
                        $code_only = false;
                        $linked = true;
                        $rand_id = false;

                        $snp = get_post_meta($id, '_ecsl');
                        $snippet = $snp[0];
                        $title = (get_the_title( $id ) == '' ? 'Untitled #' . ( $rand_id ? randid() : $id ) : get_the_title( $id ) );
                        $nr = '<sup>#' .$id . '</sup>';
                        $date = date('M jS Y - H:i', strtotime($post->post_date));
                        $author = get_userdata(get_post_field( 'post_author', $id ));
                        $lang = $snippet['language'];
                        $code = esc_html($snippet['code']);
                        $desc = $snippet['description'];
                        $perma = get_permalink($id);
                        $tags = get_the_term_list($id, 'snippet_tags', '', ', ', '');
                    ?>
            <div class="entry-content">
<pre><div style="display: inline-block; float: right;"><a href="<?=$perma;?>"><?=$nr;?></a></div><a href="<?=$perma;?>"><?=$title;?></a> - <?=$lang;?><br><hr><?=$desc;?>
<code><?=$code;?></code>Tags: <?=$tags;?><hr>Posted on <?=$date;?> by <?=$author->display_name;?></pre>
                </div>
                    <?php
                        $html .= '<pre>' . (!$code_only ? ($linked ? '<a href="' . $perma . '">'. $title . '</a>' : $title) . ' - ' . $lang . '<br>' . $desc : '' );
                        $html .= '<code>' . $code . '</code>';
                        $html .= (!$code_only ? 'Tags: ' . $tags . '<br>Posted on ' . $date . ' by ' . $author->display_name : '' ) . '</pre>';
                    ?>
                <?php endwhile; ?>
                <?php vantage_content_nav( 'nav-below' ); ?>
            <?php else : ?>
                <?php get_template_part( 'no-results', 'index' ); ?>
            <?php endif; ?>

		</div><!-- #content .site-content -->
	</section><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
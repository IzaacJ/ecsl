<?
/**
 * Easy Code Snippets CPT Shortcodes
 *
 * @package   Easy_CodeSnippet_CPT_Shortcodes
 * @since     1.0.0
 * @author    Izaac Johansson [izaac.se]
 * @license   LICENSE.txt
 * @link      http://izaac.se
 * @copyright Copyright © 2015 Izaac Johansson
 */

add_shortcode('ecsl-snippet', 'ecsl_snippet');
add_shortcode('ecsl-snippets', 'ecsl_snippets');

/***
 * function ecsl_snippet - Shows a single snippet
 *
 * @param $args - these are the arguments that are valid for this shortcode:
 *                $id - the ID(s) of the code snippet to show
 *
 * @return string - the html that will be printed in place of the shortcode
 */
function ecsl_snippet($atts){
    // UNDER DEVELOPMENT !
	$html = '';
    $atts = shortcode_atts( array(  'id' => -99,
                                    'code_only' => true,
                                    'linked' => true,
                                    'rand_id' => false
            ), $atts );
    $idstr = $atts['id'];
    $code_only = ($atts['code_only'] == 'true' ? true : false);
    $linked = ($atts['linked'] == 'true' ? true : false);
    $rand_id = ($atts['rand_id'] == 'true' ? true : false);
    if(strpos($idstr, ',') == false) {
        if ( get_post_type( $idstr ) !== 'ecsl' ) {
            $idarray = array(- 99);
        }else{
            $idarray = array($idstr);
        }
    }else{
        $idarray = explode(',', $idstr);
    }

		foreach($idarray as $id){
			if(get_post_type( $id ) == 'ecsl' ) {
				$post = get_post($id);
				$snp = get_post_meta($id, '_ecsl');
                $snippet = $snp[0];
                $title = ($post->post_title == '' ? 'Untitled #' . ( $rand_id ? randid() : $id ) : $post->post_title );
                $date = date('M jS Y - H:i', strtotime($post->post_date));
                $author = get_userdata($post->post_author);
                $lang = $snippet['language'];
                $code = esc_html($snippet['code']);
                $desc = $snippet['description'];
                $perma = get_permalink($post->ID);
                $tags = get_the_term_list($post->ID, 'tags', '', ', ', '');
                $html .= '<pre>' . (!$code_only ? ($linked ? '<a href="' . $perma . '">'. $title . '</a>' : $title) . ' - ' . $lang . '<br>' . $desc : '' );
                $html .= '<code>' . $code . '</code>';
                $html .= (!$code_only ? 'Tags: ' . $tags . '<br>Posted on ' . $date . ' by ' . $author->display_name : '' ) . '</pre>';
/*                    $tmp =<<<html
<pre>$title - $lang
$desc
<code>$code</code>Tags: $tags
Posted on $date by $author->display_name</pre>
html; */
			}else{
                $html .= <<<html
<pre>Invalid snippet ID: $idstr</pre>
html;
            }
		}
	return $html;
}

/***
 * function ecsl_snippets - Shows a list of snippets
 *
 * @return string - the html that will be printed in place of the shortcode
 */
function ecsl_snippets($atts) {
    // UNDER DEVELOPMENT !
	$html = '';
    $atts = shortcode_atts( array( 'rand_id' => false ), $atts );
    $rand_id = ($atts['rand_id'] == 'true' ? true : false);
	$args = array(
		'posts_per_page' => -1,
        'post_type' => 'ecsl',
        'post_status' => 'publish'
	);
    $posts = get_posts($args);
    if(is_array($posts)) {
        $html .= <<<html
<div class="section group row-header">
	<div class="col span_2_of_8">Title</div>
	<div class="col span_1_of_8">Date</div>
	<div class="col span_1_of_8">Language</div>
	<div class="col span_1_of_8">Author</div>
	<div class="col span_2_of_8">Description</div>
	<div class="col span_1_of_8">Tags</div>
</div>
html;
		foreach($posts as $post){
			if(get_post_type( $post ) == 'ecsl' ) {
                $snp = get_post_meta($post->ID, '_ecsl');
                $snippet = $snp[0];
                $title = ($post->post_title == '' ? 'Untitled #' . ( $rand_id ? randid() : $post->ID ) : $post->post_title );
                $date = date('M jS Y', strtotime($post->post_date));
				$author = get_userdata($post->post_author)->display_name;
                $link = get_permalink($post->ID);
				$lang = $snippet['language'];
				$desc = $snippet['description'];
                $tags = get_the_term_list($post->ID, 'tags', '', ', ', '');
				$html .= <<<html
<div class="section group row">
    <div class="col span_2_of_8 col-title"><a href="$link" target="_blank">$title</a></div>
    <div class="col span_1_of_8 col-date">$date</div>
    <div class="col span_1_of_8 col-language">$lang</div>
    <div class="col span_1_of_8 col-author">$author</div>
    <div class="col span_2_of_8 col-description">$desc</div>
    <div class="col span_1_of_8 col-tags">$tags</div>
</div>
html;
			}
		}
        return $html;
	}else{
        ob_start();
        var_dump($posts);
        $result = ob_get_clean();
        return '<pre>No snippes found.</pre>';
    }
}

function randid(){
    $ret = '';
    for($i = 0; $i <=5; $i++) {
        $ret .= rand(0, 9);
    }
    return $ret;
}
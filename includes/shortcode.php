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
function ecsl_snippet($args){
    // UNDER DEVELOPMENT !
	$html = '';
	if(in_array('id', $args)) {
		$idstr = int($args['id']);
		if(strpos($idstr, ',') == false) {
			if ( get_post_type( $idstr ) !== 'ecsl' ) {
				$idarray = array(- 99);
			}else{
				$idarray = array($idstr);
			}
		}else{
			$idarray = explode(',', $idstr);
		}
	}else{ $idarray = array(-99); }

	if(in_array(-99, $idarray)) {
        ob_start();
        var_dump($args);
        $result = ob_get_clean();
		return '<pre class="prettyprint">No snippet ID supplied. ARGS: ' . $result . '</pre>';
	}
	if(is_array($idarray)) {
		foreach($idarray as $id){
			if(get_post_type( $id ) == 'ecsl' ) {
				$post = get_post($id);
				$snippet = get_post_meta($id, '_ecsl');
                $title = $post->post_title();
                $date = $post->post_date();
                $author = get_userdata($post->post_author());
                $lang = $snippet['language'];
                $code = $snippet['code'];
                $desc = $snippet['description'];
                $html = <<<html
<h2>$title</h2>
Posted on <span>$date</span> by <span>$author->first_name $author->last_name</span>
<pre class="prettyprint">$code</pre>
html;
			}
		}
	}
	return $html;
}

/***
 * function ecsl_snippets - Shows a list of snippets
 *
 * @return string - the html that will be printed in place of the shortcode
 */
function ecsl_snippets() {
    // UNDER DEVELOPMENT !
	$html = '';
	$args = array(
		'posts_per_page' => 25,
        'post_type' => 'ecsl',
        'post_status' => 'published'
	);
    $posts = get_posts($args);
    if(is_array($posts)) {
		foreach($posts as $post){
			if(get_post_type( $post ) == 'ecsl' ) {
				$snippet = get_post_meta($post->ID, '_ecsl');
				$title = $post->post_title();
                $date = $post->post_date();
				$author = get_userdata($post->post_author());
				$lang = $snippet['language'];
				$code = $snippet['code'];
				$desc = $snippet['description'];
				$html .= <<<html
<h2>$title</h2>
Posted on <span>$date</span> by <span>$author->first_name $author->last_name</span>
<pre class="prettyprint">$code</pre>
html;
			}
		}
	}else{
        ob_start();
        var_dump($posts);
        $result = ob_get_clean();
        return '<pre class="prettyprint">No snippet ID supplied. ARGS: ' . $result . '</pre>';
    }
    return $html;
}

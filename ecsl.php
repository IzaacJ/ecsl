<?
/*
Plugin Name: Easy Code Snippets Library
Description: A code snippet custom post-type with archive/single/loop page and shortcodes.
Plugin URI: http://izaac.se
Author: Izaac Johansson
Author URI: http://izaac.se
Donate link: Coming Soon !
Version: 1.0.0
*/
define( 'ECSL_VERSION', '1.0.0' );
define( 'ECSL_HOME_URL', 'http://izaac.se' );
define( 'ECSL_AUTHOR', 'Izaac Johansson' );
define( 'ECSL_AUTHOR_URL', 'http://izaac.se' );
define( 'ECSL_AUTHOR_EMAIL', 'me@izaac.se' );

// Define internal plugin paths
define( 'ECSL_PATH', plugin_dir_path(__FILE__) );
define( 'ECSL_URL', plugin_dir_url(__FILE__) );
define( 'ECSL_PATH_TEMPLATE', plugin_dir_path( __FILE__ ) . 'templates/' );
define( 'ECSL_PATH_INCLUDES', plugin_dir_path( __FILE__ ) . 'includes/' );
define( 'ECSL_URL_INCLUDES', plugins_url( 'includes/', __FILE__ ));
define( 'ECSL_PATH_METABOXES', plugin_dir_path( __FILE__ ) . 'includes/metaboxes/' );
define( 'ECSL_URL_CSS', ECSL_URL_INCLUDES . 'css/' );
define( 'ECSL_URL_JS', ECSL_URL_INCLUDES . 'js/' );

include( ECSL_PATH_INCLUDES . 'wpalchemy/MetaBox.php' );
include( ECSL_PATH_INCLUDES . 'helpers.php' );
include( ECSL_PATH_INCLUDES . 'post-type.php' );
include( ECSL_PATH_INCLUDES . 'shortcode.php' );

add_filter('template_include', 'my_template');

add_action( 'admin_enqueue_scripts', 'enqueue_scripts_styles' );
add_action( 'wp_enqueue_scripts', 'enqueue_scripts_styles' );
add_action( 'wp_ajax_ij_codesnippet-ace-ajax', 'ace_ajax' );

add_action( 'wp_head', 'initiate_highlighter' );

function initiate_highlighter() {
    echo '<script>hljs.initHighlightingOnLoad();</script>';
}

function my_template($template) {
	if( get_query_var('post_type') == 'easycodesnippet' ) {
		if ( is_single() ) {
			return ECSL_PATH_TEMPLATE . 'snippet-single.php';
		} elseif ( is_archive() || is_search() ) {
			return ECSL_PATH_TEMPLATE . 'snippet-archive.php';
		}
	}
	return $template;
}

function enqueue_scripts_styles()
{
	if(is_admin()) {
		wp_register_style( 'acsl-ace_css', ECSL_URL_CSS . 'ace/ace.css', null, '1.0' );
		wp_register_script( 'ecsl-ace_editor', ECSL_URL_JS . 'ace/ace.js', array( 'jquery' ), '1.0', true );
		wp_register_script( 'ecsl-admin-js', ECSL_URL_JS . 'ecsl-admin.js', array( 'jquery', 'ace_editor' ), '1.0', true );
        wp_enqueue_script( 'ecsl-ace_editor' );

        wp_register_style( 'ecsl-shortcode', ECSL_URL_CSS . 'shortcode.css' );
        wp_enqueue_style( 'ecsl-shortcode' );


        wp_register_script( 'ecsl-highlighter-js', '//cdn.jsdelivr.net/highlight.js/8.4/highlight.min.js' );
        wp_register_style( 'ecsl-highlighter-css', '//cdn.jsdelivr.net/highlight.js/8.4/styles/default.min.css');
        wp_enqueue_script( 'ecsl-highlighter-js' );
        wp_enqueue_style( 'ecsl-highlighter-css' );

        wp_enqueue_script( 'ecsl-js', ECSL_URL_JS . 'ecsl.js' );

		$current_user = wp_get_current_user();
		wp_localize_script( 'ecsl-admin-js', 'ace_editor_globals', array(
			'nonce' => wp_create_nonce( 'ace_editor_nonce' ),
			'labels' => array(
				'default' => __( 'Change Theme:' ),
				'saving' => __( 'Saving...' )
			),
			'theme' => get_user_meta( $current_user->ID, 'ecsl-ace-editor-theme', true )
		) );
		wp_enqueue_script( 'ecsladmin-js' );
	}else {
        wp_register_script( 'ecsl-highlighter-js', '//cdn.jsdelivr.net/highlight.js/8.4/highlight.min.js' );
        wp_register_style( 'ecsl-highlighter-css', '//cdn.jsdelivr.net/highlight.js/8.4/styles/default.min.css');
        wp_enqueue_script( 'ecsl-highlighter-js' );
        wp_enqueue_style( 'ecsl-highlighter-css' );

        wp_register_style( 'ecsl-shortcode', ECSL_URL_CSS . 'shortcode.css' );
        wp_enqueue_style( 'ecsl-shortcode' );

        wp_enqueue_script( 'ecsl-js', ECSL_URL_JS . 'ecsl.js' );
	}
}

function ace_ajax(){
	if( ! wp_verify_nonce( $_REQUEST['nonce'], 'ace_editor_nonce' ) ){
		wp_send_json_error( array(
			'message' => __( 'Security failure' )
		) );
	}

	$current_user = wp_get_current_user();
	$new_theme = $_POST['theme'];
	$nonce = wp_create_nonce( 'ace_editor_nonce' );
	$result = update_user_meta( $current_user->ID, 'ecsl-ace-editor-theme', $new_theme );
	if ( false === $result ){
		wp_send_json_error( array(
			'nonce' => $nonce,
			'message' => __( 'Error inserting user data' )
		) );
	}

	wp_send_json_success( array(
		'nonce' => $nonce,
		'theme' => $new_theme
	) );
}

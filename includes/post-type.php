<?php
/**
* Register Custom Post Types and Custom taxonomies.
*
* @package   Easy_CodeSnippet_CPT
* @since     1.0.0
* @author    Izaac Johansson [izaac.se]
* @license   LICENSE.txt
* @link      http://izaac.se
* @copyright Copyright © 2015 Izaac Johansson
*/

add_action( 'init', 'my_custom_post_types' );
function my_custom_post_types()
{
	$labels = array(
		'name' => 'Easy Code Snippets',
		'singular_name' => 'Easy Code Snippet',
		'menu_name' => 'Easy Code Snippets Library',
		'all_items' => 'All Snippets',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Snippet',
		'edit_item' => 'Edit Snippet',
		'new_item' => 'New Snippet',
		'view_item' => 'View Snippet',
		'search_items' => 'Search Snippets',
		'not_found' =>  'No snippets found.',
		'not_found_in_trash' => 'No snippets found in Trash.',
		'parent_item_colon' => 'Parent Snippet',
	);

	$args = array(
		'label' => __( 'ecsl' ),
		'description' => __( 'Easy Code Snippet' ),
		'labels' => $labels,
		'supports' => array( 'title', 'comments', 'excerpt' ),
		'taxonomies' => array( 'tags' ),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-media-text',
		'can_export' => true,
		'has_archive' => 'snippets',
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'rewrite' => array(
			'slug' => 's'
		)
	);
	register_post_type( 'ecsl', $args );
	flush_rewrite_rules();
}

// Add Tags taxonomy
function custom_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Snippet Tags', 'Taxonomy General Name' ),
        'singular_name'              => _x( 'Snippet Tag', 'Taxonomy Singular Name' ),
        'menu_name'                  => __( 'Snippet Tags' ),
        'all_items'                  => __( 'All Snippet Tags' ),
        'parent_item'                => __( 'Parent Snippet Tag' ),
        'parent_item_colon'          => __( 'Parent Snippet Tag:' ),
        'new_item_name'              => __( 'New Snippet Tag' ),
        'add_new_item'               => __( 'Add New Snippet Tag' ),
        'edit_item'                  => __( 'Edit Snippet Tag' ),
        'update_item'                => __( 'Update Snippet Tag' ),
        'separate_items_with_commas' => __( 'Separate snippet tags with commas' ),
        'search_items'               => __( 'Search Snippet Tags' ),
        'add_or_remove_items'        => __( 'Add or remove snippet tags' ),
        'choose_from_most_used'      => __( 'Choose from the most used snippet tags' ),
        'not_found'                  => __( 'Not Found' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite' => array(
            'slug' => 'snippets'
        )
    );
    register_taxonomy( 'snippet_tags', array( 'ecsl' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_taxonomy', 0 );

$snippet = new WPAlchemy_MetaBox(array(
	'id' => '_ecsl',
	'title' => 'Easy Code Snippet',
	'template' => ECSL_PATH_METABOXES . 'codesnippet.php',
	'types' => array('ecsl')
));

// Change title of the excerpt metabox for our CPT
add_action( 'admin_init',  'change_excerpt_box_title' );
function change_excerpt_box_title() {
    remove_meta_box( 'postexcerpt', 'ecsl', 'side' );
    add_meta_box('postexcerpt', __('Short Description'), 'post_excerpt_meta_box', 'ecsl', 'normal', 'high');
}
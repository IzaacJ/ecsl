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
		'supports' => array( 'title', 'comments' ),
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
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'rewrite' => array(
			'slug' => 'ecsl'
		)
	);
	register_post_type( 'ecsl', $args );
	flush_rewrite_rules();
}

// Add Tags taxonomy
function custom_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Tags', 'Taxonomy General Name' ),
        'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name' ),
        'menu_name'                  => __( 'Tags' ),
        'all_items'                  => __( 'All Tags' ),
        'parent_item'                => __( 'Parent Tag' ),
        'parent_item_colon'          => __( 'Parent Tag:' ),
        'new_item_name'              => __( 'New Tag' ),
        'add_new_item'               => __( 'Add New Tag' ),
        'edit_item'                  => __( 'Edit Tag' ),
        'update_item'                => __( 'Update Tag' ),
        'separate_items_with_commas' => __( 'Separate tags with commas' ),
        'search_items'               => __( 'Search Tags' ),
        'add_or_remove_items'        => __( 'Add or remove tags' ),
        'choose_from_most_used'      => __( 'Choose from the most used tags' ),
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
    );
    register_taxonomy( 'tags', array( 'ecsl' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_taxonomy', 0 );

$snippet = new WPAlchemy_MetaBox(array(
	'id' => '_ecsl',
	'title' => 'Easy Code Snippet',
	'template' => ECSL_PATH_METABOXES . 'codesnippet.php',
	'types' => array('ecsl')
));
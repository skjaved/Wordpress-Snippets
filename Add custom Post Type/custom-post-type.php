<?php
/**
 * Add custom Career post type to wordpress with custom taxonomy
 */

//Register Custom Post Type
function register_career_post_type() {

	$labels = array(
		'name'                  => _x( 'Careers', 'Post Type General Name', 'text-domain' ),
		'singular_name'         => _x( 'Career', 'Post Type Singular Name', 'text-domain' ),
		'menu_name'             => __( 'Careers', 'text-domain' ),
		'name_admin_bar'        => __( 'Career', 'text-domain' ),
		'archives'              => __( 'Career Archives', 'text-domain' ),
		'attributes'            => __( 'Career Attributes', 'text-domain' ),
		'parent_item_colon'     => __( 'Parent Career:', 'text-domain' ),
		'all_items'             => __( 'All Careers', 'text-domain' ),
		'add_new_item'          => __( 'Add New Career', 'text-domain' ),
		'add_new'               => __( 'Add New Career', 'text-domain' ),
		'new_item'              => __( 'New Career', 'text-domain' ),
		'edit_item'             => __( 'Edit Career', 'text-domain' ),
		'update_item'           => __( 'Update Career', 'text-domain' ),
		'view_item'             => __( 'View Career', 'text-domain' ),
		'view_items'            => __( 'View Careers', 'text-domain' ),
		'search_items'          => __( 'Search Career', 'text-domain' ),
		'not_found'             => __( 'Not found', 'text-domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text-domain' ),
		'featured_image'        => __( 'Featured Image', 'text-domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text-domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text-domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text-domain' ),
		'insert_into_item'      => __( 'Insert into Career', 'text-domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Career', 'text-domain' ),
		'items_list'            => __( 'Careers list', 'text-domain' ),
		'items_list_navigation' => __( 'Careers list navigation', 'text-domain' ),
		'filter_items_list'     => __( 'Filter Careers list', 'text-domain' ),
	);
	$args = array(
		'label'                 => __( 'Career', 'text-domain' ),
		'description'           => __( 'Theme Careers', 'text-domain' ),
		'labels'                => $labels,
		'show_in_rest' 			=> true, // To display in gutenberg editor
		'supports'              => array( 'title', 'editor', 'page-attributes', 'revisions' ),
		//'taxonomies'            => array( 'category', 'post_tag' ), //disabled to add custom taxonomy support
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-testimonial',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'rewrite' 				=> true,
	);
	register_post_type( 'career', $args );

}
add_action( 'init', 'register_career_post_type', 0 );

// Register Custom Taxonomy
function career_departments() {

	$labels = array(
		'name'                       => _x( 'Departments', 'Taxonomy General Name', 'text-domain' ),
		'singular_name'              => _x( 'Department', 'Taxonomy Singular Name', 'text-domain' ),
		'menu_name'                  => __( 'Department', 'text-domain' ),
		'all_items'                  => __( 'All Departments', 'text-domain' ),
		'parent_item'                => __( 'Parent Department', 'text-domain' ),
		'parent_item_colon'          => __( 'Parent Department:', 'text-domain' ),
		'new_item_name'              => __( 'New Department Name', 'text-domain' ),
		'add_new_item'               => __( 'Add New Department', 'text-domain' ),
		'edit_item'                  => __( 'Edit Department', 'text-domain' ),
		'update_item'                => __( 'Update Department', 'text-domain' ),
		'view_item'                  => __( 'View Department', 'text-domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text-domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text-domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text-domain' ),
		'popular_items'              => __( 'Popular Items', 'text-domain' ),
		'search_items'               => __( 'Search Departments', 'text-domain' ),
		'not_found'                  => __( 'Not Found', 'text-domain' ),
		'no_terms'                   => __( 'No departments', 'text-domain' ),
		'items_list'                 => __( 'Departments list', 'text-domain' ),
		'items_list_navigation'      => __( 'Departments list navigation', 'text-domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'query_var'                  => true,
		'show_in_rest' 				 => true,
		'rewrite'					 => array( 'slug'	=>	'department' ),
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'department', array( 'career' ), $args );

}
add_action( 'init', 'career_departments', 0 );
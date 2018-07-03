<?php
// Add Post Type: Distributors.
add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_cpts() {
	$labels = array(
		"name" => __( "Distributors", 'wz-distributor'),
		"singular_name" => __( "Distributor", 'wz-distributor'),
		"menu_name" => __( "Distributor", 'wz-distributor'),
		"all_items" => __( "All Distributors", 'wz-distributor'),
		"add_new" => __( "Add Distributor", 'wz-distributor'),
		"add_new_item" => __( "Add New Distributor", 'wz-distributor'),
		"edit_item" => __( "Edit", 'wz-distributor'),
		"new_item" => __( "New Distributor", 'wz-distributor'),
		"view_item" => __( "View", 'wz-distributor'),
		"view_items" => __( "View", 'wz-distributor'),
		"search_items" => __( "Search Distributors", 'wz-distributor'),
		"not_found" => __( "No Distributor found", 'wz-distributor'),
		"not_found_in_trash" => __( "No Distributor found in trash", 'wz-distributor'),
		"featured_image" => __( "Featured image for Distributor", 'wz-distributor'),
		"set_featured_image" => __( "Set featured image for Distributor", 'wz-distributor'),
		"remove_featured_image" => __( "Remove featured image for Distributor", 'wz-distributor'),
		"use_featured_image" => __( "Use featured image for Distributor", 'wz-distributor'),
		"archives" => __( "Distributor archives", 'wz-distributor'),
		"insert_into_item" => __( "Insert into Distributor", 'wz-distributor'),
		"uploaded_to_this_item" => __( "Uploaded to Distributor", 'wz-distributor'),
		"filter_items_list" => __( "Filter Distributor list", 'wz-distributor'),
		"items_list_navigation" => __( "Distributor list navigation", 'wz-distributor'),
		"items_list" => __( "Distributor list", 'wz-distributor'),
		"attributes" => __( "Distributor Attributes", 'wz-distributor'),
	);
	$args = array(
		"label" => __( "Distributors", 'wz-distributor'),
		"labels" => $labels,
		"description" => __("Create list Distributor contact page for wordpress.", 'wz-distributor'),
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => array( "slug" => "wz_distributor", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 26,
		"menu_icon" => "dashicons-businessman",
		"supports" => array( "title", "thumbnail" ),
	);
	register_post_type( "wz_distributor", $args );
}


/* Add Taxonomy: Role for Distributor */
add_action( 'init', 'cptui_register_my_taxes' );
function cptui_register_my_taxes() {
	$labels = array(
		"name" => __( "Role", 'wz-distributor'),
		"singular_name" => __( "Role", 'wz-distributor'),
		"menu_name" => __( "Role", 'wz-distributor'),
		"all_items" => __( "All Role", 'wz-distributor'),
		"edit_item" => __( "Edit Role", 'wz-distributor'),
		"view_item" => __( "View Role", 'wz-distributor'),
		"update_item" => __( "Update Role", 'wz-distributor'),
		"add_new_item" => __( "Add New Role", 'wz-distributor'),
		"new_item_name" => __( "New Role", 'wz-distributor'),
		"parent_item" => __( "Parent Role", 'wz-distributor'),
		"parent_item_colon" => __( "Parent Role", 'wz-distributor'),
		"search_items" => __( "Search Role", 'wz-distributor'),
		"popular_items" => __( "Popular Role", 'wz-distributor'),
		"add_or_remove_items" => __( "Add or Remove Role", 'wz-distributor'),
		"not_found" => __( "No role found", 'wz-distributor'),
		"no_terms" => __( "No role", 'wz-distributor'),
		"items_list_navigation" => __( "Role list navigation", 'wz-distributor'),
		"items_list" => __( "Role list", 'wz-distributor'),
	);
	$args = array(
		"label" => __( "Role", 'wz-distributor'),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Role",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'role_member', 'with_front' => true,  'hierarchical' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "role_member",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "role_member", array( "wz_distributor" ), $args );
}


/* Add Default Terms: new member for Distributor */
add_action( 'init', 'register_new_terms' );
function register_new_terms() {
	$taxonomy = 'role_member';
	$terms = array (
		'0' => array (
			'name'          => 'New Member',
			'slug'          => 'new-member',
			'description'   => 'New member level',
		),
	);
	foreach ( $terms as $term_key=>$term) {
			wp_insert_term(
				$term['name'],
				$taxonomy, 
				array(
					'description'   => $term['description'],
					'slug'          => $term['slug'],
				)
			);
		unset( $term ); 
	}
}

function set_default_object_terms( $post_id, $post ) {
	if ( 'publish' === $post->post_status && $post->post_type === 'wz_distributor' ) {
		$defaults = array(
			'role_member' => array( 'new-member' )
			);
		$taxonomies = get_object_taxonomies( $post->post_type );
		foreach ( (array) $taxonomies as $taxonomy ) {
			$terms = wp_get_post_terms( $post_id, $taxonomy );
			if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
				wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
			}
		}
	}
}
add_action( 'save_post', 'set_default_object_terms', 0, 2 );

/* Add custom field to Distributor post type */
require_once( dirname( __FILE__ ) . '/vendor/advanced-custom-fields/acf.php');
define( 'ACF_LITE', true );
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_info-distributor',
		'title' => 'Info Distributor',
		'fields' => array (
			array (
				'key' => 'field_5b39e78c1a313',
				'label' => 'Distributor ID',
				'name' => 'distributor_id',
                'type' => 'text',
                'instructions' => '"insert for Distributor ID"',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b39e8c71a315',
				'label' => 'Line',
				'name' => 'line',
				'type' => 'text',
				'instructions' => 'Sample link "https://line.me/R/ti/p/%40walnutztudio"',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b39ebef1a316',
				'label' => 'Instragram',
				'name' => 'instragram',
				'type' => 'text',
				'instructions' => 'Sample link "https://www.instagram.com/walnutztudio/"',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b39ec021a317',
				'label' => 'Facebook',
				'name' => 'facebook',
				'type' => 'text',
				'instructions' => 'Sample link "https://www.facebook.com/walnutztudio"',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b39ec0c1a318',
				'label' => 'Website',
				'name' => 'website',
				'type' => 'text',
				'instructions' => 'Sample link "https://walnutztudio.com"',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'wz_distributor',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}